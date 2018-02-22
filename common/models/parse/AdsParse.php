<?php
namespace common\models\parse;

use Yii;
use yii\base\Model;
use common\models\Ads;
use common\models\User;
use common\models\GeoCity;
use common\models\CarMark;
use common\models\CarModel;
use common\models\AdsCarCharacteristic;


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
                $ad_characteristic = new AdsCarCharacteristic();
                $ad_characteristic->ads_id = $ad->id;
                $ad_characteristic->save();

                $this->uploadPhotos($data);

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

                return $ad->save() ? $ad : false;
            }

            return false;
        }

        return false;
    }

    //Upload Photos with watermark to advertisement
    protected function uploadPhotos()
    {
        //TODO
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