<?php

use yii\db\Migration;

class m000000_000002_create_car_tables extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%car_type}}', [
            'id_car_type'      => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'name'                  => $this->string()->comment(Yii::t('app', 'Название')),
        ], $tableOptions);
        
        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_type.csv', 'car_type');

        $this->createTable('{{%car_mark}}', [
            'id_car_mark'     => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'name'                  => $this->string()->comment(Yii::t('app', 'Название')),
            'date_create'           => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'           => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_type'           => $this->integer()->comment(Yii::t('app', 'Минимальная цена')),
            'name_rus'              => $this->string()->comment(Yii::t('app', 'Русское название')),
        ], $tableOptions);

        $this->createIndex('id_car_type_mark_idx', '{{%car_mark}}', 'id_car_type');
        $this->addForeignKey('type_mark_fk', '{{%car_mark}}', 'id_car_type', '{{%car_type}}', 'id_car_type');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_mark.csv', 'car_mark');

        $this->createTable('{{%car_model}}', [
            'id_car_model'          => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'id_car_mark'           => $this->integer()->comment(Yii::t('app', 'Марка автомобиля')),
            'name'                  => $this->string()->comment(Yii::t('app', 'Название')),
            'date_create'           => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'           => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_type'           => $this->integer()->comment(Yii::t('app', 'Минимальная цена')),
            'name_rus'              => $this->string()->comment(Yii::t('app', 'Русское название')),
        ], $tableOptions);

        $this->createIndex('id_car_type_model_idx', '{{%car_model}}', 'id_car_type');
        $this->addForeignKey('type_model_fk', '{{%car_model}}', 'id_car_type', '{{%car_type}}', 'id_car_type');
        $this->createIndex('id_car_mark_idx', '{{%car_model}}', 'id_car_mark');
        $this->addForeignKey('model_mark_fk', '{{%car_model}}', 'id_car_mark', '{{%car_mark}}', 'id_car_mark');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_model.csv', 'car_model');

        $this->createTable('{{%car_generation}}', [
            'id_car_generation'     => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'name'                  => $this->string()->comment(Yii::t('app', 'Название')),
            'id_car_model'          => $this->integer()->comment(Yii::t('app', 'Модель')),
            'year_begin'            => $this->string()->comment(Yii::t('app', 'Год начала выпуска')),
            'year_end'              => $this->string()->comment(Yii::t('app', 'Год окончания выпуска')),
            'date_create'           => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'           => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_type'           => $this->integer()->comment(Yii::t('app', 'Минимальная цена')),
        ], $tableOptions
        );

        $this->createIndex('id_car_type_generation_idx', '{{%car_generation}}', 'id_car_type');
        $this->addForeignKey('type_generation_fk', '{{%car_generation}}', 'id_car_type', '{{%car_type}}', 'id_car_type');
        $this->createIndex('id_car_model_generation_idx', '{{%car_generation}}', 'id_car_model');
        $this->addForeignKey('generation_model_fk', '{{%car_generation}}', 'id_car_model', '{{%car_model}}', 'id_car_model');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_generation.csv', 'car_generation');

        $this->createTable('{{%car_serie}}', [
            'id_car_serie'          => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'id_car_model'          => $this->integer()->comment(Yii::t('app', 'Модель')),
            'name'                  => $this->string()->comment(Yii::t('app', 'Название')),
            'date_create'           => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'           => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_generation'     => $this->integer()->comment(Yii::t('app', 'Поколение')),
            'id_car_type'           => $this->integer()->comment(Yii::t('app', 'Минимальная цена')),
        ], $tableOptions
        );

        $this->createIndex('id_car_type_serie_idx', '{{%car_serie}}', 'id_car_type');
        $this->addForeignKey('type_serie_fk', '{{%car_serie}}', 'id_car_type', '{{%car_type}}', 'id_car_type');
        $this->createIndex('id_car_model_serie_idx', '{{%car_serie}}', 'id_car_model');
        $this->addForeignKey('serie_model_fk', '{{%car_serie}}', 'id_car_model', '{{%car_model}}', 'id_car_model');
        $this->createIndex('id_car_generation_serie_idx', '{{%car_serie}}', 'id_car_generation');
        $this->addForeignKey('serie_generation_fk', '{{%car_serie}}', 'id_car_generation', '{{%car_generation}}', 'id_car_generation');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_serie.csv', 'car_serie');

        $this->createTable('{{%car_modification}}', [
            'id_car_modification'   => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'id_car_serie'          => $this->integer()->comment(Yii::t('app', 'Серия')),
            'id_car_model'          => $this->integer()->comment(Yii::t('app', 'Модель')),
            'name'                  => $this->string()->comment(Yii::t('app', 'Название')),
            'date_create'           => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'           => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_type'           => $this->integer()->comment(Yii::t('app', 'Минимальная цена')),
        ], $tableOptions
        );

        $this->createIndex('id_car_type_modification_idx', '{{%car_modification}}', 'id_car_type');
        $this->addForeignKey('type_modification_fk', '{{%car_modification}}', 'id_car_type', '{{%car_type}}', 'id_car_type');
        $this->createIndex('modification_serie_idx', '{{%car_modification}}', 'id_car_serie');
        $this->addForeignKey('modification_serie_fk', '{{%car_modification}}', 'id_car_serie', '{{%car_serie}}', 'id_car_serie');
        $this->createIndex('modification_model_idx', '{{%car_modification}}', 'id_car_model');
        $this->addForeignKey('modification_model_fk', '{{%car_modification}}', 'id_car_model', '{{%car_model}}', 'id_car_model');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_modification.csv', 'car_modification');

            $this->createTable('{{%car_characteristic}}', [
                'id_car_characteristic'     => $this->primaryKey()->comment(Yii::t('app', 'ID')),
                'name'                      => $this->string()->comment(Yii::t('app', 'Название')),
                'id_parent'                 => $this->integer()->comment(Yii::t('app', 'Родительская характеристика')),
                'date_create'               => $this->integer()->comment(Yii::t('app', 'Дата создания')),
                'date_update'               => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
                'id_car_type'               => $this->integer()->comment(Yii::t('app', 'Тип транспорта')),
            ], $tableOptions
        );

        $this->createIndex('id_car_type_characteristic_idx', '{{%car_characteristic}}', 'id_car_type');
        $this->addForeignKey('type_characteristic_fk', '{{%car_characteristic}}', 'id_car_type', '{{%car_type}}', 'id_car_type');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_characteristic.csv', 'car_characteristic');

        $this->createTable('{{%car_characteristic_value}}', [
            'id_car_characteristic_value'   => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'value'                         => $this->string()->comment(Yii::t('app', 'Значение')),
            'unit'                          => $this->string()->comment(Yii::t('app', 'Ед. измерение')),
            'id_car_characteristic'         => $this->integer()->comment(Yii::t('app', 'Характеристика')),
            'id_car_modification'           => $this->integer()->comment(Yii::t('app', 'Модификация')),
            'date_create'                   => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'                   => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_type'                   => $this->integer()->comment(Yii::t('app', 'Тип транспорта')),
        ], $tableOptions
        );

        $this->createIndex('id_car_type_characteristic_value_idx', '{{%car_characteristic_value}}', 'id_car_type');
        $this->addForeignKey('type_characteristic_value_fk', '{{%car_characteristic_value}}', 'id_car_type', '{{%car_type}}', 'id_car_type');
        $this->createIndex('characteristic_value_idx', '{{%car_characteristic_value}}', 'id_car_characteristic');
        $this->addForeignKey('characteristic_value_fk', '{{%car_characteristic_value}}', 'id_car_characteristic', '{{%car_characteristic}}', 'id_car_characteristic');
        $this->createIndex('characteristic_value_modification_idx', '{{%car_characteristic_value}}', 'id_car_modification');
        $this->addForeignKey('characteristic_value_modification_fk', '{{%car_characteristic_value}}', 'id_car_modification', '{{%car_modification}}', 'id_car_modification');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_characteristic_value.csv', 'car_characteristic_value');

        $this->createTable('{{%car_equipment}}', [
            'id_car_equipment'      => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'name'                  => $this->string()->comment(Yii::t('app', 'Название')),
            'date_create'           => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'           => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_modification'   => $this->integer()->comment(Yii::t('app', 'Модификация')),
            'price_min'             => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_type'           => $this->integer()->comment(Yii::t('app', 'Минимальная цена')),
            'year'                  => $this->integer()->comment(Yii::t('app', 'Год ')),
        ], $tableOptions
        );

        $this->createIndex('id_car_type_equipment_idx', '{{%car_equipment}}', 'id_car_type');
        $this->addForeignKey('type_equipment_fk', '{{%car_equipment}}', 'id_car_type', '{{%car_type}}', 'id_car_type');
        $this->createIndex('equipment_modification_idx', '{{%car_equipment}}', 'id_car_modification');
        $this->addForeignKey('equipment_modification_fk', '{{%car_equipment}}', 'id_car_modification', '{{%car_modification}}', 'id_car_modification');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_equipment.csv', 'car_equipment');

        $this->createTable('{{%car_option}}', [
            'id_car_option'         => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'name'                  => $this->string()->comment(Yii::t('app', 'Название')),
            'id_parent'             => $this->integer()->comment(Yii::t('app', 'Родительская опции')),
            'date_create'           => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'           => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_type'           => $this->integer()->comment(Yii::t('app', 'Минимальная цена')),
        ], $tableOptions
        );

        $this->createIndex('id_car_type_option_idx', '{{%car_option}}', 'id_car_type');
        $this->addForeignKey('type_option_fk', '{{%car_option}}', 'id_car_type', '{{%car_type}}', 'id_car_type');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_option.csv', 'car_option');

        $this->createTable('{{%car_option_value}}', [
            'id_car_option_value'   => $this->primaryKey()->comment(Yii::t('app', 'ID')),
            'is_base'               => $this->smallInteger(1)->comment(Yii::t('app', 'Базовая комплектация')),
            'id_car_option'         => $this->integer()->comment(Yii::t('app', 'Опция')),
            'id_car_equipment'      => $this->integer()->comment(Yii::t('app', 'Оборудование')),
            'date_create'           => $this->integer()->comment(Yii::t('app', 'Дата создания')),
            'date_update'           => $this->integer()->comment(Yii::t('app', 'Дата изменения')),
            'id_car_type'           => $this->integer()->comment(Yii::t('app', 'Минимальная цена')),
        ], $tableOptions
        );

        $this->createIndex('id_car_type_option_value_idx', '{{%car_option_value}}', 'id_car_type');
        $this->addForeignKey('type_option_value_fk', '{{%car_option_value}}', 'id_car_type', '{{%car_type}}', 'id_car_type');
        $this->createIndex('id_car_option_option_value_idx', '{{%car_option_value}}', 'id_car_option');
        $this->addForeignKey('option_option_value_fk', '{{%car_option_value}}', 'id_car_option', '{{%car_option}}', 'id_car_option');
        $this->createIndex('id_car_equipment_option_value_idx', '{{%car_option_value}}', 'id_car_equipment');
        $this->addForeignKey('option_equipment_value_fk', '{{%car_option_value}}', 'id_car_equipment', '{{%car_equipment}}', 'id_car_equipment');

        $this->importCSV('/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/car_option_value.csv', 'car_option_value');
    }

    public function safeDown()
    {
        $this->dropForeignKey('option_equipment_value_fk', '{{%car_option_value}}');
        $this->dropIndex('id_car_equipment_option_value_idx', '{{%car_option_value}}');
        $this->dropForeignKey('option_option_value_fk', '{{%car_option_value}}');
        $this->dropIndex('id_car_option_option_value_idx', '{{%car_option_value}}');
        $this->dropForeignKey('type_option_value_fk', '{{%car_option_value}}');
        $this->dropIndex('id_car_type_option_value_idx', '{{%car_option_value}}');
        $this->dropTable('{{%car_option_value}}');

        $this->dropForeignKey('type_option_fk', '{{%car_option}}');
        $this->dropIndex('id_car_type_option_idx', '{{%car_option}}');
        $this->dropTable('{{%car_option}}');

        $this->dropForeignKey('equipment_modification_fk', '{{%car_equipment}}');
        $this->dropIndex('equipment_modification_idx', '{{%car_equipment}}');
        $this->dropForeignKey('type_equipment_fk', '{{%car_equipment}}');
        $this->dropIndex('id_car_type_equipment_idx', '{{%car_equipment}}');
        $this->dropTable('{{%car_equipment}}');

        $this->dropForeignKey('characteristic_value_modification_fk', '{{%car_characteristic_value}}');
        $this->dropIndex('characteristic_value_modification_idx', '{{%car_characteristic_value}}');
        $this->dropForeignKey('characteristic_value_fk', '{{%car_characteristic_value}}');
        $this->dropIndex('characteristic_value_idx', '{{%car_characteristic_value}}');
        $this->dropForeignKey('type_characteristic_value_fk', '{{%car_characteristic_value}}');
        $this->dropIndex('id_car_type_characteristic_value_idx', '{{%car_characteristic_value}}');
        $this->dropTable('{{%car_characteristic_value}}');

        $this->dropForeignKey('type_characteristic_fk', '{{%car_characteristic}}');
        $this->dropIndex('id_car_type_characteristic_idx', '{{%car_characteristic}}');
        $this->dropTable('{{%car_characteristic}}');

        $this->dropForeignKey('modification_model_fk', '{{%car_modification}}');
        $this->dropIndex('modification_model_idx', '{{%car_modification}}');
        $this->dropForeignKey('modification_serie_fk', '{{%car_modification}}');
        $this->dropIndex('modification_serie_idx', '{{%car_modification}}');
        $this->dropForeignKey('type_modification_fk', '{{%car_modification}}');
        $this->dropIndex('id_car_type_modification_idx', '{{%car_modification}}');
        $this->dropTable('{{%car_modification}}');

        $this->dropForeignKey('serie_generation_fk', '{{%car_serie}}');
        $this->dropIndex('id_car_generation_serie_idx', '{{%car_serie}}');
        $this->dropForeignKey('serie_model_fk', '{{%car_serie}}');
        $this->dropIndex('id_car_model_serie_idx', '{{%car_serie}}');
        $this->dropForeignKey('type_serie_fk', '{{%car_serie}}');
        $this->dropIndex('id_car_type_serie_idx', '{{%car_serie}}');
        $this->dropTable('{{%car_serie}}');

        $this->dropForeignKey('generation_model_fk', '{{%car_generation}}');
        $this->dropIndex('id_car_model_generation_idx', '{{%car_generation}}');
        $this->dropForeignKey('type_generation_fk', '{{%car_generation}}');
        $this->dropIndex('id_car_type_generation_idx', '{{%car_generation}}');
        $this->dropTable('{{%car_generation}}');

        $this->dropForeignKey('model_mark_fk', '{{%car_model}}');
        $this->dropIndex('id_car_mark_idx', '{{%car_model}}');
        $this->dropForeignKey('type_model_fk', '{{%car_model}}');
        $this->dropIndex('id_car_type_model_idx', '{{%car_model}}');
        $this->dropTable('{{%car_model}}');

        $this->dropForeignKey('type_mark_fk', '{{%car_mark}}');
        $this->dropIndex('id_car_type_mark_idx', '{{%car_mark}}');
        $this->dropTable('{{%car_mark}}');

        $this->dropTable('{{%car_type}}');
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
