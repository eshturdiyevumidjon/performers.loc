<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$path = \yii::getAlias('@backend');
$langs = \backend\models\Lang::getLaguagesList();
$this->title = Yii::t('app','Edit Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="cabinet">
  <div class="container">
     <nav aria-label="breadcrumb" class="breadcrumb_nav">
          <ol class="breadcrumb"> 
            <li class="breadcrumb-item"><a href="/site/index">Главная</a></li>
            <li class="breadcrumb-item"><a href="/profile/index">Личный кабинет</a></li>
            <li class="breadcrumb-item active">Редактирование профиля</li>
          </ol>
      </nav>
    <h1><?=$this->title?></h1>
    <div class="flex_cabinet">
      <div class="cabinet_left">

        <ul class="nav tab_styles_nav">
          <li><a data-toggle="tab" <?=($active != 2 ) ? 'class="active show"' : ''?>  href="#ff0">Общие настройки</a></li>
          <li><a data-toggle="tab" <?=($active == 2 ) ? 'class="active show"' : ''?> href="#ff1" >Сменить пароль</a></li>
        </ul>
        <?php $form = ActiveForm::begin(
              [
                'options'=>
                  [
                   'class'=>'input_styles cab_st',
                  'id' => 'edit-form',
                  ]
          ]); ?>
        <div class="tab-content">
            <div id="ff0" class="tab-pane <?=($active != 2 ) ? 'in active show' : 'fade'?>">
          <?php
            $session = Yii::$app->session;
            $flashes = $session->getAllFlashes();

          
            foreach ($flashes as $key => $value) {
              if($key == 'success')
              {
                echo "<p class='alert alert-success'>$value</p>";
              }
              if($key == 'danger')
              {
                echo "<p class='alert alert-danger'>$value</p>";
              }  
            }
          ?> 
              
                <?=$form->field($user,'username')->textInput(['placeholder'=>$user->getAttributeLabel('username'),'class'=>'my_input'])->label(false)?>
                 <label for=""><?=$user->getAttributeLabel('birthday')?></label>
                    <div class="row">
                      <div class="col-lg-4">
                         <?=$form->field($user,'day')->textInput(['placeholder'=>$user->getAttributeLabel('day'),'class'=>'my_input'])->label(false)?>
                      </div>
                      <div class="col-lg-4">
                         <?= $form->field($user, 'month')->dropDownList($user->getMonthList(), ['prompt' => $user->getAttributeLabel('month'),'class'=>'my_input'])->label(false)?>
                      </div>
                      <div class="col-lg-4">
                        <?=$form->field($user,'year')->textInput(['placeholder'=>$user->getAttributeLabel('year'),'class'=>'my_input'])->label(false)?>
                      </div>
                    </div>
                 <label for=""><?=$user->getAttributeLabel('address')?></label>
                <?=$form->field($user,'address')->textInput(['placeholder'=>'Ташкент','class'=>'my_input'])->label(false)?>
                <label for=""><?=$user->getAttributeLabel('phone')?></label>
                 <?=$form->field($user,'phone')->textInput(['class'=>'my_input'])->label(false)?>

                <label for=""><?=Yii::t('app','E-mail')?></label>
                 <?=$form->field($user,'email')->textInput(['class'=>'my_input'])->label(false)->hint('<p class="opac">Почтовый адрес скрыт от других пользователей</p>')?>
                 <hr>
                  <label for="">Язык</label>
                  <div class="row">
                    <div class="col-lg-10 col-sm-9">
                      <div class="form-group">
                        <select name="language">
                          <?php foreach($langs as $lang): ?>
                          <option value="<?=$lang->id?>" <?=$user->language == $lang->id ? 'selected' : ''?>><img src="<?=$path.'/web/'.$lang->image?>"><?=$lang->name?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-3">
                      <a href="#" class="forget_pass">+ Добавить</a>
                    </div>
                  </div>
                  <div class="d-flex align-items-center barat">
                    <div class="form-group_checkbox mt10 mb15 vnu_m">
                        <input type="radio" id="bww55" name="degree" value='1' <?=($user->degree_of_language == 1)?'checked':''?>>
                        <label style="opacity: 0.7;font-weight: 100;" for="bww55">Начальный</label>
                    </div>
                    <div class="form-group_checkbox mt10 mb15 vnu_m">
                        <input type="radio" id="bww55a" name="degree" value='2' <?=($user->degree_of_language == 2)?'checked':''?>>
                        <label style="opacity: 0.7;font-weight: 100;" for="bww55a">Средний</label>
                    </div>
                    <div class="form-group_checkbox mt10 mb15 vnu_m">
                        <input type="radio" id="bww55r" name="degree" value='3' <?=($user->degree_of_language == 3)?'checked':''?>>
                        <label style="opacity: 0.7;font-weight: 100;" for="bww55r">Продвинутый</label>
                    </div>       
                    <div class="form-group_checkbox mt10 mb15 vnu_m">
                        <input type="radio" id="asc" name="degree" value='4' <?=($user->degree_of_language == 4)?'checked':''?>>
                        <label style="opacity: 0.7;font-weight: 100;" for="asc">Родной</label>
                    </div>              
                  </div>
                  <hr>
                  <div class="get_noti">
                    <h5>Получать уведомления:</h5>
                    <div class="form-group_checkbox">
                        <input type="checkbox" id="dvsv" name="alert_email" <?=($user->alert_email==1)?'checked':''?>>
                        <label for="dvsv">Получать уведомления при поступлении заявок по электронные почте</label>
                    </div> 
                    <div class="form-group_checkbox">
                        <input type="checkbox" id="sd2a" name="alert_site" <?=($user->alert_site==1)?'checked':''?>>
                        <label for="sd2a">Я хочу получать новости сайта</label>
                    </div> 
                    <p>Подписываться на задания могут только исполнители <a href="#">с подтвержденным аккаунтом.</a></p>
                  </div>
                  <hr>
              <?= Html::submitButton( Yii::t('app','Save'), ['class' =>'btn_red','name'=>'submit']) ?>
           </div>
            <div id="ff1" class="tab-pane <?=($active == 2 ) ? 'in active show' : 'fade'?>">
              <?php
                $session = Yii::$app->session;
                $flashes = $session->getAllFlashes();

                if(count($flashes) > 0 )
                {
                  $success = $flashes[0][0];
                  $message = $flashes[0][1];
                }
                foreach ($flashes as $key => $value) {
                  if($key == 'success')
                  {
                    echo "<p class='alert alert-success'>$value</p>";
                  }
                  if($key == 'danger')
                  {
                    echo "<p class='alert alert-danger'>$value</p>";
                  }  
                }
              ?>
                <form class="input_styles cab_st" id="changePassword"  method="post">
                        <?=$form->field($user,'old_password')->textInput(['placeholder'=>Yii::t('app','Old Password'),'class'=>'my_input'])->label(false)?>
                        <?=$form->field($user,'new_password')->textInput(['placeholder'=>Yii::t('app','New Password'),'class'=>'my_input'])->label(false)?>
                        <?=$form->field($user,'re_password')->textInput(['placeholder'=>Yii::t('app','Confirm password'),'class'=>'my_input'])->label(false)?>

                        <!-- <div class="form-group" style="margin-bottom:10px !important;">
                          <input type="password" name="new_password" placeholder="<?=Yii::t('app','New Password')?>">
                        </div>
                        <div class="form-group" style="margin-bottom:10px !important;">
                          <input type="password" name="re_password" placeholder="<?=Yii::t('app','Confirm password')?>">
                        </div> -->
                        <p class=""><?=Yii::t('app','From 6 to 24 characters. Only latin letters, numbers and these characters: !@#$%^&amp;*()_+-=;,./?[]{}')?></p>
                        <hr>
                        <?= Html::submitButton( Yii::t('app','Save'), ['class' =>'btn_red','name'=>'change_password']) ?>

                        <!-- <button type="submit" name="changePassword"  class="btn_red sobs"><?=Yii::t('app','Save')?></button> -->
                </form>
            </div>

        </div>
        <?php ActiveForm::end()?>

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
