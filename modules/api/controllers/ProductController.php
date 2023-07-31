<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\ProductResource;
use yii\filters\Cors;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
    public $modelClass = ProductResource::class;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['cors'] = [
            'class' => Cors::class,
        ];

        return $behaviors;
    }
}
