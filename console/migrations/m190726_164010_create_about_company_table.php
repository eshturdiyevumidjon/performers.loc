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
            'phone' => $this->string(255)->comment("Телефон"),
            'email' => $this->string(255)->comment("Email"),
            'facebook' => $this->string(255)->comment("Facebook"),
            'instagram' => $this->string(255)->comment("Instagram"),
            'address' => $this->text()->comment("Адрес"),
            'coordinate_x' => $this->string(255)->comment("Coordinate X"),
            'coordinate_y' => $this->string(255)->comment("Coordinate Y"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%about_company}}');
    }
}
