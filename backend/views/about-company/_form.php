<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

//
use katzz0\yandexmaps\Map;
use katzz0\yandexmaps\JavaScript;
use katzz0\yandexmaps\objects\Placemark;
use katzz0\yandexmaps\Polyline;
use katzz0\yandexmaps\Point;
use katzz0\yandexmaps\Canvas as YandexMaps;
//
/* @var $this yii\web\View */
/* @var $model backend\models\AboutCompany */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .panel{
        margin: 10px 10px 10px 10px;
        padding:10px;
    }
</style>

<div class="about-company-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-success">
        <div class="panel-heading ui-draggable-handle">
                <h4><?=Yii::t('app','Update')?>
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                       <div class="col-md-12">
                            <div id="image">
                            <?=$model->getImage()?>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <?= $form->field($model, 'logo_image')->fileInput(['class'=>"image_input"]); ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'address')->textarea(['rows' => 8]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'coordinate_x')->textInput(['rows' => 8]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'coordinate_y')->textInput(['rows' => 8]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
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
                                        var coords = e.get(\'target\').geometry.getCoordinates();
                                        $( "#aboutcompany-coordinate_x" ).val( coords[0]);
                                        $( "#aboutcompany-coordinate_y" ).val( coords[1]);
                                        $.get("/ru/about-company/set-coordinates",
                                        {  "coordinate_x" : coords[0], "coordinate_y" : coords[1] },
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
            <br><hr>
                           
                           
            <div class="row">
                <div class="col-md-6">
               <?= $form->field($model, 'phone_numbers')->widget(MultipleInput::className(), [
                            'max'               => 6,
                            'min'               => 1, // should be at least 2 rows
                            'allowEmptyList'    => false,
                            'enableGuessTitle'  => true,
                        ])->label(false)
                ?>
                </div>
                <div class="col-md-6">
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                     <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                     <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                     <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <br>


       

            <div class="panel-footer">
                <div class="pull-right"> 
                <div class="btn-group">  
                 <?php if (!Yii::$app->request->isAjax){ ?>                         
                     <?= Html::a( Yii::t('app','Cancel'),['index'], ['class' => 'btn btn-primary']) ?>
                 </div>
                 <div class="btn-group">
                     <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success pull-right']) ?>
                <?php } ?>
                    
                    </div>

                </div>  
            </div>                            
    </div>

    
  
	

    <?php ActiveForm::end(); ?>
    
</div>
<?php 
$this->registerJs(<<<JS
    
$(document).ready(function(){
    var fileCollection = new Array();

    $(document).on('change', '.image_input', function(e){
        var files = e.target.files;
        $.each(files, function(i, file){
            fileCollection.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e){
                var template = '<img style="width:100%; max-height:180px;" src="'+e.target.result+'"> ';
                $('#image').html('');
                $('#image').append(template);
            };
        });
    });
});
JS
);
?>
