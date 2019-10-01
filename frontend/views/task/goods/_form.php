<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
$lang = Yii::$app->language;

?>
<section class="order">
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb">   
        <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
        <li class="breadcrumb-item"><a href="/profile/index"><?=Yii::t('app','Personal Cabinet')?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Create Order')?></li>
      </ol>
    </nav>
    <div class="order_wrapper">
      <h1><?=Yii::t('app','Create Order')?></h1>
      <hr>
      <div class="br_order">
          <div class="btn_red">
            <img src="/images/surface.svg" alt="">
            <p><?=Yii::t('app','Freight transportation')?></p>
          </div>
      </div>
      <hr>
       <?php $form = ActiveForm::begin(['id'=>"goods_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles']]); ?>
        <div class="row">
          <div class="col-md-6 order_left"> 
            <h4><?=Yii::t('app','Address')?></h4>
              <?= $form->field($model, 'shipping_address')->textInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input otp_punkt','id'=>'shipping_address'])->label(false) ?>
             <?= $form->field($model, 'shipping_coordinate_x')->hiddenInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input hidden otp_punkt','id'=>'shipping_address_coordinate_x'])->label(false) ?>
             <?= $form->field($model, 'shipping_coordinate_y')->hiddenInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input hidden otp_punkt','id'=>'shipping_address_coordinate_y'])->label(false) ?>
            <hr>
             <?= $form->field($model, 'delivery_address')->textInput(['placeholder'=>Yii::t('app','Destination'),'class'=>'my_input otp_punkt2','id'=>'delivery_address'])->label(false) ?>
             <?= $form->field($model, 'delivery_coordinate_x')->hiddenInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input hidden otp_punkt','id'=>'delivery_address_coordinate_x'])->label(false) ?>
             <?= $form->field($model, 'delivery_coordinate_y')->hiddenInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input hidden otp_punkt','id'=>'delivery_address_coordinate_y'])->label(false) ?>
            <div class="d-flex align-items-center justify-content-between tire d_mob_none" id="inform">
              <h4><?=Yii::t('app','Travel time')?>: <span id="time"></span></h4>
              <h4><?=Yii::t('app','Distance')?>: <span id="destination"></span></h4>
            </div>
            <div id="map_for_mobile"></div>
            <h4 class="mt10"><?=Yii::t('app','Date')?></h4>
              <?= $form->field($model, 'date_begin')->widget(DatePicker::classname(), [
                         'options'=>[
                          'class'=>'my_input other_date_inp',
                          'style'=>'cursor:pointer;',
                          'placeholder'=>$model->getAttributeLabel('date_begin'),
                        ],
                        'pluginOptions' => [
                             'autoclose'=>true
                         ]
                     ])->hint('<p class="opac d_mob_none">'.Yii::t('app',"Start date and time when the shipment is ready to ship").'</p>')->label(false);?>
              <?= $form->field($model, 'date_close')->widget(DatePicker::classname(), [
                        'options'=>[
                          'class'=>'my_input other_date_inp',
                          'style'=>'cursor:pointer;',
                          'placeholder'=>$model->getAttributeLabel('date_close'),
                        ],
                        'pluginOptions' => [
                             'autoclose'=>true
                         ]
                     ])->hint('<p class="opac d_mob_none">'.Yii::t('app',"The maximum possible date and time when the cargo must be a destination point").'</p>')->label(false);?>
            
          </div>
          <div class="col-md-6 d_mob_none carta_d">
          <div id="map"></div>
          </div>
        </div>
        <hr class="mb15">
        <h4><?=$model->getAttributeLabel('offer_your_price')?></h4>
             <?= $form->field($model, 'offer_your_price')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>$model->getAttributeLabel('offer_your_price')]])->label(false) ?>
        
        <h4><?=Yii::t('app','Cargo Parameters')?></h4>
        <div class="row mband">
          <div class="col-sm-6">
            <?= $form->field($model, 'weight')->widget(\yii\widgets\MaskedInput::className(), [
                    'options' => [
                        'class' => 'my_input',

                        'placeholder'=> $model->getAttributeLabel('weight')
                    ],
                    'clientOptions' => [
                        'alias' => 'decimal'
                    ]
                ])->label(false) ?>
           
          </div>
          <div class="col-sm-6">
            <?= $form->field($model, 'width')->widget(\yii\widgets\MaskedInput::className(), [
                    'options' => [
                        'class' => 'my_input',
                        'placeholder'=> $model->getAttributeLabel('width')
                    ],
                    'clientOptions' => [
                        'alias' => 'decimal'
                    ]
                ])->label(false) ?>
          </div>
          <div class="col-sm-6">
            <?= $form->field($model, 'length')->widget(\yii\widgets\MaskedInput::className(), [
                    'options' => [
                        'class' => 'my_input',
                        'placeholder'=> $model->getAttributeLabel('length')
                    ],
                    'clientOptions' => [
                        'alias' => 'decimal'
                    ]
                ])->label(false) ?>
          </div>
          <div class="col-sm-6">
            <?= $form->field($model, 'height')->widget(\yii\widgets\MaskedInput::className(), [
                    'options' => [
                        'class' => 'my_input',
                        'placeholder'=> $model->getAttributeLabel('height')
                    ],
                    'clientOptions' => [
                        'alias' => 'decimal'
                    ]
                ])->label(false) ?>
          </div>
        </div>
        <div class="d-flex align-items-center barat">
          <div class="form-group_checkbox mt10 mb15 vnu_m">
              <input type="checkbox" id="bww55" name="tip_gruz[]" value="1" <?=(strpos($model->classification,'1')) ? 'checked' :'' ?>>
              <label for="bww55"><?=Yii::t('app','Oversized')?></label>
          </div>
          <div class="form-group_checkbox mt10 mb15 vnu_m">
              <input type="checkbox" id="bww55a" name="tip_gruz[]" value="2" <?=(strpos($model->classification,'2')) ? 'checked' :'' ?>>
              <label for="bww55a"><?=Yii::t('app','Fragile')?></label>
          </div>
          <div class="form-group_checkbox mt10 mb15 vnu_m">
              <input type="checkbox" id="bww55r" name="tip_gruz[]" value="3" <?=(strpos($model->classification,'3')) ? 'checked' :'' ?>>
              <label for="bww55r"><?=Yii::t('app','Dangerous')?></label>
          </div>              
        </div>
        <hr>
       <div class="row mband">
          <div class="col-sm-4">
            <div class="form-group_checkbox mt10 mb15">
                <input type="checkbox" id="bww5" name="loading_required_status" value="1" <?=($model->loading_required_status ==1)? "checked":""?> >
                <label for="bww5"><?=$model->getAttributeLabel('loading_required_status')?></label>
            </div>
          </div>
        </div>
        <hr class="mb15">
        <h4><?=Yii::t('app','Additional terms')?></h4>
        <div class="form-group_checkbox mt10 mb15">
            <input type="checkbox" id="bww3" name="alert_email" value="1" <?=($model->alert_email ==1)? "checked":""?> >
            <label for="bww3"><?=$model->getAttributeLabel('alert_email')?></label>
        </div>
        <hr class="mb-2">
       <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
        <div class="lert" id="photos">
            <div class="download_photos">
              <label class="add_photo" for="my-file-selector1">
                <input id="my-file-selector1" type="file" class="d-none" name="images[]" accept="image/*"accept="image/*" multiple>
                <img src="/images/plus_a.svg" alt="">
               </label>
            </div> 
        </div>
        <h4><?=$model->getAttributeLabel('promo_code')?></h4>
        <?= $form->field($model, 'promo_code')->textInput(['maxlength' => true,'class'=>'my_input','placeholder'=>'...'])->label(false) ?>
        <hr class="mb-0">
        <div class="d-flex align-items-center justify-content-between tit_textarea">
          <h4><?=$model->getAttributeLabel('comment')?></h4>
          <span class="numb_textarea"><span id="counter">0</span>/5000</span>
        </div>
          <?= $form->field($model, 'comment')->textarea(['rows' => 6,'id'=>'textfield','class'=>'my_input'])->label(false) ?>
          <?php if (Yii::$app->user->isGuest): ?>
           <div>
              <?=Html::a(Yii::t('app','Publish'), ['/site/login'],['role'=>'modal-remote','class'=>'btn_red','id'=>'if_user_guest'])?>
            </div>
          <?php else: ?>
            <?= Html::submitButton(Yii::t('app','Publish'), ['class' => 'btn_red']) ?>
          <?php endif ?>

        <?php ActiveForm::end(); ?>
       
        
    </div>
  </div>
