<?php
 
namespace backend\models;
 
use Yii;
use yii\base\Model;
use common\models\User;
 
/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email','string'],
            ['email', 'required'],
            ['email','validateFor'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'email' => 'Адрес электронной почты или номер телефона',
        ];
    }
    public function validateFor($attribute)
    { 
        $q=1;
        if(strpos($this->email,'@')===FALSE)
        {
            $pattern = '/\+[0-9]{2}+[0-9]{10}/s';
            if(!preg_match($pattern, $this->email)){
                $err='Неправильный номер телефона';
            }
            else{
                  $user = User::findOne([
                    'status' => User::STATUS_ACTIVE,
                    'phone' => $this->email,
                    ]);
                  if(!$user)
                  {
                    $q=0;
                    $err="Там нет пользователя с таким номером телефона.";
                  }
            }
        }
      
            if ($q&&!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $err.=' или электронной почты';
            }
            else{
                if($q)
                {
                  $user = User::findOne([
                    'status' => User::STATUS_ACTIVE,
                    'email' => $this->email,
                    ]);
                  if(!$user)
                  {
                    $err="Там нет пользователя с таким адресом электронной почты.";
                  }
              }
            }
        if(isset($err))
         {
             $this->addError($attribute,$err);
         }
    }
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
            /* @var $user User */
            $user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email,
            ]);
        
        if ($user)
        {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
                if (!$user->save(false)) {
                    return false;
                }
            }
            return Yii::$app
                ->mailer
                ->compose(
                    [
                        'html' => 'passwordResetToken-html', 
                        'text' => 'passwordResetToken-text'
                    ],
                    ['user' => $user]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('Password reset for ' . Yii::$app->name)
                ->send();
        }
        else
        {
            $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'phone' => $this->email,
            ]);
            if(!$user){
                return false;
            }
            else
            {
                // if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                // $user->password_reset_token=rand(0,9999);
                //     if (!$user->save(false)) {
                //         return false;
                //     }
                // }
                //  $sms = new Sms;
                //  $sms->transmit($this->info,Yii::t('frontend',
                //  'Please return to the site and type in {code}',['code'=>sprintf("%04d",$this->verify_code)]));
            }
        }
    }
    public function requestCode() {
        
        
    }
}