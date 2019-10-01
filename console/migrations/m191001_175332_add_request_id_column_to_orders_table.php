<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%orders}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%request}}`
 */
class m191001_175332_add_request_id_column_to_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'request_id', $this->integer());

        // creates index for column `request_id`
        $this->createIndex(
            '{{%idx-orders-request_id}}',
            '{{%orders}}',
            'request_id'
        );

        // add foreign key for table `{{%request}}`
        $this->addForeignKey(
            '{{%fk-orders-request_id}}',
            '{{%orders}}',
            'request_id',
            '{{%request}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%request}}`
        $this->dropForeignKey(
            '{{%fk-orders-request_id}}',
            '{{%orders}}'
        );

        // drops index for column `request_id`
        $this->dropIndex(
            '{{%idx-orders-request_id}}',
            '{{%orders}}'
        );

        $this->dropColumn('{{%orders}}', 'request_id');
    }
}
