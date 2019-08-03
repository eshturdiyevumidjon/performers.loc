<?php
use yii\helpers\Url;
use yii\helpers\Html;

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

?>
<style type="text/css">
    table th td{
        padding:10px;
        word-break: break-all;
        justify-content: center;
    }
</style>
<div class="about-company-index">
    <div id="ajaxCrudDatatable">
        <section class="content">
            <div class="panel panel-success">
                <div class="panel-heading ui-draggable-handle">
                 <?=Html::a('<i class="glyphicon glyphicon-pencil"></i>'.' '.Yii::t('app','Edit').' ', ['edit'],
                    ['data-pjax'=>0,'title'=> Yii::t('app','Edit'), 'class'=>'btn btn-info btn-xs pull-left'])?>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table  table-condensed">
                            <tbody>
                                <tr>
                                    <td rowspan="2">
                                        <?=$company->getImage()?>
                                    </td>
                                    <th style="color: #00a7d0"><?=$company->getAttributeLabel('email')?>:</th>
                                    <td><?= $company->email?></td>
                                    <th style="color: #00a7d0"><?=$company->getAttributeLabel('phone')?>:</th>
                                    <td>
                                        <?php foreach (explode(',',$company->phone) as $key => $value) {
                                    echo $value."<br>";
                                    }?> 
                                    </td>
                                    <th style="color: #00a7d0"><?=$company->getAttributeLabel('address')?>:</th>
                                    <td><?= $company->address?></td>
                                </tr>
                                <tr>
                                    <th style="color: #00a7d0"><?=$company->getAttributeLabel('instagram')?>:</th>
                                    <td><?= $company->instagram?></td>
                                    <th style="color: #00a7d0"><?=$company->getAttributeLabel('facebook')?>:</th>
                                    <td><?= $company->facebook?></td>
                                    <th style="color: #00a7d0"><?=$company->getAttributeLabel('telegram')?>:</th>
                                    <td><?= $company->telegram?></td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>
                </div>      

                <div class="panel-footer">
                   <br>
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
                        'center' => [$company->coordinate_x, $company->coordinate_y],
                        'zoom' => 12,
                        'controls' => [Map::CONTROL_ZOOM],
                        'behaviors' => [Map::BEHAVIOR_DRAG],
                        'type' => "yandex#map",
                    ],
                        [
                            'objects' => [
                                new Placemark(new Point($company->coordinate_x, $company->coordinate_y), [], [
                                    'draggable' => false,
                                    'preset' => 'islands#dotIcon',
                                    'iconColor' => 'red',
                                    'events' => [
                                        'dragend' => 'js:function (e) {
                                        var coords = e.get(\'target\').geometry.getCoordinates();
                                        $.get("/ru/about-company/set-coordinates",
                                        { "coordinate_x" : coords[0], "coordinate_y" : coords[1] },
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
