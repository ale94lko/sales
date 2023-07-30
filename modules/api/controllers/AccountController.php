<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\AccountResource;
use yii\filters\Cors;
use yii\rest\ActiveController;

class AccountController extends ActiveController
{
    public $modelClass = AccountResource::class;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['cors'] = [
            'class' => Cors::class,
        ];

        return $behaviors;
    }
}
