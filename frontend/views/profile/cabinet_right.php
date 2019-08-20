<?php
  $langs = \backend\models\Lang::getLanguages();
?>
<div class="gree_moder">
  <img src="/images/shield.svg" alt=""><span>Прошел проверку <br>Модератора</span>
</div>
<div class="confirm_cont">
  <h3>Подтвержденные контакты</h3>
  <div class="tel_conf">
    <div>
      <img src="/images/c1.jpg" alt="">
      <div>
        <p>Телефон</p>
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
    <span>Языки</span>
    <div>
      <?php foreach ($langs as $key => $value): ?>
        <img src="<?=$value->image?>" alt="" style="width:14%;">
      <?php endforeach ?>
    </div>
  </div>
  <p class="povis">Повысьте доверие пользователей к себе –  привяжите ваши аккаунты социальных сетей к профилю iTake. Мы обязуемся не раскрывать ваши контакты.</p>
</div>
<div class="banner_bl"></div>
