<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m190727_100749_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->comment("Способ оплаты"),
            'task_id' => $this->integer()->comment("Задание"),
            'date_pay' => $this->integer()->comment("Дата оплаты"),
            'amount' => $this->float()->comment("Сумма"),
            'status' => $this->integer()->comment("Статус"),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-orders-task_id}}',
            '{{%orders}}',
            'task_id'
        );

        // add foreign key for table `{{%tasks}}`
        $this->addForeignKey(
            '{{%fk-orders-task_id}}',
            '{{%orders}}',
            'task_id',
            '{{%tasks}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       // drops foreign key for table `{{%tasks}}`
        $this->dropForeignKey(
            '{{%fk-orders-task_id}}',
            '{{%orders}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-orders-task_id}}',
            '{{%orders}}'
        );

        $this->dropTable('{{%orders}}');
    }
}
