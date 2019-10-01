<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$lang = Yii::$app->language;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">
        <?php $form = ActiveForm::begin(['id'=>"driver_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles cab_st']]); ?>
        <div class="row">
          <div class="col-md-12">
            <?= $form->field($model, 'fio')->textInput(['placeholder'=>Yii::t('app','Username'),'class'=>'my_input'])->label(false) ?>
          </div>
          <div class="col-md-12">

            <?= $form->field($model, 'phone')->textInput(['placeholder'=>Yii::t('app','Phone number'),'class'=>'my_input'])->label(false) ?>
          </div>
          </div>
           <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
            <div class="lert" id="dr_photos_cr">
              <?php if($model->images): ?>
              <?php $images_dr = explode(',',$model->images);?>
              <?php $c=0; foreach ($images_dr as $img_dr): ?>
                <div class="download_photos added" id="dr_photo_cr<?=$c?>">
                  <input type="hidden" name="uploading_images_cr2[]" value="<?=$img_dr?>" id="uploading_image_name_cr_dr<?=$c?>">
                  <button type="button" class="remove_photo" onclick="remove5(<?=$c?>);" name="<?=$c?>" ><img src="/images/minus_a.svg" class="delete_image"></button>
                  <img src="/uploads/drivers/<?=$img_dr?>" alt="">
                </div>
              <?php $c++; endforeach ?>
              <?php endif; ?>
                <div class="download_photos">
                  <label class="add_photo" for="my-file-selector_cr_dr">
                    <input id="my-file-selector_cr_dr" type="file" class="d-none" accept="image/*"accept="image/*" multiple>
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div> 
            </div>
        <?php ActiveForm::end(); ?>
</div>
<?php
$id = $model->id;
$this->registerJs(<<<JS
   var c = 100;
   remove5 = function(id){
      $.post('/$lang/profile/delete-image2?value='+$("#uploading_image_name_cr_dr"+id).val(),function(success){});
      $("#dr_photo_cr"+id).remove();
    }
  $("#my-file-selector_cr_dr").on('change',function(e){
    var files = e.target.files;
    var data = new FormData() ; 
    $.each(files, function(i,file){
        var reader = new FileReader();
        var d = new Date();
        var new_name_photo = d.getTime() + '(' + i + ')' + Math.floor(Math.random() * 101000);  
        var ext = $( '#my-file-selector_cr_dr' )[0].files[i].type.slice(6);
        new_name_photo = new_name_photo + "." + ext;

        reader.readAsDataURL(file);

        data.append('file[]', $( '#my-file-selector_cr_dr' )[0].files[i]) ; 
        data.append('names[]', new_name_photo) ; 

        reader.onload = function(e){
            c++;
            var template = '<div class="download_photos added" id="dr_photo_cr'+c+'">' +
            '<input type="hidden" name="uploading_images_cr2[]" value="' + new_name_photo + '" id="uploading_image_name_cr_dr'+c+'">'+
            '<button type="button" class="remove_photo" onclick="remove5('+c+');" name="'+c+'" ><img src="/images/minus_a.svg" class="delete_image"></button>'+
                '<img src="'+e.target.result+'" alt="">'+
              '</div>';
            $('#dr_photos_cr').prepend(template);
          };

      });
     $.ajax({
           url: '/$lang/profile/upload-photos2',
           type: 'POST',
           data: data,
           processData: false,
           contentType: false,
           beforeSend: function(){
            },
            success: function(data){ 
            }
           });

  });
JS
);
?>
