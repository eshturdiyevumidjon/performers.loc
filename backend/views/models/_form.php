<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Models */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="models-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'mark_id')->widget(\kartik\select2\Select2::classname(), [
	    'data' => $model->getMarksList(),
	    'size'=>\kartik\select2\Select2::SMALL,
	    'options' => ['placeholder' => Yii::t('app','Select')],
	    'pluginOptions' => [
	        'allowClear' => true
	    ],
	]);?>

    <?= $form->field($model, 'name_model')->textInput(['maxlength' => true]) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
