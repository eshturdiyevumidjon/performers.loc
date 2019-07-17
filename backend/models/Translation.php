<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "translation".
 *
 * @property int $id
 * @property int $url_id
 * @property string $text
 *
 * @property Lang $url
 */
class Translation extends \yii\db\ActiveRecord
{
    public $base_text;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'translation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url_id'], 'integer'],
            [['text','base_text'], 'string'],
            [['url_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lang::className(), 'targetAttribute' => ['url_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url_id' => 'Url ID',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrl()
    {
        return $this->hasOne(Lang::className(), ['id' => 'url_id']);
    }
}
