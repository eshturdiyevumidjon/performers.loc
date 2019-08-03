<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BannersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Settings');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="banners-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                    ['content'=>
                        '<div style="margin-top:10px;">' .
                        Html::a(Yii::t('app','Add').' <i class="glyphicon glyphicon-plus"></i>', ['create','type'=>1],
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
                'heading' => '<i class="glyphicon glyphicon-list"></i>'. Yii::t('app','Settings'),
                'after'=>'<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
