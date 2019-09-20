<?php if(count($requests)>0): ?>
<h2>Заявка</h2>
<?php endif;?>
<?php foreach ($requests as $key => $value): ?>
  <div class="item_to_city" style="margin-bottom: 3px;">
    <div class="item_to_city_top">
      <div class="user_inner">
        <?php if ($value['user']->image != null): ?>
          <img src="/admin/uploads/avatars/<?=$value['user']->image?>">
        <?php else: ?>
          <img src="/uploads/nouser3.png">
        <?php endif ?>
        <div>
          <p><?=$value['user']->username?></p>
          <!-- <div class="rating">
            <a href="#" class="rating_img">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
            </a>
            <span>3</span>
          </div> -->
        </div>
      </div>
      <div class="price_cop">
        <h6><?=$value->price?> $.</h6>
        <p class="cal_tack"><?=Yii::t('app','Offer')?></p>
      </div>
    </div>
    <span class="line_toc"></span>
    <p class="mode"><img src="/images/car.svg" alt=""><?=Yii::t('app','Model and brand of car')?>: <?=$value->mark->name_mark." ".$value->model->name_model?></p>
    <div class="photos_inn">
      <?php $model = $value->getAuto();
       if($model->images != ""):?>
      <p>Фото</p>
      <div class="d-flex flex-wrap">
        <?php
               
              $imgs = explode(',',$model->images);
               foreach ($imgs as $key => $value2): ?>
                <a href="/uploads/transports/<?=$value2?>" class="netr" data-fancybox="galery"><img src="/uploads/transports/<?=$value2?>" alt=""></a>
              <?php endforeach; ?>
      </div>
    <?php endif?>
    </div>
    <div class="item_to_city_bottom">
      <div class="row">
        <div class="col-sm-3">
          <p class="cal_tack"><?=Yii::t('app','Created')?></p>
          <span><?=$value->getCreatedDate()?></span>
        </div>
        <div class="col-sm-3">
          <p class="cal_tack"><?=Yii::t('app','Phone')?></p>
          <?php if ($active_user->type == 4): ?>
          <span><?=$value['user']->phone?></span>
          <?php else: ?>
          <span>*** ** *** ** **</span>
          <?php endif ?>
        </div>
        <div class="col-sm-3">
          <p class="cal_tack"><?=Yii::t('app','Languages')?></p>
          <div>
            <?php foreach (explode(',', $value['user']->language) as $value1): ?>
              <img src="/uploads/flags/<?=$value1?>.png" alt="" style="width:17%;">
            <?php endforeach ?>
          </div>
        </div>
      <?php if ($active_user->type == 4): ?>
        <div class="col-sm-3">
         <!--  <a href="#" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Order')?></a> -->
          <?=\yii\helpers\Html::a('<span class="aft_back"></span>'.Yii::t('app','Order'), ['/task/create-order','id'=>$value->id],
            ['role'=>'modal-remote', 'class'=>'enter_to_site','title'=>Yii::t('app','Order'), 
                                    /*'data-confirm'=>false, 'data-method'=>false, 
                                    'data-request-method'=>'post',
                                    'data-toggle'=>'tooltip',
                                    'data-confirm-title'=>Yii::t('app','Are you sure?'),
                                    'data-confirm-message'=>Yii::t('app','Are you sure want to order this performer?')*/])?>
        </div>
      <?php endif;?>
      </div>
    </div>
</div>
<?php endforeach ?>
