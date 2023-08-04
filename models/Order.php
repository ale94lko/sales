<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%Order}}".
 *
 * @property int $id
 * @property int $account_id
 * @property float $subtotal
 * @property float $taxes
 * @property float $total
 */
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['account_id', 'subtotal', 'taxes', 'total'], 'required'],
            [['account_id'], 'integer'],
            [['subtotal', 'taxes', 'total'], 'number'],
            [
                ['account_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Account::class,
                'targetAttribute' => ['account_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'subtotal' => Yii::t('app', 'Subtotal'),
            'taxes' => Yii::t('app', 'Taxes'),
            'total' => Yii::t('app', 'Total'),
        ];
    }
}
