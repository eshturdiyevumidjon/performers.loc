<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $type Способ оплаты
 * @property int $task_id Задание
 * @property string $date_pay Дата оплаты
 * @property double $amount Сумма
 * @property int $status Статус
 *
 * @property Tasks $task
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'task_id', 'status','request_id'], 'integer'],
            [['date_pay'], 'safe'],
            [['amount'], 'number'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'task_id' => 'Task ID',
            'date_pay' => 'Date Pay',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }
     public function getOrder()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }
}
