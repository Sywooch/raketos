<?php

namespace frontend\components\ImageProcessing;

use phpnt\cropper\models\ImageForm as imageF;

class ImageForm extends imageF
{
    public function behaviors()
    {
        return [
            [
                'class' => ImageBehavior::className(),
            ],
        ];
    }
}
