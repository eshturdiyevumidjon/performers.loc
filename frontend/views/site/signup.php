<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$pathInfo = Yii::$app->request->pathInfo;
$this->title = Yii::t('app','Signup');
?>
<ul class="nav  tab_styles_nav">
  <li><a data-toggle="tab" href="#home" <?=($active == 1)?'class="active show"':''?>><?=Yii::t('app','Customer')?></a></li>
  <li><a data-toggle="tab" href="#menu1" <?=($active == 2)?'class="active show"':''?>><?=Yii::t('app','Performer')?></a></li>
</ul>
<?php $form = ActiveForm::begin(['enableClientScript' => false,'options'=>['class'=>'input_styles','id'=>'customerss']]); ?>
  <div class="tab-content">
    <div id="home" <?=($active == 1)?'class="tab-pane in active"':'class="tab-pane fade"'?>>
          <?=$form->field($modelCustomer,'username')->textInput(['placeholder'=>$modelCustomer->getAttributeLabel('username'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelCustomer,'phone')->textInput(['placeholder'=>$modelCustomer->getAttributeLabel('phone'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelCustomer,'email')->textInput(['placeholder'=>$modelCustomer->getAttributeLabel('email'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelCustomer,'password')->passwordInput(['placeholder'=>$modelCustomer->getAttributeLabel('password'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelCustomer,'repassword')->passwordInput(['placeholder'=>$modelCustomer->getAttributeLabel('repassword'),'class'=>'my_input'])->label(false)?>
    </div>
    <div id="menu1" <?=($active == 2)?'class="tab-pane in active"':'class="tab-pane fade"'?>>
        <ul class="nav nav-tabs inner_nav">
          <li><a data-toggle="tab" href="#step1" <?=($active == 1)?'class="active show"':''?> >1</a></li>
          <li><a data-toggle="tab" <?=($active ==2 ) ? 'href="#step2"' : 'href="#step1"'?>  <?=($active == 2)?'class="active show"':''?>>2</a></li>
        </ul>
        <div class="tab-content">
        <div id="step1"  class="tab-pane <?=($active == 1)?'in active':'fade'?>" >
          <?=$form->field($modelPerformer,'username')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('username'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelPerformer,'phone')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('phone'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelPerformer,'email')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('email'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelPerformer,'password')->passwordInput(['placeholder'=>$modelPerformer->getAttributeLabel('password'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelPerformer,'repassword')->passwordInput(['placeholder'=>$modelPerformer->getAttributeLabel('repassword'),'class'=>'my_input'])->label(false)?>
        </div>
        <div <?=($active ==2 ) ? 'id="step2"' : ''?> class="tab-pane <?=($active == 2)?'in active':'fade'?>">
          <label for=""><?=Yii::t('app','Verify Account')?> </label>
          <div class="form_big_groups d-flex justify-content-between">
          <?=$form->field($modelPerformer,'verify_phone')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('email'),'class'=>'my_input','value'=>$modelPerformer->email])->label(false)?>
            <a href="#" onclick="alert()" class="reload"><span class="aft_back"></span><img src="/images/reload.svg" alt=""></a>
          </div>
          <div class="form-group">
          <?=$form->field($modelPerformer,'verify_code')->passwordInput(['placeholder'=>Yii::t('app','Code'),'class'=>'my_input'])->label(false)?>
          <div class="help-block-error"><?=$error?></div>

          </div>
            <a href="#step1" data-toggle="tab" class="backto"><span class="aft_back"></span><img src="/images/arrow-left.svg" alt=""></a>
        </div>
      </div>
    </div>
  </div>
<?php ActiveForm::end()?>
