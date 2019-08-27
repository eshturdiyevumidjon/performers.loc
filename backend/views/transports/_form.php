<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Transports */
/* @var $form yii\widgets\ActiveForm */
$langs=backend\models\Lang::getLanguages();
$i=0;
?>

<div class="transports-form">
    <?php $form = ActiveForm::begin(); ?>
 
    <ul class="nav nav-tabs" style="margin-top:2px;">
    <?php foreach($langs as $lang):?>
    <li class="<?=($i==0)?'active':''?>">
         <a data-toggle="tab" href="#<?=$lang->url?>"><?=(isset(explode('-',$lang->name)[1])?explode('-',$lang->name)[1]:$lang->name)?></a>
    </li>
    <?php $i++; endforeach;?>
   </ul>

  <div class="tab-content">
    <?php $i=0; foreach($langs as $lang):?>
     <div id="<?=$lang->url?>" class="tab-pane fade <?=($i==0)?'in active':''?>">
        <p>
            <?php if($lang->url=='ru'): ?>
                 <div class="row">
            <?= $form->field($model, 'model')->textInput()->label(Yii::t('app','Model',null,$lang->url)) ?>
             <?= $form->field($model, 'mark')->textInput()->label(Yii::t('app','Mark',null,$lang->url)) ?>
            </div>
            <?php else: ?>
                <div class="row">
             <?= $form->field($model, 'translation_model['.$lang->url.']')->textInput(['value'=>$models[$lang->url]])->label(Yii::t('app','Model',null,$lang->url)) ?>
             <?= $form->field($model, 'translation_mark['.$lang->url.']')->textInput(['value'=>$marks[$lang->url]])->label(Yii::t('app','Mark',null,$lang->url)) ?>
            </div>
            <?php endif;?>    
            
        </p>
     </div>
    <?php $i++; endforeach;?>
  </div>
  <div class="row">
    <div class="col-md-6">
            <?= $form->field($model, 'driver')->widget(\kartik\select2\Select2::classname(), [
                  'data' => $model->getDriverList(),
                  'size'=>\kartik\select2\Select2::SMALL,
                  'options' => ['placeholder' => Yii::t('app','Select')],
                  'pluginOptions' => [
                      'allowClear' => true
                  ],
             ]);?>
         </div>
             <div class="col-md-6">
             <?= $form->field($model, 'registration_number')->textInput()?>
         </div>
	</div>
    <?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
