<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property int $type Тип
 * @property string $chat_id Чат ИД
 * @property string $date_cr Дата создании
 * @property int $from Создатель
 * @property int $to Получатель
 * @property string $title Заголовок
 * @property string $file Файл
 * @property resource $text Текст
 * @property int $reply Ответить
 * @property int $deleted Удалено
 *
 * @property User $from0
 * @property User $to0
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'from', 'to', 'reply', 'deleted'], 'integer'],
            [['date_cr'], 'safe'],
            [['text'], 'string'],
            [['chat_id', 'title', 'file'], 'string', 'max' => 255],
            [['from'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['from' => 'id']],
            [['to'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['to' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'chat_id' => 'Chat ID',
            'date_cr' => 'Date Cr',
            'from' => 'From',
            'to' => 'To',
            'title' => 'Title',
            'file' => 'File',
            'text' => 'Text',
            'reply' => 'Reply',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(User::className(), ['id' => 'from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(User::className(), ['id' => 'to']);
    }
}