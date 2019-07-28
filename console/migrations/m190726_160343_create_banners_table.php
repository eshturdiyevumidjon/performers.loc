<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banners}}`.
 */
class m190726_160343_create_banners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banners}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->comment("Заголовок"),
            'text' => $this->text()->comment("Текст"),
            'link' => $this->string(255)->comment("Ссылка"),
            'image' => $this->string(255)->comment("Фото"),
            'type' => $this->integer()->comment("Тип"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banners}}');
    }
}
