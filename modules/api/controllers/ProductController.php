<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\ProductResource;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
    public $modelClass = ProductResource::class;
}
