<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div  class="login-container lightmode">
    <div class="login-box animated fadeInDown">
        <div class="site-request-password-reset">
                <div class="login-body">
                    <p class="login-title text-center">Please fill out your email. A link to reset password will be sent there.</p>
                    <h1><?= Html::encode($this->title) ?></h1>
                    <div class="row">
                        <div class="col-lg-12">
                 
                            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                                <?= $form->field($model, 'email')->textInput(['autofocus' => true,'maxlength'=>true]) ?>
                                <div class="form-group">
                                     <div class="col-md-6">
                                        <a href="/site/login" class="btn btn-primary btn-block"><i class='fa fa-angle-double-left'></i>Назадь</a>
                                    </div>
                                <div class="col-md-6">
                                    <?= Html::submitButton('Send <i class="fa fa-angle-double-right"></i>', ['class' => 'btn btn-info btn-block']) ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                 
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>