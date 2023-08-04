<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%Account}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $street
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 */
class Account extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%account}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 15],
            [['street', 'city', 'state'], 'string', 'max' => 255],
            [['postal_code'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'street' => Yii::t('app', 'Street'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'postal_code' => Yii::t('app', 'Postal Code'),
        ];
    }
}
