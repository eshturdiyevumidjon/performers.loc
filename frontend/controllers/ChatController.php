<?php

namespace frontend\controllers;

use Yii;
use backend\models\Chat;
use backend\models\ChatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
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
        if ($action->id == 'index') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
        return false;
    }

    /**
     * Lists all Chat models.
     * @return mixed
     */
    public function actionIndex($to = null)
    {    
        $from = Yii::$app->user->identity->id;
        $query = Chat::find()->where(['and', ['to'=>[$to,$from]], ['from'=>[$to,$from]]]);
        $model = new Chat();
        $model->from = $from;

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);
        $models = $dataProvider->getModels();
        $users = \common\models\User::find()->all();

        if($to == null){
             Yii::$app->session->setFlash('warning', Yii::t('app','Please select contact in the right sidebar'));
        }else{
            $model->to = $to;

            $request = Yii::$app->request;
            if($model->load($request->post()) && $model->save())
            {
                $uploadDir = \Yii::getAlias('@backend').'/web/uploads/chat/';
                $ext = "";
                $ext = substr(strrchr($_FILES['file']['name'], "."), 1); 

                $fPath =$_FILES['file']['name']. rand() . ".$ext";
                if($ext != ""){
                   $result = move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fPath);
                    $model->file = $fPath;
                    $model->save();
                }

                return $this->redirect(['index','to'=>$model->to]);
            }
        }

        if (count($models) == 0) {
            Yii::$app->session->setFlash('error', Yii::t('app','You don’t have anything yet'));
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'models' => $models,
            'users'=>$users,
            'model'=>$model
        ]);
       
    }
   
    /**
     * Displays a single Chat model.
     * @param integer $id
     * @return mixed
     */
  
    /**
     * Creates a new Chat model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Chat();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Chat",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new Chat",
                    'content'=>'<span class="text-success">Create Chat success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new Chat",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
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

  
    /**
     * Delete an existing Chat model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }


    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
