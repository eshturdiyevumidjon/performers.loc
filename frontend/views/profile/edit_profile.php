<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */


$this->title = Yii::t('app','Edit Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="cabinet">
  <div class="container">
     <nav aria-label="breadcrumb" class="breadcrumb_nav">
          <ol class="breadcrumb"> 
            <li class="breadcrumb-item"><a href="#">Главная</a></li>
            <li class="breadcrumb-item"><a href="#">Личный кабинет</a></li>
            <li class="breadcrumb-item active"><a href="#">Редактирование профиля</a></li>
          </ol>
      </nav>
    <h1><?=$this->title?></h1>
    <div class="flex_cabinet">
      <div class="cabinet_left">
        <ul class="nav tab_styles_nav">
          <li><a data-toggle="tab" class="active show" href="#ff0">Общие настройки</a></li>
          <li><a data-toggle="tab" href="#ff1" class="">Сменить пароль</a></li>
        </ul>
        <div class="tab-content">
            <div id="ff0" class="tab-pane in active show">
              <form class="input_styles cab_st">
              
                  <label for="">Фамилия и имя/Название компании</label>
                  <div class="form-group">
                    <input type="text" placeholder="Хиракава Тэцуо">
                  </div>
                  <div>
                    <label for="">День рождения</label>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <input type="text" placeholder="День">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <input type="text" placeholder="Месяц">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <input type="text" placeholder="Год">
                        </div>
                      </div>
                    </div>
                  </div>
                  <label for="">Город</label>
                  <div class="form-group">
                    <input type="text" placeholder="Ташкент">
                  </div>
                  <label for="">Телефон</label>
                  <div class="form-group">
                    <input type="tel" placeholder="+998 90 937 86 04">
                    <p class="opac">Телефон скрыт от других пользователей</p>
                  </div>
                  <label for="">E-mail</label>
                  <div class="form-group">
                    <input type="email" placeholder="hey@deepx.uz">
                    <p class="opac">Почтовый адрес скрыт от других пользователей</p>
                  </div>
                  <hr>
                  <label for="">Язык</label>
                  <div class="row">
                    <div class="col-lg-10 col-sm-9">
                      <div class="form-group">
                        <select name="" id="">
                          <option value="">Русский</option>
                          <option value="">Русский2</option>
                          <option value="">Русский3</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-3">
                      <a href="#" class="forget_pass">+ Добавить</a>
                    </div>
                  </div>
                  <div class="d-flex align-items-center barat">
                    <div class="form-group_checkbox mt10 mb15 vnu_m">
                        <input type="checkbox" id="bww55">
                        <label for="bww55">Начальный</label>
                    </div>
                    <div class="form-group_checkbox mt10 mb15 vnu_m">
                        <input type="checkbox" id="bww55a">
                        <label for="bww55a">Средний</label>
                    </div>
                    <div class="form-group_checkbox mt10 mb15 vnu_m">
                        <input type="checkbox" id="bww55r">
                        <label for="bww55r">Продвинутый</label>
                    </div>       
                    <div class="form-group_checkbox mt10 mb15 vnu_m">
                        <input type="checkbox" id="asc">
                        <label for="asc">Родной</label>
                    </div>              
                  </div>
                  <hr>
                  <div class="get_noti">
                    <h5>Получать уведомления:</h5>
                    <div class="form-group_checkbox">
                        <input type="checkbox" id="dvsv">
                        <label for="dvsv">Получать уведомления при поступлении заявок по электронные почте</label>
                    </div> 
                    <div class="form-group_checkbox">
                        <input type="checkbox" id="sd2a">
                        <label for="sd2a">Я хочу получать новости сайта</label>
                    </div> 
                    <p>Подписываться на задания могут только исполнители <a href="#">с подтвержденным аккаунтом.</a></p>
                  </div>
                  <hr>


                   
                  <button type="submit" class="btn_red">Создать мою учетную запись</button>
              </form>
           </div>
            <div id="ff1" class="tab-pane fade">
                <form class="input_styles cab_st">
                        <div class="form-group">
                          <input type="password" placeholder="Старый пароль">
                        </div>
                        <div class="form-group">
                          <input type="password" placeholder="Новый пароль">
                        </div>
                        <div class="form-group">
                          <input type="password" placeholder="Повторите пароль">
                        </div>
                        <p class="">От 6 до 24 символов. Допустимы латинские буквы, цифры и следующие спецсимволы: !@#$%^&amp;*()_+-=;,./?[]{}</p>
                        <hr>
                        <button type="submit" class="btn_red sobs">Сохранить</button>
                </form>
            </div>
        </div>
      </div>
      <div class="cabinet_right">
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