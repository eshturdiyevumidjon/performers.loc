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
        if ($action->id == 'create-goods') {
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
    
    public function actionViewGoods($id)
    {   
        $this->enableCsrfValidation = false;
        return $this->render('goods/view-goods', [
            'model' => $this->findModel($id),
        ]);
    }
  
    public function actionCreateGoods()
    {
        $request = Yii::$app->request;
        $model = new Tasks();  
        $model->type=3;
        if (isset($_POST['submit']) && $model->save()) {
            return $this->redirect(['goods/view-goods', 'id' => $model->id]);
        } else {
            return $this->render('goods/create-goods', [
                'model' => $model,
            ]);
        }
       
    }
   
    public function actionCreatePassengers()
    {
        $request = Yii::$app->request;
        $model = new Tasks();  
        $model->type=1;
        if (isset($_POST['submit']) && $model->save()) {
            return $this->redirect(['passengers/view-passengers', 'id' => $model->id]);
        } else {
            return $this->render('passengers/create-passengers', [
                'model' => $model,
            ]);
        }
       
    }
     public function actionViewPassengers($id)
    {   
        $this->enableCsrfValidation = false;
        return $this->render('passengers/view-passengers', [
            'model' => $this->findModel($id),
        ]);
    }
  
    public function actionCreateVehicles()
    {
        $request = Yii::$app->request;
        $model = new Tasks();  
        $model->type=2;
        if (isset($_POST['submit']) && $model->save()) {
            return $this->redirect(['vehicles/view-vehicles', 'id' => $model->id]);
        } else {
            return $this->render('vehicles/create-vehicles', [
                'model' => $model,
            ]);
        }
       
    }
     public function actionViewVehicles($id)
    {   
        $this->enableCsrfValidation = false;
        return $this->render('vehicles/view-vehicles', [
            'model' => $this->findModel($id),
        ]);
    }

     public function actionCreateHelp()
    {
        $request = Yii::$app->request;
        $model = new Tasks();  
        $model->type=4;
        if (isset($_POST['submit']) && $model->save()) {
            return $this->redirect(['help/view-help', 'id' => $model->id]);
        } else {
            return $this->render('help/create-help', [
                'model' => $model,
            ]);
        }
       
    }
     public function actionViewHelp($id)
    {   
        $this->enableCsrfValidation = false;
        return $this->render('help/view-help', [
            'model' => $this->findModel($id),
        ]);
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
}
