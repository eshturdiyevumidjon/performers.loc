<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Авторизация';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div  class="login-container lightmode">
    <div class="login-box animated fadeInDown">
        <center><h1 style="color:#fff;"><?= Html::encode($this->title) ?></h1></center>
    <br>
        <div class="login-body">
            <p class="login-title text-center">Введите данные для входа</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомни меня') ?>
                            </div>
                            <div class="col-md-6">
                                <?= Html::submitButton('Вход', [ 'style' => 'width:100%', 'class' => 'btn btn-info btn-block', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                     </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                 <a href="/site/request-password-reset" class="btn btn-link btn-block">Забыли пароль?</a>
                            </div>
                        </div>
                     </div>
        <div class="login-subtitle">
                У вас еще нет аккаунта? <a href="/site/register"> Создать аккаунт</a>
        </div>
        <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>



