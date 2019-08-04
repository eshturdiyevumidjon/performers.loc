<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use katzz0\yandexmaps\Map;
use katzz0\yandexmaps\JavaScript;
use katzz0\yandexmaps\objects\Placemark;
use katzz0\yandexmaps\Polyline;
use katzz0\yandexmaps\Point;
use katzz0\yandexmaps\Canvas as YandexMaps;

$this->title =Yii::t('app','Contact');
$name=Yii::$app->name;
$company = \backend\models\AboutCompany::findOne(1);
$this->params['breadcrumbs'][] = $this->title;
?>
 <section class="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
             <?php
              if(count($this->params['breadcrumbs'])>0):
              ?>
              <nav aria-label="breadcrumb" class="breadcrumb_nav">
                <ol class="breadcrumb"> 
                  <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
                  <?php foreach ($this->params['breadcrumbs'] as $key => $value) : ?>
                  <li class="breadcrumb-item <?=($pathInfo==$value)?'active':''?>" aria-current="page"><?=$this->title?></li>
                  <?php endforeach; ?>
                </ol>
              </nav>
            <?php endif;?>
            <h1><?=Yii::t('app','Contact')?></h1>
            <h4><?=Yii::t('app','Address')." ".$name?></h4>
            <p class="adress"><img src="images/address.svg" alt=""><?=$company->address?></p>
            <h4><?=$name." ".Yii::t('app','on the net')?></h4>
            <div class="row social_icons">
              <div class="col-lg-3 col-md-5 col-6">
                <a href="#"><img src="/images/globus.svg" alt=""><span><?=$company->site?></span></a>
                <a href="#"><img src="/images/facebook.svg" alt=""><span><?=$company->facebook?></span></a>
              </div>
              <div class="col-lg-3 col-md-5 col-6">
                <a href="#"><img src="/images/telegram.svg" alt=""><span><?=$company->telegram?></span></a>
                <a href="#"><img src="/images/instagram.svg" alt=""><span><?=$company->instagram?></span></a>
              </div>
            </div>
            <h4><?=Yii::t('app','Telephone numbers')?></h4>
            <div class="row social_icons phones">
              <div class="col-6">
                <a href="tel:+998 94 366 66 66"><img src="/images/tel.svg" alt=""><span>+998 94 366 66 66</span></a>
                <a href="tel:+998 94 366 66 66"><img src="/images/tel.svg" alt=""><span>+998 94 366 66 66</span></a>
              </div>
              <div class="col-6">
                <a href="tel:+998 94 366 66 66"><img src="/images/old_phone.svg" alt=""><span>+998 94 366 66 66</span></a>
                <a href="tel:+998 94 366 66 66"><img src="/images/old_phone.svg" alt=""><span>+998 94 366 66 66</span></a>
              </div>
            </div>
            <form action="#" class="contact_form input_styles">
              <h1><?=Yii::t('app','Feedback form')?></h1>
              <div class="form-group">
                <input type="text" placeholder="<?=Yii::t('app','Name')?>">
              </div>
              <div class="form-group">
                <input type="email" placeholder="<?=Yii::t('app','Phone number or email address')?>">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="10" placeholder="<?=Yii::t('app','Messsage')?>"></textarea>
              </div>
              <button type="submit" class="btn_red"><?=Yii::t('app','Create my account')?></button>
            </form>
          </div>
           <div class="col-md-6">
              <div style="margin-top: 100px;">
                <?= YandexMaps::widget([
                    'htmlOptions' => [
                        'style' => 'height: 500px;',
                    ],
                    'map' => new Map('yandex_map', [
                        'center' => [$company->coordinate_x, $company->coordinate_y],
                        'zoom' => 12,
                        'controls' => [Map::CONTROL_ZOOM],
                        'behaviors' => [Map::BEHAVIOR_DRAG],
                        'type' => "yandex#map",
                    ],
                        [
                            'objects' => [
                                new Placemark(new Point($company->coordinate_x, $company->coordinate_y), [], [
                                    'draggable' => false,
                                    'preset' => 'islands#dotIcon',
                                    'iconColor' => 'red',
                                    'events' => [
                                        'dragend' => 'js:function (e) {
                                        var coords = e.get(\'target\').geometry.getCoordinates();
                                        $.get("/ru/about-company/set-coordinates",
                                        { "coordinate_x" : coords[0], "coordinate_y" : coords[1] },
                                            function(data){ }
                                        );
                                    }',
                                    ]
                                ])
                            ]
                        ])
                ]) ?>
              </div>
      </div>
        </div>
      </div>
    </section>