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
            <img src="<?=$model->getTypeIconWhite()?>" alt="">
            <p><?=Yii::t('app','Relocation assistance')?></p>
          </div>
      </div>
      <hr>
       <?php $form = ActiveForm::begin(['id'=>"help_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles']]); ?>
       <?php
        // echo "<pre>";
        // print_r($form->errorSummary($model));
        // // print_r($model->attributes);
        // echo "</pre>";
       ?>
       <div class="row">
          <div class="col-md-6 order_left"> 
            <h4><?=Yii::t('app','Address')?></h4>
               <?= $form->field($model, 'shipping_address')->textInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input otp_punkt','id'=>'shipping_address'])->label(false) ?>
             <?= $form->field($model, 'shipping_coordinate_x')->hiddenInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input hidden otp_punkt','id'=>'shipping_address_coordinate_x'])->label(false) ?>
             <?= $form->field($model, 'shipping_coordinate_y')->hiddenInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input hidden otp_punkt','id'=>'shipping_address_coordinate_y'])->label(false) ?>
             <?= $form->field($model, 'shipping_house_type')->textInput(['placeholder'=>Yii::t('app','Apartment'),'class'=>'my_input'])->label(false) ?>
             <?= $form->field($model, 'shipping_house_floor')->textInput(['placeholder'=>$model->getAttributeLabel('shipping_house_floor'),'class'=>'my_input'])->label(false) ?>
              <div class="form-group_checkbox">
                  <input type="checkbox" id="bwwp" name="shipping_house_lift" value="1" <?=($model->shipping_house_lift ==1)? "checked":""?>>
                  <label for="bwwp"><?=Yii::t('app','Lift')?></label>
              </div>
            
            <hr class="ker">
            <div id="map_for_mobile"></div>
              <?= $form->field($model, 'delivery_address')->textInput(['placeholder'=>Yii::t('app','Destination'),'class'=>'my_input otp_punkt2','id'=>'delivery_address'])->label(false) ?>
              <?= $form->field($model, 'delivery_coordinate_x')->hiddenInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input hidden otp_punkt','id'=>'delivery_address_coordinate_x'])->label(false) ?>
             <?= $form->field($model, 'delivery_coordinate_y')->hiddenInput(['placeholder'=>Yii::t('app','Point of departure'),'class'=>'my_input hidden otp_punkt','id'=>'delivery_address_coordinate_y'])->label(false) ?>
             <?= $form->field($model, 'delivery_house_type')->textInput(['placeholder'=>Yii::t('app','Apartment'),'class'=>'my_input'])->label(false) ?>

             <?= $form->field($model, 'delivery_house_floor')->textInput(['placeholder'=>$model->getAttributeLabel('delivery_house_floor'),'class'=>'my_input'])->label(false) ?>
             <div class="form-group_checkbox negat">
                  <input type="checkbox" id="bwwpr" name="delivery_house_lift"value="1" <?=($model->delivery_house_lift ==1)? "checked":""?>>
                  <label for="bwwpr">Наличие лифта</label>
              </div>
            <div class="d-flex align-items-center justify-content-between d_mob_none" id="inform">
             <h4><?=Yii::t('app','Travel time')?>: <span id="time"></span></h4>
              <h4><?=Yii::t('app','Distance')?>: <span id="destination"></span></h4>
            </div>
          </div>
          <div class="col-md-6 d_mob_none carta_d">
            <div id="map"></div> 
          </div>
        </div>
        <hr>
        <h4 class="mt15"><?=Yii::t('app','Date')?></h4>
        <div class="row">
          <div class="col-md-6">
             <?= $form->field($model, 'date_begin')->widget(DatePicker::classname(), [
                         'options'=>[
                          'class'=>'my_input other_date_inp',
                          'style'=>'cursor:pointer;',
                          'placeholder'=>$model->getAttributeLabel('date_begin'),
                        ],
                        'pluginOptions' => [
                             'autoclose'=>true
                         ]
                     ])->hint('<p class="opac d_mob_none">'.Yii::t('app',"Start date and time when the passengers is ready to ship").'</p>')->label(false);?>
          </div>
          <div class="col-md-6">
             <?= $form->field($model, 'date_close')->widget(DatePicker::classname(), [
                        'options'=>[
                          'class'=>'my_input other_date_inp',
                          'style'=>'cursor:pointer;',
                          'placeholder'=>$model->getAttributeLabel('date_close'),
                        ],
                        'pluginOptions' => [
                             'autoclose'=>true
                         ]
                     ])->hint('<p class="opac d_mob_none">'.Yii::t('app',"The maximum possible date and time when the passengers must be a destination point").'</p>')->label(false);?> 
          </div>
        </div>
        <hr class="mb15 mt5">
       <h4><?=$model->getAttributeLabel('offer_your_price')?></h4>
         <?= $form->field($model, 'offer_your_price')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>$model->getAttributeLabel('offer_your_price')]])->label(false) ?>
       
        <hr>
        <div class="form-group_checkbox">
            <input type="checkbox" id="bwwprw" name="demolition" value="1" <?=($model->demolition ==1)? "checked":""?>>
            <label for="bwwprw"><?=Yii::t('app','Need disassembly')?></label>
        </div>
        <div class="paino">
         
          <?php foreach ($model->getItemsList() as $key => $value): ?>
            <?php $item = $model->getItem($key);?>
             <div class="d-flex align-items-center justify-content-between">
            <div class="form-group_checkbox">
                <input type="checkbox" id="bewprw<?=$key?>" name="need_<?=$key?>" value="1" <?=($item) ? "checked":""?>>
                <label for="bewprw<?=$key?>"><?=$value?></label>
            </div>
            <div class="form_count" id="need_<?=$key?>" style="display: none;">
              <button class="minus_count"><img src="/images/minus_a.svg" alt=""></button>
              <input type="number" name="items[<?=$key?>]"  min=0 value='<?=($item)?$item['count']:1?>'>
              <button class="plus_count"><img src="/images/plus_a.svg" alt=""></button>
            </div>
          </div>
          <?php endforeach ?>
         
         
        
          <!--<div class="d-flex align-items-center justify-content-between">
            <div class="form-group_checkbox">
                <input type="checkbox" id="bbewprwc" name="need_furniture" value="1" <?=($model->need_furniture ==1)? "checked":""?> >
                <label for="bbewprwc"><?=Yii::t('app','Furniture and household appliances')?></label>
            </div>
            <div class="form_count" id="need_furniture" style="display: none;">
              <button class="minus_count"><img src="/images/minus_a.svg" alt=""></button>
              <input type="number"  min=0 name="count_furniture" placeholder="bewprw" min=0 value='<?=isset($model->count_furniture)?$model->count_furniture:1?>'>
              <button class="plus_count"><img src="/images/plus_a.svg" alt=""></button>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div class="form-group_checkbox">
                <input type="checkbox" id="bewpdrwc" name="need_building_materials" value="1" <?=($model->need_building_materials ==1)? "checked":""?> >
                <label for="bewpdrwc"><?=Yii::t('app','Building materials')?></label>
            </div>
            <div class="form_count" id="need_building_materials" style="display: none;">
              <button class="minus_count"><img src="/images/minus_a.svg" alt=""></button>
              <input type="number"  min=0 name="count_building_materials" placeholder="bewprw" min=0 value='<?=isset($model->count_building_materials)?$model->count_building_materials:1?>'>
              <button class="plus_count"><img src="/images/plus_a.svg" alt=""></button>
            </div>
          </div>              
          <div class="d-flex align-items-center justify-content-between">
            <div class="form-group_checkbox">
                <input type="checkbox" id="bbewpr1wc" name="need_personal_items" value="1" <?=($model->need_personal_items ==1)? "checked":""?>>
                <label for="bbewpr1wc"><?=Yii::t('app','Personal items')?></label>
            </div>
            <div class="form_count" id="need_personal_items" style="display: none;">
              <button class="minus_count"><img src="/images/minus_a.svg" alt=""></button>
              <input type="number"  min=0 name="count_personal_items" placeholder="bewprw" min=0 value='<?=isset($model->count_personal_items)?$model->count_personal_items:1?>'>
              <button class="plus_count"><img src="/images/plus_a.svg" alt=""></button>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div class="form-group_checkbox">
                <input type="checkbox" id="b1ewpdrwc" name="need_special_equipments" value="1" <?=($model->need_special_equipments ==1)? "checked":""?>>
                <label for="b1ewpdrwc"><?=Yii::t('app','Special equipment and oversized')?></label>
            </div>
            <div class="form_count" id="need_special_equipments" style="display: none;">
              <button class="minus_count"><img src="/images/minus_a.svg" alt=""></button>
              <input type="number"  min=0 name="count_special_equipments" placeholder="bewprw" min=0 value='<?=isset($model->count_special_equipments)?$model->count_special_equipments:1?>'>
              <button class="plus_count"><img src="/images/plus_a.svg" alt=""></button>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div class="form-group_checkbox">
                <input type="checkbox" id="beeewprw" name="need_purchases" value="1" <?=($model->need_purchases ==1)? "checked":""?>>
                <label for="beeewprw"><?=Yii::t('app','Purchases')?></label>
            </div>
             <div class="form_count" id="need_purchases" style="display: none;">
                <button class="minus_count"><img src="/images/minus_a.svg" alt=""></button>
                <input type="number"  min=0 name="count_purchases" placeholder="bewprw" min=0 value='<?=isset($model->count_purchases)?$model->count_purchases:1?>'>
                <button class="plus_count"><img src="/images/plus_a.svg" alt=""></button>
              </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div class="form-group_checkbox">
                <input type="checkbox" id="buprw" name="need_other_items" value="1" <?=($model->need_other_items ==1)? "checked":""?>>
                <label for="buprw"><?=Yii::t('app','Other goods')?></label>
            </div>
           <div class="form_count" id="need_other_items" style="display: none;">
                <button class="minus_count"><img src="/images/minus_a.svg" alt=""></button>
                <input type="number"  min=0 name="count_other_items" placeholder="bewprw" min=0 value='<?=isset($model->count_other_items)?$model->count_other_items:1?>'>
                <button class="plus_count"><img src="/images/plus_a.svg" alt=""></button>
              </div>
          </div> -->
        </div>
        <div class="d-flex align-items-center d_inp">
          <div class="form-group_checkbox vnu_m" style="margin-top: 20px;margin-bottom: 20px;">
              <input type="checkbox" id="bww55" name="need_packing"  value="1" <?=($model->need_packing ==1)? "checked":""?>>
              <label for="bww55"><?=Yii::t('app','Need packing?')?></label>
          </div>
          <div id="need_packing" style="display: none;width: 100%;">
            <?= $form->field($model, 'packing_area')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>$model->getAttributeLabel('packing_area')]])->label(false) ?>
          
           </div>
        </div>
        <hr>
        <div class="d-flex align-items-center d_inp">
          <div class="form-group_checkbox vnu_m" style="margin-top: 20px;margin-bottom: 20px;">
              <input type="checkbox" id="ascacs" value="1" name="need_loaders" <?=($model->need_loader ==1)? "checked":""?>>
              <label for="ascacs"><?=Yii::t('app','Loaders')?></label>
          </div>
          <div id="need_loaders" style="display: none;width: 100%;">
            <?= $form->field($model, 'count_loader')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>$model->getAttributeLabel('count_loader')]])->label(false) ?>
         
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
 remove = function(id){
    $("#photo"+id).remove();
  }
  $("#my-file-selector1").on('change',function(e){
    var files = e.target.files;

    $.each(files, function(i,file){
        var reader = new FileReader();

        reader.readAsDataURL(file);

        reader.onload = function(e){
            var template = '<div class="download_photos added" id="photo'+i+'">' +
            '<button type="button" class="remove_photo" onclick="remove('+i+')"><img src="/images/minus_a.svg"></button>'+
                '<img src="'+e.target.result+'" alt="">'+
              '</div>';
            $('#photos').prepend(template);

          };

      });

  });
  $("input").attr('autocomplete','off');
 
  $("[name*='need']").each(function(){
        var id = $(this).attr('name');
        if($(this).prop("checked") == true)
        {
          $("#"+id).show(300);
          $("#"+id+" input").attr('required', 'required');
        }
        else
        {
          $("#"+id).hide(300);
          $("#"+id+" input").removeAttr('required');
          $("#"+id+" input").val('0');
          $("#"+id+" :text").val('');
    
        }
    });
  $(document).ready(function(){
     $("#if_user_guest").on('click',function(){
      $.post('/$lang/task/save-session-help',$("#help_form").serialize(),function(succes){});
    });
    $("[name*='need']").change(function(){
          var id = $(this).attr('name');
          if($(this).prop("checked") == true)
          {
            $("#"+id).show(300);
            $("#"+id+" input").attr('required', 'required');
          }
          else
          {
            $("#"+id).hide(300);
            $("#"+id+" input").removeAttr('required');
            $("#"+id+" input").val('0');
            $("#"+id+" :text").val('');
      
          }
      });
  });
JS
);
?>
