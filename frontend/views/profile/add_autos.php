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
        <form class="tab-content input_styles cab_st" action="/profile/add-autos" id="transport_form" method="post" enctype="multipart/form-data">
          <div id="ff0" class="tab-pane fade">
            
            <div id="dinamic">
              <div id="auto">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                     <input type="text" name="model[]" required="" placeholder="<?=Yii::t('app',' Car model')?>" />
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                     <input type="text" name="mark[]" required="" placeholder="<?=Yii::t('app','Car mark')?>" />
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="regitr_num[]" required="" placeholder="<?=Yii::t('app','Registration Number')?>">
                    </div>
                  </div>
                </div>
                <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
                <div class="lert">
                  <div class="download_photos">
                    <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                     <label class="" for="my-file-selector">
                      <input id="my-file-selector" type="file" class="d-none">
                      <img src="/images/plus_a.svg" alt="">
                     </label>
                  </div>
                  <div class="download_photos">
                    <img src="/images/girll.jpg" alt="">
                    <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                    <label class="add_photo" for="my-file-selector">
                      <input id="my-file-selector" type="file" class="d-none">
                      <img src="/images/plus_a.svg" alt="">
                     </label>
                  </div>
                  <div class="download_photos">
                    <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                    <label class="add_photo" for="my-file-selector">
                      <input id="my-file-selector" type="file" class="d-none">
                      <img src="/images/plus_a.svg" alt="">
                     </label>
                  </div>
                  <div class="download_photos">
                    <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                    <label class="add_photo" for="my-file-selector">
                      <input id="my-file-selector" type="file" class="d-none">
                      <img src="/images/plus_a.svg" alt="">
                     </label>
                  </div>
                  <div class="download_photos">
                    <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                    <label class="add_photo" for="my-file-selector">
                      <input id="my-file-selector" type="file" class="d-none">
                      <img src="/images/plus_a.svg" alt="">
                     </label>
                  </div>
                  <div class="download_photos">
                    <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                    <label class="add_photo" for="my-file-selector">
                      <input id="my-file-selector" type="file" class="d-none">
                      <img src="/images/plus_a.svg" alt="">
                     </label>
                  </div>
                  <div class="download_photos">
                    <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                    <label class="add_photo" for="my-file-selector">
                      <input id="my-file-selector" type="file" class="d-none">
                      <img src="/images/plus_a.svg" alt="">
                     </label>
                  </div>
                </div>
              </div>
           </div>
            <hr>
              <button type="button"  class="add_content btn_red drug sobs1"><?=Yii::t('app','Add car')?></button>
            <hr>
            <div class="text-right">
              <button id="auto" name="auto" type="submit" class="btn_red drug sobs1"><?=Yii::t('app','Save')?></button>
            </div>

          </div>
          <div id="ff1" class="tab-pane in active"> 
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" placeholder="<?=Yii::t('app',' Username')?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="tel" placeholder="<?=Yii::t('app','  Phone number')?>">
                  </div>
                </div>
              </div>
              <h4 class="mrte"><?=Yii::t('app','Upload a photo')?></h4>
              <div class="lert">
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                   <label class="image_input" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image1[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <img src="/images/girll.jpg" alt="">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image2[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image3[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image4[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image5[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image6[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image7[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
              </div>
              <div class="text-right">
                <button class="btn_red drug"><img src="/images/delete.svg" alt=""><?=Yii::t('app','Delete')?></button>
              </div>
              <hr>
                <a href="#" class="btn_red drug sobs1"><?=Yii::t('app','Add driver')?></a>
              <hr>
              <div class="text-right">
                <a href="#" class="btn_red drug sobs1"><?=Yii::t('app','Save')?></a>
              </div>
          </div>
        </form>
      </div>
      <div class="cabinet_right">
        <?=$this->render('cabinet_right',['company'=>$company]);?>
      </div>
    </div>
  </div>
</section>

<?php
$this->registerJs(<<<JS
  $(document).ready(function(){
    var c = 0;
       $(document).on('click', '.add_content', function(){
          c++;
          var html = '<hr>'+$("#auto").html();
          html = '<div id="auto' + c + '">' + html;
          removeButton = '';
          removeButton = '<div class="text-right"><button type="button" name="auto'+c+'" class="remove_btn btn_red drug"><img src="/images/delete.svg" alt="">Delete</button></div>';
          html = html + removeButton + '</div>';
          $('#dinamic').append(html);
         });
        $(document).on('click', '.remove_btn', function(){
            id = $(this).attr('name');
            $("#"+id).remove();
           });
    });
JS
);
?>
