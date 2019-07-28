<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "promo_codes".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $count
 * @property int $used_count
 */
class PromoCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'used_count'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'count' => 'Count',
            'used_count' => 'Used Count',
        ];
    }
}
