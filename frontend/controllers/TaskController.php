<?php
namespace frontend\controllers;

use Yii;
use backend\models\Tasks;
use backend\models\TasksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
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
        if ($action->id == 'create-goods' || $action->id == 'create-help') {
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
    
    public function actionView($id)
    {   
        $model = $this->findModel($id);
        $user = $model->user;
        $active_user = \common\models\User::findOne(Yii::$app->user->identity->id);
        $banner = \backend\models\Banners::findOne(1);
        $requests = \backend\models\Request::find()->joinWith('user')->select('user.*,request.*')->where(['request.task_id'=>$id])->all();
       

        switch ($model->type) {
            case '1': return $this->render('passengers/view-passengers', [
                            'model' => $model,
                            'user'=>$user,
                            'banner'=>$banner,
                            'requests'=>$requests,
                            'active_user'=>$active_user,
                        ]);
            case '2': return $this->render('vehicles/view-vehicles', [
                            'model' => $model,
                            'user'=>$user,
                            'banner'=>$banner,
                            'requests'=>$requests,
                            'active_user'=>$active_user,
                        ]);
            case '3': return $this->render('goods/view-goods', [
                            'model' => $model,
                            'user'=>$user,
                            'banner'=>$banner,
                            'requests'=>$requests,
                            'active_user'=>$active_user,
                        ]);
            default:  return $this->render('help/view-help', [
                            'model' => $model,
                            'user'=>$user,
                            'banner'=>$banner,
                            'requests'=>$requests,
                            'active_user'=>$active_user,
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
    public function actionCreateGoods()
    {
        $model = new Tasks();
        $model->scenario = Tasks::SCENARIO_GOODS;
        $model->type=3;
        $model->loading_required_status = isset($_POST['loading_required_status']) ? 1 : 0;
        $model->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $model->lift = isset($_POST['lift']) ? 1 : 0;
        if(isset($_POST['tip_gruz']))
            $model->classification = implode(',',$_POST['tip_gruz']);

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            $images = [];
            $uploadDir = "uploads/tasks/";
            for ($i = 0; $i < count($_FILES['images']['name']); $i++) {

            $ext = "";
            $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 

            $fPath =$model->id .'('.$i.')'. rand() . ".$ext";
                if($ext != ""){
                   $images []= $fPath;
                   $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath);
                }
            }
            $model->image = implode(',',$images);
            $model->save();

            return $this->redirect(['view','id'=>$model->id]);
        } else {
            $model->alert_email = 1;
            return $this->render('goods/create-goods', [
                'model' => $model,
                'post'=>$_POST
            ]);
        }
       
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
        
        if(isset($_POST['need_relocation'])){
            $model->need_relocation = 1;
            $model->count_relocation = $_POST['count_relocation'];
        }
        if(isset($_POST['need_piano'])){
            $model->need_piano = 1;
            $model->count_piano = $_POST['count_piano'];
        }
        if(isset($_POST['need_furniture'])){
            $model->need_furniture = 1;
            $model->count_furniture = $_POST['count_furniture'];
        }
        if(isset($_POST['need_building_materials'])){
            $model->need_building_materials = 1;
            $model->count_building_materials = $_POST['count_building_materials'];
        }
        if(isset($_POST['need_personal_items'])){
            $model->need_personal_items = 1;
            $model->count_personal_items = $_POST['count_personal_items'];
        }
        if(isset($_POST['need_special_equipments'])){
            $model->need_special_equipments = 1;
            $model->count_special_equipments = $_POST['count_special_equipments'];
        }
        if(isset($_POST['need_purchases'])){
            $model->need_purchases = 1;
            $model->count_purchases = $_POST['count_purchases'];
        }
        if(isset($_POST['need_other_items'])){
            $model->need_other_items = 1;
            $model->count_other_items = $_POST['count_other_items'];
        }
        if(isset($_POST['need_packing'])){
            $model->need_packing = 1;
        }
        if(isset($_POST['need_loaders'])){
            $model->need_loader = 1;
        }

        if($model->load(Yii::$app->request->post()) && $model->save())
        {

            $images = [];
            $uploadDir = "uploads/tasks/";
            for ($i = 0; $i < count($_FILES['images']['name']); $i++) {

            $ext = "";
            $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 

            $fPath =$model->id .'('.$i.')'. rand() . ".$ext";
                if($ext != ""){
                   $images []= $fPath;
                   $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath);
                }
            }
            $model->image = implode(',',$images);
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
    public function actionCreateVehicles()
    {
        $model = new Tasks();
        $model->scenario = Tasks::SCENARIO_VEHICLES;
        $model->type=2;
        $model->alert_email = isset($_POST['alert_email']) ? 1 : 0;
        $model->car_on_the_go = isset($_POST['car_on_the_go']) ? 1 : 0;

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            $images = [];
            $uploadDir = "uploads/tasks/";
            for ($i = 0; $i < count($_FILES['images']['name']); $i++) {

            $ext = "";
            $ext = substr(strrchr($_FILES['images']['name'][$i], "."), 1); 

            $fPath =$model->id .'('.$i.')'. rand() . ".$ext";
                if($ext != ""){
                   $images []= $fPath;
                   $result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $fPath);
                }
            }
            $model->image = implode(',',$images);
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
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true];
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    
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

}
