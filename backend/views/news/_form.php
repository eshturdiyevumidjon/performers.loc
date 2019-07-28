<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\News */
/* @var $form yii\widgets\ActiveForm */
$i=0;
$langs=backend\models\Lang::getLanguages();
?>

<div class="news-form">

    <?php $form = ActiveForm::begin([ 'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]); ?>
    <?php var_dump($model->imageFiles)?>
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
             <?= $form->field($model, 'title')->textInput()->label(Yii::t('app','Title',null/*,$lang->url*/)) ?>
             <?= $form->field($model, 'text')->textarea(['rows' => 6])->label(Yii::t('app','Text',null/*,$lang->url*/)) ?>
            </div>
            <?php else: ?>
                <div class="row">
             <?= $form->field($model, 'translation_title['.$lang->url.']')->textInput(['value'=>$titles[$lang->url]])->label(Yii::t('app','Title',null/*,$lang->url*/)) ?>
             <?= $form->field($model, 'translation_text['.$lang->url.']')->textarea(['rows'=>6,'value'=>$texts[$lang->url]])->label(Yii::t('app','Text',null/*,$lang->url*/)) ?>
            </div>
            <?php endif;?>    
            
        </p>
     </div>
    <?php $i++; endforeach;?>
  </div>
    <div class="row">
         <?=$form->field($model, 'imageFiles')->widget(FileInput::classname(), [
                'pluginOptions' => [
                    //'uploadUrl' => Url::to(['/site/create'])
                    // 'showCaption' => false,
                    // 'showRemove' => false,
                    // 'showUpload' => false,
                    // 'browseClass' => 'btn btn-primary btn-block',
                    // 'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    // 'browseLabel' =>  'Select Photo'
                ],
                'options' => [
                    'multiple' => true,
                    // 'accept' => 'image/*'
                ]
            ]);
        ?>
    </div>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
