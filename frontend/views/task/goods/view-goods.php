<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
?>
<div class="tasks-view3">
 <section class="inner">   
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb">   
        <li class="breadcrumb-item"><a href="#">Главная</a></li>
        <li class="breadcrumb-item"><a href="#">Личный кабинет</a></li>
        <li class="breadcrumb-item active" aria-current="page">Двери, Металл, Металлопрокат</li>
      </ol>
    </nav>
    <div class="d-flex inner_main">
      <div class="inner_left">
        <!-- <h2>Мои чаты</h2>             -->
        <div class="confirm_cont">
          <div class="user_inner">
            <img src="images/user.jpg" alt="">
            <div>
              <p>Ватанабэ Масахару</p>
              <div class="rating">
                <a href="#" class="rating_img">
                  <img src="images/star.svg" alt="">
                  <img src="images/star.svg" alt="">
                  <img src="images/star.svg" alt="">
                  <img src="images/star.svg" alt="">
                  <img src="images/star.svg" alt="">
                </a>
                <span>4,5</span>
              </div>
            </div>
          </div>
          <div class="lang_conf">
            <span>Языки</span>
            <div>
              <img src="images/russ.svg" alt="">
              <img src="images/german.svg" alt="">
              <img src="images/usa.svg" alt="">
            </div>
          </div>
          <p class="povis">Телефон и Email скрыты, будут доступны исполнителю</p>
        </div>
        <div class="banner_bl"></div>
      </div>
      <div class="inner_right">
        <div class="wet">
          <h2>Доставить груз в Москву</h2>
          <div class="rating">
            <a href="#" class="rating_img">
              <img src="images/star.svg" alt="">
              <img src="images/star.svg" alt="">
              <img src="images/star.svg" alt="">
              <img src="images/star.svg" alt="">
              <img src="images/star.svg" alt="">
            </a>
            <span>4,5</span>
          </div>
          <h5>Описание</h5>
          <p>Прошу перевезти мотоцикл Хонда из Владивостока в Москву</p>
        </div>
        <div class="bc_red_inn">
          <div class="row">
            <div class="col-lg-4">
              <p>Cоздан</p>
              <span>04-07-2019</span>
            </div>
            <div class="col-lg-4">
              <p>Дата отправки</p>
              <span>04-07-2019</span>
            </div>
            <div class="col-lg-4">
              <p>Дата прибытия</p>
              <span>04-07-2019</span>
            </div>
          </div>
        </div>
        <div class="suggestion">
          <p>Предложения</p>
          <span>2 347 457 руб.</span>
        </div>
        <div class="busy_easy">
          <svg xmlns="http://www.w3.org/2000/svg" width="86" height="40" viewBox="0 0 86 40"><g><g><g><path fill="" d="M2.857 2.857H57.15v24.286H2.857zm0 27.143h13.364c-.047.047-.092.104-.143.153a5.777 5.777 0 0 0-.686.786c-.057.08-.118.155-.173.238a5.708 5.708 0 0 0-.477.877c-.01.025-.016.052-.026.076a5.714 5.714 0 0 0-.247.727H4.878l-2.02-2.02zm14.288 4.286a2.857 2.857 0 1 1 5.715 0 2.857 2.857 0 0 1-5.715 0zM23.779 30h24.799v2.857H25.536a5.817 5.817 0 0 0-.247-.727c-.01-.024-.015-.051-.026-.075a5.711 5.711 0 0 0-.477-.877c-.054-.084-.116-.16-.173-.24a5.886 5.886 0 0 0-.686-.785c-.05-.049-.095-.106-.148-.153zm27.657 0h2.857v2.857h-2.857zm5.714 0h5.715v2.857H57.15zm8.573-15.714h2.858v7.143c0 .789.64 1.428 1.428 1.428h12.86v2.857H80.01v2.858h2.858v4.285h-4.462a5.39 5.39 0 0 0-.197-.572c-.035-.09-.057-.185-.096-.273a5.725 5.725 0 0 0-.487-.898c-.046-.064-.099-.117-.143-.178a5.48 5.48 0 0 0-.506-.613c-.084-.087-.176-.163-.264-.245a5.925 5.925 0 0 0-.512-.428 5.602 5.602 0 0 0-.899-.527 5.745 5.745 0 0 0-.355-.16 5.584 5.584 0 0 0-.676-.21c-.11-.028-.217-.065-.33-.086a5.34 5.34 0 0 0-2.143 0c-.113.021-.22.058-.33.086a5.617 5.617 0 0 0-.676.21c-.121.048-.238.104-.356.16a5.587 5.587 0 0 0-.571.31c-.112.074-.22.14-.327.217-.179.133-.35.276-.512.428-.088.082-.18.158-.264.245a5.41 5.41 0 0 0-.506.613c-.047.061-.1.114-.143.178a5.73 5.73 0 0 0-.487.898c-.038.088-.062.182-.096.273a5.512 5.512 0 0 0-.197.572h-1.61v-4.285zm4.286 20a2.857 2.857 0 1 1 5.715 0 2.857 2.857 0 0 1-5.715 0zM81.629 20h-4.476v-5.701c.44.028.841.258 1.089.622zm-7.334 0h-2.857v-5.714h2.857zM1.43 0C.64 0 0 .64 0 1.428v30c0 .379.15.742.419 1.01l2.857 2.857c.268.268.631.419 1.01.42H14.49a5.689 5.689 0 0 0 11.025 0h41.84a5.689 5.689 0 0 0 11.024 0h5.918c.79 0 1.429-.64 1.429-1.43v-12a4.267 4.267 0 0 0-.715-2.368l-4.386-6.58a4.286 4.286 0 0 0-3.572-1.909H64.294c-.789 0-1.429.64-1.429 1.429v14.286h-2.857V1.428C60.008.64 59.368 0 58.58 0z"></path></g><g><path fill="" d="M14.288 5.715H11.43v18.574h2.858z"></path></g><g><path fill="" d="M25.718 5.715H22.86v18.574h2.858z"></path></g><g><path fill="" d="M37.148 5.715H34.29v18.574h2.858z"></path></g><g><path fill="" d="M48.578 5.715H45.72v18.574h2.858z"></path></g></g></g></svg>
          <span>Грузовые перевозки</span>
        </div>
        <div class="terra">
          <p class="retect">Дополнительные параметры</p>
          <div class="row_retact">
            <div>
                <span><img src="images/check.svg" alt="">Требуется погрузка/разгрузка</span>
            </div>
            <div>
                <span><img src="images/check.svg" alt="">Этаж: 5</span>
            </div>
            <div>
                <span><img src="images/check.svg" alt="">Наличие лифта: Да</span>
            </div>
            <div>
                <span><img src="images/check.svg" alt="">Крупногабаритный</span>
            </div>
            <div>
                <span><img src="images/check.svg" alt="">Хрупкий</span>
            </div>
            <div>
                <span><img src="images/check.svg" alt="">Опасный</span>
            </div>
          </div>
        </div>
        <div class="terra">
          <p class="retect">Параметры груза</p>
          <div class="row_retact">
            <div>
                <span>Вес: 236кг</span>
            </div>
            <div>
                <span>Ширина: 3477см</span>
            </div>
            <div>
                <span>Длина: 346см</span>
            </div>
            <div>
                <span>Высота: 6799см</span>
            </div>
          </div>
        </div>
        <div class="photos_inn">
          <p>Фото</p>
          <div class="d-flex flex-wrap">
            <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
            <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
            <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
            <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
            <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
          </div>
        </div>
        <div class="inner_map">
          <div class="row">
            <div class="col-sm-6">
              <div id="map"></div>
            </div>
            <div class="col-sm-6 v_koord">
              <div class="v_trans">
                <div>
                  <img src="images/otp.svg" alt="" class="nt-1">
                  <span>Казахстан, Нур-Султан (Астана)</span>
                </div>
                <img src="images/mang.svg" alt="" class="nt-2">
                <div>
                  <img src="images/otp2.svg" alt="" class="nt-3">
                  <span>Казахстан, Мангистауская область, Актау</span>
                </div>
              </div>
              <div>
                <p>Расстояние:   <b>3406 км</b></p>
                <p>Время в пути:  <b>43 ч 03 мин</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="pay_inner">
          <p>Оплачен: <b>100%</b><span>2 347 457 руб.</span></p>
          <a href="#" class="forget_pass">Условия отмены брони</a>
        </div>
        <div class="text_right_ent">
          <a href="#" class="enter_to_site"><span class="aft_back"></span>Получить инвойс</a>
        </div>
        <div class="zayavka">
          <h2>Заявка</h2>
          <div class="item_to_city">
              <div class="item_to_city_top">
                <div class="user_inner">
                  <img src="images/dest.jpg" alt="">
                  <div>
                    <p>Ватанабэ Масахару</p>
                    <div class="rating">
                      <a href="#" class="rating_img">
                        <img src="images/star.svg" alt="">
                        <img src="images/star.svg" alt="">
                        <img src="images/star.svg" alt="">
                        <!-- <img src="images/star.svg" alt="">
                        <img src="images/star.svg" alt=""> -->
                      </a>
                      <span>3</span>
                    </div>
                  </div>
                </div>
                <div class="price_cop">
                  <h6>2 347 457 руб.</h6>
                  <p class="cal_tack">Предложения</p>
                </div>
              </div>
              <span class="line_toc"></span>
              <p class="mode"><img src="images/mosh1.svg" alt="">Модель и марка автомобиля: Мitsubishi Lancer Evolution X</p>
              <div class="photos_inn">
                <p>Фото</p>
                <div class="d-flex flex-wrap">
                  <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
                  <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
                  <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
                  <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
                  <a href="#" class="netr"><img src="images/unsp.jpg" alt=""></a>
                </div>
              </div>
              <div class="item_to_city_bottom">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="cal_tack">Cоздан</p>
                    <span>03.07.2019 20:13</span>
                  </div>
                  <div class="col-sm-3">
                    <p class="cal_tack">Телефон</p>
                    <span>+998 94 363 36 36</span>
                  </div>
                  <div class="col-sm-3">
                    <p class="cal_tack">Языки</p>
                    <div>
                      <img src="images/russ.svg" alt="">
                      <img src="images/german.svg" alt="">
                      <img src="images/usa.svg" alt="">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <a href="#" class="enter_to_site"><span class="aft_back"></span>Заказать</a>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    

</div>
