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
use yii\web\NotFoundHttpException;
use common\models\User;

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

    public function actionChangePhoto()
    {
        echo "<pre>";
        print_r($_POST);
        print_r($_FILES);
        echo "</pre>";
    }

    public function actionIndex()
    {
        $user = \common\models\User::findOne(Yii::$app->user->identity->id);
        $company = \backend\models\AboutCompany::findOne(1);

        if($user->type == 3)
            return $this->render('profile_performer',['user' => $user,'company'=>$company]);
        if($user->type == 4)
            return $this->render('profile_customer',['user' => $user,'company'=>$company]);
    }
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
        return false;
    }
    public function actionChangePassword()
    {
        $id = $_POST['id_user'];
        $user = $this->findModel($id);
        $user->old_password = $_POST['User']['old_password'];
        $user->new_password = $_POST['User']['new_password'];
        $user->re_password = $_POST['User']['re_password'];
        if($user->auth_key == $user->old_password)
        {
            if($user->new_password == "" || $user->re_password == "" )
            {
                Yii::$app->session['password[status]']='danger';
                Yii::$app->session['password[message]']=Yii::t('app','Password cannot be blank.');
                 return $this->render('edit_profile',['user' => $user,'active'=>2]);
            }

            if(strlen($user->new_password) < 6 ||  strlen($user->new_password) > 24)
            {
                Yii::$app->session['password[status]']='danger';
                Yii::$app->session['password[message]']=Yii::t('app','Password must be contain from 6 to 24 characters');
                 return $this->render('edit_profile',['user' => $user,'active'=>2]);
            }

            if($user->new_password == $user->re_password)
            {
                 Yii::$app->session['password[status]']='success';
                 Yii::$app->session['password[message]']=Yii::t('app','Changes saved.');

                 $user->auth_key = $user->new_password;
                 $user->save();
                 return $this->render('edit_profile',['user' => $user,'active'=>2]);
            }
            else
            {
                Yii::$app->session['password[status]']='danger';
                Yii::$app->session['password[message]']=Yii::t('app','"Password" and "Confirm password" do not match');
                 return $this->render('edit_profile',['user' => $user,'active'=>2]);
            }
        }
        else
        {
            Yii::$app->session['password[status]']='danger';
            Yii::$app->session['password[message]']=Yii::t('app','Wrong old password.');
            return $this->render('edit_profile',['user' => $user,'active'=>2]);  
        }
    }
    
    public function actionEditProfile()
    {
        $request = Yii::$app->request;
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = $this->findModel(Yii::$app->user->identity->id);
            // echo "<pre>";
            // print_r($request->post());
            // echo "</pre>";
            // die;

        if($user->load($request->post()) && $user->save()){
            Yii::$app->session->setFlash('success', Yii::t('app','Changes saved.'));
            return $this->redirect(['edit-profile']);
        }
        else{
            return $this->render('edit_profile',['user' => $user]);
        }
    }

    public function actionAddAutos()
    {
        if(isset($_POST['auto']))
        {
           echo "<pre>";
           print_r($_POST);
           echo "</pre>";
           die;
        }
        return $this->render('add_autos',['post'=>$_POST]);
    }

    protected function findModel($id)
    {
        if (($model = \common\models\User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

   

}