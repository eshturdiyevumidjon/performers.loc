<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "marks".
 *
 * @property int $id
 * @property string $name_mark
 *
 * @property Models[] $models
 */
class Marks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_mark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_mark' => 'Name Mark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(Models::className(), ['mark_id' => 'id']);
    }
}
