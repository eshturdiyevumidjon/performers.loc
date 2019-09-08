<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%marks}}`.
 */
class m190907_191740_create_marks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%marks}}', [
            'id' => $this->primaryKey(),
            'name_mark' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%marks}}');
    }
}
