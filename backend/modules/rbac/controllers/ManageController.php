<?php

namespace backend\modules\rbac\controllers;

use backend\controllers\BehaviorsController;
use common\models\Constants;
use Yii;
use common\models\extend\AuthItemExtend;
use common\models\search\AuthItemSearch;
use yii\web\NotFoundHttpException;

/**
 * ManageController implements the CRUD actions for AuthItemExtend model.
 */
class ManageController extends BehaviorsController
{
    /**
     * Lists all AuthItemExtend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModelRole = new AuthItemSearch();
        $searchModelRole->type = Constants::TYPE_ROLE;
        $dataProviderRole = $searchModelRole->search(Yii::$app->request->queryParams);

        $searchModelPermission = new AuthItemSearch();
        $searchModelPermission->type = Constants::TYPE_PERMISSION;
        $dataProviderPermission = $searchModelPermission->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModelRole' => $searchModelRole,
            'dataProviderRole' => $dataProviderRole,
            'searchModelPermission' => $searchModelPermission,
            'dataProviderPermission' => $dataProviderPermission,
        ]);
    }

    /**
     * Displays a single AuthItemExtend model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItemExtend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItemExtend();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItemExtend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItemExtend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItemExtend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItemExtend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItemExtend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
