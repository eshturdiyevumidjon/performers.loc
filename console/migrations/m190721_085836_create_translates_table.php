<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%translates}}`.
 */
class m190721_085836_create_translates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%translates}}', [
            'id' => $this->primaryKey(),
            'table_name' => $this->string(255)->comment("Имя таблицы"),
            'field_id' => $this->integer()->comment("ID поля"),
            'field_name' => $this->string(255)->comment("Имя поля"),
            'field_description'=> $this->string(255)->comment("Описание поля"),
            'field_value' => $this->text()->comment("Значение поля"),
            'language_code' => $this->string(255)->comment("Код языка"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%translates}}');
    }
}
