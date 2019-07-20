<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Lang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lang-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?=Yii::t('app',$model->getAttributeLabel('name'))?>
             <?= $form->field($model, 'id')->widget(Select2::classname(), [
                     'data' => $model->getLanguages(),
                 ])->label(false);
             ?>
        </div>
    </div>
    
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
