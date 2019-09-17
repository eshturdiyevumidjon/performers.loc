<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
$lang = Yii::$app->language;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">
        <?php $form = ActiveForm::begin(['id'=>"transport_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles cab_st']]); ?>
        <div class="row">
          <div class="col-md-12">
            <?= $form->field($model, 'mark')->dropDownList(ArrayHelper::map(\backend\models\Marks::find()->all(),'id','name_mark'), ['class'=>'my_input','prompt' => Yii::t('app','Car mark'),'style'=>'cursor:pointer;','onchange'=>'$.post("/'.$lang.'/task/get-model-list2?mark_id="+$(this).val(),function(succes){$("#model").html(succes)})',])->label(false)?>
          </div>
          <div class="col-md-12">
            <?= $form->field($model, 'model')->dropDownList(ArrayHelper::map(\backend\models\Models::find()->all(),'id','name_model'), ['class'=>'my_input','prompt' =>  Yii::t('app','Car model'),'id'=>'model','style'=>'cursor:pointer;'])->label(false)?>
          </div>
          <div class="col-md-12">

            <?= $form->field($model, 'registration_number')->textInput(['placeholder'=>Yii::t('app','Registration Number'),'class'=>'my_input'])->label(false) ?>
          </div>
          </div>
           <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
            <div class="lert">
                <?php
                  $imgs = explode(',', $model->images);
                  for($i = 0; $i < 9; $i++){
                ?>
                <div class="download_photos <?=($imgs[$i] != '') ? 'added' : '' ?>" id="upload_photos_update_autos<?=($i+1)?>">
                  <button type="button" class="remove_photo" name="<?=($i+1)?>"><img src="/images/minus_a.svg" alt=""></button>
                  <img src="<?=($imgs[$i] != '') ? '/uploads/transports/'.$imgs[$i] : '' ?>" alt="" id="image_upload_preview_update_autos<?=($i+1)?>">
                  <label class="add_photo" for="my-file-selector-update-auto<?=($i+1)?>">
                    <input id="my-file-selector-update-auto<?=($i+1)?>" type="file" alt="<?=($i+1)?>" class="d-none" name="images[]" value="<?=$imgs[$i]?>" accept="image/*">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>  
                <?php }?> 
            </div>
        <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs(<<<JS
  $(document).ready(function(){
    function readURL1(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_upload_preview_update_autos'+id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".remove_photo").on('click',function () {
        id = $(this).attr('name');

        $("#upload_photos_update_autos"+id).removeClass('added');
        $('#image_upload_preview_update_autos'+id).attr('src', '');
    });

    $(".d-none").change(function () {
        id = $(this).attr('alt');
        readURL1(this,id);
        $("#upload_photos_update_autos"+id).addClass('added');
    });
  });
JS
);
?>
