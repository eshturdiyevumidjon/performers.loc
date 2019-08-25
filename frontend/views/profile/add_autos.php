<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
$lang = Yii::$app->language;
?>
<section class="cabinet">
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
        <li class="breadcrumb-item"><a href="/profile/index"><?=Yii::t('app','Personal Cabinet')?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Adding cars')?></li>
      </ol>
    </nav>
    <h1><?=Yii::t('app','Adding cars')?></h1>
    <div class="flex_cabinet">
      <div class="cabinet_left">
        <ul class="nav tab_styles_nav">
          <li><a data-toggle="tab" href="#ff0"><?=Yii::t('app','Adding cars')?></a></li>
          <li><a data-toggle="tab" class="active show" href="#ff1"><?=Yii::t('app','Adding Drivers')?></a></li>
        </ul>
        
        <div class="tab-content">
          <div id="ff0" class="tab-pane fade">

            <div class="text-right">
               <?=Html::a(Yii::t('app','Add car'), ['create-auto'],['role'=>'modal-remote','title'=> Yii::t('app','Add car'), 'class'=>'btn_red drug sobs1'])?>
            </div>
            <h2 class="title_add"><?=Yii::t('app','Transports')?></h2>
            <?php Pjax::begin(['enablePushState' => false,'id' => 'crud-datatable-pjax'])?>
              <?php foreach ($autos as $key => $value): ?>
                <div class="dor_item">
                <div class="d-flex align-items-center justify-content-between lman">
                  <h4><img src="/images/car.svg" alt="">Модель и марка автомобиля: <?=$value->model." ".$value->mark?></h4>

                  <div class="lin">
                    <?=Html::a(Yii::t('app','Update'), ['/profile/update-auto?id='.$value->id],[ 'class'=>'lin1','role'=>'modal-remote','title'=>Yii::t('app','Update')])?>
                    <?=Html::a(Yii::t('app','Delete'), ['/profile/delete-transport?id='.$value->id],[ 'class'=>'lin2','role'=>'modal-remote',
                      'title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false, 
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')])?>
                  </div>
                </div>
                <div class="mke"><span>Регистрационный номер::</span><b><?=$value->registration_number?></b></div>
                <div class="photos_inn">
                  <p>Фото</p>
                  <div class="d-flex flex-wrap">
                    <?php $imgs = explode(',',$value->images);
                     foreach ($imgs as $key => $value): ?>
                      <a href="/uploads/transports/<?=$value?>" class="netr" data-fancybox="galery"><img src="/uploads/transports/<?=$value?>" alt=""></a>
                    <?php endforeach ?>
                  </div>
                </div>
              </div>
              <?php endforeach ?>
            <?php Pjax::end()?>

          </div>

          <div id="ff1" class="tab-pane in active"> 

              <div class="text-right">
                <a href="#" id="add_driver" class="btn_red drug sobs1"><?=Yii::t('app','Add driver')?></a>
              </div>
              <h2 class="title_add"><?=Yii::t('app','Drivers')?></h2>
                  <div class="dor_item">
                    <div class="d-flex align-items-center justify-content-between lman">
                      <h4>Ватанабэ Масахару</h4>
                      <div class="lin">
                        <a href="#" class="lin1">изменить</a>
                        <!-- / -->
                        <a href="#" class="lin2">удалить</a>
                      </div>
                    </div>
                    <div class="mke"><span>Телефон:</span><b>+998 94 363 36 36</b></div>
                    <div class="photos_inn">
                      <p>Фото</p>
                      <div class="d-flex flex-wrap">
                        <a href="/images/unsp.jpg" class="netr" data-fancybox="galery"><img src="/images/unsp.jpg" alt=""></a>
                        <a href="/images/unsp.jpg" class="netr" data-fancybox="galery"><img src="/images/unsp.jpg" alt=""></a>
                        <a href="/images/unsp.jpg" class="netr" data-fancybox="galery"><img src="/images/unsp.jpg" alt=""></a>
                        <a href="/images/unsp.jpg" class="netr" data-fancybox="galery"><img src="/images/unsp.jpg" alt=""></a>
                        <a href="/images/unsp.jpg" class="netr" data-fancybox="galery"><img src="/images/unsp.jpg" alt=""></a>
                      </div>
                    </div>
                  </div>

          </div>
          
        </div>
      </div>
      <div class="cabinet_right">
        <?=$this->render('cabinet_right',['company'=>$company]);?>
      </div>
    </div>
  </div>
</section>
