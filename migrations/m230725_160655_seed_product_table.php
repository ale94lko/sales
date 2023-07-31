<?php

use Faker\Factory;
use yii\db\Migration;

/**
 * Class m230725_160655_seed_product_table
 */
class m230725_160655_seed_product_table extends Migration
{
    const PRODUCT_LIST = [
        'apple',
        'orange',
        'banana',
        'grape',
        'mango',
        'lemon',
        'peach',
        'cherry',
        'coconut',
        'nut',
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $this->insert(
                '{{%product}}',
                [
                    'name' => self::PRODUCT_LIST[$i],
                    'price' => $faker->randomFloat(2, 1, 100),
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230725_160655_seed_product_table cannot be reverted.\n";

        return false;
    }
}
