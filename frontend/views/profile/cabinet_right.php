<?php
  $langs = \backend\models\Lang::getLanguages();
?>

  <?php if ($user->status == 0): ?>
    <div class="gree_moder">
      <img src="/images/shield.svg" alt=""><span><?=Yii::t('app','Passed verification')."<br>".Yii::t('app','Moderator')?></span>
    </div>
  <?php else: ?>
    <div class="red_moder" style="text-align: center;">
      <img  alt=""><span><?=Yii::t('app','Doesn\'t passed verification')."<br>".Yii::t('app','Moderator')?></span>
    </div>
  <?php endif ?>
  
<div class="confirm_cont">
  <h3><?=Yii::t('app','Verified Contacts')?></h3>
  <div class="tel_conf">
    <div>
      <img src="/images/c1.jpg" alt="">
      <div>
        <p><?=Yii::t('app','Phone')?></p>
        <a href="#">+998 90 937 86 04</a>
      </div>
    </div>
  </div>
  <div class="tel_conf">
    <div>
      <img src="/images/c2.jpg" alt="">
      <div>
        <p>E-mail</p>
        <a href="#">hey@deepx.uz</a>
      </div>
    </div>
  </div>
  <div class="lang_conf">
    <span><?=Yii::t('app','Languages')?></span>
    <div>
      <?php foreach ($langs as $key => $value): ?>
        <img src="<?=$value->image?>" alt="" style="width:35%;">
      <?php endforeach ?>
    </div>
  </div>
  <p class="povis"><?=Yii::t('app','Increase user confidence in yourself - link your social network accounts to your iTake profile. We will not disclose your contact information.')?></p>
</div>
<?php if ($banner): ?>
    <img style="width: 100%;" src="/admin/uploads/banners/<?= $banner->image?>" alt="">
<?php endif ?>

