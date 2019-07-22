<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Arrayhelper;
/**
 * This is the model class for table "lang".
 *
 * @property int $id
 * @property string $url
 * @property string $local
 * @property string $name
 * @property string $image
 * @property int $default
 * @property int $status
 * @property int $date_update
 * @property int $date_create
 *
 * @property Translation[] $translations
 */
class Lang extends \yii\db\ActiveRecord
{
    //Переменная, для хранения текущего объекта языка
    static $current = null;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'name'], 'required'],
            [['default', 'status', 'date_update', 'date_create'], 'integer'],
            [['url', 'local', 'name', 'image'], 'string', 'max' => 255],
        ];
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => Yii::t('app','Language Code'),
            'local' => Yii::t('app','Local'),
            'name' => Yii::t('app','Name'),
            'image' => Yii::t('app','Image'),
            'default' => Yii::t('app','Default'),
            'status' => Yii::t('app','Status'),
            'date_update' => Yii::t('app','Date Update'),
            'date_create' => Yii::t('app','Date Create'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::className(), ['url_id' => 'id']);
    }   
    public static function getLanguages()
    {
        return Lang::find()->where(['status'=>1])->all();
    }
    //Получение текущего объекта языка
    static function getCurrent()
    {
       return Lang::find()->where(['url'=>Yii::$app->language])->one();
    }
   
}
