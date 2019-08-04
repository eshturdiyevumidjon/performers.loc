<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%about_company}}`.
 */
class m190726_164010_create_about_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%about_company}}', [
            'id' => $this->primaryKey(),
            'logo' => $this->string(255)->comment("Лого"),
            'name' => $this->string(255)->comment("Наименование компании"),
            'site' => $this->string(255)->comment("Сайт"),
            'phone' => $this->string(255)->comment("Телефон"),
            'email' => $this->string(255)->comment("Email"),
            'telegram' => $this->string(255)->comment("Telegram"),
            'facebook' => $this->string(255)->comment("Facebook"),
            'instagram' => $this->string(255)->comment("Instagram"),
            'address' => $this->text()->comment("Адрес"),
            'coordinate_x' => $this->string(255)->comment("Coordinate X"),
            'coordinate_y' => $this->string(255)->comment("Coordinate Y"),
        ]);
         $this->insert('{{%about_company}}',array(
             'logo' => 'logo.svg',
            'name' => 'iTake',
            'site' => 'www.itake.uz',
            'phone' => '+998 94 366 66 66,+998 94 366 66 66,+998 71 266 66 66,+998 71 255 55 55',
            'email' => 'itake2019@gmail.com',
            'telegram' => '@iTakeUz',
            'facebook' => 'itake.uz',
            'instagram' => 'itake.uz',
            'address' => 'Шайхонтохурский район, массив Джар арык, дом 7',
            'coordinate_x' => '41.314354',
            'coordinate_y' => '69.265480',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%about_company}}');
    }
}
