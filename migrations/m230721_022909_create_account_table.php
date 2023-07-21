<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%account}}`.
 */
class m230721_022909_create_account_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%account}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'phone' => $this->string(15),
            'street' => $this->string(255),
            'city' => $this->string(255),
            'state' => $this->string(255),
            'postal_code' => $this->string(10),
        ]);

        $this->createIndex(
            '{{%account_name_idx}}',
            '{{%account}}',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%account_name_idx}}', '{{%account}}');
        $this->dropTable('{{%account}}');
    }
}
