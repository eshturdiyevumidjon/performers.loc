<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\AboutCompany */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="about-company-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="panel panel-warning">
        
        <div class="panel-heading ui-draggable-handle">
            <h3 class="panel-title"><h4><?=$title?></h3>
        </div>
	    <div class="panel-body">
	        <div class="row">
	            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
			    <?= $form->field($model, 'value')->widget(CKEditor::className(), [
			        'options' => ['rows' => 20],
			        'preset' => 'custom'
			    ]) ?>
		          
	        </div>
	        <br><hr>
	        <div class="panel-footer">
	            <div class="pull-right"> 
	            	<div class="btn-group">  
	                 <?php if (!Yii::$app->request->isAjax){ ?>                         
	                     <?= Html::a( Yii::t('app','Cancel'),['index'], ['class' => 'btn btn-primary']) ?>
	             	</div>
	             	<div class="btn-group">
	                 <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success pull-right']) ?>
	            	<?php } ?>
	                </div>
	            </div>  
	        </div>                            
	    </div>
                           
    </div>
    <?php ActiveForm::end(); ?>
    
</div>

