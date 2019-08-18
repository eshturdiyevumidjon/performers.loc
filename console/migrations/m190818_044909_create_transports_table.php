<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transports}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%drivers}}`
 * - `{{%user}}`
 */
class m190818_044909_create_transports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transports}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string(255),
            'mark' => $this->string(255),
            'driver' => $this->integer(),
            'images'=> $this->string(),
            'registration_number'=> $this->string(),
            'user_id' => $this->integer(),
        ]);

        // creates index for column `driver`
        $this->createIndex(
            '{{%idx-transports-driver}}',
            '{{%transports}}',
            'driver'
        );

        // add foreign key for table `{{%drivers}}`
        $this->addForeignKey(
            '{{%fk-transports-driver}}',
            '{{%transports}}',
            'driver',
            '{{%drivers}}',
            'id',
            'CASCADE'
        );

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
        // drops foreign key for table `{{%drivers}}`
        $this->dropForeignKey(
            '{{%fk-transports-driver}}',
            '{{%transports}}'
        );

        // drops index for column `driver`
        $this->dropIndex(
            '{{%idx-transports-driver}}',
            '{{%transports}}'
        );

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
