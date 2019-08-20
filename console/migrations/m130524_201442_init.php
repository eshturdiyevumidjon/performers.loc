<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->comment("ФИО"),
            'email' => $this->string(255)->notNull()->unique()->comment("Емайл"),
            'auth_key' => $this->string(255)->notNull()->comment("Пароль"),
            'password_hash' => $this->string(255)->comment("Хэш пароля"),
            'password_reset_token' => $this->string()->unique()->comment("Токен сброса пароля"),
            'type' => $this->integer()->comment("Тип"),
            'birthday'=>$this->date()->comment("день рождения"),
            'phone'=>$this->string(255)->comment('Телефон'),
            'language' => $this->string(255)->defaultValue('1')->comment("Язык"),
            'confirmation_code' => $this->string(255)->comment("Код"),
            'image'=>$this->string(255)->comment('Фото'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment("Статус"),
            'created_at' => $this->integer()->notNull()->comment("Дата создания"),
            'updated_at' => $this->integer()->notNull()->comment("Дата изменения"),
            'alert_email' => $this->integer()->defaultValue(0)->comment("Получать уведомления при поступлении заявок по электронные почте"),
            'address' => $this->string(255)->comment("Город"),
            'alert_site' => $this->integer()->defaultValue(0)->comment("Получать новости сайта"),
            'note'=>$this->text()->comment(""),
        ], $tableOptions);

        $this->insert('user',array(
            'username' => 'Иванов Иван Иванович',          
            'email' => 'admin@mail.ru',
            'auth_key' => md5('admin'),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'type' => 0,
            'image'=>'',
            'status' => 10,
            'phone'=>'',
            'birthday'=>'1995-05-25',
            'created_at' => time(),
            'updated_at' => time(),
            'note'=>'',
        ));
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
