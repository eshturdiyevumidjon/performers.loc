<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lang}}`.
 */
class m190715_194709_create_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lang}}', [
            'id' => $this->primaryKey(),
            'url'=>$this->string(255)->notNull(),
            'local'=>$this->string(255)->notNull(),
            'name'=>$this->string(255)->notNull(),
            'image'=>$this->string(255),
            'default'=>$this->integer()->defaultValue(0),
            'status'=>$this->integer()->defaultValue(0),
            'date_update'=>$this->integer(),
            'date_create'=>$this->integer(),
        ]);
        $this->insert('{{%lang}}',array(
            'url'=>'en',
            'local'=>'en-En',
            'name'=>'English',
            'default'=>1,
            'status'=>1,
            'image'=>'',
            'date_update'=>time(),
            'date_create'=>time(),
        ));
         $this->insert('{{%lang}}',array(
            'url'=>'ru',
            'local'=>'ru-Ru',
            'name'=>'Русский',
            'default'=>0,
            'status'=>1,
            'image'=>'',
            'date_update'=>time(),
            'date_create'=>time(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lang}}');
    }
}
