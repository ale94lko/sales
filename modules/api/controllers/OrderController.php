<?php

namespace app\modules\api\controllers;

use app\models\Order;
use app\models\OrderProduct;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\ServerErrorHttpException;

class OrderController extends ActiveController
{
    public $modelClass = Order::class;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['cors'] = [
            'class' => Cors::class,
        ];

        return $behaviors;
    }

    /**
     * @throws ServerErrorHttpException
     * @throws InvalidConfigException
     */
    public function actionInsert(): Order
    {
        $model = new Order([
            'scenario' => Model::SCENARIO_DEFAULT,
        ]);

        $params = Yii::$app->getRequest()->getBodyParams();
        $model->load($params, '');
        if ($model->save()) {
            foreach ($params['productOrderList'] AS $productOrder) {
                $orderProduct = new OrderProduct([
                    'scenario' => Model::SCENARIO_DEFAULT,
                ]);
                $orderProduct->order_id = $model->id;
                $orderProduct->product_id = $productOrder['id'];
                $orderProduct->quantity = $productOrder['qty'];
                $orderProduct->price =
                    $productOrder['qty'] * $productOrder['price'];
                $orderProduct->save();
            }
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException(
                'Failed to create the object for unknown reason.'
            );
        }

        return $model;
    }
}
