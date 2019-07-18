<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Lang;
use backend\models\RegiterForm;
use backend\models\VerifyEmailForm;
use backend\models\ResetPasswordForm;
use backend\models\PasswordResetRequestForm;

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
                'rules' => [
                    [
                        'actions' => ['login','register','request-password-reset','reset-password2','reset-password'],
                        'allow' => true,
                        'roles'=>['?'],
                    ],
                    [
                        'actions' => ['logout','register', 'index','set-theme','dashboard','set-theme-values','error','set-language'],
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

    public function actionSetLanguage($url,$pathinfo,$local)
    {
        Lang::setCurrent($url);
        $cookie=new yii\web\Cookie([
            'name'=>'_lang',
            'value'=>$local
        ]);
        Yii::$app->getResponse()->getCookies()->add($cookie);
       return $this->redirect([$pathinfo]);
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'main-login';

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['dashboard']);
        } else {
           
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionRegister()
    {
        $model = new RegiterForm();
        $this->layout = 'main-login';

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['index']);
        } else {
           
            $model->password = "";

            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionSetTheme()
    {
        $session = Yii::$app->session;
        if (isset($_POST['theme'])) $session['theme'] = $_POST['theme'];
    }
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }
    public function actionSetThemeValues()
    {
        $session = Yii::$app->session;
        if (isset($_POST['st_head_fixed'])) $session['st_head_fixed'] = $_POST['st_head_fixed'];
        if (isset($_POST['st_sb_fixed'])) $session['st_sb_fixed'] = $_POST['st_sb_fixed'];
        if (isset($_POST['st_sb_scroll'])) $session['st_sb_scroll'] = $_POST['st_sb_scroll'];
        if (isset($_POST['st_sb_right'])) $session['st_sb_right'] = $_POST['st_sb_right'];
        if (isset($_POST['st_sb_custom'])) $session['st_sb_custom'] = $_POST['st_sb_custom'];
        if (isset($_POST['st_sb_toggled'])) $session['st_sb_toggled'] = $_POST['st_sb_toggled'];
        if (isset($_POST['st_layout_boxed'])) $session['st_layout_boxed'] = $_POST['st_layout_boxed'];
    }

    public function actionStHeadFixed()
    {
        $session = Yii::$app->session;
        if($session['st_head_fixed'] != null) return $session['st_head_fixed'];
        else return 0;
    }

    public function actionStSbFixed()
    {
        $session = Yii::$app->session;
        if($session['st_sb_fixed'] != null) return $session['st_sb_fixed'];
        else return 1;
    }

    public function actionStSbScroll()
    {
        $session = Yii::$app->session;
        if($session['st_sb_scroll'] != null) return $session['st_sb_scroll'];
        else return 1;
    }

    public function actionStSbRight()
    {
        $session = Yii::$app->session;
        if($session['st_sb_right'] != null) return $session['st_sb_right'];
        else return 0;
    }

    public function actionStSbCustom()
    {
        $session = Yii::$app->session;
        if($session['st_sb_custom'] != null) return $session['st_sb_custom'];
        else return 0;
    }

    public function actionStSbToggled()
    {
        $session = Yii::$app->session;
        if($session['st_sb_toggled'] != null) return $session['st_sb_toggled'];
        else return 0;
    }

    public function actionStLayoutBoxed()
    {
        $session = Yii::$app->session;
        if($session['st_layout_boxed'] != null) return $session['st_layout_boxed'];
        else return 0;
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        $this->layout = 'main-login';
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->redirect(['reset-password2']);
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
 
        return $this->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }
    public function actionResetPassword2()
    {
        $this->layout = 'main-login';

        $model=new VerifyEmailForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                return $this->redirect(['reset-password','token'=>$model->token]);
            }
        else return $this->render('passwordResetRequestFormToken', [
            'model' => $model]);
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
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
 
        return $this->render('passwordResetRequestForm', [
            'model' => $model]);
    }
}
