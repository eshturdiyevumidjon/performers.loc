<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $name ФИО
 * @property string $phone Телефон
 * @property string $email Email
 * @property string $message Сообщение
 * @property string $date_cr Дата создании
 */
class Feedback extends \yii\db\ActiveRecord
{
    public $feedback;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    
    public function beforeSave($insert){
        if($this->isNewRecord){
            $this->date_cr = time();
        }
        return parent::beforeSave($insert);
    }

    public function getDateCreate()
    {
        return Yii::$app->formatter->asDate($this->date_cr, 'php:d.m.Y H:i:s'); 
    }

    public function rules()
    {
        return [
            [['name','message'],'required'],
            [['date_cr','message'], 'safe'],
            [['is_reply','is_view'],'integer'],
            [['feedback'],'validateFor'],
            [['name', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }
     public function validateFor($attribute)
    { 
        $q=1;
        if(strpos($this->feedback,'@')===FALSE)
        {
            $pattern = '/\+[0-9]{2}+[0-9]{10}/s';
            if(!preg_match($pattern, $this->feedback)){
                $err='Неправильный номер телефона';
            }
            else
            {
                $q = 0;
            }
        }

        if ($q&&!filter_var($this->feedback, FILTER_VALIDATE_EMAIL)){
            $err.=' или электронной почты';
        }

        if(isset($err))
         {
             $this->addError($attribute,$err);
         }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app','Name'),
            'feedback'=>Yii::t('app','Phone number or email address'),
            'phone' => Yii::t('app','Phone number'),
            'email' => Yii::t('app','Email'),
            'message' => Yii::t('app','Message'),
            'date_cr' => Yii::t('app','Date Create'),
        ];
    }
}
