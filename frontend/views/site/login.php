<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app','Authorization');
$this->params['breadcrumbs'][] = $this->title;
?>
   <?php $form = ActiveForm::begin(['options'=>['class'=>'input_styles']]); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app','Phone number or email address'),'class'=>'my_input'])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>Yii::t('app',$model->getAttributeLabel('Password')),'class'=>'my_input'])->label(false) ?>
        <div class="d-flex align-items-center justify-content-between defau">
          <div class="form-group_checkbox">
              <input type="checkbox" id="sdvs" name="rememberMe" <?=($model->rememberMe)?'checked=""':''?>>
              <label for="sdvs">Запомнить меня</label>
          </div>
          <a href="/site/request-password-reset" class="forget_pass"><?=Yii::t('app','Forgot your password?')?></a>
          </div>
      
    <?php ActiveForm::end(); ?> 

