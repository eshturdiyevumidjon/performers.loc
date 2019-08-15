<?php
 
namespace frontend\models;
 
use Yii;
use yii\base\Model;
use common\models\User;
 
/**
 * Signup form
 */
class RegisterForm extends Model
{
    public $username;
    public $phone;
    public $email;
    public $password;
    public $repassword;
    public $code;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email','validateMail'],
            [['password', 'repassword'],'validatePassword'],
            ['password', 'string', 'min' => 6],
            [['username','phone','email','password','repassword'],'required'/*, 'on' => self::SCENARIO1*/],
      
        ];
    }

     public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app','Surname and name / Company name')/*'Фамилия и имя/Название компании'*/,
            'phone' => Yii::t('app','Phone number')/*'Телефон'*/,
            'email' => 'E-mail'/*'Логин'*/,
            'password' => Yii::t('app','password')/*'Пароль'*/,
            'repassword' => Yii::t('app','Confirm password')/*'Повторный ввод пароля'*/,
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
     public function validatePassword($attribute)
    { 
        if($this->password != $this->repassword) $this->addError($attribute, Yii::t('app','"Password" and "Confirm password" do not match'));        
    }
    public function validateMail($attribute)
    { 
        if(User::find()->where(['email'=>$this->email])->count()>0)
        $this->addError($attribute, Yii::t('app','This email address is already taken.'));        
    }

     public function signup2()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->type=4;
        $user->auth_key=$this->password;

        return $user->save() ? $user : null;
    }
 
}