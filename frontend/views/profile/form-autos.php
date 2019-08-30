<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">
        <?php $form = ActiveForm::begin(['id'=>"transport_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles cab_st']]); ?>
        <div class="row">
          <div class="col-md-12">
            <?= $form->field($model, 'model')->textInput(['placeholder'=>Yii::t('app','Car Model'),'class'=>'my_input'])->label(false) ?>
          </div>
          <div class="col-md-12">

            <?= $form->field($model, 'mark')->textInput(['placeholder'=>Yii::t('app','Car Mark'),'class'=>'my_input'])->label(false) ?>
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
                <div class="download_photos <?=($imgs[$i] != '') ? 'added' : '' ?>" id="upload_photos<?=($i+1)?>">
                  <button type="button" class="remove_photo" name="<?=($i+1)?>"><img src="/images/minus_a.svg" alt=""></button>
                  <img src="<?=($imgs[$i] != '') ? '/uploads/transports/'.$imgs[$i] : '' ?>" alt="" id="image_upload_preview<?=($i+1)?>">
                  <label class="add_photo" for="my-file-selector<?=($i+1)?>">
                    <input id="my-file-selector<?=($i+1)?>" type="file" alt="<?=($i+1)?>" class="d-none" name="images[]" value="<?=$imgs[$i]?>">
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
    function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_upload_preview'+id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".remove_photo").on('click',function () {
        id = $(this).attr('name');

        $("#upload_photos"+id).removeClass('added');
        $('#image_upload_preview'+id).attr('src', '');
    });

    $(".d-none").change(function () {
        id = $(this).attr('alt');
        readURL(this,id);
        $("#upload_photos"+id).addClass('added');
        var data = $('#change_image').serialize();
    });
  });
JS
);
?>
