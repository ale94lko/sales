<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m230721_022446_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
        ]);

        $this->createIndex(
            '{{%product_name_idx}}',
            '{{%product}}',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%product_name_idx}}', '{{%product}}');
        $this->dropTable('{{%product}}');
    }
}
