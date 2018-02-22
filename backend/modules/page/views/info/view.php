<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use phpnt\bootstrapNotify\BootstrapNotify;

/* @var $this yii\web\View */
/* @var $model common\models\forms\DocumentForm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<?= BootstrapNotify::widget() ?>
<div class="document-form-view">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'name',
                                'meta_keys',
                                'meta_desc',
                                [
                                    'attribute' => 'text',
                                    'format' => 'raw',
                                    'value' => call_user_func(function ($data) {
                                        /* @var $data \common\models\forms\DocumentForm */
                                        return $data->text;
                                    }, $model),
                                ],
                                //'text:ntext',
                                'created_at:date',
                                'updated_at:date',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
