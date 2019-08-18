<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */


$this->title = Yii::t('app','Personal Cabinet');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="cabinet">
  <div class="container">
     <nav aria-label="breadcrumb" class="breadcrumb_nav">
          <ol class="breadcrumb"> 
            <li class="breadcrumb-item"><a href="/site/index">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Личный кабинет</li>
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
          </div>
          <div id="ff1" class="tab-pane in"> 
            <a href="#" class="item_to_city">
              <div class="item_to_city_top">
                <div class="sur_">
                  <img src="images/surface_bl.svg" alt="">
                  <div>
                    <h5>Доставить груз в Москву</h5>
                    <p>Грузовые перевозки</p>
                  </div>
                </div>
                <div class="price_cop">
                  <h6>2 347 457 руб.</h6>
                  <p class="cal_tack">Предложения</p>
                </div>
              </div>
              <span class="line_toc"></span>
              <div class="item_to_city_bottom">
                <div class="row">
                  <div class="col-4">
                    <p class="cal_tack">Cоздан</p>
                    <span>04-07-2019</span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата отправки</p>
                    <span>04-07-2019</span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата прибытия</p>
                    <span>04-07-2019</span>
                  </div>
                </div>
                <div class="mangis">
                  <p class="cal_tack">Маршрут</p>
                  <div class="d-flex align-items-center">
                    <img src="images/otp.svg" alt="" class="nt-1">
                    <span>Казахстан, Нур-Султан (Астана)</span>
                    <img src="images/mang.svg" alt="" class="nt-2">
                    <img src="images/otp2.svg" alt="" class="nt-3">
                    <span>Казахстан, Мангистауская область, Актау</span>
                  </div>
                </div>
              </div>
              <button><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg></span></button>
            </a>
            <a href="#" class="item_to_city">
              <div class="item_to_city_top">
                <div class="sur_">
                  <img src="images/surface_bl.svg" alt="">
                  <div>
                    <h5>Доставить груз в Москву</h5>
                    <p>Грузовые перевозки</p>
                  </div>
                </div>
                <div class="price_cop">
                  <h6>2 347 457 руб.</h6>
                  <p class="cal_tack">Предложения</p>
                </div>
              </div>
              <span class="line_toc"></span>
              <div class="item_to_city_bottom">
                <div class="row">
                  <div class="col-4">
                    <p class="cal_tack">Cоздан</p>
                    <span>04-07-2019</span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата отправки</p>
                    <span>04-07-2019</span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата прибытия</p>
                    <span>04-07-2019</span>
                  </div>
                </div>
                <div class="mangis">
                  <p class="cal_tack">Маршрут</p>
                  <div class="d-flex align-items-center">
                    <img src="images/otp.svg" alt="" class="nt-1">
                    <span>Казахстан, Нур-Султан (Астана)</span>
                    <img src="images/mang.svg" alt="" class="nt-2">
                    <img src="images/otp2.svg" alt="" class="nt-3">
                    <span>Казахстан, Мангистауская область, Актау</span>
                  </div>
                </div>
              </div>
              <button><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg></span></button>
            </a>
            <a href="#" class="item_to_city">
              <div class="item_to_city_top">
                <div class="sur_">
                  <img src="images/surface_bl.svg" alt="">
                  <div>
                    <h5>Доставить груз в Москву</h5>
                    <p>Грузовые перевозки</p>
                  </div>
                </div>
                <div class="price_cop">
                  <h6>2 347 457 руб.</h6>
                  <p class="cal_tack">Предложения</p>
                </div>
              </div>
              <span class="line_toc"></span>
              <div class="item_to_city_bottom">
                <div class="row">
                  <div class="col-4">
                    <p class="cal_tack">Cоздан</p>
                    <span>04-07-2019</span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата отправки</p>
                    <span>04-07-2019</span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата прибытия</p>
                    <span>04-07-2019</span>
                  </div>
                </div>
                <div class="mangis">
                  <p class="cal_tack">Маршрут</p>
                  <div class="d-flex align-items-center">
                    <img src="images/otp.svg" alt="" class="nt-1">
                    <span>Казахстан, Нур-Султан (Астана)</span>
                    <img src="images/mang.svg" alt="" class="nt-2">
                    <img src="images/otp2.svg" alt="" class="nt-3">
                    <span>Казахстан, Мангистауская область, Актау</span>
                  </div>
                </div>
              </div>
              <button><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg></span></button>
            </a>
            <a href="#" class="item_to_city">
              <div class="item_to_city_top">
                <div class="sur_">
                  <img src="images/surface_bl.svg" alt="">
                  <div>
                    <h5>Доставить груз в Москву</h5>
                    <p>Грузовые перевозки</p>
                  </div>
                </div>
                <div class="price_cop">
                  <h6>2 347 457 руб.</h6>
                  <p class="cal_tack">Предложения</p>
                </div>
              </div>
              <span class="line_toc"></span>
              <div class="item_to_city_bottom">
                <div class="row">
                  <div class="col-4">
                    <p class="cal_tack">Cоздан</p>
                    <span>04-07-2019</span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата отправки</p>
                    <span>04-07-2019</span>
                  </div>
                  <div class="col-4">
                    <p class="cal_tack">Дата прибытия</p>
                    <span>04-07-2019</span>
                  </div>
                </div>
                <div class="mangis">
                  <p class="cal_tack">Маршрут</p>
                  <div class="d-flex align-items-center">
                    <img src="images/otp.svg" alt="" class="nt-1">
                    <span>Казахстан, Нур-Султан (Астана)</span>
                    <img src="images/mang.svg" alt="" class="nt-2">
                    <img src="images/otp2.svg" alt="" class="nt-3">
                    <span>Казахстан, Мангистауская область, Актау</span>
                  </div>
                </div>
              </div>
              <button><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg></span></button>
            </a>
             
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
            <img src="/images/dorian-hurst-672657-unsplash.jpg" alt="">
            <input type="file" id="inp_file">
            <label for="inp_file"><img src="/images/camera_photo.svg" alt="">Изменить фото</label>
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
            <a href="/profile/edit-profile?id=<?=$user->id?>" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Edit Account')?></a>
          </div>
        </div>
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
            <span>Языки</span>
            <div>
              <img src="/images/russ.svg" alt="">
              <img src="/images/german.svg" alt="">
              <img src="/images/usa.svg" alt="">
            </div>
          </div>
          <p class="povis">Повысьте доверие пользователей к себе –  привяжите ваши аккаунты социальных сетей к профилю iTake. Мы обязуемся не раскрывать ваши контакты.</p>
        </div>
        <div class="banner_bl"></div>
      </div>
    </div>
   
  </div>
</section>