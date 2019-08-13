<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\RegisterForm;
use frontend\models\PerformerRegister;
use frontend\models\CustomerRegister;
use frontend\models\ContactForm;
use \yii\web\Response;
use yii\helpers\Html;
use backend\models\Feedback;

/**
 * Site controller
 */
class SiteController extends Controller
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function beforeAction($action)
    {
        if ($action->id == 'set-language') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
        return false;
    }
    public function actionSetLanguage($lang)
    {
        Yii::$app->language = $lang;
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $request = Yii::$app->request;
        $model = new LoginForm();
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->rememberMe = $_POST['rememberMe'];
            if($model->load($request->post()) && $model->login()){
                return [
                    'title'=> "Авторизация",
                    'size'=>'normal',
                    'width'=>'400px',
                    'content'=>$this->renderAjax('login', [
                        'model' => $model,
                        'post' => $_POST,
                    ])."<br><br>",
                    'footer'=>Html::submitButton(Yii::t('app','Login'), ['class' => 'my_modal_submit btn_red', 'name' => 'login-button'])."<br>".
                    Html::a(Yii::t('app','Registration'),['signup'], ['class' => 'my_modal_button btn_red','role'=>'modal-remote'])
                ];   
               return $this->redirect(['index']);    
            }else{    
                $model->password = '';       
                return [
                    'title'=> "Авторизация",
                    'size'=>'normal',
                    'content'=>$this->renderAjax('login', [
                        'model' => $model,
                    ])."<br><br>",
                    'footer'=>Html::submitButton(Yii::t('app','Login'), ['class' => 'my_modal_submit btn_red', 'name' => 'login-button'])."<br>".
                    Html::a(Yii::t('app','Registration'),['signup'], ['class' => 'my_modal_button btn_red','role'=>'modal-remote'])
                ];         
            }
        }
        else
        {
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                $model->password = '';

                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new Feedback();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(filter_var($model->feedback, FILTER_VALIDATE_EMAIL))
            {
                $model->email = $model->feedback;
            }
            else
            {
                $model->phone = $model->feedback;
            }
            if ($model->save()) {
                    $success = Yii::t('app','Thank you for contacting us. We will respond to you as soon as possible.');
                    return $this->render('contact', [
                    'model' => $model,
                    'success' => $success,
                    'save'=>1,
                ]);
            } else {
                    $success = Yii::t('app','There was an error sending your message.');
                     return $this->render('contact', [
                    'model' => $model,
                    'success' => $success,
                    'save'=>0,
                ]);
            }
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
  
     public function actionSignup()
    {
        $request = Yii::$app->request;
        $modelCustomer = new CustomerRegister();
        $modelPerformer = new PerformerRegister();


        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if(!empty($_POST))
            {   
                $modelCustomer->attributes=$_POST['CustomerRegister'];
                $modelPerformer->attributes=$_POST['PerformerRegister'];
                if($modelPerformer->signuped())
                        {
                            if($modelPerformer->valid())
                            {
                                $modelForm=new LoginForm();
                                $modelForm->username=$modelPerformer->email;
                                $modelForm->password=$modelPerformer->password;
                                $modelForm->login();
                                return $this->redirect(['index']);
                            }
                            else
                            {
                                 return [
                                    'title'=> Yii::t('app','Signup'),
                                    'content'=>$this->renderAjax('signup', [
                                        'modelCustomer' => $modelCustomer,
                                        'modelPerformer' => $modelPerformer,
                                        'error' => 'Code is not valid',
                                        'active' => 2
                                    ])."<br>",
                                    'footer'=>  Html::submitButton(Yii::t('app','Create my account'),['class'=>'my_modal_submit2 btn_red'])
                        
                                ];  
                            }
                        }
                if($modelPerformer->validate() || $modelCustomer->validate())
                {

                    if($modelCustomer->validate() && $modelCustomer->signup2()){
                        $modelForm=new LoginForm();
                        $modelForm->username=$modelCustomer->email;
                        $modelForm->password=$modelCustomer->password;
                        $modelForm->login();
                        return $this->redirect(['index']);
                    }
                    else
                    {
                    
                        if($modelPerformer->validate() && $modelPerformer->signup1()){
                                 
                                return [
                                    'title'=> Yii::t('app','Signup'),
                                    'content'=>$this->renderAjax('signup', [
                                        'modelCustomer' => $modelCustomer,
                                        'modelPerformer' => $modelPerformer,
                                        'active' => 2
                                    ])."<br>",
                                    'footer'=>  Html::submitButton(Yii::t('app','Create my account'),['class'=>'my_modal_submit2 btn_red'])
                        
                                ];   
                        }

                    }
                }
                else
                {
                        return [
                        'title'=> Yii::t('app','Signup'),
                        'content'=>$this->renderAjax('signup', [
                            'modelCustomer' => $modelCustomer,
                            'modelPerformer' => $modelPerformer,
                            'post' => $_POST,
                            'active' => 1
                        ])."<br>",
                        'footer'=>  Html::submitButton(Yii::t('app','Create my account'),['class'=>'my_modal_submit2 btn_red'])
                    ];   
                }
            }
            else{           
                return [
                    'title'=> Yii::t('app','Signup'),
                    'content'=>$this->renderAjax('signup', [
                        'modelCustomer' => $modelCustomer,
                        'modelPerformer' => $modelPerformer,
                        'post' => $_POST,
                        'active' => 1

                    ])."<br>",
                    'footer'=>  Html::submitButton(Yii::t('app','Create my account'),['class'=>'my_modal_submit2 btn_red'])
        
                ];         
            }
        }
        else {
            if($model->load($request->post()) && $model->signup()){
               Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                return $this->goHome();      
            }
            else
            {
                return $this->render('signup',['model'=>$model]);
            }
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
