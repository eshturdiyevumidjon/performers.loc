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
        <a data-toggle="tab" href="#<?=$lang->url?>"><?=$lang->name?></a>
    </li>
    <?php $i++; endforeach;?>
   </ul>

  <div class="tab-content">
    <?php $i=0; foreach($langs as $lang):?>
     <div id="<?=$lang->url?>" class="tab-pane fade <?=($i==0)?'in active':''?>">
        <p>
            <?php if($lang->url=='ru'): ?>
                 <div class="row">
             <?= $form->field($model, 'driver')->textInput()->label(Yii::t('app','Driver',null,$lang->url)) ?>
             <?= $form->field($model, 'model')->textInput()->label(Yii::t('app','Model',null,$lang->url)) ?>
             <?= $form->field($model, 'mark')->textInput()->label(Yii::t('app','Mark',null,$lang->url)) ?>
            </div>
            <?php else: ?>
                <div class="row">
             <?= $form->field($model, 'translation_driver['.$lang->url.']')->textInput(['value'=>$drivers[$lang->url]])->label(Yii::t('app','Driver',null,$lang->url)) ?>
             <?= $form->field($model, 'translation_model['.$lang->url.']')->textInput(['value'=>$models[$lang->url]])->label(Yii::t('app','Model',null,$lang->url)) ?>
             <?= $form->field($model, 'translation_mark['.$lang->url.']')->textInput(['value'=>$marks[$lang->url]])->label(Yii::t('app','Mark',null,$lang->url)) ?>
            </div>
            <?php endif;?>    
            
        </p>
     </div>
    <?php $i++; endforeach;?>
  </div>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
