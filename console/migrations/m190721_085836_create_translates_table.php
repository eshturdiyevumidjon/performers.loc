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
            'table_name' => $this->string(255),
            'field_id' => $this->integer(),
            'field_name' => $this->string(255),
            'field_description'=> $this->string(255),
            'field_value' => $this->text(),
            'language_code' => $this->string(255),
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
