<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = Yii::t('app','Authorization');

?>

<center><h1 style="color:#fff;"><?= Html::encode($this->title) ?></h1></center>
    <br>
<div class="login-body">
    <p class="login-title text-center"><?=YII::t('app','Enter your login information')?></p>

    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

    <?= $form
        ->field($model, 'username'/*, $fieldOptions1*/)
        ->label(false)
        ->textInput(['placeholder' => Yii::t('app','Phone number or email address')]) ?>

    <?= $form
        ->field($model, 'password'/*, $fieldOptions2*/)
        ->label(false)
        ->passwordInput(['placeholder' => Yii::t('app','password')]) ?>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('app','Remember me')) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::submitButton(Yii::t('app','Login'), [ 'style' => 'width:100%', 'class' => 'btn btn-info btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>
             </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                         <a href="/site/request-password-reset" class="btn btn-link btn-block"><?=Yii::t('app','Forgot your password?')?></a>
                    </div>
                </div>
             </div>
<div class="login-subtitle">
        <?=Yii::t('app','Don\'t have an account yet?')?> <a href="/site/register"><?=Yii::t('app','Create an account')?></a>
</div>
<?php ActiveForm::end(); ?>
</div>
