<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['url', 'local', 'name'], 'required'],
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
            'url' => 'Url',
            'local' => 'Local',
            'name' => 'Name',
            'image' => 'Image',
            'default' => 'Default',
            'status' => 'Status',
            'date_update' => 'Date Update',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::className(), ['url_id' => 'id']);
    }

   
}