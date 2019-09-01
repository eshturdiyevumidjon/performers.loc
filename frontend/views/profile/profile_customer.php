<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \backend\models\Tasks; 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$lang = Yii::$app->language;

$this->title = Yii::t('app','Personal Cabinet');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="cabinet">
  <div class="container">
     <nav aria-label="breadcrumb" class="breadcrumb_nav">
          <ol class="breadcrumb"> 
            <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
            <li class="breadcrumb-item active"><?=Yii::t('app','Personal Cabinet')?></li>
          </ol>
     </nav>
    <h1><?=$title?></h1>
    <div class="flex_cabinet">
      <div class="cabinet_left">
        <ul class="nav tab_styles_nav">
          <li><a data-toggle="tab" href="#ff0" class="active show"><?=Yii::t('app','Create Task')?></a></li>
          <li><a data-toggle="tab" class="" href="#ff1"><?=Yii::t('app','My Orders')?></a></li>
          <li><a data-toggle="tab" href="#ff2" class=""><?=Yii::t('app','Past Orders')?></a></li>
        </ul>
        <div class="tab-content input_styles cab_st">
          <div id="ff0" class="tab-pane fade active show">
            <p class="create_equ"><?=Yii::t('app','Create Task')?></p>
          <div class="row hdr_svgs">
            <div class="col-md-3">
                <?=Html::a('<span class="aft_back"></span>'.Tasks::getTypeIconSvg(1).'
                <span>'.Yii::t('app','Passenger Transportation').'</span>', ['task/create-passengers'],['data-pjax'=>0,'title'=> Yii::t('app','Add'), 'class'=>'enter_to_site'])?>
            </div>
            <div class="col-md-3">
              <?=Html::a('<span class="aft_back"></span>'.Tasks::getTypeIconSvg(3).'
                <span>'.Yii::t('app','Freight transportation').'</span>', ['task/create-goods'],['data-pjax'=>0,'title'=> Yii::t('app','Add'), 'class'=>'enter_to_site'])?>
            </div>
            <div class="col-md-3">
              <?=Html::a('<span class="aft_back"></span>'.Tasks::getTypeIconSvg(2).'
                <span>'.Yii::t('app','Transportation of cars and equipment').'</span>', ['task/create-vehicles'],['data-pjax'=>0,'title'=> Yii::t('app','Add'), 'class'=>'enter_to_site'])?>
            </div>
            <div class="col-md-3">
               <?=Html::a('<span class="aft_back"></span>'.Tasks::getTypeIconSvg(4).'
                <span>'.Yii::t('app','Relocation assistance').'</span>', ['task/create-help'],['data-pjax'=>0,'title'=> Yii::t('app','Add'), 'class'=>'enter_to_site'])?>
            </div>
          </div>
          </div>
          <div id="ff1" class="tab-pane in"> 
            <?php foreach ($my_tasks as $key => $value): ?>
              <a href="/<?=$lang?>/task/view?id=<?=$value->id?>" class="item_to_city">
              <div class="item_to_city_top">
                <div class="sur_">
                  <img src="<?=$value->getTypeIconBlack()?>" alt="">
                  <div>
                    <h5>Доставить груз в Москву</h5>
                    <p>Грузовые перевозки</p>
                  </div>
                </div>
                <div class="price_cop">
                  <h6><?=$value->offer_your_price?></h6>
                  <p class="cal_tack">Предложения</p>
                </div>
              </div>
              <span class="line_toc"></span>
              <div class="item_to_city_bottom">
                <div class="row">
                  <div class="col-4">
                    <p class="cal_tack">Cоздан</p>
                    <span><?=$value->date_cr?></span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата отправки</p>
                    <span><?=$value->date_begin?></span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата прибытия</p>
                    <span><?=$value->date_close?></span>
                  </div>
                </div>
                <div class="mangis">
                  <p class="cal_tack">Маршрут</p>
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
            

            <ul class="pagination">
              <li class="page-item"><a class="" href="#">1</a></li>
              <li class="page-item"><a class="" href="#">2</a></li>
              <li class="page-item"><a class="" href="#">3</a></li>
              <li class="page-item"><a class="" href="#">...</a></li>
              <li class="page-item"><a class="" href="#">346</a></li>
              <li class="page-item prev toogle_pag">
                <a class="btn_red" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg>
                </a>
              </li>
              <li class="page-item next toogle_pag">
                <a class="btn_red" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg>
                </a>
              </li>
            </ul>

          </div>
          <div id="ff2" class="tab-pane fade"> 
          </div>
        </div>
      </div>
      <div class="cabinet_right">
        <div class="user_all">
          <div class="user_dorian">
              <img src="/uploads/users/nouser3.png" alt="" id="image_upload_preview">
              <input type="file" name="user_image" id="inputFile">
              <label for="inputFile"><img src="/images/camera_photo.svg" alt=""><?=Yii::t('app','Change photo')?></label>
          </div>
          <p><?= $user->username ?></p>
          <div class="rating">
            <a href="#" class="rating_img">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
            </a>
            <span>4,5</span>
          </div>
          <div class="btn_dor">
             <a href="/<?=$lang?>/profile/edit-profile" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Edit Account')?></a>
          </div>
        </div>
        <?=$this->render('cabinet_right',['company'=>$company]);?>
      </div>
    </div>
   
  </div>
</section>
<?php
$this->registerJs(<<<JS
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
        var data = $('#change_image').serialize();
        $.post('/ru/profile/change-photo',data,function(success){alert(success)});
    });

JS
);
?>