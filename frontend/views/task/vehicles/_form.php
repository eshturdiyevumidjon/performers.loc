<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
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
            <img src="/images/surface3.svg" alt="">
            <p><?=Yii::t('app','Car transportation')?></p>
          </div>
      </div>
      <hr>
       <?php $form = ActiveForm::begin(['id'=>"vehicles_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles']]); ?>
       <?php
        // echo "<pre>";
        // print_r($form->errorSummary($model));
        // print_r($model->attributes);
        // print_r($post);
        // echo "</pre>";
       ?>
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
            <div class="d-flex align-items-center justify-content-between tire d_mob_none " id="inform">
              <h4><?=Yii::t('app','Travel time')?>: <span id="time"></span></h4>
              <h4><?=Yii::t('app','Distance')?>: <span id="destination"></span></h4>
            </div>
            <div id="map_for_mobile"></div>
            <h4 class="mt10"><?=Yii::t('app','Date')?></h4>
              <?= $form->field($model, 'date_begin')->widget(DatePicker::classname(), [
                         'options'=>[
                          'style'=>'cursor:pointer;',
                          'class'=>'my_input other_date_inp',
                          'placeholder'=>$model->getAttributeLabel('date_begin'),
                        ],
                        'pluginOptions' => [
                             'autoclose'=>true
                         ]
                     ])->hint('<p class="opac d_mob_none">'.Yii::t('app',"Start date and time when the shipment is ready to ship").'</p>')->label(false);?>
             <?= $form->field($model, 'date_close')->widget(DatePicker::classname(), [
                        'options'=>[
                          'style'=>'cursor:pointer;',
                          'class'=>'my_input other_date_inp',
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
        
        <h4>Модель и марка автомобиля</h4>
        
       
        <?= $form->field($model, 'car_mark')->dropDownList(ArrayHelper::map(\backend\models\Marks::find()->all(),'id','name_mark'), ['class'=>'my_input','prompt' => Yii::t('app','Car mark'),'style'=>'cursor:pointer;'])->label(false)?>
         <?= $form->field($model, 'car_model')->dropDownList(ArrayHelper::map(\backend\models\Models::find()->all(),'id','name_model'), ['class'=>'my_input','prompt' => Yii::t('app','Car model'),'style'=>'cursor:pointer;'])->label(false)?>
        <div class="d-flex align-items-center hodu">
          <div class="form-group_checkbox mt10 mb15 vnu_m">
              <input type="checkbox" id="bww55" name="car_on_the_go" value="1" <?=($model->car_on_the_go == 1)?'checked':''?>>
              <label for="bww55">Автомобиль на ходу?</label>
          </div>
        <!--   <div class="form-group">
            <input type="text" placeholder="Не нашли модель своего автомобиля? Напишите здесь">
          </div> -->
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
        <hr class="mb15">
        <h4><?=Yii::t('app','Additional terms')?></h4>
        <div class="form-group_checkbox mt10 mb15">
            <input type="checkbox" id="bww3" name="alert_email" value="1" <?=($model->alert_email ==1)? "checked":""?> >
            <label for="bww3"><?=$model->getAttributeLabel('alert_email')?></label>
        </div>
        <hr>
        <h4><?=$model->getAttributeLabel('promo_code')?></h4>
        <?= $form->field($model, 'promo_code')->textInput(['maxlength' => true,'class'=>'my_input','placeholder'=>'...'])->label(false) ?>
        <hr class="mb-0">
        <div class="d-flex align-items-center justify-content-between tit_textarea">
          <h4><?=$model->getAttributeLabel('comment')?></h4>
          <span class="numb_textarea"><span id="counter">0</span>/5000</span>
        </div>
          <?= $form->field($model, 'comment')->textarea(['rows' => 6,'id'=>'textfield','class'=>'my_input'])->label(false) ?>

            <?php if (Yii::$app->user->isGuest): ?>
             <div style="width: 30%; text-align: center;float: right; margin-right: 5%;">
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
  $(document).ready(function(){
      $("#if_user_guest").on('click',function(){
      $.post('/$lang/task/save-session-vehicles',$("vehicles_form").serialize(),function(succes){alert(succes)});
    });
    });
 
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
  
 
JS
);
?>
