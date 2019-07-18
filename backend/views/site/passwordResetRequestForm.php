<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Восстановления пароля ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
        <div class="login-body">
            <p class="login-title text-center">Пожалуйста, заполните это поле. Ссылка для сброса пароля будет отправлена ​​туда.</p>
            <h1 align='center'><?= Html::encode($this->title) ?></h1>
            <div class="row">
                <div class="col-lg-12">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true,'maxlength'=>true]) ?>
                        <div class="form-group">
                             <div class="col-md-6">
                                <a href="/site/login" class="btn btn-link btn-block">Назадь</a>
                            </div>
                        <div class="col-md-6">
                            <?= Html::submitButton('Восстановить пароль ', ['class' => 'btn btn-info btn-block']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
</div>
