<?php
namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\User;

/**
 * Password reset form
 */
class VerifyAccountForm extends Model
{
    public $code;
    public $email;
   
    public function rules()
    {
        return [
            ['code', 'required'],
            ['code', 'string'],
            ['email', 'required'],
            ['email', 'string'],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function validateUser($email)
    {
        $user = \common\models\User::find()->where(['email'=>$email])->one();

        return $this->code == $user->confirmation_code;
       
    }
    
}
