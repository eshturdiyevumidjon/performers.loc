<?php
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
$lang = Yii::$app->language;
use yii\widgets\Pjax;
?>

<section class="inner">   
<?php Pjax::begin(['enablePushState' => false,'id' => 'crud-datatable-pjax'])?>
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb">   
        <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
        <li class="breadcrumb-item"><a href="/profile/index"><?=Yii::t('app','Personal Cabinet')?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Passenger Transportation')?></li>
      </ol>
    </nav>
    <div class="d-flex inner_main">
      <div class="inner_left" style="max-width: 35%">
         <h2 id="chat" style="cursor:pointer;"><?=Yii::t('app','My chats')?></h2>
          <?php if ($model->performer_id != null && (($active_user->type == 3 && $active_user->id == $model->performer_id) ||($active_user->type == 4 && $active_user->id == $model->user_id))): ?>
            <div class="chat_inner">
              <div class="form">
                <div style="overflow-y: auto;overflow-x: hidden; height: 400px; " id="messages">
                 <?=$this->render('../request/messages',['messages'=>$messages])?>
                </div>
                <form action="/<?=$lang?>/task/send-message" enctype="multipart/form-data" method="post" class="btm_chat" id="myForm">
                 <div class="input_styles">
                    <input type="text" id="message" placeholder="<?=Yii::t('app','Write')?>">
                    <input type="hidden" id="task_id" value="<?=$model->id?>">
                    <input type="hidden" id="from" value="<?=Yii::$app->user->identity->id?>">
                    <input type="hidden" id="to" value="<?=($active_user->type == 4) ? $model->performer_id : $model->user_id?>">
                    <input type="file" class="file_input" id="inputFile" accept="image/*">
                    <label for="inputFile"><img src="/images/file_chat.svg" alt=""></label>
                  </div>
                  <button type="button" name="submit_send_message" id="submit_send_message" class="btn_red"><img src="/images/arrow_chat.svg" alt=""></button>
                </form>
              </div>
            </div>
          <?php endif ?>           
              <?= $this->render('../request/inner_left',['user'=>$user,'banner'=>$banner,'active_user'=>$active_user,'model'=>$model]);?>
      </div>
      <div class="inner_right">
        <div class="wet">
          <h2><?=$model->getType()[1]?></h2>
          <!-- <div class="rating">
            <a href="#" class="rating_img">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
            </a>
            <span>4,5</span>
          </div> -->
              <h5><?=Yii::t('app','Description')?></h5>
              <p><?=$model->comment?></p>
            </div>
            <div class="bc_red_inn">
              <div class="row">
                <div class="col-lg-4">
                  <p><?=Yii::t('app','Created')?></p>
                  <span><?=$model->date_cr?></span>
                </div>
                <div class="col-lg-4">
                  <p><?=Yii::t('app','Shipping date')?></p>
                  <span><?=$model->date_begin?></span>
                </div>
                <div class="col-lg-4">
                    <?php if ($model->return == 1): ?>
                          <p><?=Yii::t('app','Date and time of return transfer')?></p>
                           <span><?=$model->date_begin2?></span>
                    <?php endif ?>
                </div>
              </div>
            </div>
            <?php if (isset($model->offer_your_price)): ?>
            <div class="suggestion">
              <p><?=Yii::t('app','Offer')?></p>
              <span><?=$model->offer_your_price." $"?> </span>
            </div>
            <?php endif ?>
           
        <div class="busy_easy">
          <?=$model->getTypeIconSvg(1)?>
          <span><?=$model->getType()[1]?></span>
        </div>
        <div class="terra aut">
          <p class="retect"><?=Yii::t('app','Passengers')?></p>
          <div class="row_retact" id="passengers" style="cursor: pointer;">
            <div>
                <span><img src="/images/people.svg" alt=""><?=Yii::t('app','Adults')?>: <?=$model->count_adult?></span>
            </div>
            <div>
                <span><img src="/images/baby.svg" alt=""><?=Yii::t('app','Children')?>: <?=$model->countDeti?></span>
            </div>
          </div>
          <div class="col-md-6 option" id="count_passengers" >
            <div class="d-flex align-items-center justify-content-between row">
                <div class="col-md-6"><b><?=Yii::t('app','Adults')?></b> :</div>
                <span><?=$model->count_adult?></span>
            </div>
            
            <div class="d-flex align-items-center justify-content-between row">
              <div class="col-md-6"> <b><?=Yii::t('app','Children')?></b></div>
            </div>

            <div class="d-flex align-items-center justify-content-between row" style="margin-bottom: 5px;">
              <div class="col-md-6">
              Автолюлька :
              <p class="opac d_mob_none">до 10 кг, до 6 месяцев</p>
              </div>
              <span><?=$model->count_avtolulka?></span>
            </div>

            <div class="d-flex align-items-center justify-content-between row" style="margin-bottom: 5px;">
              <div class="col-md-6">
              Автокресло
              <p class="opac d_mob_none">9–25 кг, 0–7 лет</p>
              </div>
              <span><?=$model->count_avtokreslo?></span>
            </div>

            <div class="d-flex align-items-center justify-content-between row" style="margin-bottom: 5px;">
              <div class="col-md-6">
              Бустер
              <p class="opac d_mob_none">22–36 кг, 6–12 лет</p>
              </div>
              <span><?=$model->count_buster?></span>
            </div>
          </div>
        </div>
        <div class="terra">
          <p class="retect"><?=Yii::t('app','Additional options')?></p>
          <div class="row">
            <?php if ($model->flight_number_status == 1): ?>
                <div class="col-xl-4 col-md-6"><span><img src="/images/air_black.svg" alt=""><?=Yii::t('app','Train/Flight Number')?>: <?=$model->flight_number?></span></div>
            <?php endif ?>

             <?php if ($model->meeting_with_sign_status == 1): ?>
                <div class="col-xl-4 col-md-6"><span><img src="/images/air_black.svg" alt=""><?=Yii::t('app','Meeting With Sign')?>: <?=$model->meeting_with_sign?></span></div>
            <?php endif ?>
            <?php if ($model->category): ?>
                <div class="col-12 mt-md-2"><span><img src="/images/front-car.svg" alt=""><?=Yii::t('app','Category of transport')?>: <?=$model->category->name?></span></div>
            <?php endif ?>
       
          </div>
        </div>
        <div class="inner_map">
          <div class="row">
            <div class="col-sm-6">
              <div id="map"></div>
            </div>
            <div class="col-sm-6 v_koord">
              <div class="v_trans">
                <div style="word-break: break-word;">
                  <img src="/images/otp.svg" alt="" class="nt-1">
                  <strong><?=$model->shipping_address?></strong>
                </div>
                <img src="/images/mang.svg" alt="" class="nt-2">
                <div style="word-break: break-word;">
                  <img src="/images/otp2.svg" alt="" class="nt-3">
                  <strong><?=$model->delivery_address?></strong>
                </div>
              </div>
              <div>
                <p><?=Yii::t('app','Distance')?>:   <b id="destination"></b></p>
                <p><?=Yii::t('app','Travel time')?>:  <b id="time"></b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="pay_inner">
          <?php if ($active_user->type == 4): ?>
               <p><?=Yii::t('app','Minimum payment')?>: <b>30%</b></p>
          <?php else: ?>
               <p><?=Yii::t('app','Paid')?>: <b><?php if($model->orders->request->price) printf("%.2f", 100*$model->orders->amount/$model->orders->request->price); else echo "0"?> %</b></p>
          <?php endif ?>
         
          <a href="/site/cancellation-policy" target="_blank" class="forget_pass"><?=Yii::t('app','Cancellation Terms')?></a>
        </div>
        <?php if ($active_user->type == 3): ?>
          <div class="text_right_ent">
             <?php if ($active_user->isHaveRequest($model->id)): ?>
                  
              <?php else: ?>
                  <?php if($active_user->status == 0) echo \yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Leave a request'), ['create-request','id'=>$model->id],['role'=>'modal-remote', 'class'=>'enter_to_site'])?>
              <?php endif ?>
           <!--  <?=\yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Get Invoice'), ['create-pay','id'=>$model->id],
             ['role'=>'modal-remote', 'class'=>'enter_to_site'])?> -->
          </div>
        <?php endif ?>
         <?php if ($active_user->type == 4): ?>
          <div class="text_right_ent">
          <?=\yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Order cancellation'), ['delete-task','id'=>$model->id],
            ['role'=>'modal-remote', 'class'=>'enter_to_site','title'=>Yii::t('app','Delete'), 
                                    'data-confirm'=>false, 'data-method'=>false, 
                                    'data-request-method'=>'post',
                                    'data-toggle'=>'tooltip',
                                    'data-confirm-title'=>Yii::t('app','Are you sure?'),
                                    'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')])?>
          </div>
        <?php endif ?>
        <div class="zayavka">
          <?= $this->render('../request/index',['user'=>$user,'active_user'=>$active_user,'requests'=>$requests,'task'=>$model])?>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->render('../request/map2',['model'=>$model])?>

