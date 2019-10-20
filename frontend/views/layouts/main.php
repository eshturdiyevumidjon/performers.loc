<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\ItakeAsset;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
ItakeAsset::register($this);

CrudAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
        <?=$this->render('header')?>
        <?= Alert::widget() ?>
        <?= $content ?>

        <?php if (!Yii::$app->user->isGuest): ?>
           <div class="floating-chat">
                      <button class="open-button" >Chat</button>
                              
                       <div class="chat">
                          <div class="header">
                              <span class="title">
                                  what's on your mind?
                              </span>
                              <button>
                                  <i class="fa fa-times" aria-hidden="true"></i>
                              </button>
                                           
                          </div>
                          <ul class="messages">
                              <li class="other">asdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdas</li>
                              <li class="other">Are we dogs??? 🐶</li>
                              <li class="self">no... we're human</li>
                              <li class="other">are you sure???</li>
                              <li class="self">yes.... -___-</li>
                              <li class="other">if we're not dogs.... we might be monkeys 🐵</li>
                              <li class="self">i hate you</li>
                              <li class="other">don't be so negative! here's a banana 🍌</li>
                              <li class="self">......... -___-</li>
                          </ul>
                          <div class="footer">
                              <div class="text-box" contenteditable="true" disabled="true"></div>
                              <button id="sendMessage">send</button>
                          </div>
                      </div>
            </div>

      
        <?php endif ?>
       
</div>

<footer class="footer">
        <?=$this->render('footer')?>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "options" => [
        "tabindex" => false,
    ],
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

