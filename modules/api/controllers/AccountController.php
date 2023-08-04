<?php

namespace app\modules\api\controllers;

use app\models\Account;
use yii\filters\Cors;
use yii\rest\ActiveController;

class AccountController extends ActiveController
{
    public $modelClass = Account::class;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['cors'] = [
            'class' => Cors::class,
        ];

        return $behaviors;
    }
}
