<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;


//
use katzz0\yandexmaps\Map;
use katzz0\yandexmaps\JavaScript;
use katzz0\yandexmaps\objects\Placemark;
use katzz0\yandexmaps\Polyline;
use katzz0\yandexmaps\Point;
use katzz0\yandexmaps\Canvas as YandexMaps;
//



/* @var $this yii\web\View */
/* @var $searchModel backend\models\AboutCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','About');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<style type="text/css">
    table th td{
        padding:10px;
        text-align: center;
        justify-content: center;
    }
</style>
<div class="about-company-index">
    <div id="ajaxCrudDatatable">
        <section class="content">
            <div class="panel panel-success">
                <div class="panel-heading ui-draggable-handle" style="background-color: #669999;">
                <?=$company->getImage()?>

                </div>
                <div class="clearfix"></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-responsive table-condensed">
                            <tbody>
                                <tr>
                                    <th style="color: #00a7d0">E-mail</th>
                                    <td><?=$company->email?></td>
                                    <th style="color: #00a7d0">Телефон номер</th>
                                    <td>
                                    <?php foreach (explode(',',$company->phone) as $key => $value) {
                                    echo $value."<br>";
                                    }?>        
                                    </td>
                                    <th style="color: #00a7d0">Адрес</th>
                                    <td><?=$company->address?></td>
                                </tr>
                                    <tr>
                                    <th style="color: #00a7d0">Instagram</th>
                                    <td><?=$company->instagram?></td>
                                    <th style="color: #00a7d0">Facebook</th>
                                    <td><?=$company->facebook?></td>
                                    <th style="color: #00a7d0">Telegram</th>
                                    <td><?=$company->telegram?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>      
                
                <div class="panel-footer">
                    <?=Html::a('<i class="glyphicon glyphicon-pencil"></i>'.' '.Yii::t('app','Edit').' ', ['edit'],
                    ['data-pjax'=>0,'title'=> Yii::t('app','Edit'), 'class'=>'btn btn-primary btn-xs pull-right'])?>
                </div>                            
            </div>
               <div class="panel panel-info">
            <div class="panel-heading">
                <div class="pull-left">
                    Адрес
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="rc-handle-container">
                <?= YandexMaps::widget([
                    'htmlOptions' => [
                        'style' => 'height: 400px;',
                    ],
                    'map' => new Map('yandex_map', [
                        'center' => [$model->coordinate_x, $model->coordinate_y],
                        'zoom' => 12,
                        'controls' => [Map::CONTROL_ZOOM],
                        'behaviors' => [Map::BEHAVIOR_DRAG],
                        'type' => "yandex#map",
                    ],
                        [
                            'objects' => [
                                new Placemark(new Point($model->coordinate_x, $model->coordinate_y), [], [
                                    'draggable' => true,
                                    'preset' => 'islands#dotIcon',
                                    'iconColor' => 'red',
                                    'events' => [
                                        'dragend' => 'js:function (e) {
                                        //console.log(e.get(\'target\').geometry.getCoordinates());                                        
                                        var coords = e.get(\'target\').geometry.getCoordinates();
                                        //$( "#contacts-coordinate_x" ).val( coords[0]);
                                        //$( "#contacts-coordinate_y" ).val( coords[1]);
                                        $.get("/'.$lang.'/admin/about/set-coordinates",
                                        { "id" : 1, "coordinate_x" : coords[0], "coordinate_y" : coords[1] },
                                            function(data){ }
                                        );
                                    }',
                                    ]
                                ])
                            ]
                        ])
                ]) ?>

            </div>
        </div>
        </section>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>



 