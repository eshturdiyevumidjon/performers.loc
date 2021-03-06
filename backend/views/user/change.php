<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([ 'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]); ?>


 <div class="row">
        <div class="col-md-4">
           <div class="col-md-12 col-xs-12">
                <div id="image">
                <?=$model->getUserAvatar()?>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <?= $form->field($model, 'avatar')->fileInput(['class'=>"image_input"]); ?>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
    				<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'phone')->textInput([])?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
                        'pluginOptions' => [
                             'autoclose'=>true
                         ]
                     ]);?>
  
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
    				 <?= $form->field($model, 'new_password')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                     
                </div>
            </div>
        </div>
    </div>       

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

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
