<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>
<div class="order_wrapper">
  <h1><?=Yii::t('app','Create Order')?></h1>
  <hr>
  <div class="br_order">
      <div class="btn_red">
        <img src="/images/surface3.svg" alt="">
        <p><?=Yii::t('app','Car transportation')?></p>
      </div>
  </div>
  <hr>
   <?php $form = ActiveForm::begin(['id'=>"request_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles']]); ?>
   <?php
    // echo "<pre>";
    // print_r($form->errorSummary($model));
    // print_r($model->attributes);
    // print_r($post);
    // echo "</pre>";
   ?>
     <?= $form->field($model, 'price')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>$model->getAttributeLabel('offer_your_price')]])->label(false) ?>

    <?php ActiveForm::end(); ?>
   
    
</div>
