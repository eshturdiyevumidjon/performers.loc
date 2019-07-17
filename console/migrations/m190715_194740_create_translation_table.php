<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%translation}}`.
 */
class m190715_194740_create_translation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%translation}}', [
            'id' => $this->primaryKey(),
            'url_id'=>$this->integer(),
            'text'=>$this->text(),
        ]);
          $this->createIndex(
            '{{%idx-translation-url_id}}',
            '{{%translation}}',
            'url_id'
        );

        // add foreign key for table `{{%lang}}`
        $this->addForeignKey(
            '{{%fk-translation-url_id}}',
            '{{%translation}}',
            'url_id',
            '{{%lang}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-translation-url_id}}',
            '{{%translation}}'
        );

        // drops index for column `region_id`
        $this->dropIndex(
            '{{%idx-translation-url_id}}',
            '{{%translation}}'
        );
        $this->dropTable('{{%translation}}');
    }
}
