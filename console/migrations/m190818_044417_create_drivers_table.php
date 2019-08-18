<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%drivers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m190818_044417_create_drivers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%drivers}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'images'=> $this->string(),
            'user_id' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-drivers-user_id}}',
            '{{%drivers}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-drivers-user_id}}',
            '{{%drivers}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-drivers-user_id}}',
            '{{%drivers}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-drivers-user_id}}',
            '{{%drivers}}'
        );

        $this->dropTable('{{%drivers}}');
    }
}
