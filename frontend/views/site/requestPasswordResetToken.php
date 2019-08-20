<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app','Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="registratsion">
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
        <?php endif;?>
      
        <div class="form_registration">
            <?php
            $session = Yii::$app->session;
            $flashes = $session->getAllFlashes();

            if(count($flashes) ==1 )
            {
              $success = $flashes[0][0];
              $message = $flashes[0][1];
            }
            foreach ($flashes as $key => $value) {
              if($key == 'success')
              {
                echo "<p class='alert alert-success'>$value</p>";
              }
              if($key == 'error')
              {
                echo "<p class='alert alert-error'>$value</p>";
              }  
            }
          ?> 
          <h1><?=$this->title?></h1>
          <?php $form = ActiveForm::begin(['enableClientScript' => false, 'options' => ['class'=>'tab-content input_styles' ],'id'=>'request-password-form']); ?>
          <?= $form->field($model, 'email')->textInput(['placeholder'=>Yii::t('app','Email address'),'style'=>'font-size:16px;','class'=>'my_input'])->label(false); ?>
          <br>
          <?= Html::submitButton( Yii::t('app','Restore password'), ['class' =>'btn_red']) ?>
          <?php ActiveForm::end()?>

        
        </div>
      </div>
</section>