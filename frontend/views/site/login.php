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
<div class="form_registration">
     
    <h2><?=$this->title?></h2>
   <?php $form = ActiveForm::begin(['options'=>['class'=>'input_styles']]); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app','Phone number or email address'),'class'=>'my_input input_styles'])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>Yii::t('app',$model->getAttributeLabel('Password')),'class'=>'my_input input_styles'])->label(false) ?>
        <div class="row" style="margin-top:-10px;">
          <div class="col-md-6 pull-left">
        <?= $form->field($model, 'rememberMe',['template' => '<div class="row"><div class="col-md-3 center">{input}</div><div class="col-md-9 center" >{label}</div></div>'])->input('checkbox',['class'=>'my_input']
        )?>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
             <?=Html::a(Yii::t('app','Forgot your password?'), ['request-password-reset'],
        ['class'=>'forget_pass pull-right'])?>
              </div>
            </div>
          </div>
        </div>
    <?php ActiveForm::end(); ?> 

</div>
