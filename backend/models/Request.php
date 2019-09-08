<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $task_id Заказ
 * @property int $date_create Дата создания
 * @property int $price Цена
 * @property int $user_id Испольнитель
 * @property int $car_id Марка и Модел автомобиля
 *
 * @property Tasks $task
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'date_create', 'price', 'user_id', 'car_id'], 'integer'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'date_create' => 'Date Create',
            'price' => 'Price',
            'user_id' => 'User ID',
            'car_id' => 'Car ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
