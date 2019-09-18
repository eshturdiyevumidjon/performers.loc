<?php

use yii\widgets\DetailView;
use yii\widgets\Pjax;
$lang = Yii::$app->language;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
?>
<?php Pjax::begin(['enablePushState' => false,'id' => 'crud-datatable-pjax'])?>
  <section class="inner">   
    <div class="container">
      <nav aria-label="breadcrumb" class="breadcrumb_nav">
        <ol class="breadcrumb">   
          <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
          <li class="breadcrumb-item"><a href="/profile/index"><?=Yii::t('app','Personal Cabinet')?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Relocation assistance')?></li>
        </ol>
      </nav>
      <div class="d-flex inner_main">
        <div class="inner_left">
          <h2 id="chat" style="cursor:pointer;">Мои чаты</h2>
          <?php if ($model->performer_id != null): ?>
            <div class="chat_inner">
              <div class="form">
                <div style="overflow-y: auto;overflow-x: hidden; height: 400px; " id="messages">
                 <?=$this->render('../request/messages',['messages'=>$messages])?>
                </div>
                <form action="/<?=$lang?>/task/send-message" enctype="multipart/form-data" method="post" class="btm_chat" id="myForm">
                  <div class="input_styles">
                    <input type="text" id="message" placeholder="Написать">
                    <input type="hidden" id="from" value="<?=$model->user_id?>">
                    <input type="hidden" id="to" value="<?=$model->performer_id?>">
                    <input type="file" class="file_input" id="inputFile">
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
            <h2><?=$model->getType()[4]?></h2>
           
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
            <?=$model->getTypeIconSvg(4)?>
            <span><?=$model->getType()[4]?></span>
          </div>
          <div class="terra">
            <p class="retect"><?=Yii::t('app','Additional options')?></p>
            <div class="row_retact">
              <?php if ($model->need_loader == 1): ?>
                  <div>
                  <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Loaders')?>: <?=$model->count_loader?></span>
                  </div>
              <?php endif ?>

              <?php if ($model->need_packing == 1): ?>
                  <div>
                  <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Need to pack')?>: <?=$model->packing_area?> объём</span>
                  </div>
              <?php endif ?>
              
              <?php if ($model->demolition == 1): ?>
                 <div>
                  <span><img src="/images/check.svg" alt="">Нужна разборка</span>
                  </div>
              <?php endif ?>
              
              <?php foreach ($model->getItemsList() as $key => $value): ?>
              <?php $item = $model->getItem($key);?>
                  <?php if ($item && $item->count > 0): ?>
                    <div>
                    <span><img src="/images/check.svg" alt=""><?=$value?>: <?=$item->count?></span>
                    </div>
                  <?php endif ?>
              <?php endforeach;?>

            </div>
          </div>
          <div class="terra">
            <p><img src="/images/otp.svg" alt=""><?=Yii::t('app','Point of departure')?></p>
             <div class="row">
              <?php if ($model->shipping_house_type): ?>
                <div class="col-md-3">
                    <span><?=$model->shipping_house_type?></span>
                </div>
              <?php endif ?>
              <?php if ($model->shipping_house_floor): ?>
                <div class="col-md-3">
                    <span><?=Yii::t('app','Floor')?>: <?=$model->shipping_house_floor?></span>
                </div>
              <?php endif ?>
                <div class="col-md-3">
                  <span><?=Yii::t('app','Lift')?>: <?=$model->getYesNo($model->shipping_house_lift)?></span>
                </div>
           
            </div>
            <hr>
            <p><img src="/images/otp2.svg" alt=""><?=Yii::t('app','Destination')?></p>
            <div class="row">
              <?php if ($model->delivery_house_type): ?>
                <div class="col-md-3">
                    <span><?=$model->delivery_house_type?></span>
                </div>
              <?php endif ?>
              <?php if ($model->delivery_house_floor): ?>
                <div class="col-md-3">
                    <span><?=Yii::t('app','Floor')?>: <?=$model->delivery_house_floor?></span>
                </div>
              <?php endif ?>
                <div class="col-md-3">
                  <span><?=Yii::t('app','Lift')?>: <?=$model->getYesNo($model->delivery_house_lift)?></span>
                </div>
           
            </div>
          </div>
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
              <p><?=Yii::t('app','Paid')?>: <b>30%</b><!-- <span>2 347 457 руб.</span> --></p>
            <a href="/site/cancellation-policy" target="_blank" class="forget_pass"><?=Yii::t('app','Cancellation Terms')?></a>
          </div>
          <?php if ($active_user->type == 3): ?>
            <div class="text_right_ent">
              <?php if ($active_user->isHaveRequest($model->id)): ?>
                    
              <?php else: ?>
                 <?=\yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Leave a request'), ['create-request','id'=>$model->id],
                ['role'=>'modal-remote', 'class'=>'enter_to_site'])?>
              <?php endif ?>
            </div>
          <?php endif ?>
           <?php if ($active_user->type == 4): ?>
            <div class="text_right_ent">

            <?=\yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Order cancellation'), ['delete-task','id'=>$model->id],
              ['role'=>'modal-remote', 'class'=>'enter_to_site', 
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
<?php Pjax::end()?>

<?php $this->registerJs(<<<JS
  $(document).ready(function(){
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