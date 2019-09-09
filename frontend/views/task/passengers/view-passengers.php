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
        <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Passenger Transportation')?></li>
      </ol>
    </nav>
    <div class="d-flex inner_main">
      <div class="inner_left">
        <!-- <h2>Мои чаты</h2>             -->
          <?= $this->render('../request/inner_left',['user'=>$user,'banner'=>$banner]);?>
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
            <div class="suggestion">
              <p><?=Yii::t('app','Offer')?></p>
              <span><?=$model->offer_your_price?></span>
            </div>
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
            
            <div class="col-12 mt-md-2"><span><img src="/images/front-car.svg" alt=""><?=Yii::t('app','Category of transport')?>: <?=$model->category->name?></span></div>
          </div>
        </div>
        <div class="inner_map">
          <div class="row">
            <div class="col-sm-6">
              <div id="map"></div>
            </div>
            <div class="col-sm-6 v_koord">
              <div class="v_trans">
                <div>
                  <img src="/images/otp.svg" alt="" class="nt-1">
                  <span><?=$model->shipping_address?></span>
                </div>
                <img src="/images/mang.svg" alt="" class="nt-2">
                <div>
                  <img src="/images/otp2.svg" alt="" class="nt-3">
                  <span><?=$model->delivery_address?></span>
                </div>
              </div>
              <div>
                <p><?=Yii::t('app','Distance')?>:   <b>3406 км</b></p>
                <p><?=Yii::t('app','Travel time')?>:  <b>43 ч 03 мин</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="pay_inner">
          <p><?=Yii::t('app','Paid')?>: <b>30%</b><!-- <span>2 347 457 руб.</span> --></p>
          <a href="/site/cancellation-policy" target="_blank" class="forget_pass"><?=Yii::t('app','Cancellation Policy')?></a>
        </div>
        <?php if ($user->type == 3): ?>
          <div class="text_right_ent">
            <?=\yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Order service'), ['create-request','id'=>$model->id],
              ['role'=>'modal-remote', 'class'=>'enter_to_site'])?>
          </div>
        <?php endif ?>
        <div class="zayavka">
          <h2>Заявка</h2>
          <?= $this->render('../request/index',['user'=>$user,'requests'=>$requests])?>


        </div>
      </div>
    </div>
  </div>
</section>

<?php
$this->registerJs(<<<JS
  $(document).ready(function(){
    $('#passengers').click(function(){
        $('#count_passengers').toggle(300);
      })
  });
JS
);
?>

