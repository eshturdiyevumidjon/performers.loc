<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%models}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%marks}}`
 */
class m190907_191814_create_models_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%models}}', [
            'id' => $this->primaryKey(),
            'name_model' => $this->string(255),
            'mark_id' => $this->integer(),
        ]);

        // creates index for column `mark_id`
        $this->createIndex(
            '{{%idx-models-mark_id}}',
            '{{%models}}',
            'mark_id'
        );

        // add foreign key for table `{{%marks}}`
        $this->addForeignKey(
            '{{%fk-models-mark_id}}',
            '{{%models}}',
            'mark_id',
            '{{%marks}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%marks}}`
        $this->dropForeignKey(
            '{{%fk-models-mark_id}}',
            '{{%models}}'
        );

        // drops index for column `mark_id`
        $this->dropIndex(
            '{{%idx-models-mark_id}}',
            '{{%models}}'
        );

        $this->dropTable('{{%models}}');
    }
}
