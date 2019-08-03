<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransportCategory */
/* @var $form yii\widgets\ActiveForm */
$langs=backend\models\Lang::getLanguages();

?>

<div class="transport-category-form">

    <?php $form = ActiveForm::begin(); ?>
	 <ul class="nav nav-tabs" style="margin-top:2px;">
    <?php foreach($langs as $lang):?>
    <li class="<?=($i==0)?'active':''?>">
        <a data-toggle="tab" href="#<?=$lang->url?>"><?=explode('-',$lang->name)[1]?></a>
    </li>
    <?php $i++; endforeach;?>
   </ul>

  <div class="tab-content">
    <?php $i=0; foreach($langs as $lang):?>
     <div id="<?=$lang->url?>" class="tab-pane fade <?=($i==0)?'in active':''?>">
        <p>
            <?php if($lang->url=='ru'): ?>
                 <div class="row">
             <?= $form->field($model, 'name')->textInput()->label(Yii::t('app','Name',null/*,$lang->url*/)) ?>
            </div>
            <?php else: ?>
                <div class="row">
             <?= $form->field($model, 'translation_name['.$lang->url.']')->textInput(['value'=>$names[$lang->url]])->label(Yii::t('app','Name',null,$lang->url)) ?>
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
