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
          <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Transportation of cars and equipment')?></li>
          </ol>
        </nav>
        <div class="d-flex inner_main">
          <div class="inner_left">
            <!-- <h2>Мои чаты</h2>             -->
          <?= $this->render('../request/inner_left',['user'=>$user,'banner'=>$banner]);?>
          </div>
         <div class="inner_right">
        <div class="wet">
          <h2><?=$model->getType()[2]?></h2>
          
        <!--   <div class="rating">
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
            <?=$model->getTypeIconSvg(2)?>
            <span><?=$model->getType()[2]?></span>
        </div>
            
            <div class="terra fourt">
              <p class="retect"><?=Yii::t('app','Additional options')?></p>
              <div class="row_retact">
                <div>
                    <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Model and brand of car')?>: <?=$model->getModel()." ".$model->getMark()?></span>
                </div>
                <?php if ($model->car_on_the_go == 1): ?>
                <div>
                    <span><img src="/images/check.svg" alt=""><?=Yii::t('app','Car On The Go')?></span>
                </div>
                <?php endif ?>
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
  