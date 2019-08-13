<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "replies".
 *
 * @property int $id
 * @property string $name ФИО
 * @property string $phone Телефон
 * @property string $email Email
 * @property string $message Сообщение
 * @property int $feedback_id
 * @property int $date_cr Дата создании
 */
class Replies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'replies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message','email'],'required'],
            [['message'], 'string'],
            [['feedback_id', 'date_cr'], 'integer'],
            [['name', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

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
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'message' => 'Message',
            'feedback_id' => 'Feedback ID',
            'date_cr' => 'Date Cr',
        ];
    }
}
