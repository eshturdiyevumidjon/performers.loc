<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <section class="registratsion">
      <div class="container">
       <?php
          if(count($this->params['breadcrumbs'])>0):
          ?>
          <nav aria-label="breadcrumb" class="breadcrumb_nav">
            <ol class="breadcrumb"> 
              <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
              <?php foreach ($this->params['breadcrumbs'] as $key => $value) : ?>
              <li class="breadcrumb-item <?=($pathInfo==$value)?'active':''?>" aria-current="page"><?=$this->title?></li>
              <?php endforeach; ?>
            </ol>
          </nav>
        <?php endif;?> -->
        <div class="form_registration">
          <h1><?=$this->title?></h1>
           <?php $form = ActiveForm::begin(['options' => ['method' => 'post', 'class'=>'tab-content input_styles' ]]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app',$model->getAttributeLabel('Username')),'style'=>'font-size:16px;'])->label(false) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>Yii::t('app',$model->getAttributeLabel('Password')),'style'=>'font-size:16px;'])->label(false) ?>
                <div class="row">
                    <label>
                <?= $form->field($model, 'rememberMe')->checkbox(['class'=>''])->label(false) ?>
                </div>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>
      
                <div class="form-group">
                    
                </div>

            <?php ActiveForm::end(); ?>

        
        </div>
<!--       </div>
</section> -->