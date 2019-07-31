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
 * This is the model class for table "transports".
 *
 * @property int $id
 * @property int $user_id
 * @property string $model
 * @property string $mark
 * @property string $driver
 *
 * @property User $user
 */
class Transports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $translation_model;
    public $translation_mark;
    public $translation_driver;

    public static function tableName()
    {
        return 'transports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['translation_driver','translation_mark','translation_model'],'safe'],
            [['user_id'], 'integer'],
            [['model', 'mark', 'driver'], 'required'],
            [['model', 'mark', 'driver'], 'string', 'max' => 255],
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
            'user_id' => Yii::t('app','Owner'),
            'model' => Yii::t('app','Model'),
            'mark' => Yii::t('app','Mark'),
            'driver' => Yii::t('app','Driver'),
        ];
    }
    public static function NeedTranslation()
    {
        return [
            'model'=>'translation_model',
            'mark'=>'translation_mark',
            'driver'=>'translation_driver',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
 
    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
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
}