<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transport_category".
 *
 * @property int $id
 * @property string $name Наименование
 *
 * @property Tasks[] $tasks
 */
class TransportCategory extends \yii\db\ActiveRecord
{
    public $translation_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transport_category';
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
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['category_id' => 'id']);
    }
}
