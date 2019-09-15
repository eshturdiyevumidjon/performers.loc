<?php
use kartik\date\DatePicker;
use common\widgets\Alert;
use yii\widgets\MaskedInput;
use \backend\models\Tasks;
$lang = Yii::$app->language;
$post['type'] = isset($post['type']) ? $post['type'] : [];

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
  <h1><?=Yii::t('app','Personal Cabinet')?></h1>
  <div class="flex_cabinet">
    <div class="cabinet_left">
      <ul class="nav tab_styles_nav">
        <li><a data-toggle="tab" class="active show" href="#ff1"><?=Yii::t('app','View Available Jobs')?></a></li>
        <li><a data-toggle="tab" href="#ff0"><?=Yii::t('app','My active tasks')?></a></li>
      </ul>
      <div class="tab-content input_styles cab_st">
        <div id="ff1" class="tab-pane in active"> 
          <form id="filter_form" action="/<?=$lang?>/profile/search" method="post">
            <input type="hidden" name="searching" id="searching" value="0">
            <div class="filter_block">
              <p><?=Yii::t('app','Filter')?></p>
              <div class="row hdr_svgs">
                <?php
                $arr = explode(',',$user->role_performer);
                for ($i=0; $i < 4; $i++) {
                  $k = $i + 1; 
                  if(in_array($k, $arr)):
              ?>
                 <div class="col-lg-3 col-sm-6">
                    <a  class="enter_to_site choose <?=in_array($k,$post['type']) ? 'active' : ''?>" id="<?=$k?>">
                      <span class="aft_back"></span>
                      <?=Tasks::getTypeIconSvg($i+1)?>
                      <span><?=Tasks::getInf()[$i][0]?></span>
                    </a>
                </div>
                <input type="checkbox" style="display: none;" name="type[]" value="<?=$k?>"  id="type<?=$k?>"  <?=in_array($k,$post['type'])? 'checked' : ''?>>
              <?php
                endif;
                }
              ?>
              </div>
            </div>
            <div class="ot_do">
              <label for=""><?=Yii::t('app','Cost')?>:</label>
              <div class="ine_ot">
                <label for=""><?=Yii::t('app','from')?></label>
                <div class="form-group">
                  <?php echo MaskedInput::widget([
                      'name' => 'cost_from',
                      'value'=>$post['cost_from'],
                      'mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>'...']
                  ]);?>
                </div>
              </div>
              <div class="ine_ot">
                <label for=""><?=Yii::t('app','to')?></label>
                <div class="form-group">
                 <?php echo MaskedInput::widget([
                      'name' => 'cost_to',
                      'value'=>$post['cost_to'],
                      'mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false],'options'=>['class'=>'my_input','placeholder'=>'...']
                  ]);?>
                </div>
              </div>
            </div>
            <div class="ot_do">
              <label for=""><?=Yii::t('app','Date')?>:</label>
              <div class="ine_ot">
                <label for=""><?=Yii::t('app','from')?></label>
               <?php echo DatePicker::widget([
                       'name' => 'data_from',
                       'id' => 'data_from',
                       'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                       'value' => $post['data_from'],
                       'options'=>[
                        'class'=>'my_input',
                        'placeholder'=>'...',
                       ],
                       'pluginOptions' => [
                           'autoclose'=>true,
                           'allowClear'=>true,        
                           'clearBtn' => true,
                           'format' => 'dd.mm.yyyy'
                       ]
                   ]);
                ?>
              </div>
              <div class="ine_ot">
                <label for=""><?=Yii::t('app','to')?></label>
                <?php echo DatePicker::widget([
                       'name' => 'data_to',
                       'id' => 'data_to',
                       'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                       'value' => $post['data_to'],
                       'options'=>[
                        'class'=>'my_input',
                        'placeholder'=>'...',
                       ],
                       'pluginOptions' => [
                           'autoclose'=>true,
                           'allowClear'=>true,
                           'clearBtn' => true,
                           'format' => 'dd.mm.yyyy'
                       ]
                   ]);
                ?>
              </div>
            </div>
            <div class="ot_address">
              <div class="form-group">
                  <input type="text" name="address" value="<?=$post['address']?>" placeholder="<?=Yii::t('app','Address')?>">
              </div>
            </div>
            <div class="clear_and_chen">
              <a  class="enter_to_site" id="reset"><span class="aft_back"></span><?=Yii::t('app','Reset')?></a>
              <!-- <a class="enter_to_site" id="send_data"><span class="aft_back"></span><?=Yii::t('app','Apply')?></a> -->
              <button type="submit" style="border: none;margin-left: 5px;cursor:pointer;" class="enter_to_site" name="search_submit" value=""><span class="aft_back"></span><?=Yii::t('app','Apply')?></button>
            </div>
          </form>
          <div id="result">
            <?=$this->render('filter',['all_tasks'=>$all_tasks,'lang'=>$lang])?>
            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
           </div>
          <!-- <ul class="pagination">

            
            <li class="page-item prev toogle_pag">
              <a class="btn_red" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"/></g></g></g></g></svg>
              </a>
            </li>
            <li class="page-item next toogle_pag">
              <a class="btn_red" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"/></g></g></g></g></svg>
              </a>
            </li>
          </ul> -->
        </div>
        <div id="ff0" class="tab-pane fade">
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
        <div id="err"></div>
        <p><?= $user->username ?></p>
        <div class="rating">
     <!--      <a href="#" class="rating_img">
       <img src="/images/star.svg" alt="">
       <img src="/images/star.svg" alt="">
       <img src="/images/star.svg" alt="">
       <img src="/images/star.svg" alt="">
       <img src="/images/star.svg" alt="">
     </a>
     <span>4,5</span>-->
             </div> 
        <div class="btn_dor">
          <a href="/<?=$lang?>/profile/edit-profile" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Edit Account')?></a>
            <a href="/<?=$lang?>/profile/add-autos" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Adding cars')?></a>
      </div>
        <?=$this->render('cabinet_right',['company'=>$company,'banner'=>$banner,'user'=>$user]);?>
    </div>
  </div>
</div>

</section>
<?php
$this->registerJs(<<<JS
 $(document).ready(function() { 
  $(".choose").on('click',function(){
    id = $(this).attr('id');
    if($(this).hasClass('active')){
      $(this).removeClass('active');
      $('#type'+id).prop("checked",false);
    }else{
      $(this).addClass('active');
      $('#type'+id).prop("checked",true);
    }
  });
  $("#reset").on('click',function(){
    $("#filter_form")[0].reset();
    $(":input").val('');
    $(':checkbox').prop("checked",false);
    $('.choose').each(function(){
      $(this).removeClass('active');
      });
  });
  
  $("#send_data").on('click',function(){
   $.post('/$lang/profile/search',$('#filter_form').serialize(),function(data){
        // $('#result').html(data);
        alert(data);
    });
  });


  $("input").attr('autocomplete','off');
  $("a").addClass('pointer');
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

  }); 
JS
);
