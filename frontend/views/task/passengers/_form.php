<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\datetime\DateTimePicker;

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
            <img src="/images/bus.svg" alt="">
            <p><?=Yii::t('app','Passenger Transportation')?></p>
          </div>
      </div>
      <hr>
       <?php $form = ActiveForm::begin(['id'=>"passengers_form",'options'=>['enctype'=>'multipart/form-data','class'=>'input_styles']]); ?>
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
             
            <div class=" my_input" style="margin-top:10px;margin-bottom: 20px;">
            <?php echo DateTimePicker::widget([
                'model' => $model,
                'attribute' => 'date_begin',
                'options'=>[
                      'placeholder'=>$model->getAttributeLabel('date_begin'),
                      'class'=>'my_input other_date_inp',
                      'style'=>'cursor:pointer;',
                    ],
                    'pluginOptions' => [
                          'format' => 'dd.mm.yyyy hh:ii',
                          'todayBtn' => true,
                          'autoclose' => true,
                     ]
                 ]);?>
                 <p class="opac d_mob_none"><?=Yii::t('app',"Start date and time when the passengers is ready to ship")?></p>
              </div>
             <div class="form-group_checkbox">
                <input type="checkbox" id="bww5" name="return" value="1" <?=($model->return == 1)? "checked":""?>>
                <label for="bww5"><?=Yii::t('app','Add return route')?></label>
             </div>
             <div style="margin-top:10px;margin-bottom: 20px;">
                <?php echo DateTimePicker::widget([
                'model' => $model,
                'attribute' => 'date_begin2',
                'options'=>[
                      'placeholder'=>$model->getAttributeLabel('date_begin2'),
                      'class'=>'my_input other_date_inp option',
                      'id'=>'option',
                      'style'=>'cursor:pointer;',
                    ],
                    'pluginOptions' => [
                          'format' => 'dd.mm.yyyy hh:ii',
                          'todayBtn' => true,
                          'autoclose' => true,
                     ]
                 ]);?>
             </div>
          </div>
          <div class="col-md-6 d_mob_none carta_d">
          <div id="map"></div>
          </div>
        </div>
        <hr class="mb15">
        <h4><?=$model->getAttributeLabel('offer_your_price')?></h4>
             <?= $form->field($model, 'offer_your_price')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>$model->getAttributeLabel('offer_your_price')]])->label(false) ?>
       
        <h4><?=Yii::t('app','Number of passengers')?></h4>
        <div class="form-group" id="passengers" style="cursor: pointer;">
          <div class="spans">
            <span class="large_young"><?=Yii::t('app','Adults')?>: <?=isset($model->count_adult)?$model->count_adult:0?></span>
            <span class="small_young"><?=Yii::t('app','Children')?>: <?=$model->countDeti?></span>
          </div>
        </div>
        <div class="col-md-6 option" id="count_passengers" >

           <div class="d-flex align-items-center justify-content-between row">
              <div class="col-md-2"><b><?=Yii::t('app','Adults')?></b></div>
              <div class="form_count" style="width: 100px;height: 35px;">
                <button class="minus_count" name="minus_adult" style="width: 33%;"><img src="/images/minus_a.svg" alt=""></button>
                <input type="number" min=0 name="count_adult" value='<?=isset($model->count_adult)?$model->count_adult:0?>' style="width: 33%;">
                <button class="plus_count" name="plus_adult" style="width: 33%;"><img src="/images/plus_a.svg" alt="" ></button>
              </div>
           </div>

          <div class="row"><div class="col-md-12"> <b><?=Yii::t('app','Children')?></b></div></div>

          <div class="d-flex align-items-center justify-content-between row" style="margin-bottom: 5px;">
            <div class="col-md-6">
            Автолюлька
            <p class="opac d_mob_none">до 10 кг, до 6 месяцев</p>
            </div>
            <div class="form_count" style="width: 100px;height: 35px;">
              <button class="minus_count" name="minus_avtolulka" style="width: 33%;"><img src="/images/minus_a.svg" alt=""></button>
              <input type="number" name="count_avtolulka"  min=0 value='<?=isset($model->count_avtolulka)?$model->count_avtolulka:0?>' style="width: 33%;">
              <button class="plus_count" name="plus_avtolulka" style="width: 33%;"><img src="/images/plus_a.svg" alt="" ></button>
            </div>
          </div>

          <div class="d-flex align-items-center justify-content-between row" style="margin-bottom: 5px;">
            <div class="col-md-6">
            Автокресло
            <p class="opac d_mob_none">9–25 кг, 0–7 лет</p>
            </div>
            <div class="form_count" style="width: 100px;height: 35px;">
              <button class="minus_count" name="minus_avtokreslo" style="width: 33%;"><img src="/images/minus_a.svg" alt=""></button>
              <input type="number" min=0  name="count_avtokreslo" value="<?=isset($model->count_avtokreslo)?$model->count_avtokreslo:0?>" style="width: 33%;">
              <button class="plus_count" name="plus_avtokreslo"  style="width: 33%;"><img src="/images/plus_a.svg" alt="" ></button>
            </div>
          </div>

          <div class="d-flex align-items-center justify-content-between row" style="margin-bottom: 5px;">
            <div class="col-md-6">
            Бустер
            <p class="opac d_mob_none">22–36 кг, 6–12 лет</p>
            </div>
            <div class="form_count"  style="width: 100px;height: 35px;">
              <button class="minus_count" name="minus_buster" style="width: 33%;"><img src="/images/minus_a.svg" alt=""></button>
              <input type="number" name="count_buster" min=0 value='<?=isset($model->count_buster)?$model->count_buster:0?>' style="width: 33%;">
              <button class="plus_count" name="plus_buster" style="width: 33%;"><img src="/images/plus_a.svg" alt="" ></button>
            </div>
          </div>

        </div>
        <br>
        <h4><?=Yii::t('app','Select a transport category')?></h4>
        <?= $form->field($model, 'category_id')->dropDownList($model->getCategoryList(), ['class'=>'my_input form-control','prompt' => Yii::t('app','Select'),'style' => 'color: #652341; font-size: 18px;cursor:pointer;'])->label(false)?>
        <hr>
        <div style="margin-bottom: 10px;margin-top: 10px;">
          <div class="form-group_checkbox" style="margin-bottom: 10px;margin-top: 10px;">
              <input type="checkbox" id="bww1" name="flight_number_status" value="1" <?=($model->flight_number_status ==1)? "checked":""?>>
              <label for="bww1"><?=Yii::t('app','Air or railway flight number')?></label>
          </div>
          <div class="option" id="flight_number">
          <?= $form->field($model, 'flight_number')->textInput(['placeholder'=>'Например, ВА 2254','class'=>'my_input'])->label(false) ?>
          </div>
        </div>
        <hr>
        <div style="margin-bottom: 10px;margin-top: 10px;">
          <div class="form-group_checkbox" style="margin-bottom: 10px;margin-top: 10px;">
              <input type="checkbox" id="bww2" name="meeting_with_sign_status" value="1" <?=($model->meeting_with_sign_status ==1)? "checked":""?>>
              <label for="bww2"><?=Yii::t('app','Meeting With Sign')?></label>
          </div>
          <div class="option" id="meeting_with_sign">
          <?= $form->field($model, 'meeting_with_sign')->textInput(['placeholder'=>'Текст на табличке','class'=>'my_input'])->label(false) ?>
          </div>
        </div>
        <hr class="mb15">
        <h4><?=Yii::t('app','Additional terms')?></h4>
        <div class="form-group_checkbox mt10 mb15">
            <input type="checkbox" id="bww3" name="alert_email" value="1" <?=($model->alert_email ==1)? "checked":""?> >
            <label for="bww3"><?=$model->getAttributeLabel('alert_email')?></label>
        </div>
        <hr class="mb-2">
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
<?=$this->render('../request/map.php',['lang'=>$lang])?> 
<?php
$this->registerJs(<<<JS
  $("input").attr('autocomplete','off');
  if($('#bww5').prop("checked") == true)
          $('#option').show();
   if($('#bww1').prop("checked") == true)
          $('#flight_number').show();
   if($('#bww2').prop("checked") == true)
          $('#meeting_with_sign').show();

  $(document).ready(function(){
    $("#if_user_guest").on('click',function(){
      $.post('/$lang/task/save-session-passenger',$("#passengers_form").serialize(),function(succes){alert(succes)});
    });
    $('#passengers').click(function(){
        $('#count_passengers').toggle(300);
      })
    $("[class*='_count']").on('click',function(){
        if($(this).attr('name') == 'minus_adult' || $(this).attr('name') == 'plus_adult')
          $('.large_young').text("Взрослые: " + $("[name|='count_adult']").val());
        else
        {
          var deti = parseInt($("[name|='count_buster']").val()) + parseInt($("[name|='count_avtolulka']").val()) + parseInt($("[name|='count_avtokreslo']").val());
          $('.small_young').text("Дети: " + deti);
        }
      });
    $('#bww5').change(function(){
      if($(this).prop("checked") == true)
        {
          $('#option').show(300);
          $('#option').attr('required', 'required');
        }
        else
        {
          $('#option').val('');
          $('#option').removeAttr('required');
          $('#option').hide(300);
        }
      });
    $('#bww1').change(function(){
    if($(this).prop("checked") == true)
      {
        $('#flight_number').show(300);
        $('#flight_number').attr('required', 'required');
      }
      else
      {
        $('#flight_number').val('');
        $('#flight_number').removeAttr('required');

        $('#flight_number').hide(300);
      }
    });
    $('#bww2').change(function(){
    if($(this).prop("checked") == true)
      {
        $('#meeting_with_sign').show(300);
        $('#meeting_with_sign').attr('required', 'required');
      }
      else
      {
        $('#meeting_with_sign').val('');
        $('#meeting_with_sign').removeAttr('required');
        $('#meeting_with_sign').hide(300);
      }
    });
  });
JS
);
?>
