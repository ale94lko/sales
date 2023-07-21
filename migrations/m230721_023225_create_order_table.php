<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m230721_023225_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(11)->notNull(),
            'subtotal' => $this->decimal(10, 2)->notNull(),
            'taxes' => $this->decimal(10, 2)->notNull(),
            'total' => $this->decimal(10, 2)->notNull(),
        ]);

        $this->addForeignKey(
            '{{%fk_order_ref_account_id}}',
            '{{%order}}',
            'account_id',
            '{{%account}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk_order_ref_account_id}}', '{{%order}}');
        $this->dropTable('{{%order}}');
    }
}
