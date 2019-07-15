<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','set-theme','dashboard','set-theme-values','error'],
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

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        } else {
           
            $model->password = '';

            return $this->render('login', [
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

}
