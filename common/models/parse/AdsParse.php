<?php
namespace common\models\parse;

use Yii;
use yii\base\Model;
use yii\imagine\Image;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use Imagine\Image\Box;
use common\models\Ads;
use common\models\User;
use common\models\CarGeneration;
use common\models\CarModification;
use common\models\CarSerie;
use common\models\GeoCity;
use common\models\CarMark;
use common\models\CarModel;
use common\models\forms\AdsCarCharacteristicForm;
use phpnt\cropper\models\Photo;


class AdsParse extends Model
{
    const Active = 1;
    const Hidden = 0;

    public function rules()
    {
        $items = [];

        return $items;
    }

    public function create($data)
    {
        if($user = $this->createUser($data)) {
            if($ad = $this->createAdvertisement($data, $user->id)) {

                $this->createAdCharacteristic($ad->id_car_modification, $ad->id);
                $this->uploadPhotos($user->id, $ad->id);

                return true;
            } else {
                $this->deleteUser($user->id);
            }

        } else {

            return false;
        }

    }

    //Create fake user
    protected function createUser($user_data)
    {
        $user = User::findOne(['phone' => $user_data['phone']]);

        if(!$user && $user_data){
            $user = new User();

            $user->username = uniqid();
            $user->phone = $user_data['phone'];
            $user->first_name = $user_data['first_name'];
            $user->last_name = $user_data['last_name'];
            $user->email = isset($user_data['email']) ? $user_data['email'] : uniqid().'@gmail.com';
            $user->status = self::Active;
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->is_real = 0;
            $user->created_at = strtotime(date('Y-m-d H:i:s'));
            $user->updated_at = strtotime(date('Y-m-d H:i:s'));

            return $user->save() ? $user : false;
        }

        return false;
    }

    //Create new Advertisement
    protected function createAdvertisement($ad_data, $user_id)
    {
        if($ad_data){

            $ad = new Ads();

            $mark = CarMark::findOne(['name' => $ad_data['car_mark']]);
            $model = CarModel::findOne(['name' => $ad_data['car_model']]);
            $city = GeoCity::findOne(['name_ru' => $ad_data['city']]);

            if($mark && $model && $city){

                if(isset($ad_data['generation']) && $ad_data){
                    $car_generation = CarGeneration::findOne([
                        'name' => $ad_data['generation'],
                        'id_car_model' => $model->id_car_model]
                    );
                }

                if(isset($ad_data['serie']) && $ad_data && isset($car_generation)){
                    $car_serie = CarSerie::findOne([
                        'name' => $ad_data['serie'],
                        'id_car_model' => $model->id_car_model,
                        'id_car_generation' => $car_generation->id_car_generation
                    ]);
                }

                if(isset($ad_data['modification']) && $ad_data['modification'] && isset($car_serie)){
                    $car_modification = CarModification::findOne([
                        'id_car_serie' => $car_serie->id_car_serie,
                        'id_car_model' => $model->id_car_model
                    ]);
                }

                $ad->id_car_mark = $mark->id_car_mark;
                $ad->id_car_model = $model->id_car_model;
                $ad->mileage = $ad_data['mileage'];
                $ad->desc = isset($ad_data['description']) ? $ad_data['description'] : '';
                $ad->price = $ad_data['price'];
                $ad->user_id = $user_id;
                $ad->city_id = $city->id;
                $ad->year = $ad_data['year'];
                $ad->temp = self::Hidden;
                $ad->created_at = strtotime(date('Y-m-d H:i:s'));
                $ad->updated_at = strtotime(date('Y-m-d H:i:s'));
                $ad->id_car_generation = isset($car_generation) ? $car_generation->id_car_generation : null;
                $ad->id_car_serie = isset($car_serie) ? $car_serie->id_car_serie : null;
                $ad->id_car_modification = isset($car_modification) ? $car_modification->id_car_modification : null;

                return $ad->save() ? $ad : false;
            }

            return false;
        }

        return false;
    }

