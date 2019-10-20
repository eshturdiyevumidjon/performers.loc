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
            <div class="chat-popup" id="myForm">
                      <div class="form form-container">
                        <div class="modal-header">
                            <button type="button" class="close" onclick="closeForm()" aria-hidden="true">×</button>

                            <h4 class="modal-title">Chat</h4>
                        </div>
                        <div style="overflow-y: auto;overflow-x: hidden; height: 400px; width:300px; " id="messages">
                         <?=$this->render('../task/request/messages',['messages'=>$messages])?>
                        </div>
                        <form action="/<?=Yii::$app->language?>/task/send-message" enctype="multipart/form-data" method="post" class="btm_chat" id="myForm">
                           
                         <div class="input_styles">
                           
                            <input type="text" id="message" placeholder="<?=Yii::t('app','Write')?>">

                            <input type="file" class="file_input" id="inputFile" accept="image/*" onchange="alert()">
                            <label for="inputFile"><img src="/images/file_chat.svg" alt="" style="width: 120%;margin-bottom: 60%; float: right;"></label>
                          </div>
                         
                          <button type="button" name="submit_send_message" id="submit_send_message" class="btn_red"><img src="/images/arrow_chat.svg" alt=""></button>
                          <br>
                          <br>
                        </form>
                      </div>
            </div>

            <button class="open-button" onclick="openForm()">Chat</button>

        <?php endif ?>
       
</div>

<footer class="footer">
        <?=$this->render('footer')?>
</footer>
<script type="text/javascript">
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
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

