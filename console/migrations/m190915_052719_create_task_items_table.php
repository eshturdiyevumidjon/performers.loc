<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tasks}}`
 * - `{{%items_description}}`
 */
class m190915_052719_create_task_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_items}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'item_id' => $this->integer(),
            'count' => $this->integer(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-task_items-task_id}}',
            '{{%task_items}}',
            'task_id'
        );

        // add foreign key for table `{{%tasks}}`
        $this->addForeignKey(
            '{{%fk-task_items-task_id}}',
            '{{%task_items}}',
            'task_id',
            '{{%tasks}}',
            'id',
            'CASCADE'
        );

        // creates index for column `item_id`
        $this->createIndex(
            '{{%idx-task_items-item_id}}',
            '{{%task_items}}',
            'item_id'
        );

        // add foreign key for table `{{%items_description}}`
        $this->addForeignKey(
            '{{%fk-task_items-item_id}}',
            '{{%task_items}}',
            'item_id',
            '{{%items_description}}',
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
            '{{%fk-task_items-task_id}}',
            '{{%task_items}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-task_items-task_id}}',
            '{{%task_items}}'
        );

        // drops foreign key for table `{{%items_description}}`
        $this->dropForeignKey(
            '{{%fk-task_items-item_id}}',
            '{{%task_items}}'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            '{{%idx-task_items-item_id}}',
            '{{%task_items}}'
        );

        $this->dropTable('{{%task_items}}');
    }
}
