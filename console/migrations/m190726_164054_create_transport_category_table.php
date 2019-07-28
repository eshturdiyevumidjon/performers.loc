<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transport_category}}`.
 */
class m190726_164054_create_transport_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transport_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("Наименование"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transport_category}}');
    }
}
