<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transports}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m190721_065422_create_transports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transports}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment("Владелец"),
            'model' => $this->string(255)->comment("Модель"),
            'mark' => $this->string(255)->comment("Марка"),
            'driver' => $this->string(255)->comment("Водитель"),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-transports-user_id}}',
            '{{%transports}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-transports-user_id}}',
            '{{%transports}}',
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
            '{{%fk-transports-user_id}}',
            '{{%transports}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-transports-user_id}}',
            '{{%transports}}'
        );

        $this->dropTable('{{%transports}}');
    }
}
