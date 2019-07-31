<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','register'],
                        'allow' => true,
                        'roles'=>['?'],
                    ],
                    [
                        'actions' => ['create','update','columns','bulk-delete', 'index','view','delete','error','profile','change'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> Yii::t('app','User'),
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }
    /**
     * Creates a new User model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new User();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
               $model->avatar = UploadedFile::getInstance($model,'avatar');
                if(!empty($model->avatar))
                {
                    $model->avatar->saveAs('uploads/avatars/' . $model->id.'.'.$model->avatar->extension);
                    Yii::$app->db->createCommand()->update('user', ['image' => $model->id.'.'.$model->avatar->extension], [ 'id' => $model->id ])->execute();
                }
                return [
                    'title'=>Yii::t('app','Create new user'),
                    'forceReload'=>'#crud-datatable-pjax',
                    'size'=>'large',
                    'title'=> Yii::t('app','Users'),
                    'content'=>'<span class="text-success">'.Yii::t('app','Complete successfully').'</span>',
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Create more'),['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('app','Create new user'),
                    'size'=>'large',
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
        
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
     * Updates an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionChange($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                

                
                $model->avatar = UploadedFile::getInstance($model,'avatar');
                if(!empty($model->avatar))
                {   
                     if($model->image!=null&&file_exists('uploads/avatars/'.$model->image))
                    {
                        unlink(('uploads/avatars/'.$model->image));
                    }
                    $model->avatar->saveAs('uploads/avatars/' . $model->id.'.'.$model->avatar->extension);
                    Yii::$app->db->createCommand()->update('user', ['image' => $model->id.'.'.$model->avatar->extension], [ 'id' => $model->id ])->execute();
                }
                return [
                    'forceReload'=>'#profile-pjax',
                    'forceClose'=>true,
                ];    
            }else{
                 return [
                    'title'=> Yii::t('app','Profile'),
                    'size'=>'large',
                    'content'=>$this->renderAjax('change', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect('profile');
            } else {
                return $this->render('change', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                
                $model->avatar = UploadedFile::getInstance($model,'avatar');
                if(!empty($model->avatar))
                {
                    if($model->image!=null&&file_exists('uploads/avatars/'.$model->image))
                    {
                        unlink(('uploads/avatars/'.$model->image));
                    }
                    $model->avatar->saveAs('uploads/avatars/' . $model->id.'.'.$model->avatar->extension);
                    Yii::$app->db->createCommand()->update('user', ['image' => $model->id.'.'.$model->avatar->extension], [ 'id' => $model->id ])->execute();
                }
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'forceClose'=>true,
                    // 'size'=>'large',
                    // 'title'=> Yii::t('app','User'),
                    // 'content'=>$this->renderAjax('view', [
                    //     'model' => $model,
                    // ]),
                    // 'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    //         Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('app','Update User'),
                    'size'=>'large',
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }
     public function actionColumns($id)
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $session = Yii::$app->session;

        if($request->post()){
            $post = $request->post();
            User::SortColumns($post);
            return [
               
                'forceReload'=>'#crud-datatable-pjax',
                'forceClose'=>true,
            ];          
        }
        else
        {           
            return [
                 'title'=> Yii::t('app','Sort Columns'),
                'content'=>$this->renderAjax('columns', [
                    'session' => $session,
                    'id'=>$id,
                ]),
                'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-primary pull-left','data-dismiss'=>"modal"]).
                            Html::button(Yii::t('app','Save'),['class'=>'btn btn-info','type'=>"submit"])
            ];         
        }       
    } 
    /**
     * Delete an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        if($id!=1)
        {
            $model=$this->findModel($id);
            if(file_exists('uploads/avatars/'.$model->image)&&$model->image!=null)
            {
                unlink('uploads/avatars/'.$model->image);
            }
            $model->delete();            
        }
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
     * Delete multiple existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            if($pk==1)continue;

            $model = $this->findModel($pk);
            if(file_exists('uploads/avatars/'.$model->image)&&$model->image!=null)
            {
                unlink('uploads/avatars/'.$model->image);
            }
            $model->delete();
        }

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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
