<?php
use yii\widgets\Pjax;
$lang = Yii::$app->language;
?>

 <section class="inner">   
<?php Pjax::begin(['enablePushState' => false,'id' => 'crud-datatable-pjax'])?>

  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb">   
        <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
        <li class="breadcrumb-item"><a href="/profile/index"><?=Yii::t('app','Personal Cabinet')?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Freight transportation')?></li>
      </ol>
    </nav>
    <div class="d-flex inner_main">
      <div class="inner_left">
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
          <?= $this->render('../request/inner_left',['user'=>$user,'banner'=>$banner]);?>
      </div>
      <div class="inner_right">
        <div class="wet">
              <h2><?=$model->getType()[3]?></h2>
         <!--  <div class="rating">
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
              <p><?=Yii::t('app','Arrival date')?></p>
              <span><?=$model->date_close?></span>
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
          <?=$model->getTypeIconSvg(3)?>
          <span><?=$model->getType()[3]?></span>
        </div>
        <div class="terra">
          <p class="retect"><?=Yii::t('app','Additional options')?></p>
          <div class="row_retact">
            <?php if ($model->loading_required_status == 1): ?>
              <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Required load')?></span>
              </div>
               <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Floor')?>: <?=$model->floor?></span>
              </div>
              <div>
                  <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Lift')?>: <?=($model->lift == 1) ? Yii::t('app','Yes') : Yii::t('app','No')?></span>
              </div>
            <?php endif ?>
            <?php 
              $variable = explode(',', $model->classification);
              foreach ($variable as $value): ?>
              <?php if ($value): ?>
                  <div>
                    <span><img src="/images/check.svg" alt=""><?=$model->getTypeOfTheGoods($value)?></span>
                  </div>
              <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
        <?php if ($model->weight || $model->width || $model->length || $model->height): ?>
             <div class="terra">
                <p class="retect"><?=Yii::t('app','Cargo Parameters')?></p>
                <div class="row_retact">
                  <?php if ($model->weight): ?>
                    <div>
                        <span><?=$model->getAttributeLabel('weight')." : ".$model->weight?></span>
                    </div>
                  <?php endif ?>
                  <?php if ($model->width): ?>
                      <div>
                        <span><?=$model->getAttributeLabel('length')." : ".$model->width?></span>
                    </div>
                  <?php endif ?>
                  <?php if ($model->length): ?>
                     <div>
                        <span><?=$model->getAttributeLabel('length')." : ".$model->length?></span>
                    </div>
                  <?php endif ?>
                  <?php if ($model->height): ?>
                     <div>
                        <span><?=$model->getAttributeLabel('height')." : ".$model->height?></span>
                    </div>
                  <?php endif ?>
          </div>
        </div>
        <?php endif ?>
     
        <div class="photos_inn">
          <p><?=Yii::t('app','Image')?></p>
          <div class="d-flex flex-wrap">
            <?php
              if($model->image != ""){ 
              $imgs = explode(',',$model->image);
               foreach ($imgs as $key => $value): ?>
                <a href="/uploads/tasks/<?=$value?>" class="netr" data-fancybox="galery"><img src="/uploads/tasks/<?=$value?>" alt=""></a>
              <?php endforeach;} ?>
          </div>
        </div>
        <div class="inner_map">
          <div class="row">
            <div class="col-sm-6">
              <div id="map"></div>
            </div>
            <div class="col-sm-6 v_koord">
              <div class="v_trans">
                <div style="word-break:break-word;">
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
             <p><?=Yii::t('app','Minimum payment')?>: <b>30%</b><!-- <span>2 347 457 руб.</span> --></p>
          <?php else: ?>
             <p><?=Yii::t('app','Paid')?>: <b>30%</b><!-- <span>2 347 457 руб.</span> --></p>
          <?php endif ?>
          <a href="/site/cancellation-policy" target="_blank" class="forget_pass"><?=Yii::t('app','Cancellation Terms')?></a>
        </div>
        <?php if ($active_user->type == 3): ?>
          <div class="text_right_ent">
           <?php if ($active_user->isHaveRequest($model->id)): ?>
                  
           <?php else: ?>
             <?=\yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Leave a request'), ['create-request','id'=>$model->id],
            ['role'=>'modal-remote', 'class'=>'enter_to_site'])?>
          <?php endif ?>
            <!-- <a href="#" class="enter_to_site"><span class="aft_back"></span>Получить инвойс</a> -->
          </div>
        <?php endif ?>
        <?php if ($active_user->type ==4): ?>
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
          <?= $this->render('../request/index',['user'=>$user,'active_user'=>$active_user,'requests'=>$requests])?>
        </div>
      </div>
    </div>
  </div>
</section>
    
<?= $this->render('../request/map2',['model'=>$model])?>
<?php $this->registerJs(<<<JS
  $(document).keypress(function(event){
  
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
     var data = new FormData() ; 
     data.append('file', $( '#inputFile' )[0].files[0]) ; 
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
  setInterval(function()
  { 
     var data = new FormData() ; 
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
  $('#inputFile').change(function(){ 
     var data = new FormData() ; 
     data.append('file', $( '#inputFile' )[0].files[0]) ; 
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

    $('#chat').on('click',function(){
        $('.chat_inner').toggle(500);
      });
  $('#submit_send_message').on('click',function(){ 
     var data = new FormData() ; 
     data.append('file', $( '#inputFile' )[0].files[0]) ; 
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

