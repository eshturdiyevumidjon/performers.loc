<?php
 
namespace backend\models;
 
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User; 
/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
 
    public $password;
    public $repassword;
 
    public $token;
    /**
     * @var \app\models\User
     */
    private $_user;
 
    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
 
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
 
        $this->_user = User::findByPasswordResetToken($token);
 
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
 
        parent::__construct($config);
    }
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['repassword', 'required'],
            ['token','safe'],
            ['password', 'string', 'min' => 6],
            ['repassword', 'string', 'min' => 6],
            [['password', 'repassword'],'validatePassword'],
        ];
    }
    public function validatePassword($attribute)
    { 
        if($this->password != $this->repassword) $this->addError($attribute, '«Пароль» и «Повторный ввод пароля» не совпадают');        
    }
    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
            'token'=>'Код для подтверждения',
            'repassword' => 'Повторный ввод пароля',
        ];
    }
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
 
}