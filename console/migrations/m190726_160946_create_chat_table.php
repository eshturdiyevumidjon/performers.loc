<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m190726_160946_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->comment("Тип"),
            'chat_id' => $this->string(255)->comment("Чат ИД"),
            'date_cr' => $this->integer()->comment("Дата создании"),
            'from' => $this->integer()->comment("Создатель"),
            'to' => $this->integer()->comment("Получатель"),
            'title' => $this->string(255)->comment("Заголовок"),
            'file' => $this->string(255)->comment("Файл"),
            'text' => $this->binary()->comment("Текст"),
            'reply' => $this->integer()->comment("Ответить"),
            'deleted' => $this->boolean()->comment("Удалено"),
        ]);

        // creates index for column `from`
        $this->createIndex(
            '{{%idx-chat-from}}',
            '{{%chat}}',
            'from'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-chat-from}}',
            '{{%chat}}',
            'from',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `to`
        $this->createIndex(
            '{{%idx-chat-to}}',
            '{{%chat}}',
            'to'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-chat-to}}',
            '{{%chat}}',
            'to',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-chat-from}}',
            '{{%chat}}'
        );

        // drops index for column `from`
        $this->dropIndex(
            '{{%idx-chat-from}}',
            '{{%chat}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-chat-to}}',
            '{{%chat}}'
        );

        // drops index for column `to`
        $this->dropIndex(
            '{{%idx-chat-to}}',
            '{{%chat}}'
        );

        $this->dropTable('{{%chat}}');
    }
}
