<?php

use yii\db\Migration;

class m000000_000001_create_geo_tables extends Migration
{
    public function up()
    {
        $this->createTable('{{%geo_country}}', [
            'id'                => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'continent'         => $this->string(2)->notNull()->comment(Yii::t('app', 'Континент')),
            'name_ru'           => $this->string(128)->notNull()->comment(Yii::t('app', 'Русское название')),
            'lat'               => $this->decimal(6,2)->notNull()->comment(Yii::t('app', 'Широта')),
            'lon'               => $this->decimal(6,2)->notNull()->comment(Yii::t('app', 'Долгота')),
            'timezone'          => $this->string(30)->notNull()->comment(Yii::t('app', 'Временная зона')),
            'iso2'              => $this->string(2)->notNull()->comment(Yii::t('app', 'ISO2')),
            'short_name'        => $this->string(80)->notNull()->comment(Yii::t('app', 'Короткое название')),
            'long_name'         => $this->string(80)->notNull()->comment(Yii::t('app', 'Длинное название')),
            'iso3'              => $this->string(3)->notNull()->comment(Yii::t('app', 'ISO3')),
            'num_code'          => $this->string(6)->notNull()->comment(Yii::t('app', 'Цифровой код')),
            'un_member'         => $this->string(12)->notNull()->comment(Yii::t('app', 'Участник')),
            'calling_code'      => $this->string(8)->notNull()->comment(Yii::t('app', 'Телефонный код')),
            'cctld'             => $this->string(5)->notNull()->comment(Yii::t('app', 'Доменная зона')),
            'phone_number_digits' => $this->integer(2)->defaultValue(0)->comment(Yii::t('app', 'Количество цифр в телефонном номере')),
            'currency'          => $this->string(3)->notNull()->comment(Yii::t('app', 'Валюта')),
            'system_measure'    => $this->smallInteger(1)->notNull()->comment(Yii::t('app', 'Система измерения')),
            'active'            => $this->boolean()->notNull()->comment(Yii::t('app', 'Активный')),
        ]//, 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/geo_country.csv', 'geo_country');

        $this->createTable('{{%geo_region}}', [
            'id'            => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'iso'           => $this->string(7)->notNull()->comment(Yii::t('app', 'ISO')),
            'country'       => $this->string(2)->comment(Yii::t('app', 'Страна')),
            'name_ru'       => $this->string(128)->notNull()->comment(Yii::t('app', 'Русское название')),
            'name_en'       => $this->string(128)->notNull()->comment(Yii::t('app', 'Английское название')),
            'timezone'      => $this->string(30)->notNull()->comment(Yii::t('app', 'Временная зона')),
            'okato'         => $this->string(4)->notNull()->comment(Yii::t('app', 'ОКАТО')),
        ]//, 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/geo_region.csv', 'geo_region');

        $this->createTable('{{%geo_city}}', [
            'id'            => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'region_id'     => $this->integer()->comment(Yii::t('app', 'Регион')),
            'name_ru'       => $this->string(128)->notNull()->comment(Yii::t('app', 'Русское название')),
            'name_en'       => $this->string(128)->notNull()->comment(Yii::t('app', 'Английское название')),
            'lat'           => $this->decimal(6,2)->notNull()->comment(Yii::t('app', 'Широта')),
            'lon'           => $this->decimal(6,2)->notNull()->comment(Yii::t('app', 'Долгота')),
            'okato'         => $this->string(20)->notNull()->comment(Yii::t('app', 'ОКАТО')),
        ]//, 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/geo_city.csv', 'geo_city');
    }

    public function down()
    {
        $this->dropTable('{{%geo_city}}');
        $this->dropTable('{{%geo_region}}');
        $this->dropTable('{{%geo_country}}');
    }

    private function importCSV($file, $table, $separate = '^') {
        $sql = "LOAD DATA INFILE '".$file."'
         INTO TABLE ".$table."
         FIELDS TERMINATED BY '".$separate."'
         LINES TERMINATED BY '\n'";

        if ($this->db->createCommand($sql)->execute()){
            return true;
        } else {
            return false;
        }
    }
}