    //Create car characteristic
    protected function createAdCharacteristic($id_car_modification, $ad_id)
    {
        $modelAdsCarCharacteristic = new AdsCarCharacteristicForm();

        $modelAdsCarCharacteristic->id_car_modification = $id_car_modification;
        $modelAdsCarCharacteristic->ads_id = $ad_id;
        $modelAdsCarCharacteristic->save();
    }

    //Upload Photos with watermark to advertisement
    protected function uploadPhotos($user_id, $ad_id)
    {
        $photos = UploadedFile::getInstancesByName('photo');

        if($photos) {
            foreach($photos as $key => $photo) {

                $baseUrl = '@webroot';
                $imagePath = '/uploads/car/';
                $md5_1 = \Yii::$app->security->generateRandomString(2);
                $md5_2 = \Yii::$app->security->generateRandomString(2);

                $smallFileName = time() . '_' . $user_id . '_small.' . $photo->extension;
                $fileName = time() . '_' . $user_id . '.' . $photo->extension;

                $modelPhoto = new Photo();
                $modelPhoto->file = $imagePath . $md5_1 . '/' . $md5_2 . '/' . $fileName;
                $modelPhoto->file_small = $imagePath . $md5_1 . '/' . $md5_2 . '/' . $smallFileName;
                $modelPhoto->type = $key == 0 ? 'mainAds' : 'imagesAds';
                $modelPhoto->object_id = $ad_id;
                $modelPhoto->user_id = $user_id;

                $modelPhoto->save();

                FileHelper::createDirectory(\Yii::getAlias($baseUrl)
                    . $imagePath . $md5_1 . '/' . $md5_2 . '/', $mode = 509);

                $photo->saveAs(\Yii::getAlias($baseUrl)
                    . $imagePath . $md5_1 . '/' . $md5_2 . '/' . $fileName);

                $image = Image::getImagine();

                $newImage = $image->open(\Yii::getAlias($baseUrl)
                    . $imagePath . $md5_1 . '/' . $md5_2 . '/' . $fileName);

                $newImage->thumbnail(new Box(750, 750))
                    ->save(\Yii::getAlias($baseUrl) . $imagePath
                        . $md5_1 . '/' . $md5_2 . '/' . $smallFileName);

                $this->overlayWatermark(\Yii::getAlias($baseUrl) . $modelPhoto->file);
                $this->overlayWatermark(\Yii::getAlias($baseUrl) . $modelPhoto->file_small);
            }
        }
    }

    protected function overlayWatermark($imagePath)
    {
        $image = Image::getImagine()
            ->open($imagePath);
        $imageSize = $image->getSize();
        $watermarkNewWidth = $imageSize->getWidth() / 3;
        $watermark = Image::getImagine()
            ->open(\Yii::getAlias('@frontend') . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR
                . 'logo_raketos.png');
        $watermarkSize = $watermark->getSize();
        $watermarkScaleRatio = $watermarkSize->getWidth() / $watermarkNewWidth;
        $watermark = $watermark->thumbnail(new Box($watermarkNewWidth,
            $watermarkSize->getHeight() / $watermarkScaleRatio));
        $watermarkSize = $watermark->getSize();
        Image::watermark($image, $watermark, [
            $imageSize->getWidth() - $watermarkSize->getWidth() - 10,
            $imageSize->getHeight() - $watermarkSize->getHeight() - 10
        ])
            ->save();
    }

    //Delete user by id
    protected function deleteUser($user_id)
    {
        $user = User::findOne($user_id);

        if($user && $user->delete()){

            return true;
        }

        return true;

    }

    //Delete advertisement by id
    protected function deleteAdvertisement($ad_id)
    {
        $ad = Ads::findOne($ad_id);

        if($ad && $ad->delete()){

            return true;
        }

        return true;

    }

}