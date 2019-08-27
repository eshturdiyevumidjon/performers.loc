<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Lang */
/* @var $form yii\widgets\ActiveForm */

$adminka = Yii::$app->params['adminka'];
?>

<div class="lang-form">
    <?php $form = ActiveForm::begin(); ?>
   
    <div class="row">
      <div class="col-md-6">
          <?= $form->field($model, 'url')->widget(\yii\widgets\MaskedInput::className(), ['mask' => 'aa','options'=>['placeholder'=>'ru']]) ?>
      </div>
      <div class="col-md-6">
         <?= $form->field($model, 'local')->widget(\yii\widgets\MaskedInput::className(), ['mask' => 'aa-AA','options'=>['placeholder'=>'ru-RU']]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
          <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'Русский']) ?>
      </div>
      <div class="col-md-6">
           <?= $form->field($model, 'status')->dropDownList($model->getStatus(), ['options'=>['0'=>['disabled'=>($model->default)?true:false]]]); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <div id="image">
            <?=($model->image != null)?'<img src="'.$adminka . $model->image.'">':'';?>
        </div>
      </div>
      <div class="col-md-4">
        <?= $form->field($model, 'flag')->fileInput(['class'=>'image_input']) ?>
      </div>
    </div>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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