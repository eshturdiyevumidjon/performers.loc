<?php $company = \backend\models\AboutCompany::findOne(1);?>
<div class="container">
  <div class="row ftr_top">
    <div class="col-lg-2 col-sm-6 ft1">
      <a href="index.html" class="logo">
        <img src="/images/logo.svg" alt="">
      </a>
    </div>
    <div class="col-lg-3 col-sm-6 ft2">
      <ul class="nav flex-column">
          <li><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
          <li><a href="#"><?=Yii::t('app','FAQ')?></a></li>
          <li><a href="#"><?=Yii::t('app','Service')?></a></li>
          <li><a href="/site/contact"><?=Yii::t('app','Contact')?></a></li>
          <li><a href="#"><?=Yii::t('app','Blog')?></a></li>
      </ul>
    </div>
    <div class="col-lg-4 col-sm-6 ft3">
      <h4><?=Yii::t('app','Address')?> iTake</h4>
      <p class="adress"><img src="/images/address.svg" alt=""><?=$company->address?></p>
    </div>
    <div class="col-lg-3 col-sm-6 ft4">
      <h4>iTake <?=Yii::t('app','on the net')?></h4>
      <div class="row social_icons">
        <div class="col-6">
          <a href="#"><img src="/images/globus.svg" alt=""><span><?=$company->site?></span></a>
          <a href="#"><img src="/images/facebook.svg" alt=""><span><?=$company->facebook?></span></a>
        </div>
        <div class="col-6">
          <a href="#"><img src="/images/telegram.svg" alt=""><span><?=$company->telegram?></span></a>
          <a href="#"><img src="/images/instagram.svg" alt=""><span><?=$company->instagram?></span></a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ftr_bottom">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between last_ft">
      <div>
        <p><?=Yii::t('app','© 2011—2019 «iTake» LLC. By using the site, you agree to be bound by the terms')?><a href="#"><?=Yii::t('app','User agreement.')?></a></p>
      </div>
      <div>
        <p><?=Yii::t('app','Created by')?><a href="#">DeepX</a></p>
      </div>
    </div>
  </div>
</div>
