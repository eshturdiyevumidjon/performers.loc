<?php

namespace backend\models;

use common\models\User;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class VerifyEmailForm extends Model
{
    /**
     * @var string
     */
    public $token;


    public function rules()
    {
        return [
            ['token', 'trim'],
            ['token','string'],
            ['token', 'required'],
            ['token','validateToken'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'token' => 'Код для подтверждения',
        ];
    }
    public function validateToken($attribute)
    {
        if(!User::findByVerificationToken($token))
            $this->addError($attribute,'Неверный код подтверждения');
    }
}
