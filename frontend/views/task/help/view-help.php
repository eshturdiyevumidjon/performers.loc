<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
?>
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
        <!-- <div class="chat_inner">
          <div class="form" style="overflow-y: scroll; height: 400px; ">
            <div class="user1 user_chats">
              <div class="avatar">
                <img src="/images/user.jpg" alt="">
              </div>
              <div>
                <div class="sms">
                  <p>Здравствуйте! Я могу Вам чем-то помочь? Если помощь не нужна, то закройте окно чата. Всегда буду рад ответить Вам.</p>
                  <span class="time_sms">12:15</span>
                </div>
                <div class="sms down_file">
                  <a href="#"><img src="/images/file-download.svg" alt=""></a>
                  <p>Здравствуйте! Я могу Вам чем-то помочь?</p>
                  <span class="size_file">347,34 Кб PNG</span>
                  <span class="time_sms">12:15</span>
                </div>
              </div>
            </div>
             <div class="user1 user_chats">
              <div class="avatar">
                <img src="/images/user.jpg" alt="">
              </div>
              <div>
                <div class="sms">
                  <p>Здравствуйте! Я могу Вам чем-то помочь? Если помощь не нужна, то закройте окно чата. Всегда буду рад ответить Вам.</p>
                  <span class="time_sms">12:15</span>
                </div>
                <div class="sms down_file">
                  <a href="#"><img src="/images/file-download.svg" alt=""></a>
                  <p>Здравствуйте! Я могу Вам чем-то помочь?</p>
                  <span class="size_file">347,34 Кб PNG</span>
                  <span class="time_sms">12:15</span>
                </div>
              </div>
            </div> <div class="user1 user_chats">
              <div class="avatar">
                <img src="/images/user.jpg" alt="">
              </div>
              <div>
                <div class="sms">
                  <p>Здравствуйте! Я могу Вам чем-то помочь? Если помощь не нужна, то закройте окно чата. Всегда буду рад ответить Вам.</p>
                  <span class="time_sms">12:15</span>
                </div>
                <div class="sms down_file">
                  <a href="#"><img src="/images/file-download.svg" alt=""></a>
                  <p>Здравствуйте! Я могу Вам чем-то помочь?</p>
                  <span class="size_file">347,34 Кб PNG</span>
                  <span class="time_sms">12:15</span>
                </div>
              </div>
            </div>
             <div class="user1 user_chats">
              <div class="avatar">
                <img src="/images/user.jpg" alt="">
              </div>
              <div>
                <div class="sms">
                  <p>Здравствуйте! Я могу Вам чем-то помочь? Если помощь не нужна, то закройте окно чата. Всегда буду рад ответить Вам.</p>
                  <span class="time_sms">12:15</span>
                </div>
                <div class="sms down_file">
                  <a href="#"><img src="/images/file-download.svg" alt=""></a>
                  <p>Здравствуйте! Я могу Вам чем-то помочь?</p>
                  <span class="size_file">347,34 Кб PNG</span>
                  <span class="time_sms">12:15</span>
                </div>
              </div>
            </div>
             <div class="user1 user_chats">
              <div class="avatar">
                <img src="/images/user.jpg" alt="">
              </div>
              <div>
                <div class="sms">
                  <p>Здравствуйте! Я могу Вам чем-то помочь? Если помощь не нужна, то закройте окно чата. Всегда буду рад ответить Вам.</p>
                  <span class="time_sms">12:15</span>
                </div>
                <div class="sms down_file">
                  <a href="#"><img src="/images/file-download.svg" alt=""></a>
                  <p>Здравствуйте! Я могу Вам чем-то помочь?</p>
                  <span class="size_file">347,34 Кб PNG</span>
                  <span class="time_sms">12:15</span>
                </div>
              </div>
            </div>
             <div class="user1 user_chats">
              <div class="avatar">
                <img src="/images/user.jpg" alt="">
              </div>
              <div>
                <div class="sms">
                  <p>Здравствуйте! Я могу Вам чем-то помочь? Если помощь не нужна, то закройте окно чата. Всегда буду рад ответить Вам.</p>
                  <span class="time_sms">12:15</span>
                </div>
                <div class="sms down_file">
                  <a href="#"><img src="/images/file-download.svg" alt=""></a>
                  <p>Здравствуйте! Я могу Вам чем-то помочь?</p>
                  <span class="size_file">347,34 Кб PNG</span>
                  <span class="time_sms">12:15</span>
                </div>
              </div>
            </div>
            <div class="user2 user_chats">
              <div class="sms">
                <p>Здравствуйте! Я могу Вам чем-то помочь? Если помощь не нужна, то закройте окно чата. Всегда буду рад ответить Вам.</p>
                <span class="time_sms">12:15</span>
              </div>
              <div class="avatar">
                <img src="/images/user.jpg" alt="">
              </div>
            </div>
            <div class="user1 user_chats">
              <div class="avatar">
                <img src="/images/user.jpg" alt="">
              </div>
              <div>
                <div class="sms">
                  <img src="/images/girll.jpg" alt="">
                  <span class="time_sms">12:15</span>
                </div>
              </div>
            </div>
            <div class="btm_chat">
              <div class="input_styles">
                <input type="text" placeholder="Написать">
                <input type="file" class="file_input" id="filesw">
                <label for="filesw"><img src="/images/file_chat.svg" alt=""></label>
              </div>
              <button type="submit" class="btn_red"><img src="/images/arrow_chat.svg" alt=""></button>
            </div>
          </div>
        </div> -->
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
        <div class="suggestion">
          <p><?=Yii::t('app','Offer')?></p>
          <span><?=$model->offer_your_price?></span>
        </div>
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
            
            <?php if ($model->need_relocation == 1): ?>
                <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Relocation')?>: <?=$model->count_relocation?></span>
                </div>
            <?php endif ?>

            <?php if ($model->need_furniture == 1): ?>
                <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Furniture and household appliances')?>: <?=$model->count_furniture?></span>
                </div>
            <?php endif ?>

            <?php if ($model->need_personal_items == 1): ?>
                <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Personal items')?>: <?=$model->count_personal_items?></span>
                </div>
            <?php endif ?>

            <?php if ($model->need_purchases == 1): ?>
                <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Purchases')?>: <?=$model->count_purchases?></span>
                </div>
            <?php endif ?>

            <?php if ($model->need_piano == 1): ?>
                <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Piano and safes')?>: <?=$model->count_piano?></span>
                </div>
            <?php endif ?>

            <?php if ($model->need_building_materials == 1): ?>
                <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Building materials')?>: <?=$model->count_building_materials?></span>
                </div>
            <?php endif ?>

            <?php if ($model->need_special_equipments == 1): ?>
                <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Special equipment and oversized')?>: <?=$model->count_special_equipments?></span>
                </div>
            <?php endif ?>

            <?php if ($model->need_other_items == 1): ?>
                <div>
                <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Other goods')?>: <?=$model->count_other_items?></span>
                </div>
            <?php endif ?>

          </div>
        </div>
        <div class="terra">
          <p><img src="/images/otp.svg" alt=""><?=Yii::t('app','Point of departure')?></p>
          <div class="row">
            <div class="col-md-3">
                <span><?=$model->getTypeOfTheHouse($model->shipping_house_type)?></span>
            </div>
            <div class="col-md-3">
                <span><?=Yii::t('app','Floor')?>: <?=$model->shipping_house_floor?></span>
            </div>
            <div class="col-md-3">
                <span><?=Yii::t('app','Lift')?>: <?=$model->getYesNo($model->shipping_house_lift)?></span>
            </div>
          </div>
          <hr>
          <p><img src="/images/otp2.svg" alt=""><?=Yii::t('app','Destination')?></p>
          <div class="row">
             <div class="col-md-3">
                <span><?=$model->getTypeOfTheHouse($model->delivery_house_type)?></span>
            </div>
            <div class="col-md-3">
                <span><?=Yii::t('app','Floor')?>: <?=$model->delivery_house_floor?></span>
            </div>
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
                <a href="/uploads/task/<?=$value?>" class="netr" data-fancybox="galery"><img src="/uploads/tasks/<?=$value?>" alt=""></a>
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
                <div style="word-break: break-all;">
                  <img src="/images/otp.svg" alt="" class="nt-1">
                  <strong><?=$model->shipping_address?></strong>
                </div>
                <img src="/images/mang.svg" alt="" class="nt-2">
                <div style="word-break: break-all;">
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
          <a href="/site/cancellation-policy" target="_blank" class="forget_pass"><?=Yii::t('app','Cancellation Policy')?></a>
        </div>
        <?php if ($active_user->type == 3): ?>
          <div class="text_right_ent">
            <?=\yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Order service'), ['create-request','id'=>$model->id],
              ['role'=>'modal-remote', 'class'=>'enter_to_site'])?>
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
  $(document).ready(function(){
    $('#chat').on('click',function(){
        $('.chat_inner').toggle(500);
      })
    });
JS
);
?>