</section>
 
<?=$this->render('../request/map.php')?>

<?php
$this->registerJs(<<<JS
     var c = 100;
 remove = function(id){
    $.post('/$lang/task/delete-image?value='+$("#uploading_image_name"+id).val(),function(success){});
    $("#photo"+id).remove();
    
 
  }
 
  $("#my-file-selector1").on('change',function(e){
    var files = e.target.files;
    var data = new FormData() ; 
    $.each(files, function(i,file){
        var reader = new FileReader();
        var d = new Date();
        var new_name_photo = d.getTime() + '(' + i + ')' + Math.floor(Math.random() * 101000);  
        var ext = $( '#my-file-selector1' )[0].files[i].type.slice(6);
        new_name_photo = new_name_photo + "." + ext;

        reader.readAsDataURL(file);

        data.append('file[]', $( '#my-file-selector1' )[0].files[i]) ; 
        data.append('names[]', new_name_photo) ; 

        reader.onload = function(e){
            c++;
            var template = '<div class="download_photos added" id="photo'+c+'">' +
            '<input type="hidden" name="uploading_images[]" value="' + new_name_photo + '" id="uploading_image_name'+c+'">'+
            '<button type="button" class="remove_photo" onclick="remove('+c+');" name="delete" id="'+c+'" ><img src="/images/minus_a.svg" class="delete_image"></button>'+
                '<img src="'+e.target.result+'" alt="">'+
              '</div>';
            $('#photos').prepend(template);

          };

      });
     $.ajax({
           url: '/$lang/task/upload-photos-help',
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
    $("input").attr('autocomplete','off');
  
    if($(this).prop("checked") == true)
    {
      $('#option').show(300);
    }
    else
    {
      $('#option').hide(300);
      $('#option :text').val('');
    }
    $(document).ready(function(){
    $("#if_user_guest").on('click',function(){
      $.post('/$lang/task/save-session-goods',$("#goods_form").serialize(),function(succes){});
    });
    $('#bww5').change(function(){
      if($(this).prop("checked") == true)
        {
          $('#option').show(300);
        }
        else
        {
          $('#option').hide(300);
          $('#option :text').val('');
        }
      });
  });
JS
);
?>
