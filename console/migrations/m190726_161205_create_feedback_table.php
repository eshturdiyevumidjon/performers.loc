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
            'message' => $this->string(255)->comment("Сообщение"),
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
