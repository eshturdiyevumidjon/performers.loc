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
use yii\data\Pagination;

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
        $company = \backend\models\AboutCompany::findOne(1);
        $my_tasks = \backend\models\Tasks::find()->where(['user_id'=>$user->id]);
        $all_tasks = \backend\models\Tasks::find()->all();
        $banner = \backend\models\Banners::findOne(1);

        $countQuery = clone $my_tasks;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $my_tasks->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        if($user->type == 3)
            return $this->render('profile_performer',['user' => $user,'company'=>$company,'all_tasks'=>$all_tasks,'banner'=>$banner]);
        if($user->type == 4)
            return $this->render('profile_customer',['user' => $user,'company'=>$company,'my_tasks'=>$models,'banner'=>$banner,'pages' => $pages]);
    }

    public function beforeAction($action)
    {
        if ($action->id == 'edit-profile' || $action->id == 'change-password' || $action->id == 'delete-transport' || $action->id == 'create-auto1' || $action->id == 'create-driver1' || $action->id == 'add-autos') {
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
                    return $this->redirect(['edit-profile']);
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
        $banner = \backend\models\Banners::findOne(1);
        $user->alert_site = 1;
        $user->alert_email = 1;
        $user->save();
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
                return $this->redirect(['edit-profile']);
            }
            else
            {
                Yii::$app->session->setFlash('danger', Yii::t('app','Check your information.Something wrong.'));
                return $this->render('edit_profile',['user' => $user,'banner'=>$banner]);
            }
        }
        return $this->render('edit_profile',['user' => $user,'banner'=>$banner]);
    }

    //auto and drivers -- performers
    public function actionAddAutos()
    {
        $post = Yii::$app->request->post();

        $autos = \backend\models\Transports::find()->all();
        $drivers = \backend\models\Drivers::find()->all();
        $company = \backend\models\AboutCompany::findOne(1);
        $id = Yii::$app->user->identity->id;
        $user = $this->findModel($id);
        $transport = new \backend\models\Transports();
        $driver = new \backend\models\Drivers();
       
        $transport->active = (Yii::$app->session['active']) ? Yii::$app->session['active'] : 1; 
        if(isset($post['submit'])){


            if($post['submit'] == 'add_transport')
            {
                $transport->active = 1;
                Yii::$app->session['active_create'] = 1;

                $transport['attributes'] = $post['Transports'];
                if($transport->validate())
                {
                    $transport->save();
                    Yii::$app->session['active'] = 1;

                    $images = [];
                    $uploadDir = "uploads/transports/";
                    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {

                    $ext = "";
                    $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 

                    $fPath =$transport->id .'('.$i.')'. rand() . ".$ext";
                        if($ext != ""){
                           $images []= $fPath;
                           $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath);
                        }
                    }
                    $transport->images = implode(',',$images);
                    $transport->save();
                    $this->redirect(['add-autos']);
                }
                else
                     return $this->render('add_autos',[
                            'user'=>$user,
                            'drivers'=>$drivers,
                            'company'=>$company,
                            'autos'=>$autos,
                            'transport'=>$transport,
                            'driver'=>$driver
                        ]);

            }
             if( $post['submit'] == 'add_driver')
            {
                $transport->active = 2;

                $driver['attributes'] = $post['Drivers'];
                Yii::$app->session['active_create'] = 2;

                if($driver->validate())
                {
                    $driver->save();
                    Yii::$app->session['active'] = 2;

                    $images = [];
                    $uploadDir = "uploads/drivers/";
                    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {

                    $ext = "";
                    $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 

                    $fPath =$driver->id .'('.$i.')'. rand() . ".$ext";
                        if($ext != ""){
                           $images []= $fPath;
                           $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath);
                        }
                    }
                    $driver->images = implode(',',$images);
                    $driver->save();
                    $this->redirect(['add-autos']);
                }
                else
                     return $this->render('add_autos',[
                            'user'=>$user,
                            'drivers'=>$drivers,
                            'company'=>$company,
                            'autos'=>$autos,
                            'transport'=>$transport,
                            'driver'=>$driver
                        ]);

            }
        }else
        
        {
            Yii::$app->session['active_create'] = 0;
        return $this->render('add_autos',[
            'user'=>$user,
            'drivers'=>$drivers,
            'company'=>$company,
            'autos'=>$autos,
            'transport'=>$transport,
            'driver'=>$driver
        ]);
        }
    }

   
    public function actionUpdateAuto($id)
    {
        $request = Yii::$app->request;
        $model = \backend\models\Transports::find()->where(['id'=>$id])->one();
        $old_images = explode(',', $model->images);
        Yii::$app->session['active'] = 1;
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
                    'title'=> Yii::t('app','Update'),
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

     public function actionUpdateDriver($id)
    {
        $request = Yii::$app->request;
        $model = \backend\models\Drivers::find()->where(['id'=>$id])->one();
        $old_images = explode(',', $model->images);
        Yii::$app->session['active'] = 2;
        
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
                    'title'=> Yii::t('app','Update'),
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
        if($model->images != ""){
            $imgs = explode(',', $model->images);
            foreach ($imgs as $value) {
                if(file_exists('uploads/transports/'.$value))
                {   
                    unlink('uploads/transports/'.$value);
                }
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
        if($model->images != ""){
            $imgs = explode(',', $model->images);
            foreach ($imgs as $value) {
                if(file_exists('uploads/drivers/'.$value))
                {   
                    unlink('uploads/drivers/'.$value);
                }
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
    public function actionChangePhoto()
    {
        $user = \common\models\User::findOne($_POST['id']);
        $path = '/admin/uploads/avatars/'; // upload directory

        if($_FILES['image'])
        {

        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

        $user->image = $user->id .'('.$i.')'. rand() . '.'.$ext;
        $path = $path. $user->image; 
        if(move_uploaded_file($tmp,$path)) 
            {
                echo "<img src='$path' />";
                 $user->save();
            }
        }
        else{
            echo "<pre>";
            print_r($_POST);
        }
    }
}