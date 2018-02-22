<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModelRole common\models\search\AuthItemSearch */
/* @var $dataProviderRole yii\data\ActiveDataProvider */
/* @var $searchModelPermission common\models\search\AuthItemSearch */
/* @var $dataProviderPermission yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Роли и разрешения');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'Возможные роли и раздешения для пользователей.',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<div class="auth-item-extend-index">
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1><?= Yii::t('app', 'Роли пользователей') ?></h1>
            </div>
            <?php Pjax::begin(); ?>
            <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProviderRole,
                            'filterModel' => $searchModelRole,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'description:ntext',
                                'name',
                                // 'place',
                                // 'created_at',
                                // 'updated_at',

                                //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1><?= Yii::t('app', 'Разрешения пользователей') ?></h1>
            </div>
            <?php Pjax::begin(); ?>
            <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProviderPermission,
                            'filterModel' => $searchModelPermission,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'description:ntext',
                                'name',
                                'rule_name',
                                // 'created_at',
                                // 'updated_at',
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>