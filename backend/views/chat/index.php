<?php
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chats';
$this->params['breadcrumbs'][] = $this->title;

$id = $from;
?>
<?php
$lang = Yii::$app->language;
$adminka = Yii::$app->params['adminka'];
?>
<div class="content-frame">                                    
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2><span class="fa fa-comments"></span> Messages</h2>
        </div>                                                    
        <div class="pull-right">                            
            <button class="btn btn-danger"><span class="fa fa-book"></span> Contacts</button>
            <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
        </div>                           
    </div>
    <!-- END CONTENT FRAME TOP -->
    
    <!-- START CONTENT FRAME RIGHT -->
    <div class="content-frame-right" style="display: none;">
        
        <div class="list-group list-group-contacts border-bottom push-down-10">
            <?php foreach ($users as $key => $value): ?>
                  <a href="<?=$adminka?><?=$lang?>/chat/index?to=<?=$value->id?>" class="list-group-item choose">                                 
                        <!-- <div class="list-group-status status-online"></div> -->
                    <?=$value->getUserAvatar('_columns')?>
                    <?php if ($id == $value->id): ?>
                        <span class="contacts-title"><?=Yii::t('app','Saved messages')?></span>
                    <?php else: ?>
                        <span class="contacts-title"><?=$value->username?></span>

                    <?php endif ?>
                </a>
            <?php endforeach ?>
        </div>
    </div>
    <!-- END CONTENT FRAME RIGHT -->

    <!-- START CONTENT FRAME BODY -->
    <div class="content-frame-body content-frame-body-left">
        <div class="panel panel-default" id="chat" style="height: 400px; overflow-y: all;">
            <?=$this->render('chat',['dataProvider'=>$dataProvider])?>
        </div>
        <div class="panel panel-default push-up-10">
            <div class="panel-body panel-body-search">
                <form method="post" action="<?=$adminka?>/chat/index" enctype="multipart/form-data"
                        id="myform"> 
                    <input type="hidden" name="from" value="<?=$from?>">
                    <input type="hidden" name="to" value="<?=$to?>">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <input type="file" class="file_input" id="inputFile" style="display: none;">
                            <label class="btn btn-default" for="inputFile"><img src="/images/file_chat.svg" alt=""></label>
                        </div>
                        <input type="text" id="message" class="form-control" placeholder="Your message...">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default" id="but_upload">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
$this->registerJs(<<<JS
            alert();

JS
);
?>