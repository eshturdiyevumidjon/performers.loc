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
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use common\models\User;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

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

    public function actionChangeType()
    {
        $user = \common\models\User::findOne(Yii::$app->user->identity->id);
        if($user->note == 'isp')
            $user->note = 'zkz';
        else{
            $user->note = 'isp';
        }
        $user->save();
        return $this->redirect(['index']);
    }
    public function actionIndex($tab = null)
    {
        $user = \common\models\User::findOne(Yii::$app->user->identity->id);
        $company = \backend\models\AboutCompany::findOne(1);
        $banner = \backend\models\Banners::findOne(1);

        if($user->type == 3){
            $all_tasks = \backend\models\Tasks::find()->where(['type'=>explode(',',$user->role_performer),'performer_id'=>null,'status'=>0]);

            $my_active_tasks = \backend\models\Tasks::find()->where(['performer_id'=>$user->id,'status'=>0]);
            $countQuery3 = clone $my_active_tasks;
            $pages3 = new Pagination(['totalCount' => $countQuery3->count()]);
            $pages3->setPageSize(10);
            $all_active_tasks = $my_active_tasks->offset($pages3->offset)
                ->limit($pages3->limit)
                ->all();

            $countQuery2 = clone $all_tasks;
            $pages2 = new Pagination(['totalCount' => $countQuery2->count()]);
            $pages2->setPageSize(10);
            $all_tasks = $all_tasks->offset($pages2->offset)
                ->limit($pages2->limit)
                ->all();

            return $this->render('profile_performer',['user' => $user,'company'=>$company,'all_tasks'=>$all_tasks,'banner'=>$banner,'pages' => $pages2,'post'=>$post,'all_active_tasks'=>$all_active_tasks,'pages2' => $pages3,'tab'=>$tab]);
        }

        if($user->type == 4){
            $my_tasks = \backend\models\Tasks::find()->where(['user_id'=>$user->id,'status'=>0]);
            $countQuery = clone $my_tasks;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $pages->setPageSize(10);
            $models = $my_tasks->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('profile_customer',['user' => $user,'company'=>$company,'my_tasks'=>$models,'banner'=>$banner,'pages' => $pages,'tab'=>$tab]);
        }
    }

    public function beforeAction($action)
    {
        if ($action->id == 'edit-profile' || $action->id == 'change-password' || $action->id == 'delete-transport' || $action->id == 'create-auto1' || $action->id == 'create-driver1' || $action->id == 'add-autos'|| $action->id == 'search' || $action->id == 'upload-photos') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
        return false;
    }

    public function actionSearch()
    {
        $user = \common\models\User::findOne(Yii::$app->user->identity->id);
        $company = \backend\models\AboutCompany::findOne(1);
        $banner = \backend\models\Banners::findOne(1);

        $all_tasks = \backend\models\Tasks::find()->where(['performer_id'=>null,'status'=>0]);


        $my_active_tasks = \backend\models\Tasks::find()->where(['performer_id'=>$user->id,'status'=>0]);
        $countQuery3 = clone $my_active_tasks;
        $pages3 = new Pagination(['totalCount' => $countQuery3->count()]);
        $pages3->setPageSize(10);
        $all_active_tasks = $my_active_tasks->offset($pages3->offset)
            ->limit($pages3->limit)
            ->all();

        $dataProvider = new ActiveDataProvider([
               'query' => $all_tasks,
        ]);

            $type = ($_POST['type']) ? $_POST['type'] : explode(',',$user->role_performer);
            $cost_from = ($_POST['cost_from']) ? $_POST['cost_from'] : "";
            $cost_to = ($_POST['cost_to']) ? $_POST['cost_to'] : "";
            $data_from = ($_POST['data_from']) ? $_POST['data_from'] : "";
            $data_to = ($_POST['data_to']) ? $_POST['data_to'] : "";
            $adress = $_POST['address'];
                
            $all_tasks->andWhere(['type'=>$type]);
                       
            if ($cost_to != "" && $cost_from != "") {
                // die("bir");
                $all_tasks->andWhere(['between', 'offer_your_price', $cost_from, $cost_to]);
            }
            elseif($cost_to != "" || $cost_from != ""){
                if($cost_to)
                {
                    $all_tasks->andWhere(['<=', 'offer_your_price', $cost_to]);
                }
                else{
                    $all_tasks->andWhere(['>=', 'offer_your_price', $cost_from]);
                }
            }

            if ($data_to != "" && $data_from != "") {
                $data_from=Yii::$app->formatter->asDate($data_from, 'php:Y-m-d H:i'); 
                $data_to=Yii::$app->formatter->asDate($data_to, 'php:Y-m-d H:i'); 
                // die("bir");
                $all_tasks->andWhere(['between', 'date_begin', $data_from, $data_to]);
            }
            elseif($data_to != "" || $data_from != ""){
                if($data_to)
                {
                    $data_to=Yii::$app->formatter->asDate($data_to, 'php:Y-m-d H:i'); 
                    $all_tasks->andWhere(['<=', 'date_begin', $data_to]);
                }
                else{
                    $data_from=Yii::$app->formatter->asDate($data_from, 'php:Y-m-d H:i'); 
                    $all_tasks->andWhere(['>=', 'date_begin', $data_from]);
                }
            }

            if($adress){

                    $all_tasks->andWhere(['like', 'shipping_address', $adress]);
            }

            $count = $all_tasks->count();      
            $countQuery2 = clone $all_tasks;
            $pages2 = new Pagination(['totalCount' => $countQuery2->count(),'pageSize'=>10]);
            $all_tasks = $all_tasks->offset($pages2->offset)
                ->limit($pages2->limit)
                ->all();
            return $this->render('profile_performer',['user' => $user,'company'=>$company,'all_tasks'=>$all_tasks,'banner'=>$banner,'pages' => $pages2,'post'=>$_POST,'all_active_tasks'=>$all_active_tasks,'pages2' => $pages3]);
    }

    public function actionChangeProfile()
    {
        $post = Yii::$app->request->post();
        $id = Yii::$app->user->identity->id;
        $user = $this->findModel($id);
        $banner = \backend\models\Banners::findOne(1);
        
        if(isset($post['save_changes'])){

            if($post['save_changes'] == 'edit_information')
            {
                $user->scenario = User::SCENARIO_INF;

                Yii::$app->session['active_tab'] = 1;
                $user->language = implode(',',($_POST['language']));

                $user->alert_site = ($_POST['alert_site'])?1:0;
                $user->alert_email = ($_POST['alert_email'])?1:0;
                $user->attributes = $_POST['User'];

                if($user->load($post) && $user->validate())
                {
                    $user->save();
                    Yii::$app->session['active'] = 1;
                    Yii::$app->session->setFlash('success', Yii::t('app','Changes saved.'));
                    $this->redirect(['change-profile']);
                }
                else
                return $this->render('change_profile',[
                    'user' => $user,
                    'banner'=>$banner,
                    'active'=>$active
                ]);
            }
            
            if( $post['save_changes'] == 'change_password')
            {
                $user->scenario = User::SCENARIO_PSW;
                Yii::$app->session['active_tab'] = 2;

                if($user->load($post) && $user->validate())
                {
                    $user->save();
                    Yii::$app->session['active_tab'] = 2;
                    Yii::$app->session->setFlash('success', Yii::t('app','Changes saved.'));
                    $this->redirect(['change-profile']);
                }
                else
                return $this->render('change_profile',[
                    'user' => $user,
                    'banner'=>$banner,
                    'active'=>$active
                ]);

            }
        }else
        {
         return $this->render('change_profile',[
                    'user' => $user,
                    'banner'=>$banner,
                    'active'=>$active
                ]);
        }
    }
    public function actionSetActive($id)
    {
        Yii::$app->session['active_tab'] = $id;
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
                $transport->images = ($_POST['uploading_images1']) ? implode(',',$_POST['uploading_images1']) : '';
                if($transport->validate())
                {
                    $transport->save();
                    Yii::$app->session['active'] = 1;

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
                $driver->images = ($_POST['uploading_images2']) ? implode(',',$_POST['uploading_images2']) : '';
                if($driver->validate())
                {
                    Yii::$app->session['active'] = 2;
                    
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
        // $old_images = explode(',', $model->images);
        Yii::$app->session['active'] = 1;
       

        // $st = '';
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            if($model->load($request->post()) && $model->validate()){
                $model->images = ($_POST['uploading_images_cr'])  ? implode(',',$_POST['uploading_images_cr']) : '';
                $model->save();
                 return [
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
                 $model->images = ($_POST['uploading_images_cr2'])  ? implode(',',$_POST['uploading_images_cr2']) : '';
                $model->save();
                 return [
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
        $user = \common\models\User::findOne(Yii::$app->user->identity->id);
        $path = \Yii::getAlias('@backend').'/web/uploads/avatars/'; // upload directory
        $img = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];

        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        if($user->image!=null&&file_exists(\Yii::getAlias('@backend').'/web/uploads/avatars/'.$user->image))
        {
            unlink((\Yii::getAlias('@backend').'/web/uploads/avatars/'.$user->image));
        }
        $user->image = $user->id .'('.$i.')'. rand() . '.'.$ext;
        $path = $path. $user->image; 
        if(move_uploaded_file($tmp,$path)) 
            {
                 $user->save();
                 echo $path;
            }
    }
    public function actionUploadPhotos1()
    {
        $images = [];
        $uploadDir = "uploads/transports/";

        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

        $ext = "";
        $ext = substr(strrchr($_FILES['file']['name'][$i], "."), 1); 

        $fPath = $_POST['names'][$i];
            if($ext != ""){
               $images []= $fPath;
               $result = move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadDir . $fPath);
            }
        }

        // echo "<pre>";
        // print_r($_FILES['file']['type']);
        echo "<pre>Photos<br>";
        print_r($images);
        echo "</pre>";

    }
    public function actionUploadPhotos2()
    {
        $images = [];
        $uploadDir = "uploads/drivers/";

        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

        $ext = "";
        $ext = substr(strrchr($_FILES['file']['name'][$i], "."), 1); 

        $fPath = $_POST['names'][$i];
            if($ext != ""){
               $images []= $fPath;
               $result = move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadDir . $fPath);
            }
        }

        // echo "<pre>";
        // print_r($_FILES['file']['type']);
        echo "<pre>";
        print_r($images);
        echo "</pre>";

    }

    public function actionDeleteImage1($value)
    {
          echo "<pre>";
          print_r($value);
          if(file_exists('uploads/transports/'.$value))
             {
                 unlink('uploads/transports/'.$value);
                 echo "deleted";
             }
    }

    public function actionDeleteImage2($value)
    {
          echo "<pre>";
          print_r($value);
        if(file_exists('uploads/drivers/'.$value))
         {
             unlink('uploads/drivers/'.$value);
             echo "deleted";
         }
    }
    
}