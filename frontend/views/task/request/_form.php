<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$lang = Yii::$app->language;
?>
<?php $form = ActiveForm::begin(['id'=>"request_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles']]); ?>
<?php
// echo "<pre>";
// print_r($form->errorSummary($model));
// print_r($model->attributes);
// print_r($post);
// echo "</pre>";
?>
 <?= $form->field($model, 'price')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>Yii::t('app','Price')]])->label(false) ?>
 <?= $form->field($model, 'mark_id')->dropDownList($model->getMarkList(), 
 	[
 		'class'=>'my_input',
 		'prompt' => Yii::t('app','Car mark'),
 		'style'=>'cursor:pointer;',
	 	'onchange'=>'$.post("/'.$lang.'/task/get-model-list?mark_id="+$(this).val(),function(succes){$("#model").html(succes)})',
	])->label(false)?>

 <?= $form->field($model, 'model_id')->dropDownList([], 
 	[
 		'class'=>'my_input',
 		'prompt' => Yii::t('app','Car model'),
 		'style'=>'cursor:pointer;',
 		'id'=>'model',
 	])->label(false)
 	?>

<?php ActiveForm::end(); ?>
   
    
