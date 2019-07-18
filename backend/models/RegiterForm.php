<?php
 
namespace backend\models;
 
use Yii;
use yii\base\Model;
use common\models\User;
 
/**
 * Signup form
 */
class RegiterForm extends Model
{
 
    public $username;
    public $phone;
    public $email;
    public $password;
    public $repassword;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['phone', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email','validateMail'],
            ['password', 'required'],
            ['repassword', 'required'],
            [['password', 'repassword'],'validatePassword'],
            ['password', 'string', 'min' => 6],
        ];
    }
     public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Логин',
            'password' => 'Пароль',
            'repassword' => 'Повторный ввод пароля',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
     public function validatePassword($attribute)
    { 
        if($this->password != $this->repassword) $this->addError($attribute, '«Пароль» и «Повторный ввод пароля» не совпадают');        
    }
    public function validateMail($attribute)
    { 
        if(User::find()->where(['username'=>$this->email])->count()>0)
        $this->addError($attribute, 'Этот адрес электронной почты уже занят.');        
    }
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->type=4;
        $user->auth_key=$this->password;

        return $user->save() ? $user : null;
    }
 
}