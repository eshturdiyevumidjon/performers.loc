<?php

namespace backend\models;

use Yii;
use common\models\User;
use backend\base\AppActiveQuery;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use backens\models\Translates;
/**
 * This is the model class for table "drivers".
 *
 * @property int $id
 * @property string $fio
 * @property string $phone
 * @property int $user_id
 *
 * @property User $user
 * @property Transports[] $transports
 */
class Drivers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drivers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['fio', 'phone'], 'required'],
            ['images','string'],
            [['user_id'], 'integer'],
            [['fio', 'phone'], 'string', 'max' => 255],
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
            'fio' => Yii::t('app','Username'),
            'phone' => Yii::t('app','Phone number'),
            'user_id' => 'User ID',
        ];
    }

  
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransports()
    {
        return $this->hasMany(Transports::className(), ['driver' => 'id']);
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
    public static function find()
    {
        if(Yii::$app->user->isGuest == false)
        {
            if(Yii::$app->user->identity->type === 3)
            {
                $userId = Yii::$app->user->identity->id;
            }
            else $userId = null;
        } 
        else $userId = null;

        return new AppActiveQuery(get_called_class(), [
           'companyId' => $userId,
        ]);
    }

}