<?php
$this->registerJs(<<<JS
    $(document).keypress(function(event){
  
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
     var data = new FormData() ; 
     data.append('file', $( '#inputFile' )[0].files[0]) ; 
     data.append('task_id', $( '#task_id' ).val()) ; 
     data.append('text', $( '#message' ).val()) ; 
     data.append('from', $( '#from' ).val()) ; 
     data.append('to', $( '#to' ).val()) ; 
     $.ajax({
     url: '/$lang/task/send-message',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
      beforeSend: function(){
       
      },
      success: function(data){ 
        $("#messages").html(data);
        $("#myForm")[0].reset();
        // location.reload(true);
      }
     });
    return false;
  }
  
});
  $(document).ready(function(){

    $('#passengers').click(function(){
        $('#count_passengers').toggle(300);
      })
  });
  
JS
);
?>
<?php $this->registerJs(<<<JS


  $(document).ready(function(){

  $('#inputFile').change(function(){ 
     var data = new FormData() ; 
     data.append('file', $( '#inputFile' )[0].files[0]) ; 
     data.append('task_id', $( '#task_id' ).val()) ; 
     data.append('from', $( '#from' ).val()) ; 
     data.append('to', $( '#to' ).val()) ; 
     $.ajax({
     url: '/$lang/task/send-message',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
      beforeSend: function(){
      },
      success: function(data){ 
        $("#messages").html(data);
        $("#myForm")[0].reset();
      }
     });
    return false;
  });
  setInterval(function()
  { 
     var data = new FormData() ; 
     data.append('task_id', $( '#task_id' ).val()) ; 
     data.append('to', $( '#to' ).val()) ; 
     data.append('from', $( '#from' ).val()) ;  
      $.ajax({
        url: '/$lang/task/send-message',
         type: 'POST',
         data: data,
         processData: false,
         contentType: false,
          beforeSend: function(){
           
          },
          success: function(data){ 
            $("#messages").html(data);
            // location.reload(true);
          }
      });
  }, 10000);//time in milliseconds 
  $('#chat').on('click',function(){
      $('.chat_inner').toggle(500);
    });
  $('#submit_send_message').on('click',function(){ 
     var data = new FormData() ; 
     data.append('file', $( '#inputFile' )[0].files[0]) ; 
     data.append('task_id', $( '#task_id' ).val()) ; 
     data.append('text', $( '#message' ).val()) ; 
     data.append('from', $( '#from' ).val()) ; 
     data.append('to', $( '#to' ).val()) ; 
     $.ajax({
     url: '/$lang/task/send-message',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
      beforeSend: function(){
       
      },
      success: function(data){ 
        $("#messages").html(data);
        $("#myForm")[0].reset();
        // location.reload(true);
      }
     });
    return false;
  });
    });
JS
);
?>
<?php Pjax::end()?>
