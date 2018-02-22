<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 18.03.2017
 * Time: 15:30
 */

namespace common\models\extend;

use common\models\AdsCarCharacteristic;
use common\models\AdsTariff;
use common\models\CarCharacteristicValue;
use Yii;
use common\models\Ads;
use common\models\CarGeneration;
use common\models\CarMark;
use common\models\CarModel;
use common\models\CarModification;
use common\models\CarSerie;
use common\models\Constants;
use common\models\GeoCity;
use common\models\Rating;
use phpnt\cropper\models\Photo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * @property array $allImagesList
 * @property array $characteristicValueList
 * @property array $colorList
 * @property integer $countMark
 * @property array $cylinderArrangementList
 * @property array $driveUnitList
 * @property array $ecoStandardList
 * @property array $equipmentList
 * @property array $engineTypeList
 * @property array $fuelGradeList
 * @property array $gearboxTypeList
 * @property array $generationList
 * @property array $inletTypeList
 * @property array $isPaidList
 * @property array $markList
 * @property array $modelList
 * @property array $modificationList
 * @property array $numberOfGearsList
 * @property array $numberOfCylindersList
 * @property array $numberOfValvesPerCylinderList
 * @property integer $ratingCalculate
 * @property array $serieList
 * @property array $stateList
 * @property array $tariffList
 * @property string $statusAds
 * @property array $statusList
 * @property array $yearList
 * @property Photo $imageMain
 * @property Photo[] $imagesMain
 * @property Photo[] $imagesOther
 *
 * @property CarGeneration $generation
 * @property CarMark $mark
 * @property CarModel $model
 * @property CarModification $modification
 * @property CarSerie $serie
 * @property GeoCity $cityAds
 * @property Rating $ratingAds
 * @property Rating $deleteRatingAds
 * @property AdsCarCharacteristic $adsCarCharacteristic
 * @property CarCharacteristicValue[] $characteristicValues
 */

class AdsExtend extends Ads
{
    public function getCountMark()
    {
        return self::find()->where(['id_car_mark' => $this->id_car_mark])->count();
    }

    public function getAllImagesList()
    {
        $item = [];
        foreach ($this->imagesMain as $one) {
            /* @var $one Photo */
            $item[] .= $one->file_small;
        }

        foreach ($this->imagesOther as $one) {
            /* @var $one Photo */
            $item[] .= $one->file_small;
        }

        return $item;
    }

    public function getItemsCarousel($images)
    {
        $items = [];
        $i = 0;
        //dd($images);
        if ($images) {
            foreach ($images as $image) {
                $items[$i] = ['content' => '<img class="animated fadeIn" style="width: 100%" src="' . $image . '"/>'];
                $i++;
            }
            return $items;
        } else {
            //$image = Html::img(['/../img/nologo.png'], ['style' => 'width: 100%; border-bottom: 1px solid #000;']);
            return false;
        }
    }

    public function getCylinderArrangementList()
    {
        return [
            'V-образный' => 'V-образный',
            'W-образный' => 'W-образный',
            'Оппозитный' => 'Оппозитный',
            'Роторно-поршневой' => 'Роторно-поршневой',
            'Рядный' => 'Рядный',
        ];
    }

    public function getStatusAds()
    {
        switch ($this->status) {
            case Constants::STATUS_BLOCKED:
                return '<span class="label label-danger">
                            <i class="fa fa-ban" aria-hidden="true"></i> '.$this->getStatusList()[Constants::STATUS_BLOCKED].'</span>';
                break;
            case Constants::STATUS_WAIT:
                return '<span class="label label-warning">
                            <i class="glyphicon glyphicon-hourglass"></i> '.$this->getStatusList()[Constants::STATUS_WAIT].'</span>';
                break;
            case Constants::STATUS_ACTIVE:
                return '<span class="label label-success">
                            <i class="glyphicon glyphicon-ok"></i> '.$this->getStatusList()[Constants::STATUS_ACTIVE].'</span>';
                break;
        }
        return false;
    }

    public static function getStatusList()
    {
        return [
            Constants::STATUS_BLOCKED => \Yii::t('app', 'Заблокировано'),
            Constants::STATUS_ACTIVE => \Yii::t('app', 'Активно'),
            Constants::STATUS_WAIT =>  \Yii::t('app', 'Не активно'),
        ];
    }

    public function getCharacteristicValueList()
    {
        $models = CarCharacteristicValueExtend::find()->where(['id_car_modification' => $this->id_car_modification])->all();
        return $models;
    }

