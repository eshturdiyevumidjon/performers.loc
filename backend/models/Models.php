<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "models".
 *
 * @property int $id
 * @property string $name_model
 * @property int $mark_id
 *
 * @property Marks $mark
 */
class Models extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'models';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mark_id'], 'integer'],
            [['name_model','mark_id'], 'string', 'max' => 255],
            [['mark_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marks::className(), 'targetAttribute' => ['mark_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_model' => Yii::t('app','Car model'),
            'mark_id' => Yii::t('app','Car mark'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMark()
    {
        return $this->hasOne(Marks::className(), ['id' => 'mark_id']);
    }

    public function getMarksList()
    {
        return \yii\helpers\ArrayHelper::map(\backend\models\Marks::find()->all(),'id','name_mark');
    }
}
