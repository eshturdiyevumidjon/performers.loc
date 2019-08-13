<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%replies}}`.
 */
class m190809_033053_create_replies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%replies}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("ФИО"),
            'phone' => $this->string(255)->comment("Телефон"),
            'email' => $this->string(255)->comment("Email"),
            'message' => $this->text()->comment("Сообщение"),
            'feedback_id' => $this->integer(),
            'date_cr' => $this->integer()->comment("Дата создании"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%replies}}');
    }
}