    public function getColorIten($clsaa)
    {
        switch ($clsaa) {
            case 'radio-color-white':
                return '#ffffff;';
                break;
            case 'radio-color-silver':
                return '#C1C1C1;';
                break;
            case 'radio-color-beige':
                return '#FFEFD5;';
                break;
            case 'radio-color-yellow':
                return '#FDE910;';
                break;
            case 'radio-color-gold':
                return '#FABE00;';
                break;
            case 'radio-color-orange':
                return '#FF9966;';
                break;
            case 'radio-color-pink':
                return '#FFC0CB;';
                break;
            case 'radio-color-red':
                return '#FF2600;';
                break;
            case 'radio-color-magenta':
                return '#CC1D33;';
                break;
            case 'radio-color-brown':
                return '#926547;';
                break;
            case 'radio-color-cyan':
                return '#0088ff;';
                break;
            case 'radio-color-blue':
                return '#0433FF;';
                break;
            case 'radio-color-purple':
                return '#9966CC;';
                break;
            case 'radio-color-green':
                return '#35BA2B;';
                break;
            case 'radio-color-grey':
                return '#9C9999;';
                break;
            case 'radio-color-black':
                return '#333;';
                break;

        }
        return [
            'radio-color-white' => 'radio-color-white',
            'radio-color-silver' => 'radio-color-silver',
            'radio-color-beige' => 'radio-color-beige',
            'radio-color-yellow' => 'radio-color-yellow',
            'radio-color-gold' => 'radio-color-gold',
            'radio-color-orange' => 'radio-color-orange',
            'radio-color-pink' => 'radio-color-pink',
            'radio-color-red' => 'radio-color-red',
            'radio-color-magenta' => 'radio-color-magenta',
            'radio-color-brown' => 'radio-color-brown',
            'radio-color-cyan' => 'radio-color-cyan',
            'radio-color-blue' => 'radio-color-blue',
            'radio-color-purple' => 'radio-color-purple',
            'radio-color-green' => 'radio-color-green',
            'radio-color-grey' => 'radio-color-grey',
            'radio-color-black' => 'radio-color-black',
        ];
    }

    public function getColorList()
    {
        return [
            'radio-color-white' => 'radio-color-white',
            'radio-color-silver' => 'radio-color-silver',
            'radio-color-beige' => 'radio-color-beige',
            'radio-color-yellow' => 'radio-color-yellow',
            'radio-color-gold' => 'radio-color-gold',
            'radio-color-orange' => 'radio-color-orange',
            'radio-color-pink' => 'radio-color-pink',
            'radio-color-red' => 'radio-color-red',
            'radio-color-magenta' => 'radio-color-magenta',
            'radio-color-brown' => 'radio-color-brown',
            'radio-color-cyan' => 'radio-color-cyan',
            'radio-color-blue' => 'radio-color-blue',
            'radio-color-purple' => 'radio-color-purple',
            'radio-color-green' => 'radio-color-green',
            'radio-color-grey' => 'radio-color-grey',
            'radio-color-black' => 'radio-color-black',
        ];
    }

    public function getDriveUnitList()
    {
        return [
            'Задний' => 'Задний',
            'Передний' => 'Передний',
            'Полный' => 'Полный',
            'Полный подключаемый' => 'Полный подключаемый',
        ];
    }

    public function getEcoStandardList()
    {
        return [
            'EURO I' => 'EURO I',
            'EURO II' => 'EURO II',
            'EURO III' => 'EURO III',
            'EURO IV' => 'EURO IV',
            'EURO V' => 'EURO V',
            'EURO VI' => 'EURO VI'
        ];
    }

    public function getEngineTypeList()
    {
        return [
            'Бензиновый' => 'Бензиновый',
            'Газ' => 'Газ',
            'Дизельный' => 'Дизельный',
            'Электрический' => 'Электрический',
            'Гибридный' => 'Гибридный',
            'Бензиновый, Газ' => 'Бензиновый + Газ',
            'Бензиновый, Электрический' => 'Бензиновый + Электрический',
        ];
    }

    public function getFuelGradeList()
    {
        return [
            'АИ-80' => 'АИ-80',
            'АИ-92' => 'АИ-92',
            'АИ-95' => 'АИ-95',
            'АИ-98' => 'АИ-98',
            //'Бензин' => 'Бензин',
            'Газ' => 'Газ',
            'ДТ' => 'ДТ',
            'Этанол' => 'Этанол',
        ];
    }

    public function getGearboxTypeList()
    {
        return [
            'Автомат' => 'Автомат',
            'Вариатор' => 'Вариатор',
            'Механика' => 'Механика',
            'Робот' => 'Робот',
        ];
    }

    public function getGenerationList()
    {
        $model = CarGeneration::find()->where(['id_car_model' => $this->id_car_model])->orderBy(['name' => SORT_ASC])->all();
        //dd(ArrayHelper::map($model, 'id_car_generation', 'name'));
        return ArrayHelper::map($model, 'id_car_generation', 'name');
    }

    public function getInletTypeList()
    {
        return [
            'Инжектор' => 'Инжектор',
            'Карбюратор' => 'Карбюратор',
            'Моновпрыск' => 'Моновпрыск',
            'Непосредственный впрыск' => 'Непосредственный впрыск',
            'Распределенный впрыск' => 'Распределенный впрыск',
            'Common Rail' => 'Common Rail (дизель)',
        ];
    }

