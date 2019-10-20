<div class="confirm_cont">
  <div class="user_inner">
    <?php if ($user->image != null ): ?>
      <img src="/admin/uploads/avatars/<?=$user->image?>">
    <?php else: ?>
      <img src="/uploads/nouser3.png">
    <?php endif ?>
    <div>
      <p><?=$user->username?></p>
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
    </div>
  </div>
  <div class="lang_conf">
    <span><?=Yii::t('app','Languages')?></span>
    <div>
      <?php foreach (explode(',', $user->language) as $value): ?>
        <img src="/uploads/flags/<?=$value?>.png" alt="" style="width:22px ;">
      <?php endforeach ?>
    </div>
  </div>
  <?php if ($model->performer_id == $active_user->id): ?>
      <div class="tel_conf">
        <div>
          <img src="/images/c1.jpg" alt="">
          <div>
            <p><?=Yii::t('app','Phone')?></p>
            <a href="#"><?=$user->phone?></a>
          </div>
        </div>
      </div>
      <div class="tel_conf">
        <div>
          <img src="/images/c2.jpg" alt="">
          <div>
            <p>E-mail</p>
            <a href="#"><?=$user->email?></a>
          </div>
        </div>
      </div>
  <?php else: ?>
    <p class="povis"><?=Yii::t('app','Phone and Email are hidden, will be available to the performer')?></p>
  <?php endif ?>
  
</div>
<?php if ($banner->image): ?>
    <img style="width: 100%;" src="/admin/uploads/banners/<?= $banner->image?>" alt="">
<?php endif ?>
