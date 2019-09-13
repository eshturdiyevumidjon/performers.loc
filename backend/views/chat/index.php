<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chats';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
$id = Yii::$app->user->identity->id;
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
                  <button href="#" class="list-group-item choose"  id="<?=$value->id?>">                                 
                        <!-- <div class="list-group-status status-online"></div> -->
                    <?=$value->getUserAvatar('_columns')?>
                    <?php if ($id == $value->id): ?>
                        <span class="contacts-title"><?=Yii::t('app','Saved messages')?></span>
                    <?php else: ?>
                        <span class="contacts-title"><?=$value->username?></span>

                    <?php endif ?>
                </button>
            <?php endforeach ?>
        </div>
    </div>
    <!-- END CONTENT FRAME RIGHT -->

    <!-- START CONTENT FRAME BODY -->
    <div class="content-frame-body content-frame-body-left" style="height: 599px;" id="chat">
        <?=$this->render('chat',['dataProvider'=>$dataProvider])?>
        
    </div>
    <!-- END CONTENT FRAME BODY -->      
</div>
<?php
$this->registerJs(<<<JS
    $(document).ready(function(){
        $('.choose').on('click',function(){
           $.post('/admin/$lang/chat/index',{to:$(this).attr('id')},function(success){alert(success);$('#chat').html(success);});
            alert();

            });
        });
JS
);

