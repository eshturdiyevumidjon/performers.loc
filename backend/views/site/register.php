<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Регистрация';


$fieldOptions1 = [
    'options' => ['class' => 'has-feedback','style'=>'margin-top:14px;'],
    'inputTemplate' => "{input}<span style='font-size:18px;padding-top:4px;' class='glyphicon glyphicon-user form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'has-feedback','style'=>'margin-top:14px;'],
    'inputTemplate' => "{input}<span style='font-size:18px;padding-top:4px;' class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$fieldOptions3 = [
    'options' => ['class' => 'has-feedback','style'=>'margin-top:14px;'],
    'inputTemplate' => "{input}<span style='font-size:18px;padding-top:4px;' class='glyphicon glyphicon-phone form-control-feedback'></span>"
];
$fieldOptions4 = [
    'options' => ['class' => 'has-feedback','style'=>'margin-top:14px;'],
    'inputTemplate' => "{input}<span style='font-size:18px;padding-top:4px;' class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
$fieldOptions5 = [
    'options' => ['class' => 'has-feedback','style'=>'margin-top:14px;'],
    'inputTemplate' => "{input}<span style='font-size:18px;padding-top:4px;' class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>
<div  class="login-container lightmode">
    <div class="login-box animated fadeInDown">
        <center><h1 style="color:#fff;"><?= Html::encode($this->title) ?></h1></center>
    <br>
        <div class="login-body">
            <p class="login-title text-center">Введите данные для регистрация</p>

            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>
            <div class="form-group">
                    <div class="col-md-12 ">
                    <?=$form->field($model,'username',$fieldOptions1)->textInput(['placeholder'=>$model->getAttributeLabel('username')])->label(false)?>
                    </div>
            </div>

            <div class="form-group ">
                <div class="col-md-12">
                    <?=$form->field($model,'email',$fieldOptions2)->textInput(['placeholder'=>$model->getAttributeLabel('email')])->label(false)?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <?= $form->field($model, 'phone',$fieldOptions3)->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+9 999-999-99-99',
                             'options' => [
                                  'placeholder' => $model->getAttributeLabel('phone'),
                             ]]
                    )->label(false) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <?=$form->field($model,'password',$fieldOptions4)->textInput(['placeholder'=>$model->getAttributeLabel('password')])->label(false)?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <?=$form->field($model,'repassword',$fieldOptions5)->textInput(['placeholder'=>$model->getAttributeLabel('repassword')])->label(false)?>
                </div>
            </div>
           
                <div class="col-md-6">
                    <a href="/site/login" class="btn btn-link btn-block">У вас уже есть account?</a>
                </div>
                <div class="col-md-6">
                    <?= Html::submitButton('Продолжить', [ 'class' => 'btn btn-info btn-block', 'name' => 'register-button']) ?>
                </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