    public static function getIsPaidList()
    {
        return [
            Constants::STATUS_IS_PAID => \Yii::t('app', 'Платное'),
            Constants::STATUS_IS_NOT_PAID => \Yii::t('app', 'Бесплатное'),
        ];
    }

    public static function getMarkList()
    {
        $model = CarMark::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_mark', 'name');
    }

    public function getModelList()
    {
        $model = CarModel::find()->where(['id_car_mark' => $this->id_car_mark])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_model', 'name');
    }

    public function getModificationList()
    {
        $model = CarModification::find()->where(['id_car_serie' => $this->id_car_serie])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_modification', 'name');
    }

    public function getNumberOfGearsList()
    {
        return [
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10',
        ];
    }

    public function getNumberOfCylindersList()
    {
        return [
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            10 => '10',
            12 => '12',
            16 => '16',
        ];
    }

    public function getNumberOfValvesPerCylinderList()
    {
        return [
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
        ];
    }

    public function getSerieList()
    {
        $model = CarSerie::find()->where(['id_car_generation' => $this->id_car_generation])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_serie', 'name');
    }

    public function getStateList()
    {
        return [
            Constants::STATUS_STATE_1 => 'Отличное',
            Constants::STATUS_STATE_2 => 'Хорошее',
            Constants::STATUS_STATE_3 => 'Среднее',
            Constants::STATUS_STATE_4 => 'Аварийное',
            Constants::STATUS_STATE_5 => 'На запчасти',
        ];
    }

    public static function getTariffList()
    {
        $model = AdsTariff::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id', 'name');
    }

    public function getKey($array)
    {
        foreach ($array as $key => $value) {
            return $key;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsCarCharacteristic()
    {
        return $this->hasOne(AdsCarCharacteristic::className(), ['ads_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityAds()
    {
        return $this->hasOne(GeoCity::className(), ['id' => 'city_id']);
    }

    public function getImageMain()
    {
        return  $this->hasOne(Photo::className(),
            [
                'object_id' => 'id',
                'type' => 'image_main',
            ])->andWhere(['deleted' => 0]);
    }

    public function getImagesMain()
    {
        return  $this->hasMany(Photo::className(),
            [
                'object_id' => 'id',
                'type' => 'image_main',
            ])->andWhere(['deleted' => 0]);
    }

    public function getImagesOther()
    {
        return  $this->hasMany(Photo::className(),
            [
                'object_id' => 'id',
                'type' => 'images',
            ])->andWhere(['deleted' => 0]);
    }

    public function getRatingCalculate() {
        $model = RatingCalculateExtend::findOne(1);
        $model->setParams();
        $i = 1;
        while ($i <= 24) {
            switch ($model['item'.$i]) {
                case 'Г';
                    $model['item'.$i] = $this->year ? $this->year : 1;
                    break;
                case 'П';
                    $model['item'.$i] = $this->mileage ? $this->mileage : 1;
                    break;
                case 'Р';
                    $model['item'.$i] = $this->rating ? $this->rating : 1;
                    break;
                case 'С';
                    $model['item'.$i] = $this->state ? $this->serie : 1;
                    break;
                case 'Ц';
                    $model['item'.$i] = $this->price ? $this->price : 1;
                    break;
            }
            $i++;
        }
        return $model->calulateRaiting;
    }

    public static function getYearList()
    {
        $year = date('Y');
        $startYear = 1900;
        $item = [$year => $year];
        while ($startYear != date('Y')) {
            $startYear++;
            $year--;
            $item += [$year => $year];
        }
        return $item;
    }

    public static function getCities()
    {
        $citiesModel = \common\models\extend\GeoCityExtend::find()
            ->joinWith('region')
            ->andWhere(['geo_region.country' => 'RU'])->orderby('name_ru')
            ->all();
        $cities = \yii\helpers\ArrayHelper::map($citiesModel, 'id','name_ru');
        $cities = ['Все города' => ['-1' => 'Все']] + $cities;

        return $cities;
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicValues()
    {
        return $this->hasMany(CarCharacteristicValue::className(), ['id_car_modification' => 'id_car_modification']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneration()
    {
        return $this->hasOne(CarGeneration::className(), ['id_car_generation' => 'id_car_generation']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMark()
    {
        return $this->hasOne(CarMark::className(), ['id_car_mark' => 'id_car_mark']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CarModel::className(), ['id_car_model' => 'id_car_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModification()
    {
        return $this->hasOne(CarModification::className(), ['id_car_modification' => 'id_car_modification']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatingAds()
    {
        return $this->hasOne(Rating::className(), ['ads_id' => 'id'])->where(['user_id' => Yii::$app->user->id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeleteRatingAds()
    {
        return $this->hasOne(Rating::className(), ['ads_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSerie()
    {
        return $this->hasOne(CarSerie::className(), ['id_car_serie' => 'id_car_serie']);
    }
}