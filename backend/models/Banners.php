<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property string $text Текст
 * @property string $link Ссылка
 * @property string $image Фото
 * @property int $type Тип
 */
class Banners extends \yii\db\ActiveRecord
{
    public $translation_title;
    public $translation_text;
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['text','title'],'required'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg',],
            [['text'], 'string'],
            [['translation_text','translation_title'],'safe'],
            [['type'], 'integer'],
            [['title', 'link', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app','Title'),
            'text' => Yii::t('app','Text'),
            'link' => Yii::t('app','Link'),
            'image' => Yii::t('app','Image'),
            'file' => Yii::t('app','Image'),
            'type' => Yii::t('app','Type'),
        ];
    }
    public static function NeedTranslation()
    {
        return [
            'title'=>'translation_title',
            'text'=>'translation_text',
        ];
    }
    public function getImage($for='_form'){
        if($for=='_form')
        return $this->image != null ? '<img style="width:100%;border-radius:10%;" src="/uploads/banners/' . $this->image .'">' : '<img style="width:100%; max-height:300px;border-radius:10%;" src="/uploads/noimg.jpg">';
        if($for=='_columns')
           return $this->image != null ? '<img style="width:60px; border-radius:10%;" src="/uploads/banners/' . $this->image .' ">' : '<img style="width:60px;" src="/uploads/noimg.jpg">';
    }
}
