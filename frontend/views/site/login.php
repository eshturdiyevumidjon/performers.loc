<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form_registration">
  <h1><?=$this->title?></h1>
   <?php $form = ActiveForm::begin(['options' => ['method' => 'post', 'class'=>'tab-content input_styles' ]]); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app',$model->getAttributeLabel('Username')),'class'=>'my_input'])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>Yii::t('app',$model->getAttributeLabel('Password')),'class'=>'my_input'])->label(false) ?>
        <div class="row">
            <label>
        <?= $form->field($model, 'rememberMe')->checkbox(['class'=>''])->label(false) ?>
        </div>
        <div style="color:#999;margin:1em 0">
             <?= Html::a('signup', ['site/signup'],['role'=>'modal-remote']) ?>.
            <br>
            Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
