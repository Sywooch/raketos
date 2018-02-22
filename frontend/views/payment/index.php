<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 31.03.2017
 * Time: 18:24
 */

/*echo kroshilin\yakassa\widgets\Payment::widget([
    //'order' => $order,
    'order' => ['id' => 1, 'sum' => 555],
    'userIdentity' => Yii::$app->user->identity,
    'data' => ['customParam' => 'value'],
    'paymentType' => ['PC' => 'Со счета в Яндекс.Деньгах', 'AC' => 'С банковской карты']
]);*/
?>
<form action="https://demomoney.yandex.ru/eshop.xml" method="post">
    <!-- Обязательные поля -->
    <input name="paymentType" value="" type="hidden">
    <input name="shopId" value="151" type="hidden"/>
    <input name="scid" value="363" type="hidden"/>
    <input name="sum" value="100"/>
    <input name="customerNumber" value="100500"/>
    <input name="cps_phone" value="79110000000"/>
    <input name="cps_email" value="user@domain.com"/>
    <input type="submit" value="Заплатить"/>
</form>
