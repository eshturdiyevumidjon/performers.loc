<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promo_codes}}`.
 */
class m190726_164037_create_promo_codes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promo_codes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(255),
            'count' => $this->integer(),
            'used_count' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promo_codes}}');
    }
}
