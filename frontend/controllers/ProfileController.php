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
        if ($action->id == 'edit-profile' || $action->id == 'change-password' || $action->id == 'delete-transport' || $action->id == 'create-auto') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
        return false;
    }
    public function actionChangePassword()
    {
        $id = Yii::$app->user->identity->id;
        $user = $this->findModel($id);
       
        $user->old_password = $_POST['User']['old_password'];
        $user->new_password = $_POST['User']['new_password'];
        $user->re_password = $_POST['User']['re_password'];

        if($user->auth_key == $user->old_password)
        {
            if($user->new_password == "" || $user->re_password == "" )
            {
                Yii::$app->session['status']='danger';
                Yii::$app->session['messag]']=Yii::t('app','Password cannot be blank.');
                 return $this->render('edit_profile',['user' => $user,'active'=>2]);
            }

            if($user->new_password == $user->re_password)
            {
                 Yii::$app->session['status']='success';
                 Yii::$app->session['message']=Yii::t('app','Changes saved.');
                if(strlen($user->new_password) < 6 ||  strlen($user->new_password) > 24)
                {
                    Yii::$app->session['status']='danger';
                    Yii::$app->session['message']=Yii::t('app','Password must be contain from 6 to 24 characters');
                     return $this->render('edit_profile',['user' => $user,'active'=>2]);
                }
                else
                {
                 $user->auth_key = $user->new_password;
                 $user->save();
                 return $this->render('edit_profile',['user' => $user,'active'=>2]);
                 }
            }
            else
            {
                Yii::$app->session['status']='danger';
                Yii::$app->session['message']=Yii::t('app','"Password" and "Confirm password" do not match');
                 return $this->render('edit_profile',['user' => $user,'active'=>2]);
            }
        }
        else
        {
            Yii::$app->session['status']='danger';
            Yii::$app->session['message']=Yii::t('app','Wrong old password.');
            return $this->render('edit_profile',['user' => $user,'active'=>2]);  
        }
    }
    
    public function actionEditProfile()
    {
       $id = Yii::$app->user->identity->id;
        $user = $this->findModel($id);
        
        if(isset($_POST['save_changes']))
        {
            $user->language = implode(',',($_POST['language']));
            $user->alert_site = ($_POST['alert_site'])?1:0;
            $user->alert_email = ($_POST['alert_email'])?1:0;
            $user->attributes = $_POST['User'];
            //echo $user->birthday;

            if($user->validate())
            {   
                 $user->save();
                Yii::$app->session->setFlash('success', Yii::t('app','Changes saved.'));
                return $this->render('edit_profile',['user' => $user]);

            }
            else
            {
                Yii::$app->session->setFlash('danger', Yii::t('app','Check your information.Something wrong.'));
                return $this->render('edit_profile',['user' => $user]);
            }
        }
        return $this->render('edit_profile',['user' => $user]);
    }

    //auto and drivers -- performers
    public function actionAddAutos()
    {
        $autos = \backend\models\Transports::find()->all();
        $drivers = \backend\models\Drivers::find()->all();
        $company = \backend\models\AboutCompany::findOne(1);
        $id = Yii::$app->user->identity->id;
        $user = $this->findModel($id);
       
        return $this->render('add_autos',[
            'user'=>$user,
            'drivers'=>$drivers,
            'company'=>$company,
            'autos'=>$autos
        ]);
    }

    public function actionCreateAuto()
    {
        $request = Yii::$app->request;
        $model = new \backend\models\Transports();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            if($model->load($request->post()) && $model->validate()){
                $model->save();
                $images = [];
                $uploadDir = "uploads/transports/";
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {

                $ext = "";
                $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 

                $fPath =$model->id .'('.$i.')'. rand() . ".$ext";
                    if($ext != ""){
                       $images []= $fPath;
                       $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath);
                    }
                }
                $model->images = implode(',',$images);
                $model->save();
                 return [
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax'
                 ];
               }else{           
                return [
                    'title'=> Yii::t('app','Create'),
                    'size'=>'normal',
                    'content'=>$this->renderAjax('create-autos', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn_red drug sobs1','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn_red drug sobs1','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

     public function actionUpdateAuto($id)
    {
        $request = Yii::$app->request;
        $model = \backend\models\Transports::find()->where(['id'=>$id])->one();
        $old_images = explode(',', $model->images);

        $st = '';
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            if($model->load($request->post()) && $model->validate()){
                $model->save();
                $uploadDir = "uploads/transports/";
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                $ext = "";
                $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 
                
                $fPath =$model->id .'('.$i.')'. rand() . ".$ext";

                if(isset($old_images[$i]))
                {
                    preg_match("/\(([^\)]*)\)/", $old_images[$i], $aMatches);
                    $value = $aMatches[1];
                    $st .= $value . ' ';
                    if($ext != ""){
                        if($value == $i){
                            if(file_exists('uploads/transports/'.$old_images[$i]) && $old_images[$i] != "")
                            {   
                                unlink('uploads/transports/'.$old_images[$i]);
                            }
                            $images []= $fPath;
                            $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath); 
                        }
                        else
                        {
                            $images []= $old_images[$i];
                        }
                    }
                    else{
                        $images []= $old_images[$i];
                    }
                }
                else{
                    if($ext != ""){
                      $images []= $fPath;
                      $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath);
                  }   
                }
                   
                }
                $model->images = implode(',',$images);
                $model->save();
                 return [
                    'title' => count($old_images).'/'.$st,
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax'
                 ];
               }else{           
                return [
                    'title'=> Yii::t('app','Create'),
                    'size'=>'normal',
                    'content'=>$this->renderAjax('update-autos', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn_red drug sobs1 pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn_red drug sobs1','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    public function actionCreateDriver()
    {
        $request = Yii::$app->request;
        $model = new \backend\models\Drivers();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            if($model->load($request->post()) && $model->validate()){
                $model->save();
                $images = [];
                $uploadDir = "uploads/drivers/";
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {

                $ext = "";
                $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 

                $fPath =$model->id .'('.$i.')'. rand() . ".$ext";
                    if($ext != ""){
                       $images []= $fPath;
                       $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath);
                    }
                }
                $model->images = implode(',',$images);
                $model->save();
                 return [
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax-2'
                 ];
               }else{           
                return [
                    'title'=> Yii::t('app','Create'),
                    'size'=>'normal',
                    'content'=>$this->renderAjax('create-drivers', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn_red drug sobs1','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn_red drug sobs1','type'=>"submit"])
        
                ];         
            }
        }
    }

     public function actionUpdateDriver($id)
    {
        $request = Yii::$app->request;
        $model = \backend\models\Drivers::find()->where(['id'=>$id])->one();
        $old_images = explode(',', $model->images);
        
        $st = [];
        foreach ($old_images as $key => $value) {
            preg_match("/\(([^\)]*)\)/", $value, $aMatches);
            $value = $aMatches[1];
            $st[] = $value;
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            if($model->load($request->post()) && $model->validate()){
                $model->save();
                $uploadDir = "uploads/drivers/";
                
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                    $ext = "";
                    $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 
                    
                    $fPath =$model->id .'('.$i.')'. rand() . ".$ext";

                    if($ext != "" ){
                        if(in_array($i, $st)){
                             if(file_exists('uploads/drivers/'.$old_images[$i]) && $old_images[$i] != "")
                                {   
                                    unlink('uploads/drivers/'.$old_images[$i]);
                                }
                        }
                        $images []= $fPath;
                        $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath); 
                    }
                    else{
                        if(in_array($i, $st)){
                            $images []= $old_images[$i];
                        }
                    }
                }
                $model->images = implode(',',$images);
                $model->save();
                 return [
                    'title' => count($old_images).'/'.$st,
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax-2'
                 ];
               }else{           
                return [
                    'title'=> Yii::t('app','Create'),
                    'size'=>'normal',
                    'content'=>$this->renderAjax('update-drivers', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn_red drug sobs1 pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn_red drug sobs1','type'=>"submit"])
        
                ];         
            }
        }
    }

    public function actionDeleteTransport($id)
    {
        $model = \backend\models\Transports::find()->where(['id'=>$id])->one();

        $imgs = explode(',', $model->images);
        foreach ($imgs as $value) {
            if(file_exists('uploads/transports/'.$value))
            {   
                unlink('uploads/transports/'.$value);
            }
        }
        $model->delete();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax'
                 ];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['add-autos']);
        }
    }
    public function actionDeleteImage()     
    {
        $model = \backend\models\Drivers::find()->where(['id'=>$_POST['id']])->one();
        $old_images = explode(',', $model->images);
        $search = $_POST['id'].'('.$_POST['image'].')';
        $images = [];
        for ($i=0; $i < count($old_images); $i++) { 
            if( $_POST['image'] == $i )
                {
                   if(file_exists('uploads/drivers/'.$old_images[$i]))
                    {   
                        unlink('uploads/drivers/'.$old_images[$i]);
                    }  
                }
            $images[] = $old_images[$i];
        }

        $model->images=implode(',', $images);
        $model->save();
       
        echo "<pre>";
        print_r($_POST);
    }
    public function actionDeleteDriver($id)
    {
        $model = \backend\models\Drivers::find()->where(['id'=>$id])->one();

        $imgs = explode(',', $model->images);
        foreach ($imgs as $value) {
            if(file_exists('uploads/drivers/'.$value))
            {   
                unlink('uploads/drivers/'.$value);
            }
        }
        $model->delete();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax-2'
                 ];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['add-autos']);
        }
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