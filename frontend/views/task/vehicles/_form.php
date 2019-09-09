<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
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
             <?= $form->field($model, 'shipping_address')->textInput(['placeholder'=>$model->getAttributeLabel('shipping_address'),'class'=>'my_input otp_punkt'])->label(false) ?>
            <hr>
             <?= $form->field($model, 'delivery_address')->textInput(['placeholder'=>$model->getAttributeLabel('delivery_address'),'class'=>'my_input otp_punkt2'])->label(false) ?>
            <div class="d-flex align-items-center justify-content-between tire d_mob_none">
              <h4>Время в пути: <span>43 ч 03 мин</span></h4>
              <h4>Расстояние:  <span>3406 км</span></h4>
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
        <div class="lert">
            <?php
              for($i = 0; $i < 4; $i++){
            ?>
            <div class="download_photos" id="upload_photos<?=($i+1)?>">
              <button type="button" class="remove_photo" name="<?=($i+1)?>"><img src="/images/minus_a.svg" alt=""></button>
              <img src="" alt="" id="image_upload_preview<?=($i+1)?>">
              <label class="add_photo" for="my-file-selector<?=($i+1)?>">
                <input id="my-file-selector<?=($i+1)?>" type="file" alt="<?=($i+1)?>" class="d-none" name="images[]" accept="image/*"accept="image/*">
                <img src="/images/plus_a.svg" alt="">
               </label>
            </div>  
            <?php }?> 
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
              <?=Html::a(Yii::t('app','Publish'), ['/site/signup'],['role'=>'modal-remote','class'=>'btn_red'])?>
            </div>
          <?php else: ?>
            <?= Html::submitButton(Yii::t('app','Publish'), ['class' => 'btn_red']) ?>
          <?php endif ?>
        <?php ActiveForm::end(); ?>
       
        
    </div>
  </div>
</section>
 
<script>
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 13
  });
  var card = document.getElementById('pac-card');
  var input = document.getElementById('pac-input');
  var types = document.getElementById('type-selector');
  var strictBounds = document.getElementById('strict-bounds-selector');

  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

  var autocomplete = new google.maps.places.Autocomplete(input);

  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo('bounds', map);

  // Set the data fields to return when the user selects a place.
  autocomplete.setFields(
      ['address_components', 'geometry', 'icon', 'name']);

  var infowindow = new google.maps.InfoWindow();
  var infowindowContent = document.getElementById('infowindow-content');
  infowindow.setContent(infowindowContent);
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindowContent.children['place-icon'].src = place.icon;
    infowindowContent.children['place-name'].textContent = place.name;
    infowindowContent.children['place-address'].textContent = address;
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);

  document.getElementById('use-strict-bounds')
      .addEventListener('click', function() {
        console.log('Checkbox clicked! New state=' + this.checked);
        autocomplete.setOptions({strictBounds: this.checked});
      });
}
</script>
<script  async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0nNC2JY5h2LxGdKCTXSXMV5ZNDrpwvvA&callback=initMap"></script>
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
    });
  });
JS
);
?>
