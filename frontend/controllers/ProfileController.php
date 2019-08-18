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

    public function actionIndex()
    {
        $user = \common\models\User::findOne(Yii::$app->user->identity->id);

        if($user->type == 3)
            return $this->render('profile_performer',['user' => $user]);
        if($user->type == 4)
            return $this->render('profile_customer',['user' => $user]);
    }

    public function actionEditProfile($id)
    {
        $user = $this->findModel($id);
        if($user->birthday)
        {
            $arr = explode('.', $user->birthday);
            $user->day = (int)$arr[0];
            $user->month = (int)$arr[1];
            $user->year = (int)$arr[2];
            $user->birthday = date("yyyy-mm-dd",$user->birthday);
        }

        if(isset($_POST['change_password']))
        {   
            $user->old_password = $_POST['User']['old_password'];
            $user->new_password = $_POST['User']['new_password'];
            $user->re_password = $_POST['User']['re_password'];

            if($user->auth_key == $user->old_password)
            {
                if($user->new_password == "" || $user->re_password == "" )
                {
                    Yii::$app->session->setFlash('danger', Yii::t('app','Password cannot be blank.'));
                     return $this->render('edit_profile',['user' => $user,'active'=>2,'post'=>$_POST['User']]);
                }

                if(strlen($user->new_password) < 6 ||  strlen($user->new_password) > 24)
                {
                    Yii::$app->session->setFlash('danger', Yii::t('app','Password must be contain from 6 to 24 characters'));
                     return $this->render('edit_profile',['user' => $user,'active'=>2,'post'=>$_POST['User']]);
                }

                if($user->new_password == $user->re_password)
                {
                     Yii::$app->session->setFlash('success', Yii::t('app','Changes saved.'));
                     $user->auth_key = $user->new_password;
                     $user->save();
                     $this->refresh();
                }
                else
                {
                    Yii::$app->session->setFlash('danger', Yii::t('app','"Password" and "Confirm password" do not match'));
                     return $this->render('edit_profile',['user' => $user,'active'=>2,'post'=>$_POST['User']]);
                }
            }
            else
            {
                Yii::$app->session->setFlash('danger', Yii::t('app','Wrong old password.'));
                return $this->render('edit_profile',['user' => $user,'active'=>2,'post'=>$_POST['User']]);  
            }
        }

        if(isset($_POST['submit']))
        {
         
            $user->language = implode(',',array_unique($_POST['language']));
            $user->alert_site = ($_POST['alert_site'])?1:0;
            $user->alert_email = ($_POST['alert_email'])?1:0;
            $user->degree_of_language = $_POST['degree'];
            // echo "<pre>";
            // print_r($user->attributes);
            // print_r($_POST);
            // echo "</pre>";
            // die;
          
            if($user->load(Yii::$app->request->post()) && $user->validate())
            {   
                if(isset($user->day) && isset($user->month) &&isset($user->year))
                {
                    $user->birthday = $user->day.'.'.$user->month.'.'.$user->year;
                    if(checkdate((int)$user->month,(int)$user->day,(int)$user->year) || $user->birthday =='..')
                    {
                        $user->save();
                    }
                    else {
                            Yii::$app->session->setFlash('danger', Yii::t('app','Check your information.Something wrong.'));
                            return $this->render('edit_profile',['user' => $user]); 
                    }
                }
                else
                {
                    if(!isset($user->day) && !isset($user->month) && !isset($user->year))
                    {
                        $user->save();
                    }
                    else
                    {

                        Yii::$app->session->setFlash('danger', Yii::t('app','Check your information.Something wrong.'));
                            return $this->render('edit_profile',['user' => $user]); 
                    }
                }

                Yii::$app->session->setFlash('success', Yii::t('app','Changes saved.'));
                $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('danger', Yii::t('app','Check your information.Something wrong.'));
                return $this->render('edit_profile',['user' => $user]);
            }
        }
        
        return $this->render('edit_profile',['user' => $user]);
    }

    public function actionEdit1Profile($id)
    {
        $user = $this->findModel($id);

        if(isset($_POST['change_password']))
        {   
            $user->old_password = $_POST['User']['old_password'];
            $user->new_password = $_POST['User']['new_password'];
            $user->re_password = $_POST['User']['re_password'];

            if($user->auth_key == $user->old_password)
            {
                if($user->new_password == "" || $user->re_password == "" )
                {
                    Yii::$app->session->setFlash('danger', Yii::t('app','Password cannot be blank.'));
                     return $this->render('edit_profile',['user' => $user,'active'=>2,'post'=>$_POST['User']]);
                }

                if(strlen($user->new_password) < 6 ||  strlen($user->new_password) > 24)
                {
                    Yii::$app->session->setFlash('danger', Yii::t('app','Password must be contain from 6 to 24 characters'));
                     return $this->render('edit_profile',['user' => $user,'active'=>2,'post'=>$_POST['User']]);
                }

                if($user->new_password == $user->re_password)
                {
                     Yii::$app->session->setFlash('success', Yii::t('app','Changes saved.'));
                     $user->auth_key = $user->new_password;
                     $user->save();
                     $this->refresh();
                }
                else
                {
                    Yii::$app->session->setFlash('danger', Yii::t('app','"Password" and "Confirm password" do not match'));
                     return $this->render('edit_profile',['user' => $user,'active'=>2,'post'=>$_POST['User']]);
                }
            }
            else
            {
                Yii::$app->session->setFlash('danger', Yii::t('app','Wrong old password.'));
                return $this->render('edit_profile',['user' => $user,'active'=>2,'post'=>$_POST['User']]);  
            }
        }

        if(isset($_POST['submit']))
        {
            $user->language = $_POST['language'];
            $user->alert_site = ($_POST['alert_site'])?1:0;
            $user->alert_email = ($_POST['alert_email'])?1:0;
            $user->degree_of_language = $_POST['degree'];
          
            if($user->load(Yii::$app->request->post()) && $user->validate())
            {   
                Yii::$app->session->setFlash('success', Yii::t('app','Changes saved.'));
                $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('danger', Yii::t('app','Check your information.Something wrong.'));
                return $this->render('edit_profile',['user' => $user]);
            }
        }
        
        return $this->render('edit_profile',['user' => $user]);
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

    public function actionChangePassword()
    {
        $user = $this->findModel($_POST['idModel']);
        if($user->auth_key == $_POST['old_password'])
        {

        }
        else{
            Yii::$app->session->setFlash('danger', Yii::t('app','Wrong old password'));
            return $this->render('edit_profile',['user' => $user,'post'=>$_POST,'active'=>2]);
        }
    }

}