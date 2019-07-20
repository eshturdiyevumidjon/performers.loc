<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Users');
$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
?>
        <div class="faq-index">
            <div id="ajaxCrudDatatable">
                <?=GridView::widget([
                    'id'=>'crud-datatable',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pjax'=>true,
                    'responsiveWrap' => false,
                    'columns' => require(__DIR__.'/_columns.php'),
                    'toolbar'=> [
                        ['content'=>
                            '<div style="margin-top:10px;">' .
                            Html::a(Yii::t('app','Add').' <i class="glyphicon glyphicon-plus"></i>', ['create'],
                            ['role'=>'modal-remote','title'=> Yii::t('app','Add'), 'class'=>'btn btn-info']).
                            Html::a(Yii::t('app','Sort Columns'), ['columns','id'=>10],['role'=>'modal-remote','title'=> Yii::t('app','Sort Columns'), 'class'=>'btn btn-warning']) .
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
                        'type' => 'warning', 
                        'heading' => '<i class="glyphicon glyphicon-list"></i>&nbsp;&nbsp;'.Yii::t('app','Users listing'),
                        'before'=>'',
                        'after'=>BulkButtonWidget::widget([
                                    'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>'.Yii::t('app','Delete All'),
                                        ["bulk-delete"] ,
                                        [
                                            "class"=>"btn btn-danger btn-xs",
                                            'role'=>'modal-remote-bulk',
                                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                            'data-request-method'=>'post',
                                            'data-confirm-title'=>Yii::t('app','Are you sure?'),
                                            'data-confirm-message'=>Yii::t('app','Really do you want delete this item')
                                        ]),
                                ]).                        
                                '<div class="clearfix"></div>',
                    ]
                ])?>
            </div>
        </div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "options" => [
        "tabindex" => false,
    ],
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
