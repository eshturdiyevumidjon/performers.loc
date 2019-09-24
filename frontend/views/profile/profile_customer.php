<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
use \backend\models\Tasks; 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$lang = Yii::$app->language;

$this->title = Yii::t('app','Personal Cabinet');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="cabinet">
  <div class="container">
     <nav aria-label="breadcrumb" class="breadcrumb_nav">
          <ol class="breadcrumb"> 
            <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
            <li class="breadcrumb-item active"><?=Yii::t('app','Personal Cabinet')?></li>
          </ol>
     </nav>
    <?=Alert::widget()?>
    <h1><?=$title?></h1>
    <div class="flex_cabinet">
      <div class="cabinet_left">
        <ul class="nav tab_styles_nav">
          <li><a data-toggle="tab" href="#ff0" class="active show"><?=Yii::t('app','Create Task')?></a></li>
          <li><a data-toggle="tab" class="" href="#ff1"><?=Yii::t('app','My Orders')?></a></li>
          <li><a data-toggle="tab" href="#ff2" class=""><?=Yii::t('app','Past Orders')?></a></li>
        </ul>
        <div class="tab-content input_styles cab_st">
          <div id="ff0" class="tab-pane fade active show">
            <p class="create_equ"><?=Yii::t('app','Create Task')?></p>
          <div class="row hdr_svgs">
            <div class="col-md-3">
                <?=Html::a('<span class="aft_back"></span>'.Tasks::getTypeIconSvg(1).'
                <span>'.Yii::t('app','Passenger Transportation').'</span>', ['task/create-passengers'],['data-pjax'=>0,'title'=> Yii::t('app','Add'), 'class'=>'enter_to_site'])?>
            </div>
            <div class="col-md-3">
              <?=Html::a('<span class="aft_back"></span>'.Tasks::getTypeIconSvg(3).'
                <span>'.Yii::t('app','Freight transportation').'</span>', ['task/create-goods'],['data-pjax'=>0,'title'=> Yii::t('app','Add'), 'class'=>'enter_to_site'])?>
            </div>
            <div class="col-md-3">
              <?=Html::a('<span class="aft_back"></span>'.Tasks::getTypeIconSvg(2).'
                <span>'.Yii::t('app','Transportation of cars and equipment').'</span>', ['task/create-vehicles'],['data-pjax'=>0,'title'=> Yii::t('app','Add'), 'class'=>'enter_to_site'])?>
            </div>
            <div class="col-md-3">
               <?=Html::a('<span class="aft_back"></span>'.Tasks::getTypeIconSvg(4).'
                <span>'.Yii::t('app','Relocation assistance').'</span>', ['task/create-help'],['data-pjax'=>0,'title'=> Yii::t('app','Add'), 'class'=>'enter_to_site'])?>
            </div>
          </div>
          </div>
          <div id="ff1" class="tab-pane in"> 
            <?php if (count($my_tasks) > 0): ?>
              <?=$this->render('filter',['all_tasks'=>$my_tasks,'lang'=>$lang])?>
              <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
              
              <!-- <ul class="pagination">
              <li class="page-item"><a class="" href="#">1</a></li>
              <li class="page-item"><a class="" href="#">2</a></li>
              <li class="page-item"><a class="" href="#">3</a></li>
              <li class="page-item"><a class="" href="#">...</a></li>
              <li class="page-item"><a class="" href="#">346</a></li>
              <li class="page-item prev toogle_pag">
                <a class="btn_red" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg>
                </a>
              </li>
              <li class="page-item next toogle_pag">
                <a class="btn_red" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"></path></g></g></g></g></svg>
                </a>
              </li>
            </ul> -->
            <?php else: ?>
              <h4><?=Yii::t('app','You don’t have anything yet')?></h4>
            <?php endif ?>
          </div>
          <div id="ff2" class="tab-pane fade"> 
          </div>
        </div>
      </div>
      <div class="cabinet_right">
        <div class="user_all">
           <div class="user_dorian">
              <img src="<?=($user->image != null ) ? '/admin/uploads/avatars/'.$user->image : '/uploads/nouser3.png'?>" id="image_upload_preview">
                <form id="form" action="/$lang/profile/change-photo" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$user->id?>">
                <input type="file" name="user_image" id="inputFile" accept="image/*">
              </form>
              <label for="inputFile"><img src="/images/camera_photo.svg" alt=""><p style="color:black;"><?=Yii::t('app','Change photo')?></p></label>
          </div>
          <p><?= $user->username ?></p>
          <br>
          <!-- <div class="rating">
            <a href="#" class="rating_img">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
              <img src="/images/star.svg" alt="">
            </a>
            <span>4,5</span>
          </div> -->
          <div class="btn_dor">
             <a href="/<?=$lang?>/profile/change-profile" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Edit Account')?></a>
          </div>
        </div>
        <?=$this->render('cabinet_right',['company'=>$company,'banner'=>$banner,'user'=>$user]);?>
      </div>
    </div>
   
  </div>
</section>
<?php
$this->registerJs(<<<JS
  $("#w0-success-0").removeClass('fade in');
  $("#inputFile").on('change',function(e){
    var files = e.target.files;

    $.each(files, function(i,file){
        var reader = new FileReader();

        reader.readAsDataURL(file);

        reader.onload = function(e){
            $("#image_upload_preview").attr('src',e.target.result);
          };

      });

  });
  $('#inputFile').change(function(){ 
     var data = new FormData() ; 
     data.append('file', $( '#inputFile' )[0].files[0]) ; 
     $.ajax({
     url: '/$lang/profile/change-photo',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
      beforeSend: function(){
       $('#preview-image').html('Loading...');
      },
      success: function(data){ 
        location.reload(true);
      }
     });
    return false;
  });
JS
);
?>