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
    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->date_cr=time();
        }
        return parent::beforeSave($insert);
    }
    public function getDateCreate()
    {
        return Yii::$app->formatter->asDate($this->date_cr, 'php:d.m.Y');
    }
    public function getSizeInKb($size)
    {
        if ($size < 1024) {
            return "{$this->size} bytes";
        } elseif ($size < 1048576) {
            $size_kb = round($size/1024);
            return "{$size_kb} KB";
        } else {
            $size_mb = round($size/1048576, 1);
            return "{$size_mb} MB";
        }
    }
    
    public function beforeDelete()
    {
     if (file_exists(\Yii::getAlias('@backend').'/web/uploads/chat/'.$this->file)) {
                  unlink(\Yii::getAlias('@backend').'/web/uploads/chat/'.$this->file);
              }
         return parent::beforeDelete();
    }
    
    public function getFileSize()
    {
        $adminka = Yii::$app->params['adminka'];
        return $this->getSizeInKb(filesize(\Yii::getAlias('@backend').'/web/uploads/chat/'.$this->file));
    }
    public function getFileExtension()
    {
        return substr(strrchr($this->file, "."), 1);
    }
    public function getDateTime()
    {
        return Yii::$app->formatter->asDate($this->date_cr, 'php:H:i');
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
