<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\AccountResource;
use yii\rest\ActiveController;

class AccountController extends ActiveController
{
    public $modelClass = AccountResource::class;
}
