<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Chat');
$this->params['breadcrumbs'][] = $this->title;

$id = $model->from;
?>
<?php
$lang = Yii::$app->language;
$adminka = Yii::$app->params['adminka'];
?>
<div class="content-frame">                                    
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2><span class="fa fa-comments"></span> <?=$this->title?></h2>
        </div>                                                    
        <div class="pull-right">                            
            <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
        </div>                           
    </div>
    <!-- END CONTENT FRAME TOP -->
    
    <!-- START CONTENT FRAME RIGHT -->
    <div class="content-frame-right" style="display: none;">
        
        <div class="list-group list-group-contacts border-bottom push-down-10">
            <?php foreach ($users as $key => $value): ?>
                <?php if ($id != $value->id): ?>
                  <a href="<?=$adminka?><?=$lang?>/chat/index?to=<?=$value->id?>" class="list-group-item choose">                                 
                        <!-- <div class="list-group-status status-online"></div> -->
                    <?=$value->getUserAvatar('_columns')?>
                        <span class="contacts-title"><?=$value->username?></span>
                  </a>
                <?php endif ?>

            <?php endforeach ?>
        </div>
    </div>
    <!-- END CONTENT FRAME RIGHT -->

    <!-- START CONTENT FRAME BODY -->
    <div class="content-frame-body content-frame-body-left">
        <div style="overflow-y: auto; height: 450px;">
            <?=$this->render('chat',['models'=>$models,'from'=>$id])?>
        </div>
        <div class="panel panel-default push-up-10">
            <div class="panel-body panel-body-search">
                <?php $form = ActiveForm::begin([ 'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]); ?>
                    <?= $form->field($model, 'to')->hiddenInput()->label(false) ?>
                    <?= $form->field($model, 'from')->hiddenInput()->label(false) ?>
                    <div class="input-group">
                        <div class="input-group-btn">
                            <input type="file" class="file_input" name="file" id="inputFile" style="display: none;">
                            <label class="btn btn-default" for="inputFile"><img src="/images/file_chat.svg" alt=""></label>
                        </div>
                        <input type="text" required="" name="Chat[text]" class="form-control" placeholder="Your message...">
                       

                        <div class="input-group-btn">
                           <?= Html::submitButton(Yii::t('app','Send'), ['name'=>'send_message','class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>

                <form method="post" action="<?=$adminka?>/chat/index" enctype="multipart/form-data">    <input type="hidden" name="from" value="<?=$from?>">
                    <input type="hidden" name="to" value="<?=$to?>">
                    
                </form>
            </div>
        </div>
    </div>
</div>
