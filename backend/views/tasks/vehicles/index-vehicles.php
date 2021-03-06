<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Transportation of cars and equipment');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="tasks-index2">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns-vehicles.php'),
            'toolbar'=> [
                        ['content'=>
                            '<div style="margin-top:10px;">'.Html::a(Yii::t('app','Add').'<i class="glyphicon glyphicon-plus"></i>', ['create-vehicles'],
                            ['role'=>'modal-remote','title'=> Yii::t('app','Add'), 'class'=>'btn btn-info']).
                            '<ul class="panel-controls">
                                <li>{export}</li>
                            </ul>'.
                        '</div>'
                        ],
                    ],        
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
               'heading' => '<i class="glyphicon glyphicon-list"></i>'. Yii::t('app','Tasks listing'),
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp;'.Yii::t('app','Delete All'),
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>Yii::t('app','Are you sure?'),
                                    'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item')
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
