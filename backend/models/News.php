<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property string $text Текст
 * @property string $fone Фон
 * @property string $date_cr Дата
 */
class News extends \yii\db\ActiveRecord
{
    public $imageFiles;
    public $translation_title;
    public $translation_text;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }
   
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','text'],'required'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
            [['text'], 'string'],
            [['translation_text','translation_title'],'safe'],
            [['date_cr'], 'safe'],
            [['title', 'fone'], 'string', 'max' => 255],
        ];
    }
    public static function NeedTranslation()
    {
        return [
            'title'=>'translation_title',
            'text'=>'translation_text',
        ];
    }
    public function getImage($for='_form')
    {
        if($for=='_form')
        return $this->fone != null ? '<img style="width:100%;border-radius:10%;" src="/uploads/news/' . $this->fone .'">' : '<img style="width:100%; max-height:300px;border-radius:10%;" src="/uploads/noimg.jpg">';
        if($for=='_columns')
           return $this->fone != null ? '<img style="width:60px; border-radius:10%;" src="/uploads/news/' . $this->fone .' ">' : '<img style="width:60px;" src="/uploads/noimg.jpg">';
    }
    public function beforeSave($insert)
    {
        if($this->isNewRecord)
        $this->date_cr=date("Y-m-d");
        return parent::beforeSave($insert);
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->date_cr=Yii::$app->formatter->asDate($this->date_cr, 'php:d.m.Y'); 
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app','Title'),
            'imageFiles' => Yii::t('app',"Image"),
            'text' => Yii::t('app','Text'),
            'fone' => Yii::t('app','Image'),
            'date_cr' => Yii::t('app','Date Create'),
        ];
    }
}
