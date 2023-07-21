<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_product}}`.
 */
class m230721_025153_create_order_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_product}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
            'quantity' => $this->integer(11)->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
        ]);

        $this->addForeignKey(
            '{{%fk_order_product_ref_order_id}}',
            '{{%order_product}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%fk_order_product_ref_product_id}}',
            '{{%order_product}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk_order_product_ref_order_id}}',
            '{{%order_product}}'
        );
        $this->dropForeignKey(
            '{{%fk_order_product_ref_product_id}}',
            '{{%order_product}}'
        );
        $this->dropTable('{{%order_product}}');
    }
}
