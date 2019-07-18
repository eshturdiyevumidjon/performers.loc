<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Восстановления пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="site-request-password-reset">
        <div class="login-body">
            <p class="login-title text-center">Для подтверждения вашей личности введите код токена</p>
            <h1 align='center'><?= Html::encode($this->title) ?></h1>
            <div class="row">
                <div class="col-lg-12">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form-token']); ?>
                        <?= $form->field($model, 'token')->textInput(['autofocus' => true,'maxlength'=>true]) ?>
                        <div class="form-group">
                             <div class="col-md-6">
                                <a href="/site/request-password-reset" class="btn btn-link btn-block">Назадь</a>
                            </div>
                        <div class="col-md-6">
                            <?= Html::submitButton('Одобрения', ['class' => 'btn btn-info btn-block']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
</div>
   