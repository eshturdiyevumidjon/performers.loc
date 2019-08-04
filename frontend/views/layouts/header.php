<?php
use yii\helpers\Url;
  $language=Yii::$app->language;
  $langs=\backend\models\Lang::getLanguages();
  $pathInfo=Yii::$app->request->pathInfo;
?>
<header <?php if(Yii::$app->request->pathInfo=='site/index') echo 'class="fixed_header"'?>  style="background-color: initial;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center hdr_top">
      <div class="d-flex align-items-center">
        <a href="/site/index" class="logo"><img src="/images/logo.svg" alt=""></a>
        <div class="d-flex align-items-center notif">
          <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <a href="#" class="notification red_notifi"><img src="/images/notification.svg" alt=""></a>
        </div>
      </div>
      <div class="d-flex align-items-center">
        <div class="dropdown language_h">
          <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" >
            <?=ucfirst($language)?>
          </button>
          <div class="dropdown-menu flex-column" aria-labelledby="dropdownMenuButton">
            <?php foreach($langs as $lang):?>
            <a <?=( $language == $lang->url ) ? 'class="active"':''?> href="<?= Url::to([$pathInfo, 'language' => $lang->url]) ?>">
              <?=ucfirst($lang->url)?>
              </a>
          <?php endforeach;?>
          </div>
        </div>
        <a href="/site/signup" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Login / Register')?></a>
      </div>
    </div>
    </div>
    <div class="hdr_bottom" style="display: none;">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <ul class="nav">
          <li><a href="/site/index" class="active"><?=Yii::t('app','Home')?></a></li>
          <li><a href="#"><?=Yii::t('app','FAQ')?></a></li>
          <li><a href="#"><?=Yii::t('app','Service')?></a></li>
          <li><a href="/site/contact"><?=Yii::t('app','Contact')?></a></li>
          <li><a href="#"><?=Yii::t('app','Blog')?></a></li>
        </ul>
        <a href="#" class="btn_red"><span><?=yii::t('app','Invoice:')?></span> <span class="price">2 347 457 руб.</span></a>
      </div>
    </div>
    </div>
</header>