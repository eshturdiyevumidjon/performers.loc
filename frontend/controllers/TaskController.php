<?php
namespace frontend\controllers;

use Yii;
use backend\models\Tasks;
use backend\models\TasksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TaskController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }
    public function beforeAction($action)
    {
        if ($action->id == 'create-goods' || $action->id == 'view' || $action->id == 'create-help' || $action->id == 'create-order'|| $action->id == 'send-message') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
        return false;
    }
    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }
    public function actionIndexGoods()
    {    
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,3);

        return $this->render('goods/index-goods', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     */
    
    public function actionSendMessage()
    {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $message = new \backend\models\Chat();

        $message->from = $from;
        $message->to = $to;
        $message->text = $_POST['text'];

        if($_POST['text'] || $_FILES['file'])
        {
            $message->save();
            $uploadDir = \Yii::getAlias('@backend').'/web/uploads/chat/';
            $ext = "";
            $ext = substr(strrchr($_FILES['file']['name'], "."), 1); 

            $fPath =$_FILES['file']['name'];
            if($ext != ""){
               $result = move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fPath);
                $message->file = $fPath;
                $message->save();
            }
        }
        else{
        }

        $query = \backend\models\Chat::find()->where(['and', ['to'=>[$to,$from]], ['from'=>[$to,$from]]])->orderBy(['date_cr' => SORT_ASC //specify sort order ASC for ascending DESC for descending      
            ]);;

        $messages = [];
        $dataProvider = new ActiveDataProvider([
           'query' => $query,
           'pagination'=>[
                'pageSize'=>1000
           ]
        ]);
        $messages = $dataProvider->getModels();

        return $this->renderAjax('request/messages',['messages'=>$messages]);

    }

    public function actionView($id)
    {   
        Yii::$app->session['photo_helps'] = "";
        
        if(! $this->findModel($id) )
        {
            return $this->redirect(['/profile/index']);
        }
        
        $model = $this->findModel($id);

        $user = $model->user;
        $active_user = \common\models\User::findOne(Yii::$app->user->identity->id);
        $banner = \backend\models\Banners::findOne(1);
        $requests = \backend\models\Request::find()->joinWith('user')->select('user.*,request.*')->where(['request.task_id'=>$id]);
    
        if($active_user->type == 3){
            $requests->andWhere(['request.user_id'=>$active_user->id]);
        }      

        $messages = [];
        if($model->performer_id){
            $from = $model->user_id;
            $to = $model->performer_id;
            $query = \backend\models\Chat::find()->where(['and', ['to'=>[$to,$from]], ['from'=>[$to,$from]]])->orderBy(['date_cr' => SORT_ASC //specify sort order ASC for ascending DESC for descending      
            ]);
            
            $dataProvider = new ActiveDataProvider([
               'query' => $query,
               'pagination'=>[
                    'pageSize'=>1000
               ]
            ]);
            $messages = $dataProvider->getModels();
        }


        switch ($model->type) {
            case '1': return $this->render('passengers/view-passengers', [
                            'model' => $model,
                            'user'=>$user,
                            'banner'=>$banner,
                            'requests'=>$requests->all(),
                            'active_user'=>$active_user,
                            'messages'=>$messages
                        ]);
            case '2': return $this->render('vehicles/view-vehicles', [
                            'model' => $model,
                            'user'=>$user,
                            'banner'=>$banner,
                            'requests'=>$requests->all(),
                            'active_user'=>$active_user,
                            'messages'=>$messages
                        ]);
            case '3': return $this->render('goods/view-goods', [
                            'model' => $model,
                            'user'=>$user,
                            'banner'=>$banner,
                            'requests'=>$requests->all(),
                            'active_user'=>$active_user,
                            'messages'=>$messages
                        ]);
            default:  return $this->render('help/view-help', [
                            'model' => $model,
                            'user'=>$user,
                            'banner'=>$banner,
                            'requests'=>$requests->all(),
                            'active_user'=>$active_user,
                            'messages'=>$messages
                        ]);;
        }
    }

    public function actionCreatePassengers()
    {
        $model = new Tasks();
        $model->scenario = Tasks::SCENARIO_PASSENGERS;
        $model->type=1;
        $model->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $model->meeting_with_sign_status = isset($_POST['meeting_with_sign_status']) ? 1 : 0;
        $model->flight_number_status = isset($_POST['flight_number_status']) ? 1 : 0;
        $model->return = isset($_POST['return']) ? 1 : 0;

        $model->count_adult = $_POST['count_adult'];
        $model->count_avtolulka = $_POST['count_avtolulka'];
        $model->count_avtokreslo = $_POST['count_avtokreslo'];
        $model->count_buster = $_POST['count_buster'];

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['view','id'=>$model->id]);
        } else {
            $model->alert_email = 1;
            return $this->render('passengers/create-passengers', [
                'model' => $model,
                'post'=>$_POST
            ]);
        }
    }

    public function actionSaveSessionPassenger()
    {
        $task = new Tasks();
        $task->scenario = Tasks::SCENARIO_PASSENGERS;
        $task->attributes = $_POST['Tasks'];

        $task->type=1;
        $task->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $task->meeting_with_sign_status = isset($_POST['meeting_with_sign_status']) ? 1 : 0;
        $task->flight_number_status = isset($_POST['flight_number_status']) ? 1 : 0;
        $task->return = isset($_POST['return']) ? 1 : 0;
        $task->image = ($_POST['uploading_images']) ? implode(',',$_POST['uploading_images']) : '';

        $task->count_adult = $_POST['count_adult'];
        $task->count_avtolulka = $_POST['count_avtolulka'];
        $task->count_avtokreslo = $_POST['count_avtokreslo'];
        $task->count_buster = $_POST['count_buster'];

        Yii::$app->session['passenger[]'] = $task->attributes;
    }

    public function actionCreateGoods()
    {
        $model = new Tasks();
        $model->scenario = Tasks::SCENARIO_GOODS;
        $model->type=3;
        $model->loading_required_status = isset($_POST['loading_required_status']) ? 1 : 0;
        $model->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $model->lift = isset($_POST['lift']) ? 1 : 0;
        if(isset($_POST['tip_gruz']) && $_POST['tip_gruz'] != [])
            $model->classification = implode(',',$_POST['tip_gruz']);

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model->image = ($_POST['uploading_images']) ? implode(',',$_POST['uploading_images']) : '';
            $model->save();

            return $this->redirect(['view','id'=>$model->id]);
        } else {
            return $this->render('goods/create-goods', [
                'model' => $model,
                'post'=>$_POST
            ]);
        }
       
    }
    public function actionSaveSessionGoods()
    {
        $task = new Tasks();
        $task->scenario = Tasks::SCENARIO_GOODS;
        $task->attributes = $_POST['Tasks'];

        $task->type=3;
        $task->loading_required_status = isset($_POST['loading_required_status']) ? 1 : 0;
        $task->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $task->lift = isset($_POST['lift']) ? 1 : 0;
        $task->image = ($_POST['uploading_images']) ? implode(',',$_POST['uploading_images']) : '';

        if(isset($_POST['tip_gruz']))
            $task->classification = implode(',',$_POST['tip_gruz']);
        Yii::$app->session['goods[]'] = $task->attributes;
    }
    
    public function actionCreateHelp()
    {
        $model = new Tasks();
        $model->scenario = Tasks::SCENARIO_HELP;
        $model->type=4;
        $model->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $model->delivery_house_lift = isset($_POST['delivery_house_lift']) ? 1 : 0;
        $model->shipping_house_lift = isset($_POST['shipping_house_lift']) ? 1 : 0;
        $model->demolition = isset($_POST['demolition']) ? 1 : 0;
      
        if(isset($_POST['need_packing'])){
            $model->need_packing = 1;
        }
        if(isset($_POST['need_loaders'])){
            $model->need_loader = 1;
        }

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            if($_POST['items']){
                foreach ($_POST['items'] as $key => $value) {
                   $mm = new \backend\models\TaskItems();
                   $mm->task_id = $model->id;
                   $mm->item_id = $key;
                   $mm->count = $value;
                   $mm->save(); 
                }
            }

            $model->image = ($_POST['uploading_images']) ? implode(',',$_POST['uploading_images']) : '';
            $model->save();

            return $this->redirect(['view','id'=>$model->id]);
        } else {
            $model->alert_email = 1;
            return $this->render('help/create-help', [
                'model' => $model,
                'post'=>$_POST
            ]);
        }
       
    }
   

    public function actionSaveSessionHelp()
    {
        $task = new Tasks();
        $task->scenario = Tasks::SCENARIO_HELP;
        $task->attributes = $_POST['Tasks'];

        $task->type=4;
        $task->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $task->delivery_house_lift = isset($_POST['delivery_house_lift']) ? 1 : 0;
        $task->shipping_house_lift = isset($_POST['shipping_house_lift']) ? 1 : 0;
        $task->demolition = isset($_POST['demolition']) ? 1 : 0;
        $task->image = ($_POST['uploading_images']) ? implode(',',$_POST['uploading_images']) : '';
        
      
        if(isset($_POST['need_packing'])){
            $task->need_packing = 1;
        }
        if(isset($_POST['need_loaders'])){
            $task->need_loader = 1;
        }
        Yii::$app->session['help[]'] = $task->attributes;
    }

    public function actionCreateVehicles()
    {
        $model = new Tasks();
        $model->scenario = Tasks::SCENARIO_VEHICLES;
        $model->type=2;
        $model->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $model->car_on_the_go = isset($_POST['car_on_the_go']) ? 1 : 0;

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model->image = ($_POST['uploading_images']) ? implode(',',$_POST['uploading_images']) : '';
            $model->save();

            return $this->redirect(['view','id'=>$model->id]);
        } else {
            $model->alert_email = 1;
            return $this->render('vehicles/create-vehicles', [
                'model' => $model,
                'post'=>$_POST
            ]);
        }
    }

    public function actionSaveSessionVehicles()
    {
        $task = new Tasks();
        $task->scenario = Tasks::SCENARIO_VEHICLES;
        $task->attributes = $_POST['Tasks'];

        $task->type=2;
        $task->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $task->car_on_the_go = isset($_POST['car_on_the_go']) ? 1 : 0;
        $task->image = ($_POST['uploading_images']) ? implode(',',$_POST['uploading_images']) : '';
        
        if(isset($_POST['need_packing'])){
            $task->need_packing = 1;
        }
        if(isset($_POST['need_loaders'])){
            $task->need_loader = 1;
        }

        Yii::$app->session['vehicles[]'] = $task->attributes;
    }

    public function actionUpdateVehicles($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['vehicles/view-vehicles', 'id' => $model->id]);
            } else {
                return $this->render('vehicles/update-vehicles', [
                    'model' => $model,
                ]);
            }
    
    }

    public function actionDeleteTask($id)
    {
        $request = Yii::$app->request;
       
        $model=$this->findModel($id);
        if($model->image != ""){
            foreach (explode(',',$model->image) as $value) {
                 if(file_exists('uploads/avatars/'.$value))
                    {
                        unlink('uploads/task/'.$value);
                    }
            }
        }

        

        $model->delete();  
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->session->setFlash('warning', Yii::t('app','Complete successfully'));
            return [
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax'
                ];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    
    }

    public function actionDownloadFile($id)
    {
        $model = \backend\models\Chat::findOne($id);
        return \Yii::$app->response->sendFile(\Yii::getAlias('@backend').'/web/uploads/chat/'.$model->file);
    }

    public function actionCreateRequest($id)
    {
        $request = Yii::$app->request;
        $model = new \backend\models\Request();
        $model->task_id = $id;
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
        
            if($model->load($request->post()) && $model->validate()){
                $model->save();
                 return [
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax'
                 ];
               }else{           
                return [
                    'title'=> Yii::t('app','Create'),
                    'size'=>'normal',
                    'content'=>$this->renderAjax('request/create', [
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
                return $this->render('request-create', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionCreateOrder($id)
    {
        $rr = \backend\models\Request::findOne($id);
        $request = Yii::$app->request;
        
        $order = new \backend\models\Orders();
        $order->task_id = $rr->task_id;
        $order->request_id = $rr->id;

        $task = $this->findModel($rr->task_id);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
        
            if($request->post()){
                    $order->save();
                    $ispolnitel = $rr->user;
                    $zakazchik = $rr->task->user;
                    $task->performer_id = $ispolnitel->id;
                    $task->save();

                     Yii::$app
                    ->mailer
                    ->compose()
                    ->setFrom(['itake1110@gmail.com' => Yii::$app->name . ' robot'])
                    ->setTo($ispolnitel->email)
                    ->setSubject('New Order From ' . Yii::$app->name)
                    ->setHtmlBody("<p>Dear ".$ispolnitel->username.". You have new Order From ".$zakazchik->username."</p>")
                    ->send();

                 return [
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax'
                 ];

               }else{           
                return [
                    'title'=> Yii::t('app','Service charge'),
                    'size'=>'large',
                    'content'=>$this->renderAjax('request/pay_form', [
                    ]),
                     'footer'=>'<br>'.Html::submitButton(Yii::t('app','Pay'), ['class' => 'my_modal_submit btn_red', 'name' => 'order-button']).
                    Html::a(Yii::t('app','Add funds'),['#'], ['class' => 'my_modal_button btn_red','role'=>'modal-remote'])
        
                ];         
            }
        }       
    }
    public function actionDeleteOrder($id,$task_id)
    {
        $request = Yii::$app->request;
       
        $model=\backend\models\Orders::find()->where(['task_id'=>$task_id,'request_id'=>$id])->one();
        $task = $this->findModel($task_id);
        $task->performer_id = null;
        $task->save();

        $model->delete();  
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->session->setFlash('warning', Yii::t('app','Complete successfully'));
            return [
                    'forceClose'=>true,
                    'forceReload'=>'#crud-datatable-pjax'
                ];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }
    public function actionGetModelList($mark_id)
    {
        $arr = \backend\models\Transports::find()->where(['mark'=>$mark_id])->asArray()->all();
        $models = \yii\helpers\ArrayHelper::getColumn($arr, 'model');
        $result = \backend\models\Models::find()->where(['id'=>$models])->all();

        if(count($result) != 0){
            foreach ($result as $key => $value) {
                echo '<option value="'.$value->id.'">'.$value->name_model.'</option>';
            }
        }
        else{
            echo "<option> - </option>";
        }
    }

    public function actionGetModelList2($mark_id)
    {
        $result = \backend\models\Models::find()->where(['mark_id'=>$mark_id])->all();

        if(count($result) != 0){
            foreach ($result as $key => $value) {
                echo '<option value="'.$value->id.'">'.$value->name_model.'</option>';
            }
        }
        else{
            echo "<option> - </option>";
        }
    }
    public function actionUploadPhotosHelp()
    {
        $images = [];
        $uploadDir = "uploads/tasks/";
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

    public function actionDeleteImage($value)
    {
          echo "<pre>";
          print_r($value);
          if(file_exists('uploads/tasks/'.$value))
             {
                 unlink('uploads/tasks/'.$value);
                 echo "deleted";
             }
    }

}
