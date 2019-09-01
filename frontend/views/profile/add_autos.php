<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
$lang = Yii::$app->language;
?>
<section class="cabinet">
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
        <li class="breadcrumb-item"><a href="/profile/index"><?=Yii::t('app','Personal Cabinet')?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Adding cars')?></li>
      </ol>
    </nav>
    <h1><?=Yii::t('app','Adding cars')?></h1>
    <div class="flex_cabinet">
      <div class="cabinet_left">
        <ul class="nav tab_styles_nav">
          <li><a data-toggle="tab" href="#ff0"><?=Yii::t('app','Adding cars')?></a></li>
          <li><a data-toggle="tab" class="active show" href="#ff1"><?=Yii::t('app','Adding Drivers')?></a></li>
        </ul>
        
         <div class="tab-content" >
          <div id="ff0" class="tab-pane fade">
            <div id="create_autos" style="display: none;">
              <form id="create_autoss" method="post" action='/<?=$lang?>/profile/create-auto1' enctype="multipart/form-data" class="tab-content input_styles cab_st" >
              <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" required="" name="Transports[model]" placeholder="<?=Yii::t('app','Car model')?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" required="" name="Transports[mark]" placeholder="<?=Yii::t('app','Car mark')?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" required="" name="Transports[registration_number]" placeholder="<?=Yii::t('app','Registration number')?>">
                      </div>
                    </div>
                  </div>
                 <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
                <div class="lert">
                    <?php
                      $imgs = explode(',', $model->images);
                      for($i = 0; $i < 7; $i++){
                    ?>
                    <div class="download_photos <?=($imgs[$i] != '') ? 'added' : '' ?>" id="upload_photos<?=($i+1)?>">
                      <button type="button" class="remove_photo remove_photo1" name="<?=($i+1)?>"><img src="/images/minus_a.svg" alt=""></button>
                      <img src="<?=($imgs[$i] != '') ? '/uploads/drivers/'.$imgs[$i] : '' ?>" alt="" id="image_upload_preview<?=($i+1)?>">
                      <label class="add_photo" for="my-file-selector<?=($i+1)?>">
                        <input id="my-file-selector<?=($i+1)?>" type="file" alt="<?=($i+1)?>" class="d-none d-none1" name="images[]" value="<?=$imgs[$i]?>" accept="image/*">
                        <img src="/images/plus_a.svg" alt="">
                       </label>
                    </div>  
                    <?php }?> 
                </div>
                <div class="text-right">
                    <button type="submit" name="auto" class="btn_red drug"><?=Yii::t('app','Save')?></button>
                </div>
              </form>
            </div>
                <br>
                 <div class="text-right">
                    <button type="button" class="btn_red drug" id="add_car"><img src="images/delete.svg" alt=""><?=Yii::t('app','Add car')?></button>
                  </div>
         
            <h2 class="title_add"><?=Yii::t('app','Transports listing')?></h2>
            <?php Pjax::begin(['enablePushState' => false,'id' => 'crud-datatable-pjax'])?>
              <?php foreach ($autos as $key => $value): ?>
                <div class="dor_item">
                <div class="d-flex align-items-center justify-content-between lman">
                  <h4><img src="/images/car.svg" alt=""><?=Yii::t('app','Model and brand of car')?> <?=$value->model." ".$value->mark?></h4>

                  <div class="lin">
                    <?=Html::a(Yii::t('app','Update'), ['/profile/update-auto?id='.$value->id],[ 'class'=>'lin1','role'=>'modal-remote','title'=>Yii::t('app','Update')])?>
                    <?=Html::a(Yii::t('app','Delete'), ['/profile/delete-transport?id='.$value->id],[ 'class'=>'lin2','role'=>'modal-remote',
                      'title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false, 
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')])?>
                  </div>
                </div>
                <div class="mke"><span><?=Yii::t('app','Registration Number')?>::</span><b><?=$value->registration_number?></b></div>
                <div class="photos_inn">
                  <p><?=Yii::t('app','Image')?></p>
                  <div class="d-flex flex-wrap">
                    <?php if($value->images != ""){  $imgs = explode(',',$value->images);
                     foreach ($imgs as $key => $value): ?>
                      <a href="/uploads/transports/<?=$value?>" class="netr" data-fancybox="galery"><img src="/uploads/transports/<?=$value?>" alt=""></a>
                    <?php endforeach; } ?>
                  </div>
                </div>
              </div>
              <?php endforeach ?>
            <?php Pjax::end()?>

          </div>

          <div id="ff1" class="tab-pane in active"> 
              <div id="create_driver" style="display: none;">
              <form id="create_driverss" method="post" action='/<?=$lang?>/profile/create-driver1' enctype="multipart/form-data" class="tab-content input_styles cab_st" >
              <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" required="" name="Drivers[fio]" placeholder="<?=Yii::t('app','Username')?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" required="" name="Drivers[phone]" placeholder="<?=Yii::t('app','Phone number')?>">
                      </div>
                    </div>
                  </div>
                <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
                <div class="lert">
                    <?php
                      $imgs = explode(',', $model->images);
                      for($i = 0; $i < 7; $i++){
                    ?>
                    <div class="download_photos <?=($imgs[$i] != '') ? 'added' : '' ?>" id="uploads<?=($i+1)?>">
                      <button type="button" class="remove_photo remove_photo2" name="<?=($i+1)?>"><img src="/images/minus_a.svg" alt=""></button>
                      <img src="<?=($imgs[$i] != '') ? '/uploads/drivers/'.$imgs[$i] : '' ?>" alt="" id="image_preview<?=($i+1)?>">
                      <label class="add_photo" for="my-selector<?=($i+1)?>">
                        <input id="my-selector<?=($i+1)?>" type="file" alt="<?=($i+1)?>" class="d-none d-none2" name="images[]" value="<?=$imgs[$i]?>" accept="image/*">
                        <img src="/images/plus_a.svg" alt="">
                       </label>
                    </div>  
                    <?php }?> 
                </div>
                <div class="text-right">
                    <button type="submit" name="driver" class="btn_red drug"><?=Yii::t('app','Save')?></button>
                </div>
              </form>
              </div>
                <br>
                 <div class="text-right">
                    <button type="button" class="btn_red drug" id="add_driver"><img src="images/delete.svg" alt=""><?=Yii::t('app','Add driver')?></button>
                  </div>

              <h2 class="title_add"><?=Yii::t('app','Drivers listing')?></h2>
              <?php Pjax::begin(['enablePushState' => false,'id' => 'crud-datatable-pjax-2'])?>
              <?php foreach ($drivers as $value): ?>
                 <div class="dor_item">
                    <div class="d-flex align-items-center justify-content-between lman">
                      <h4><?=$value->fio?></h4>
                      <div class="lin">
                        <?=Html::a(Yii::t('app','Update'), ['/profile/update-driver?id='.$value->id],[ 'class'=>'lin1','role'=>'modal-remote','title'=>Yii::t('app','Update')])?>
                        <?=Html::a(Yii::t('app','Delete'), ['/profile/delete-driver?id='.$value->id],[ 'class'=>'lin2','role'=>'modal-remote',
                          'title'=>Yii::t('app','Delete'), 
                              'data-confirm'=>false, 'data-method'=>false, 
                              'data-request-method'=>'post',
                              'data-toggle'=>'tooltip',
                              'data-confirm-title'=>Yii::t('app','Are you sure?'),
                              'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')])?>
                      </div>
                    </div>
                    <div class="mke"><span><?=Yii::t('app','Phone')?>:</span><b><?=$value->phone?></b></div>
                     <div class="photos_inn">
                      <p><?=Yii::t('app','Image')?></p>
                      <div class="d-flex flex-wrap">
                        <?php
                        if($value->images != ""){ 
                        $imgs = explode(',',$value->images);
                         foreach ($imgs as $value): ?>
                          <a href="/uploads/drivers/<?=$value?>" class="netr" data-fancybox="galery"><img src="/uploads/drivers/<?=$value?>" alt=""></a>
                        <?php endforeach;} ?>
                      </div>
                </div>
                  </div>
              <?php endforeach  ?>
            <?php Pjax::end()?>
          </div>
          
        </div>
      </div>
      <div class="cabinet_right">
        <?=$this->render('cabinet_right',['company'=>$company]);?>
      </div>
    </div>
  </div>
</section>
<?php
$id = $model->id;
$this->registerJs(<<<JS
  $(document).ready(function(){

    $("#add_car").on('click',function(){
      $("#create_autos").toggle(300);
      });
    $("#add_driver").on('click',function(){
    $("#create_driver").toggle(300);
    });

    function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_upload_preview'+id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".remove_photo1").on('click',function () {
        id = $(this).attr('name');
        $("#upload_photos"+id).removeClass('added');
        $('#image_upload_preview'+id).attr('src', '');
    });

    $(".d-none1").change(function () {
        id = $(this).attr('alt');
        readURL(this,id);
        $("#upload_photos"+id).addClass('added');
    });

    function readURL2(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_preview'+id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".remove_photo2").on('click',function () {
        id = $(this).attr('name');
        $("#uploads"+id).removeClass('added');
        $('#image_preview'+id).attr('src', '');
    });

    $(".d-none2").change(function () {
        id = $(this).attr('alt');
        readURL2(this,id);
        $("#uploads"+id).addClass('added');
    });
  });
JS
);
?>