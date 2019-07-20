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
        $language=[
            ['af','Afrikaans'],
            ['ar','‏Arabic -العربية‏'],
            ['az','Azerbaijani - Azərbaycan dili'],
            ['be','Belarusian - Беларуская' ],
            ['bg','Bulgarian - Български' ],
            ['bs','Bosnian - Bosanski'],
            ['ca','Catalan - Català'] ,
            ['cs','Czech - Čeština' ],
            ['da','Danish - Dansk'],
            ['de','German - Deutsch'],
            ['el','Greek - Ελληνικά'],
            ['es','Spanish - Español'],
            ['et','Estonian - Eesti'],
            ['fa','Persian -فارسی‏'] ,
            ['fi','Finnish - Suomi'],
            ['fr','French - Français'],
            ['he','Hebrew - ברית‏'],
            ['hr','Croatian - Hrvatski'],
            ['hu','Hungarian - Magyar'],
            ['hy','Armenian - Հայերեն'],
            ['id','Indonesian - Bahasa Indonesia'] ,
            ['it','Italian - Italiano'],
            ['ja','Japanese - 日本語'],
            ['ka','Georgian - ქართული'],
            ['kk','Kazakh - Qazaqşa'],
            ['ko','Korean - 한국어'],
            ['lt','Leet Speak'],
            ['lv','Latvian - Latviešu'],
            ['ms','Malay - Bahasa Malayu' ],
            ['nb-NO','Norwegian - Norsk'],
            ['nl','Dutch - Nederlands' ],
            ['pl','Polish - Polski'],
            ['pt','Portuguese-Portugal'],
            ['pt-BR','Portuguese-Brazil'],
            ['ro','Romanian - Română'],
            ['sk','Slovak - Slovenčina'],
            ['sl','Slovenian - Slovenščina'],
            ['sr','Serbian - Српски'],
            ['sv','Swedish - Svenska'],
            ['th','Thai - ภาษาไทย'],
            ['tr','Turkish - Türkçe'],
            ['uk','Ukrainian - Українська'],
            ['uz','Uzbek - O\'zbekcha'],
            ['vi','Vietnamese - Tiếng Việt'],
            ['zh-CN','Simplified Chinese (China)-中文(简体)'],
            ['zh-TW','Traditional Chinese (Taiwan)-中文(台灣)'],
            ];
        $this->createTable('{{%lang}}', [
            'id' => $this->primaryKey(),
            'url'=>$this->string(255)->notNull(),
            'local'=>$this->string(255),
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
            'default'=>1,
            'status'=>1,
            'image'=>'',
            'date_update'=>time(),
            'date_create'=>time(),
        ));
          $this->batchInsert('{{%lang}}', [
            'url',
            'name',
        ], $language);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lang}}');
    }
}