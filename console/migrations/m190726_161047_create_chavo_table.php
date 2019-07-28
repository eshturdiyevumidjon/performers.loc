<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chavo}}`.
 */
class m190726_161047_create_chavo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chavo}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->comment("Заголовок"),
            'text' => $this->text()->comment("Текст"),
            'sorting' => $this->integer()->comment("Сортировка"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chavo}}');
    }
}
