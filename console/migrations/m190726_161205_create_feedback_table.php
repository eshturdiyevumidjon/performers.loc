<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedback}}`.
 */
class m190726_161205_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("ФИО"),
            'phone' => $this->string(255)->comment("Телефон"),
            'email' => $this->string(255)->comment("Email"),
            'message' => $this->text()->comment("Сообщение"),
            'is_view' => $this->integer()->defaultValue(0),
            'is_reply' => $this->integer()->defaultValue(-1),
            'date_cr' => $this->integer()->comment("Дата создании"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }
}
