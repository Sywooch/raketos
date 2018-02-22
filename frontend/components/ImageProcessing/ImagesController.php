<?php

namespace frontend\components\ImageProcessing;

use phpnt\cropper\controllers\ImagesController as ic;

class ImagesController extends ic
{
    public function actionAutoloadImage()
    {
        if (!\Yii::$app->request->isAjax) {
            return $this->goBack();
        }
        $imageData = \Yii::$app->request->post('imageData');
        $modelImageForm = new ImageForm();

        if ($imageData['image_id'] == '0' || $imageData['image_id'] == null):
            $modelImageForm->createImage();
        else:
            $modelImageForm->updateImage();
        endif;

        if (\Yii::$app->session->get('error')):
            \Yii::$app->session->set('message', [
                'type' => 'danger',
                'icon' => 'glyphicon glyphicon-envelope',
                'message' => \Yii::$app->session->get('error'),
            ]);
        endif;

        $imagesObject = $modelImageForm->getPhotosByLabel($label = $imageData['images_label'],
            $objectId = $imageData['object_id']);

        $render = ($imageData['images_num'] == 1)
            ? '_image'
            : '_image-many';

        return $this->renderAjax('@vendor/phpnt/yii2-cropper/views/' . $render, [
            'imagesObject' => $imagesObject,
            'modelImageForm' => $modelImageForm,
            'modelName' => $imageData['modelName'],
            'id' => $imageData['id'],
            'object_id' => $imageData['object_id'],
            'images_num' => $imageData['images_num'],
            'images_label' => $imageData['images_label'],
            'buttonClass' => $imageData['buttonClass'],
            'previewSize' => $imageData['previewSize'],
            'images_temp' => $imageData['images_temp'],
            'imageSmallWidth' => $imageData['imageSmallWidth'],
            'imageSmallHeight' => $imageData['imageSmallHeight'],
            'createImageText' => $imageData['createImageText'],
            'updateImageText' => $imageData['updateImageText'],
            'deleteImageText' => $imageData['deleteImageText'],
            'frontendUrl' => $imageData['frontendUrl'],
            'baseUrl' => $imageData['baseUrl'],
            'imagePath' => $imageData['imagePath'],
            'noImage' => $imageData['noImage'],
            'loaderImage' => $imageData['loaderImage'],
            'backend' => $imageData['backend'],
            'imageClass' => $imageData['imageClass'],
            'buttonDeleteClass' => $imageData['buttonDeleteClass'],
            'imageContainerClass' => $imageData['imageContainerClass'],
            'formImagesContainerClass' => $imageData['formImagesContainerClass'],
        ]);
    }
}
