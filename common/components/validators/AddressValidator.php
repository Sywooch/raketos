<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 21.10.2016
 * Time: 21:16
 */

namespace common\components\validators;

use common\models\extend\GeoCityExtend;
use deka6pb\geocoder\Geocoder;
use deka6pb\geocoder\objects\YandexObject;
use yii\validators\Validator;

class AddressValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        /* @var \deka6pb\geocoder\abstraction\CoderInterface $coder */
        $coder = Geocoder::build(\deka6pb\geocoder\Geocoder::TYPE_YANDEX);

        $city       = $model->city;
        $address    = $model->address;
        $modelGeoCityExtend = GeoCityExtend::findOne($city);

        if ($model && $address != '') {
            /* @var $object YandexObject */
            $cityPrefix = $modelGeoCityExtend->region->countryFk->name_ru.' '.$modelGeoCityExtend->region->name_ru.' '.$modelGeoCityExtend->name_ru;
            $object = $coder::findOneByAddress($cityPrefix.' '.$address);
            /* [
                'city' => 'Нижний Новгород'
                'area' => 'Нижегородская область'
                'sub_area' => 'городской округ Нижний Новгород'
                'dependent_locality' => null
                'country' => 'Россия'
                'countrySlug' => null
                'thoroughfare' => 'проспект Ленина'
                'street' => 'проспект Ленина'
                'house' => '5'
            ] */
            $data = $object->getData();
            if ($data['city'] == $modelGeoCityExtend->name_ru && $data['street'] != null && $data['house'] != null) {
                $dataPoint = $object->getPoint();
                $model->address = $data['street'] . ', ' . $data['house'];
                $model->latitude = $dataPoint->getLatitude();
                $model->longitude = $dataPoint->getLongitude();
            }
            else {
                $this->addError($model, $attribute, \Yii::t('app', 'Адрес "{address}" не найден.',
                    [
                        'address' => $modelGeoCityExtend->region->countryFk->name_ru.', '.$modelGeoCityExtend->region->name_ru. ', ' . $modelGeoCityExtend->name_ru . ', '. $address
                    ]));
            }
        }
    }
}