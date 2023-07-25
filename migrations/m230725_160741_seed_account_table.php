<?php

use Faker\Factory;
use yii\db\Migration;

/**
 * Class m230725_160741_seed_account_table
 */
class m230725_160741_seed_account_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $this->insert(
                '{{%account}}',
                [
                    'name' => $faker->company,
                    'phone' => $faker->phoneNumber,
                    'street' => $faker->streetName,
                    'city' => $faker->city,
                    'state' => $faker->name,
                    'postal_code' => $faker->postcode,
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230725_160741_seed_account_table cannot be reverted.\n";

        return false;
    }
}
