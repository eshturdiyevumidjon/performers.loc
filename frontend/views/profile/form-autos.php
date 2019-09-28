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
            <div class="lert" id="tr_photos_cr">
              <?php if($model->images): ?>
              <?php $images_tr = explode(',',$model->images);?>
              <?php $c=0; foreach ($images_tr as $img_tr): ?>
                <div class="download_photos added" id="tr_photo_cr<?=$c?>">
                  <input type="hidden" name="uploading_images_cr[]" value="<?=$img_tr?>" id="uploading_image_name_cr<?=$c?>">
                  <button type="button" class="remove_photo" onclick="remove(<?=$c?>);" name="<?=$c?>" ><img src="/images/minus_a.svg" class="delete_image"></button>
                  <img src="/uploads/transports/<?=$img_tr?>" alt="">
                </div>
              <?php $c++; endforeach ?>
              <?php endif; ?>
                <div class="download_photos">
                  <label class="add_photo" for="my-file-selector_cr1">
                    <input id="my-file-selector_cr1" type="file" class="d-none" accept="image/*"accept="image/*" multiple>
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div> 
            </div>
        <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs(<<<JS
   var c = 100;
   remove = function(id){
      $.post('/$lang/profile/delete-image1?value='+$("#uploading_image_name_cr"+id).val(),function(success){alert(success)});
      $("#tr_photo_cr"+id).remove();
    }
  $("#my-file-selector_cr1").on('change',function(e){
    var files = e.target.files;
    var data = new FormData() ; 
    $.each(files, function(i,file){
        var reader = new FileReader();
        var d = new Date();
        var new_name_photo = d.getTime() + '(' + i + ')' + Math.floor(Math.random() * 101000);  
        var ext = $( '#my-file-selector_cr1' )[0].files[i].type.slice(6);
        new_name_photo = new_name_photo + "." + ext;

        reader.readAsDataURL(file);

        data.append('file[]', $( '#my-file-selector_cr1' )[0].files[i]) ; 
        data.append('names[]', new_name_photo) ; 

        reader.onload = function(e){
            c++;
            var template = '<div class="download_photos added" id="tr_photo'+c+'">' +
            '<input type="hidden" name="uploading_images_cr[]" value="' + new_name_photo + '" id="uploading_image_name_cr'+c+'">'+
            '<button type="button" class="remove_photo" onclick="remove('+c+');" name="'+c+'" ><img src="/images/minus_a.svg" class="delete_image"></button>'+
                '<img src="'+e.target.result+'" alt="">'+
              '</div>';
            $('#tr_photos_cr').prepend(template);
          };

      });
     $.ajax({
           url: '/$lang/profile/upload-photos1',
           type: 'POST',
           data: data,
           processData: false,
           contentType: false,
           beforeSend: function(){
            },
            success: function(data){alert(data) 
            }
           });

  });
JS
);
?>
