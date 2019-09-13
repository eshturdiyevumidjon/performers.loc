<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
$lang = Yii::$app->language;
$active = $transport->active;
$cr =  Yii::$app->session['active_create'];
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
          <li id="ccc"><a data-toggle="tab" <?= ($active == 1) ? 'class="active show"' : ''?> href="#home"><?=Yii::t('app','Adding cars')?></a></li>
          <li id="ppp"><a data-toggle="tab" <?= ($active == 2) ? 'class="active show"' : ''?> href="#menu1"><?=Yii::t('app','Adding Drivers')?></a></li>
        </ul>
        <?php $form = ActiveForm::begin(['enableClientScript' => false,'options'=>['enctype'=>'multipart/form-data','class'=>'input_styles','id'=>'create_auto_and_driver']]); ?>
        <input type="hidden" name="active" id="active"  value="<?=$active?>">
        <div class="tab-content">
          <div id="home" <?=($active == 1)?'class="tab-pane in active"':'class="tab-pane fade"'?>>
                 <div id="create_autos" <?=($cr != 1)?'style="display: none;"':''?>>
                   <div class="row">
                    <div class="col-sm-6">
                       <?= $form->field($transport, 'mark')->dropDownList(ArrayHelper::map(\backend\models\Marks::find()->all(),'id','name_mark'), ['class'=>'my_input','prompt' => Yii::t('app','Car mark'),'style'=>'cursor:pointer;'])->label(false)?>
                     </div>
                     <div class="col-sm-6">
                       <?= $form->field($transport, 'model')->dropDownList(ArrayHelper::map(\backend\models\Models::find()->all(),'id','name_model'), ['class'=>'my_input','prompt' => Yii::t('app','Car model'),'style'=>'cursor:pointer;'])->label(false)?>
                     </div>
                     <div class="col-sm-6">
                        <?= $form->field($transport, 'registration_number')->textInput(['placeholder'=>Yii::t('app','Registration Number'),'class'=>'my_input'])->label(false) ?>
                     </div>
                    </div>
                   <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
                    <div class="lert">
                          <?php
                            $imgs = explode(',', $transport->images);
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
                      <?= Html::submitButton(Yii::t('app','Add'), ['class' => 'btn_red','value'=>'add_transport','name'=>'submit']) ?>
                  </div>
                  <br>
                  <div class="text-right">
                      <button type="button" class="btn_red drug" id="add_car"><img src="images/delete.svg" alt=""><?=Yii::t('app','Add car')?></button>
                  </div>
                  <?php if (count($autos)>0): ?>
                    <h2 class="title_add"><?=Yii::t('app','Transports listing')?></h2>
                  <?php endif ?>
                  <?php Pjax::begin(['enablePushState' => false,'id' => 'crud-datatable-pjax'])?>
                    <?php foreach ($autos as $key => $value): ?>
                      <div class="dor_item">
                      <div class="d-flex align-items-center justify-content-between lman">
                        <h4><img src="/images/car.svg" alt=""><?=Yii::t('app','Model and brand of car')?> <?=$value->getModel()." ".$value->getMark()?></h4>

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
          <div id="menu1" <?=($active == 2)?'class="tab-pane in active"':'class="tab-pane fade"'?>>
              <div id="create_driver" <?=($cr != 2)?'style="display: none;"':''?>>
                        <div class="row">
                          <div class="col-sm-6">
                                <?= $form->field($driver, 'phone')->textInput(['class'=>'my_input','placeholder' => Yii::t('app','Phone')])->label(false)?>
                           </div>
                           <div class="col-sm-6">
                             <?= $form->field($driver, 'fio')->textInput(['class'=>'my_input','placeholder' => Yii::t('app','Username')])->label(false)?>
                           </div>
                        </div>
                        <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
                        <div class="lert">
                                <?php
                                  $imgs = explode(',', $driver->images);
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
                        <?= Html::submitButton(Yii::t('app','Add'), ['class' => 'btn_red','value'=>'add_driver','name'=>'submit']) ?>

                    </div>
                    <br>
                     <div class="text-right">
                        <button type="button" class="btn_red drug" id="add_driver"><img src="images/delete.svg" alt=""><?=Yii::t('app','Add driver')?></button>
                     </div>
                    <?php if (count($drivers)>0): ?>
                      <h2 class="title_add"><?=Yii::t('app','Drivers listing')?></h2>
                    <?php endif ?>
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
        <?php ActiveForm::end()?>
      </div>
    </div>
  </div>
</section>
<?php
$id = $model->id;
$this->registerJs(<<<JS
  $(document).ready(function(){
    $("#ccc").on('click',function(){
      $('#active').val('1');
    });

    $("#ppp").on('click',function(){
      $('#active').val('2');
    });

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