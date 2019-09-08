<section class="cabinet news">
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
       <ol class="breadcrumb"> 
            <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
            <li class="breadcrumb-item"><a href="/site/news"><?=Yii::t('app','Blog')?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','News')?></li>
        </ol>
    </nav>
    <div class="flex_cabinet">
      <div class="cabinet_left">
          <h1><?=$new->title?> </h1>
          <span class="news_date"><?=$new->date_cr?></span>
          <img src="/admin/uploads/news/<?= $new->fone?>" alt="" class="new_img">
          <p>
            <?=$new->title?>
          </p>
      </div>
      <div class="cabinet_right">
        <div class="gree_moder">
          <img src="/images/shield.svg" alt=""><span><?=Yii::t('app','Passed verification')."<br>".Yii::t('app','Moderator')?></span>
        </div>
        <div class="banner_bl"></div>
      </div>
    </div>
   
  </div>
</section>