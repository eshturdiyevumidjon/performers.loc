<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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
          <h1><?=$this->title?></h1>
          <form class="tab-content input_styles">
            <div class="form-group">
              <input type="tel" placeholder="<?=Yii::t('app','Phone number')?>">
            </div>
            <button type="submit" class="btn_red"><?=Yii::t('app','Restore password')?></button>
          </form>
        </div>
      </div>
</section>