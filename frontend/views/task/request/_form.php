<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
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
 <?= $form->field($model, 'mark_id')->dropDownList(ArrayHelper::map(\backend\models\Marks::find()->all(),'id','name_mark'), ['class'=>'my_input','prompt' => Yii::t('app','Car mark'),'style'=>'cursor:pointer;'])->label(false)?>
 <?= $form->field($model, 'model_id')->dropDownList(ArrayHelper::map(\backend\models\Models::find()->all(),'id','name_model'), ['class'=>'my_input','prompt' => Yii::t('app','Car model'),'style'=>'cursor:pointer;'])->label(false)?>
<?php ActiveForm::end(); ?>
   
    
