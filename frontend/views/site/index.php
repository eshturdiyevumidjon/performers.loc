<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<section class="main_take" style="background-image: url(/images/glavniy_bg.jpg);">
      <div class="container">
        <h1><?=Yii::t('app','Urgent delivery of your goods')?></h1>
        <p><?=Yii::t('app','We connect with professional carriers near you!')?></p>
        <div class="row">
          <div class="col-lg-6">
            <a href="#" class="del_items">
              <div class="del_img">
                <img src="/images/bus.svg" alt="">
              </div>
              <p><?=Yii::t('app','Passenger Transportation')?></p>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="#" class="del_items">
              <div class="del_img">
                <img src="/images/surface.svg" alt="">
              </div>
              <p><?=Yii::t('app','Freight transportation')?></p>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="#" class="del_items">
              <div class="del_img">
                <img src="/images/surface3.svg" alt="">
              </div>
              <p><?=Yii::t('app','Transportation of cars and equipment')?></p>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="#" class="del_items">
              <div class="del_img">
                <img src="/images/surface4.svg" alt="">
              </div>
              <p><?=Yii::t('app','Relocation assistance')?></p>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="steps_red">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="steps_item">
              <div class="img"><img src="/images/step1.svg" alt=""></div>
              <div class="text">
                <h5><?=Yii::t('app','STEP 1')?></h5>
                <h4><?=Yii::t('app','Register or download the application')?></h4>
                <p><?=Yii::t('app','Calculate the cost of transportation and place your order using the pre-order form.')?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="steps_item">
              <div class="img"><img src="/images/step2.svg" alt=""></div>
              <div class="text">
                <h5><?=Yii::t('app','STEP 2')?></h5>
                <h4><?=Yii::t('app','Choose a performers and pay for the service')?></h4>
                <p><?=Yii::t('app','Calculate the cost of transportation and place your order using the pre-order form.')?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="steps_item">
              <div class="img"><img src="/images/step3.svg" alt=""></div>
              <div class="text">
                <h5><?=Yii::t('app','STEP 3')?></h5>
                <h4><?=Yii::t('app','First create a task, in the process of registration')?></h4>
                <p><?=Yii::t('app','Calculate the cost of transportation and place your order using the pre-order form.')?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="easier">
      <!-- <div class="container"> -->
        <h2 class="text-center"><?=Yii::t('app','Transporting cargo is much easier than you think.')?></h2>
      <!-- </div> -->
      <div class="easier_item" style="background-image: url(/images/gor1.jpg);">
        <div class="container">
          <h2><?=Yii::t('app','Download')?> <br><?=Yii::t('app','app')?></h2>
          <p><?=Yii::t('app','Find Our app in Play Market and')?> <br>AppStore</p>
          <div class="img_eas"><img src="/images/step1.svg" alt=""></div>
        </div>
      </div>
      <div class="easier_item odd_e" style="background-image: url(/images/gor2.jpg);">
        <div class="container">
          <h2><?=Yii::t('app','создай занание во')?> <br><?=Yii::t('app','registration')?></h2>
          <p><?=Yii::t('app','In one page Registr and Create')?> <br><?=Yii::t('app','task. Everything is simple, save time.')?></p>
          <div class="img_eas"><img src="/images/step2.svg" alt=""></div>
        </div>
      </div>
      <div class="easier_item" style="background-image: url(/images/gor3.jpg);">
        <div class="container">
          <h2><?=Yii::t('app','Select')."<br>".Yii::t('app','performer')."<br>".Yii::t('app','and pay for the service')?></h2>
          <p><?=Yii::t('app','Start negotiations with the contractor.')?></p>
          <div class="img_eas"><img src="/images/step3.svg" alt=""></div>
        </div>
      </div>
    </section>

    <section class="personal" style="background-image: url(/images/personal_bc.jpg);">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h2><?=Yii::t('app','Personal')."<br>".Yii::t('app','assistant in')."<br>".Yii::t('app','in your pocket')?></h2>
            <p><?Yii::t('app','Download our application and use')."<br>".Yii::t('app','itake, wherever you are.')?></p>
            <div class="d-flex align-items-center plays">
              <a href="#"><img src="/images/google_play.jpg" alt=""></a>
              <a href="#"><img src="/images/app_store.jpg" alt=""></a>
            </div>
            <div class="link_pers">
              <a href="<?=$company->site?>"><img src="/images/globus.svg" alt=""></a>
              <a href="<?=$company->telegram?>"><img src="/images/telegram.svg" alt=""></a>
              <a href="<?=$company->instagram?>"><img src="/images/instagram.svg" alt=""></a>
              <a href="<?=$company->facebook?>"><img src="/images/facebook.svg" alt=""></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="phone_logo">
              <img src="/images/dw.png" class="bc_phone" alt="">
              <img src="/images/logo_white.svg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
