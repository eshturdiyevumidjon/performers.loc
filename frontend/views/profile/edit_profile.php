<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Lang;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$langList = Lang::getLaguagesList();

$path = \yii::getAlias('@backend');
$this->title = Yii::t('app','Edit Profile');
$user_langs = explode(',', $user->language);

$this->params['breadcrumbs'][] = $this->title;
$company = \backend\models\AboutCompany::findOne(1);

function full_data($i){
  $langs = \backend\models\Lang::getLaguagesList();
  $output = '<select name="language[]" id="countries">';

  foreach($langs as $lang): 
      $output .= '<option value="'.$lang->id.'" ';
      if($i == $lang->id)
      $output .= ' selected';
      $output .= '>'.$lang->name.'</option>';
  endforeach;
  $output .= '</select>';
  return $output;
}

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
        <div class="tab-content">
              <div id="ff0" class="tab-pane <?=($active != 2 ) ? 'in active show' : 'fade'?>">
                <form class="input_styles cab_st" method="post" id="form1" action="/ru/profile/edit-profile">
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
                <input type="hidden" name="id_user" value="<?=$user->id?>">
                <label for=""><?=$user->getAttributeLabel('username')?></label>
                <div class="form-group">
                  <input type="text" name="User[username]" value="<?=$user->username?>">
                </div>
                <div>
                  <label for=""><?=$user->getAttributeLabel('birthday')?></label>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <input type="date" name="User[birthday]" placeholder="<?=$user->getAttributeLabel('birthday')?>" value="<?=$user->birthday?>">
                      </div>
                    </div>
                  </div>
                </div>
                <label for=""><?=$user->getAttributeLabel('address')?></label>
                <div class="form-group">
                  <input type="text" name="User[address]" placeholder="<?=$user->getAttributeLabel('address')?>" value="<?=$user->address?>">
                </div>
                <label for=""><?=$user->getAttributeLabel('phone')?></label>
                <div class="form-group">
                  <input type="tel" value="<?=$user->phone?>" name="User[phone]">
                  <p class="opac">Телефон скрыт от других пользователей</p>
                </div>
                <label for="">E-mail</label>
                <div class="form-group">
                  <input type="email" value="<?=$user->email?>" name="User[email]">
                  <p class="opac">Почтовый адрес скрыт от других пользователей</p>
                </div>
                <hr>
                <label for="">Язык</label>
                <div class="row">
                  <div class="col-lg-10 col-sm-9">
                    <!-- <div class="form-group"> -->
                      <select name="sss" class="vodiapicker">
                        <?php foreach ($langList as $value) {
                          ?>
                          <option value="<?=$value->url?>" class="test" data-thumbnail="<?=$value->image?>"><?=$value->name?></option>
                        <?php
                          } 
                        ?>
                      </select>

                      <div class="lang-select">
                      <div class="btn-select" value=""></div>
                      <div class="b">
                        <ul id="a"></ul>
                      </div>
                      </div>
                    <!-- </div> -->
                  </div>
                  <div class="col-lg-2 col-sm-3">
                    <a href="#" class="forget_pass">+ Добавить</a>
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
                        <p>Подписываться на задания могут только исполнители <a href="/site/index" target="_blank" >с подтвержденным аккаунтом.</a></p>
                      </div>
                      <hr>
                <button type="submit" name="save_changes" class="btn_red"><?=Yii::t('app','Save')?></button>
              </form>

              </div>
              <div id="ff1" class="tab-pane <?=($active == 2 ) ? 'in active show' : 'fade'?>">
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
                <form class="input_styles cab_st" id="form2" action="/ru/profile/change-password" method="post">
                  <input type="hidden" name="id_user" value="<?=$user->id?>">
                <div class="form-group">
                  <input type="password" name="User[old_password]" placeholder="<?=Yii::t('app','Old Password')?>" style="margin-bottom:15px;" value="<?=$model->old_password?>">
                </div>
                <div class="form-group">
                  <input type="password" name="User[new_password]" placeholder="<?=Yii::t('app','New Password')?>" style="margin-bottom:15px;" value="<?=$model->new_password?>">
                </div>
                <div class="form-group">
                  <input type="password" name="User[re_password]" placeholder="<?=Yii::t('app','Confirm password')?>" style="margin-bottom:15px;" value="<?=$model->re_password?>">
                </div>
                <p class=""><?=Yii::t('app','From 6 to 24 characters. Only latin letters, numbers and these characters: !@#$%^&amp;*()_+-=;,./?[]{}')?></p>
                <hr>
                <button type="submit" name="changePassword"  class="btn_red sobs"><?=Yii::t('app','Save')?></button>
              </form>
              </div>
        </div>
      </div>
      <div class="cabinet_right">
        <?=$this->render('cabinet_right',['company'=>$company]);?>
      </div>
    </div>
    
  </div>
</section>
