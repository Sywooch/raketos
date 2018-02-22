<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 17.04.2017
 * Time: 9:53
 */

use phpnt\exportFile\ExportFile;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CarMarkSearch */

$this->title = 'Экспорт в CSV';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-make-form-index">
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1>Таблицы данных</h1>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        <h3><?= \common\models\search\AdsSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\AdsSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\AdsCarCharacteristicSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\AdsCarCharacteristicSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\AdsTariffSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\AdsTariffSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\ArticleSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\ArticleSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\DocumentSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\DocumentSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\InfoSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\InfoSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\PhotoSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\PhotoSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\QuestionSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\QuestionSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\RatingSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\RatingSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\RatingCalculateSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\RatingCalculateSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\UserOauthKeySearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\UserOauthKeySearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1>Служебные таблицы</h1>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        <h3><?= \common\models\search\UserSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\UserSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\UserOauthKeySearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\UserOauthKeySearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\AuthAssignmentSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\AuthAssignmentSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\GeoCountrySearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\GeoCountrySearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\GeoRegionSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\GeoRegionSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\GeoCitySearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\GeoCitySearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarTypeSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarTypeSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarMarkSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarMarkSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarModelSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarModelSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarGenerationSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarGenerationSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarSerieSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarSerieSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarModificationSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarModificationSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarCharacteristicSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarCharacteristicSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarCharacteristicValueSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarCharacteristicValueSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarEquipmentSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarEquipmentSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarOptionSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarOptionSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <h3><?= \common\models\search\CarOptionValueSearch::tableName() ?></h3>
                        <?= ExportFile::widget([
                            'model'             => 'common\models\search\CarOptionValueSearch',   // путь к модели
                            'title'             => 'Заголовок документа',
                            'queryParams'       => Yii::$app->request->queryParams,

                            'getAll'            => true,                               // все записи - true, учитывать пагинацию - false
                            'csvCharset'        => 'Windows-1251',                      // кодировка csv файла: 'UTF-8' (по умолчанию) или 'Windows-1251'

                            'buttonClass'       => 'btn btn-primary',                   // класс кнопки
                            'blockClass'        => 'pull-left',                         // класс блока в котором кнопка
                            'blockStyle'        => 'padding: 5px;',                     // стиль блока в котором кнопка

                            // экспорт в следующие файлы (true - разрешить, false - запретить)
                            'xls'               => true,
                            'csv'               => true,
                            'word'              => true,
                            'html'              => true,
                            'pdf'               => false,

                            // шаблоны кнопок
                            'xlsButtonName'     => Yii::t('app', 'MS Excel'),
                            'csvButtonName'     => Yii::t('app', 'CSV'),
                            'wordButtonName'    => Yii::t('app', 'MS Word'),
                            'htmlButtonName'    => Yii::t('app', 'HTML'),
                            'pdfButtonName'     => Yii::t('app', 'PDF')
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
