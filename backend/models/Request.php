<?php

namespace backend\models;

use Yii;
use common\models\User;
use backend\base\AppActiveQuery;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
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
            [['price','mark_id','model_id'],'required'],
            [['mark_id','model_id'],'required'],
            [['task_id', 'date_create', 'price', 'user_id'], 'integer'],
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
            'date_create' => Yii::t('app','Created'),
            'price' => 'Price',
            'user_id' => 'User ID',
            'mark_id' => Yii::t('app','Car mark'),
            'model_id' => Yii::t('app','Car model'),
        ];
    }
    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->date_create = time();
        }
        return parent::beforeSave($insert);
    }

    public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate($this->date_create, 'php:d.m.Y H:i');
    }

    public function behaviors()
    {
        if(Yii::$app->user->identity){
            return [
                [
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'user_id',
                    'updatedByAttribute' => null,
                    'value' => function($event) {
                        return Yii::$app->user->identity->id;
                    },
                ],
            ];
        }
    }

    public function getMarkList()
    {
        $arr = \backend\models\Transports::find()->asArray()->all();
        $marks = ArrayHelper::getColumn($arr, 'mark');
        $result = \backend\models\Marks::find()->where(['id'=>$marks])->all();

        return ArrayHelper::map($result,'id','name_mark');
    }
  
    public static function findOne($condition)
    {
        $model = parent::findOne($condition);
        if(Yii::$app->user->isGuest == false) 
        {
            if(Yii::$app->user->identity->type === 3)
            {
                $userId = Yii::$app->user->identity->id;
                if($model->user_id != $userId){
                    throw new ForbiddenHttpException('Доступ запрещен');
                }
            }
        }
        return $model;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    public function getModel()
    {
        return $this->hasOne(Models::className(), ['id' => 'model_id']);
    }

    public function getMark()
    {
        return $this->hasOne(Marks::className(), ['id' => 'mark_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAuto($user_id)
    {
        return Transports::find()->where(['mark'=>$this->mark_id,'model'=>$this->model_id,'user_id'=>$user_id])->one();
    }
}
