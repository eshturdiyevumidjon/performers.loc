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
use frontend\models\VerifyAccountForm;
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
        $company = \backend\models\AboutCompany::findOne(1);
        return $this->render('index',['company' => $company]);
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
               return $this->redirect(['/profile/index']);    
            }else{    
                $model->password = '';       
                return [
                    'title'=> "Авторизация",
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

    public function actionRetry($email)
    {
        $user = \common\models\User::findOne([
            'email' => $email,
        ]);

        $user->generateCode();
         Yii::$app
        ->mailer
        ->compose()
        ->setFrom(['itake1110@gmail.com' => Yii::$app->name . ' robot'])
        ->setTo($email)
        ->setSubject('Verify account for ' . Yii::$app->name)
        ->setHtmlBody('<b>'.$user->confirmation_code.'</b>')
        ->send();
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
    public function actionSinglePage($id)
    {
        $new = \backend\models\News::find()->where(['id'=>$id])->one();
        return $this->render('single-page',['new' => $new]);  
    }
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    
    public function actionChavo()
    {
        $chavos = \backend\models\Chavo::find()->all();
        return $this->render('chavo',['chavos' => $chavos]);
    }

    public function actionNews()
    {
        $news = \backend\models\News::find()->all();
        return $this->render('blog',['news' => $news]);
    }

    public function actionPrivacy()
    {
        $text = \backend\models\Settings::findOne(1)->value;
        return $this->render('privacy',['text' => $text]);
    }

    public function actionContact()
    {
        $model = new Feedback();
        $company = \backend\models\AboutCompany::findOne(1);

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
                Yii::$app->session->setFlash('success', Yii::t('app','Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app','There was an error sending your message.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                'company' => $company,
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
    public function actionSetConfirm($email)
    {
         $user = \common\models\User::findOne([
            'email' => $email,
        ]);

        $user->generateCode();
         Yii::$app
        ->mailer
        ->compose()
        ->setFrom(['itake1110@gmail.com' => Yii::$app->name . ' robot'])
        ->setTo($user->email)
        ->setSubject('Password reset for ' . Yii::$app->name)
        ->setHtmlBody('<b>'.$user->confirmation_code.'</b>')
        ->send();

    }
    public function actionSignup()
    {
        $request = Yii::$app->request;
        $modelCustomer = new CustomerRegister();
        $modelPerformer = new PerformerRegister();
        $modelCustomer->active = 1;

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if(!empty($_POST))
            {   
                $modelCustomer->attributes=$_POST['CustomerRegister'];
                $modelPerformer->attributes=$_POST['PerformerRegister'];
                $modelCustomer->active = $_POST['CustomerRegister']['active'];
                
                if($modelCustomer->active == 1)
                {
                    if($modelCustomer->validate() && $modelCustomer->signup2()){
                        $modelForm=new LoginForm();
                        $modelForm->username=$modelCustomer->email;
                        $modelForm->password=$modelCustomer->password;
                        $modelForm->login();
                        return $this->redirect(['/profile/index']);
                    }
                    else
                    {
                         return [
                                    'title'=> Yii::t('app','Signup'),
                                    'content'=>$this->renderAjax('signup', [
                                        'modelCustomer' => $modelCustomer,
                                        'modelPerformer' => $modelPerformer,
                                        'active' => 1
                                    ])."<br>",
                                    'footer'=>  Html::submitButton(Yii::t('app','Create my account'),['class'=>'my_modal_submit2 btn_red'])
                        
                                ];
                    }
                }
                if($modelCustomer->active == 2)
                {
                     if($modelPerformer->signuped())
                        {
                            if($modelPerformer->valid())
                            {
                                $modelForm=new LoginForm();
                                $modelForm->username=$modelPerformer->email;
                                $modelForm->password=$modelPerformer->password;
                                $modelForm->login();
                                return $this->redirect(['/profile/index']);
                            }
                            else
                            {
                                 return [
                                    'title'=> Yii::t('app','Signup'),
                                    'content'=>$this->renderAjax('signup', [
                                        'modelCustomer' => $modelCustomer,
                                        'modelPerformer' => $modelPerformer,
                                        'error' => 'Code is not valid',
                                        'active' => 3
                                    ])."<br>",
                                    'footer'=>  Html::submitButton(Yii::t('app','Create my account'),['class'=>'my_modal_submit2 btn_red'])
                        
                                ];  
                            }
                        }
                    if($modelPerformer->validate() && $modelPerformer->signup1())
                    {
                         return [
                                    'title'=> Yii::t('app','Signup'),
                                    'content'=>$this->renderAjax('signup', [
                                        'modelCustomer' => $modelCustomer,
                                        'modelPerformer' => $modelPerformer,
                                        'active' => 3
                                    ])."<br>",
                                    'footer'=>  Html::submitButton(Yii::t('app','Create my account'),['class'=>'my_modal_submit2 btn_red'])
                        
                                ];  
                    }
                    else{
                        return [
                        'title'=> Yii::t('app','Signup'),
                        'content'=>$this->renderAjax('signup', [
                            'modelCustomer' => $modelCustomer,
                            'modelPerformer' => $modelPerformer,
                            'active' => $_POST['CustomerRegister']['active']
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
                        'active' => 1
                    ])."<br>",
                    'footer'=>  Html::submitButton(Yii::t('app','Create my account'),['class'=>'my_modal_submit2 btn_red'])
        
                ]; 
            }
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */

    public function actionRequestPasswordReset($email = null)
    {
        
        $model = new PasswordResetRequestForm();
        if($email != null)
            {
                $model->email = $email;
                    if ($model->sendEmail()) {
                    Yii::$app->session->setFlash('success', Yii::t('app','Check your email for further instructions.'));
                    return $this->redirect(['verify-account','email'=>$model->email]);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app','Sorry, we are unable to reset password for the provided email address.'));
                }
            }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('app','Check your email for further instructions.'));
                return $this->redirect(['verify-account','email'=>$model->email]);
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app','Sorry, we are unable to reset password for the provided email address.'));
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionVerifyAccount($email)
    {
        $model = new VerifyAccountForm();
        $model->email = $email;

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->validateUser($email)) {
            return $this->redirect(['reset-password','email'=>$model->email]);
        }

        return $this->render('resendVerificationEmail', [
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

    public function actionResetPassword($email)
    {
        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword($email)) {
            Yii::$app->session->setFlash('success', Yii::t('app','New password saved.'));
            return $this->redirect(['request-password-reset']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
            'email'=>$email,
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
    public function actionCancellationPolicy()
    {
        $text = \backend\models\Settings::findOne(1)->value;
        return $this->render('privacy',['text' => $text]);
    }
   
}
