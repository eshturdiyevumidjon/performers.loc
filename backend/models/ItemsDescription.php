<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayhHelper;

/**
 * This is the model class for table "items_description".
 *
 * @property int $id
 * @property string $name
 *
 * @property TaskItems[] $taskItems
 */
class ItemsDescription extends \yii\db\ActiveRecord
{
    public $translation_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_description';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name','required'],
            [['name'], 'string', 'max' => 255],
            [['translation_name'],'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app','Name'),
        ];
    }
    public static function NeedTranslation()
    {
        return [
            'name'=>'translation_name',
        ];
    }
   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskItems()
    {
        return $this->hasMany(TaskItems::className(), ['item_id' => 'id']);
    }
}
