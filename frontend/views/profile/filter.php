<?php foreach ($all_tasks as $key => $value): ?>
    <a href="/<?=$lang?>/task/view?id=<?=$value->id?>" class="item_to_city">
    <div class="item_to_city_top">
      <div class="sur_">
        <img src="<?=$value->getTypeIconBlack()?>" alt="">
        <div>
          <h5>Доставить груз в Москву</h5>
          <p><?=$value->getType()[$value->type]?></p>
        </div>
      </div>
      <?php if ($value->offer_your_price): ?>
        <div class="price_cop">
          <h6><?=$value->offer_your_price?> $</h6>
          <p class="cal_tack"><?=Yii::t('app','Offer')?></p>
      </div>
      <?php endif ?>
      
    </div>
    <span class="line_toc"></span>
    <div class="item_to_city_bottom">
      <div class="row">
        <div class="col-4">
          <?php if ($value->date_cr): ?>
             <p class="cal_tack"><?=Yii::t('app','Created')?></p>
              <span><?=$value->date_cr?></span>
          <?php endif ?>
         
        </div>
        <div class="col-4">
          <?php if ($value->date_begin): ?>
              <p class="cal_tack"><?=Yii::t('app','Shipping date')?></p>
              <span><?=$value->date_begin?></span>
          <?php endif ?>
         
        </div>
        <div class="col-4">
          <?php if ($value->date_close): ?>
              <p class="cal_tack"><?=Yii::t('app',' Arrival date')?></p>
              <span><?=$value->date_close?></span>
          <?php endif ?>
        </div>
      </div>
      <div class="mangis">
        <p class="cal_tack"><?=Yii::t('app','Route')?></p>
        <div class="d-flex align-items-center">
          <img src="/images/otp.svg" alt="" class="nt-1">
          <span><?=$value->shipping_address?></span>
          <img src="/images/mang.svg" alt="" class="nt-2">
          <img src="/images/otp2.svg" alt="" class="nt-3">
          <span><?=$value->delivery_address?></span>
        </div>
      </div>
    </div>
    <button><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg></span></button>
  </a>
<?php endforeach ?>