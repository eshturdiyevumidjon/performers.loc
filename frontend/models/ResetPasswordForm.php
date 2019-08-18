<?php
namespace frontend\models;

use Yii;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $repassword;

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['repassword', 'required'],
            ['repassword', 'string', 'min' => 6],
            [['password', 'repassword'],'validatePassword'],
        ];
    }
    public function validatePassword($attribute)
    { 
        if($this->password != $this->repassword) $this->addError($attribute, Yii::t('app','"Password" and "Confirm password" do not match'));        
    }
    public function resetPassword($email)
    {
        $user = \common\models\User::find()->where(['email'=>$email])->one();
        $user->auth_key = md5($this->password);

        $user->setPassword($this->password);
        $user->confirmation_code="";
        return $user->save(false);
    }
}
