<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tasks}}`
 * - `{{%user}}`
 */
class m190907_004951_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->comment("Заказ"),
            'date_create' => $this->integer()->comment("Дата создания"),
            'price' => $this->integer()->comment("Цена"),
            'user_id' => $this->integer()->comment("Испольнитель"),
            'car_id' => $this->integer()->comment("Марка и Модел автомобиля"),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-request-task_id}}',
            '{{%request}}',
            'task_id'
        );

        // add foreign key for table `{{%tasks}}`
        $this->addForeignKey(
            '{{%fk-request-task_id}}',
            '{{%request}}',
            'task_id',
            '{{%tasks}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-request-user_id}}',
            '{{%request}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-request-user_id}}',
            '{{%request}}',
            'user_id',
            '{{%user}}',
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
            '{{%fk-request-task_id}}',
            '{{%request}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-request-task_id}}',
            '{{%request}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-request-user_id}}',
            '{{%request}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-request-user_id}}',
            '{{%request}}'
        );

        $this->dropTable('{{%request}}');
    }
}
