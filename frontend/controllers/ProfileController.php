<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * Site controller
 */
class ProfileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionPersonalCabinet()
    {
        $user = \common\models\User::findOne(Yii::$app->user->identity->id);

        if($user->type == 3)
            return $this->render('profile_performer',['user' => $user]);
        if($user->type == 4)
            return $this->render('profile_customer',['user' => $user]);
    }

    public function actionEditProfile()
    {
        $user = \common\models\User::findOne(Yii::$app->user->identity->id);

        if($user->type == 3)
            return $this->render('edit_profile',['user1' => $user]);
        if($user->type == 4)
            return $this->render('edit_profile',['user1' => $user]);

    }
    public function actionAddAutos()
    {

        return $this->render('add_autos');
    }

}