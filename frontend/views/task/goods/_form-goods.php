<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
$lang = Yii::$app->language;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="order">
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb">   
        <li class="breadcrumb-item"><a href="/site/index">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Создание заказа ПП</li>
      </ol>
    </nav>
    <div class="order_wrapper">
      <h1>Создание заказа</h1>
      <hr>
      <div class="br_order">
          <div class="btn_red">
            <img src="/images/surface.svg" alt="">
            <p>Грузовые перевозки</p>
          </div>
      </div>
      <hr>
      <form action="/<?=$lang?>/task/create-goods" enctype="multipart/form-data" method="post" class="input_styles">
        <div class="row">
          <div class="col-md-6 order_left"> 
            <h4>Адрес</h4>
            <div class="form-group">
                <input type="text" placeholder="Адрес отгрузки" class="otp_punkt" required="" name="Tasks[shipping_address]" value="<?=$model->shipping_address?>">
            </div>
            <hr>
            <div class="form-group">
                <input type="text" placeholder="Адрес доставки" class="otp_punkt2" required="" name="Tasks[delivery_address]" value="<?=$model->delivery_address?>">
            </div>
            <div class="d-flex align-items-center justify-content-between tire d_mob_none fre_sp">
              <h4>Время в пути: <span>43 ч 03 мин</span></h4>
              <h4>Расстояние:  <span>3406 км</span></h4>
            </div>
            <div id="map_for_mobile"></div>
            <h4 class="mt10">Дата</h4>
            <div class="form-group">
                <input type="date" placeholder="Дата начала срока задания" class="other_date_inp" required="" name="Tasks[date_begin]" value="<?=$model->date_begin?>">
                <p class="opac d_mob_none">Начальная дата и время когда груз будет готов к отправке</p>
            </div>
            <div class="form-group">
                <input type="date" placeholder="Дата окончания срока задания" class="other_date_inp" required="" name="Tasks[date_close]" value="<?=$model->date_close?>">
                <p class="opac d_mob_none">Максимально возможная дата и время, когда груз должен быть в точке назначения</p>
            </div>
          </div>
          <div class="col-md-6 d_mob_none carta_d">
          <div id="map"></div> 
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
          </div>
        </div>
        <hr class="mb15">
        <h4>Предложить свою цену</h4>
        <div class="form-group">
          <input type="text" placeholder="Цена" required="" name="Tasks[offer_your_price]" name="<?=$model->offer_your_price?>">
        </div>
        <h4>Параметры груза</h4>
        <div class="row mband">
          <div class="col-sm-6">
            <div class="form-group">
                <input type="text" placeholder="Вес" required="" name="Tasks[weight]" name="<?=$model->weight?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
                <input type="text" placeholder="Длина" required="" name="Tasks[length]" name="<?=$model->length?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
                <input type="text" placeholder="Ширина" required="" name="Tasks[width]" name="<?=$model->width?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
                <input type="text" placeholder="Высота" required="" name="Tasks[height]" name="<?=$model->height?>">
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center barat">
          <div class="form-group_checkbox mt10 mb15 vnu_m">
              <input type="checkbox" id="bww55" name="tip_gruz1">
              <label for="bww55">Крупногабаритный</label>
          </div>
          <div class="form-group_checkbox mt10 mb15 vnu_m">
              <input type="checkbox" id="bww55a" name="tip_gruz2">
              <label for="bww55a">Хрупкий</label>
          </div>
          <div class="form-group_checkbox mt10 mb15 vnu_m">
              <input type="checkbox" id="bww55r" name="tip_gruz3">
              <label for="bww55r">Опасный</label>
          </div>              
        </div>
        
        <hr class="mb15">
        <h4>Дополнительные условия</h4>
        <div class="form-group_checkbox mt10 mb15">
            <input type="checkbox" id="bww3" name="Tasks[alert_email]" <?=($model->alert_email ==1)? "checked":""?> >
            <label for="bww3">Показывать уведомления посредством электронной почты</label>
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
                <input id="my-file-selector<?=($i+1)?>" type="file" alt="<?=($i+1)?>" class="d-none" name="images[]">
                <img src="/images/plus_a.svg" alt="">
               </label>
            </div>  
            <?php }?> 
        </div>
        <h4>Промо-КОД</h4>
        <div class="form-group">
          <input type="text" name="Tasks[promo_code]" placeholder="..." value="<?=$model->promo_code?>">
        </div>
        <hr class="mb-0">
        <div class="d-flex align-items-center justify-content-between tit_textarea">
          <h4>Комментарий</h4>
          <span class="numb_textarea"><span id="counter">0</span>/5000</span>
        </div>
        <textarea name="Tasks[comment]" id="textfield" cols="30" rows="10" placeholder="..." maxlength='5000'>
          <?=$model->comment?>
        </textarea>
        <button type="submit" class="btn_red" name="submit">Опубликовать</button>
      </form>
    </div>
  </div>
</section>
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
