<?php
 
namespace frontend\models;
 
use Yii;
use yii\base\Model;
use common\models\User;
 
/**
 * Signup form
 */
class PerformerRegister extends Model
{
	public $username;
    public $phone;
    public $email;
    public $password;
    public $repassword;
    public $code;
	public $verify_code;
 	public $verify_phone;

	public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['verify_code','safe'],
 			['verify_phone','safe'],
            ['email', 'string', 'max' => 255],
            ['email','validateMail'],
            [['password', 'repassword'],'validatePassword'],
            ['password', 'string', 'min' => 6],
            [['username','phone','email','password','repassword'],'required'/*, 'on' => self::SCENARIO1*/],
        ];
    }
     public function validatePassword($attribute)
    { 
        if($this->password != $this->repassword) $this->addError($attribute, Yii::t('app','"Password" and "Confirm password" do not match'));        
    }
    public function validateMail($attribute)
    { 
        if(User::find()->where(['email'=>$this->email])->count()>0)
        $this->addError($attribute, Yii::t('app','This email address is already taken.'));        
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
    public function signuped()
    {
	 	$count = User::find()->where(['email' => $this->email,'username' => $this->username, 'type' => 3, 'phone' => $this->phone])->count();
	 	if($count > 0) return true;

	 	return false;
    }
    public function signup1()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->type=3;
        $user->generateCode();
        $user->auth_key=($this->password);

        Yii::$app
        ->mailer
        ->compose()
        ->setFrom(['itake1110@gmail.com' => Yii::$app->name . ' robot'])
        ->setTo($user->email)
        ->setSubject('Verify account for ' . Yii::$app->name)
        ->setHtmlBody('<b>'.$user->confirmation_code.'</b>')
        ->send();

        return $user->save() ? $user : null;
    }
    public function valid()
	{
	 	$user = User::find()->where(['email' => $this->email,'username' => $this->username, 'type' => 3, 'phone' => $this->phone])->one();

		return    $user->confirmation_code == $this->verify_code;
	}

}