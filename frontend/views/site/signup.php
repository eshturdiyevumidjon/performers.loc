<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
$pathInfo = Yii::$app->request->pathInfo;
$this->title = Yii::t('app','Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form_registration">
  <h1><?=$this->title?></h1>
  <ul class="nav tab_styles_nav">
    <li><a data-toggle="tab" class="active show" href="#ff0"><?=Yii::t('app','Performer')?></a></li>
    <li><a data-toggle="tab" href="#ff1"><?=Yii::t('app','Customer')?></a></li>
  </ul>

  <form class="tab-content input_styles">
    <div id="ff0" class="tab-pane in active">
      <?php $form = ActiveForm::begin(['id' => 'register-form','class'=>'input_styles']); ?>
        <?=$form->field($model,'username')->textInput(['placeholder'=>$model->getAttributeLabel('username'),'class'=>'my_input'])->label(false)?>
        <?=$form->field($model,'phone')->textInput(['placeholder'=>$model->getAttributeLabel('phone'),'class'=>'my_input'])->label(false)?>
        <?=$form->field($model,'email')->textInput(['placeholder'=>$model->getAttributeLabel('email'),'class'=>'my_input'])->label(false)?>
        <?=$form->field($model,'password')->textInput(['placeholder'=>$model->getAttributeLabel('password'),'class'=>'my_input'])->label(false)?>
       <?=$form->field($model,'repassword')->textInput(['placeholder'=>$model->getAttributeLabel('repassword'),'class'=>'my_input'])->label(false)?>
      <button type="submit" class="btn_red"><?=Yii::t('app','Create my account')?></button>  
    </div>

   
    <div id="ff1" class="tab-pane fade">
      <ul class="nav inner_nav">
        <li><a href="#d1" data-toggle="tab" class="active show">1</a></li>
        <li><a href="#d2" data-toggle="tab">2</a></li>
      </ul>
      <div class="tab-content">
        <div id="d1" class="tab-pane in active">
          <?=$form->field($model,'username')->textInput(['placeholder'=>$model->getAttributeLabel('username'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($model,'phone')->textInput(['placeholder'=>$model->getAttributeLabel('phone'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($model,'email')->textInput(['placeholder'=>$model->getAttributeLabel('email'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($model,'password')->textInput(['placeholder'=>$model->getAttributeLabel('password'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($model,'repassword')->textInput(['placeholder'=>$model->getAttributeLabel('repassword'),'class'=>'my_input'])->label(false)?>
          <button type="submit" class="btn_red"><?=Yii::t('app','Create my account')?></button>
        </div>
        <div id="d2" class="tab-pane fade">
          <label for=""><?=Yii::t('app','Verify phone number')?> </label>
          <div class="form_big_groups d-flex justify-content-between">
            <div class="form-group">
              <input type="tel" placeholder="<?=Yii::t('app','Phone number')?>" value="+998 90 937 86 04">
            </div>
            <a href="#" class="reload"><span class="aft_back"></span><img src="/images/reload.svg" alt=""></a>
          </div>
          <div class="form-group">
            <input type="password" placeholder="<?=Yii::t('app','Code')?>">

          </div>
          <div class="btm_form">
            <button type="submit" class="btn_red"><?=Yii::t('app','Create my account')?></button>
            <a href="#" class="backto"><span class="aft_back"></span><img src="images/arrow-left.svg" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </form>
  <?php ActiveForm::end()?>
</div>
