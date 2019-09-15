<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%items_description}}`.
 */
class m190915_052600_create_items_description_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%items_description}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
        $descriptions = [
            'Мебель и бытовая техника','Пианино и сейфы','Спецтехника и негабарит'
        ];
        foreach ($descriptions as $value) {
              $this->insert('{{%items_description}}',array(
                    'name' => $value,
            ));
        };
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%items_description}}');
    }
}
