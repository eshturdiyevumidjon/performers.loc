<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
<div class="col-md-8">

    <div class="panel panel-default">
        <div class="panel-body source-message-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
