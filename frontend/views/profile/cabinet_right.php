<?php
  $langs = \backend\models\Lang::getLanguages();
?>
<div class="gree_moder">
  <img src="/images/shield.svg" alt=""><span><?=Yii::t('app','Passed verification')."<br>".Yii::t('app','Moderator')?></span>
</div>
<div class="confirm_cont">
  <h3><?=Yii::t('app','Verified Contacts')?></h3>
  <div class="tel_conf">
    <div>
      <img src="/images/c1.jpg" alt="">
      <div>
        <p><?=Yii::t('app','Phone')?></p>
        <a href="#"><?=explode(',',$company->phone)[0]?></a>
      </div>
    </div>
  </div>
  <div class="tel_conf">
    <div>
      <img src="/images/c2.jpg" alt="">
      <div>
        <p>E-mail</p>
        <a href="#"><?=$company->email?></a>
      </div>
    </div>
  </div>
  <div class="lang_conf">
    <span><?=Yii::t('app','Languages')?></span>
    <div>
      <?php foreach ($langs as $key => $value): ?>
        <img src="<?=$value->image?>" alt="" style="width:17%;">
      <?php endforeach ?>
    </div>
  </div>
  <p class="povis"><?=Yii::t('app','Increase user confidence in yourself - link your social network accounts to your iTake profile. We will not disclose your contact information.')?></p>
</div>
<div class="banner_bl"></div>
