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
                    <div class="lert" id="tr_photos">
                        <div class="download_photos">
                          <label class="add_photo" for="my-file-selector1">
                            <input id="my-file-selector1" type="file" class="d-none" name="tr_images[]" accept="image/*"accept="image/*" multiple>
                            <img src="/images/plus_a.svg" alt="">
                           </label>
                        </div> 
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
                       <div class="lert" id="dr_photos">
                            <div class="download_photos">
                              <label class="add_photo" for="my-file-selector2">
                                <input id="my-file-selector2" type="file" class="d-none" name="dr_images[]" accept="image/*"accept="image/*" multiple>
                                <img src="/images/plus_a.svg" alt="">
                               </label>
                            </div> 
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
      <div class="cabinet_right">
         <?=$this->render('cabinet_right',['company'=>$company,'banner'=>$banner,'user'=>$user]);?>
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

    remove = function(id){
        $("#tr_photo"+id).remove();
      }
      $("#my-file-selector1").on('change',function(e){
        var files = e.target.files;

        $.each(files, function(i,file){
            var reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = function(e){
                var template = '<div class="download_photos added" id="tr_photo'+i+'">' +
                '<button type="button" class="remove_photo" onclick="remove('+i+')"><img src="/images/minus_a.svg"></button>'+
                    '<img src="'+e.target.result+'" alt="">'+
                  '</div>';
                $('#tr_photos').prepend(template);

              };

          });

      });
      remove2 = function(id){
            $("#dr_photo"+id).remove();
          }
          $("#my-file-selector2").on('change',function(e){
            var files = e.target.files;

            $.each(files, function(i,file){
                var reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = function(e){
                    var template = '<div class="download_photos added" id="dr_photo'+i+'">' +
                    '<button type="button" class="remove_photo" onclick="remove2('+i+')"><img src="/images/minus_a.svg"></button>'+
                        '<img src="'+e.target.result+'" alt="">'+
                      '</div>';
                    $('#dr_photos').prepend(template);

                  };

              });

          });

    
  });
JS
);
?>