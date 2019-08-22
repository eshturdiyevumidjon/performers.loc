<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
use unclead\multipleinput\MultipleInput;
use mihaildev\ckeditor\CKEditor;
use kartik\select2\Select2;
use kartik\date\DatePicker;

$this->title =Yii::t('app','Contact');
$name=Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="contact">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
       <?php
        if(count($this->params['breadcrumbs'])>0):
        ?>
        <nav aria-label="breadcrumb" class="breadcrumb_nav">
          <ol class="breadcrumb"> 
            <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
            <?php foreach ($this->params['breadcrumbs'] as $key => $value) : ?>
            <li class="breadcrumb-item <?=($pathInfo==$value)?'active':''?>" aria-current="page"><?=$this->title?></li>
            <?php endforeach; ?>
          </ol>
        </nav>
        <?php endif;?>
        <h1><?=Yii::t('app','Contact')?></h1>
            <h4><?=Yii::t('app','Address')." ".$name?></h4>
            <p class="adress"><img src="/images/address.svg" alt=""><?=$company->address?></p>
        <h4><?=$name." ".Yii::t('app','on the net')?></h4>
        <div class="row social_icons">
          <div class="col-lg-3 col-md-5 col-6">
            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><g><g><path fill="" d="M12.806 11.288a7.907 7.907 0 0 0-1.572-.742c.19-.8.303-1.667.334-2.56h2.435a6.495 6.495 0 0 1-1.197 3.302zm-2.868 2.26c.453-.616.788-1.345 1.029-2.06.436.156.84.343 1.204.559a6.545 6.545 0 0 1-2.233 1.501zm-1.949.383v-2.997c.713.03 1.4.124 2.04.276-.349 1.022-1.03 2.35-2.04 2.721zm0-5.945h2.6a12.155 12.155 0 0 1-.294 2.284 11.736 11.736 0 0 0-2.306-.315zm0-2.941c.803-.032 1.58-.138 2.306-.315.165.713.265 1.482.294 2.28h-2.6zm0-3.976C9 1.439 9.68 2.767 10.03 3.79a10.77 10.77 0 0 1-2.04.276zm4.182 1.885zm-1.204.559c-.24-.716-.576-1.445-1.029-2.061a6.544 6.544 0 0 1 2.233 1.502 6.977 6.977 0 0 1-1.204.559zm1.839.199a6.483 6.483 0 0 1 1.197 3.299h-2.435a13.095 13.095 0 0 0-.334-2.557 7.908 7.908 0 0 0 1.572-.742zm-5.795.354a10.77 10.77 0 0 1-2.04-.276c.349-1.022 1.03-2.35 2.04-2.721zm0 2.945h-2.6a12.12 12.12 0 0 1 .294-2.28c.726.176 1.503.282 2.306.314zm0 2.944c-.803.032-1.58.138-2.306.315a12.126 12.126 0 0 1-.294-2.28h2.6v1.965zm0 3.976C6 13.561 5.32 12.233 4.97 11.21a10.77 10.77 0 0 1 2.04-.276zm-4.182-1.885a6.976 6.976 0 0 1 1.204-.559c.24.716.576 1.445 1.029 2.061a6.544 6.544 0 0 1-2.233-1.502zm-.635-.758A6.483 6.483 0 0 1 .997 7.989h2.435c.03.893.144 1.756.334 2.557a7.909 7.909 0 0 0-1.572.742zm0-7.576c.468.292.997.54 1.572.742-.19.8-.303 1.664-.334 2.557H.997a6.484 6.484 0 0 1 1.197-3.299zm2.868-2.26c-.453.616-.788 1.345-1.029 2.06a6.976 6.976 0 0 1-1.204-.559 6.545 6.545 0 0 1 2.233-1.501zM7.5 0C3.365 0 0 3.365 0 7.5S3.365 15 7.5 15 15 11.635 15 7.5 11.635 0 7.5 0z"/></g></g></svg><span><?=$company->site?></span></a>
            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="15" viewBox="0 0 7 15"><g><g><path fill="" d="M4.68 15H1.87V7.5H-.005V4.915H1.87l-.003-1.523C1.867 1.283 2.439 0 4.923 0H6.99v2.585H5.698c-.967 0-1.014.361-1.014 1.036L4.68 4.914h2.325L6.731 7.5 4.682 7.5z"/></g></g></svg><span><?=$company->facebook?></span></a>
          </div>
          <div class="col-lg-3 col-md-5 col-6">
            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><g><g><path fill="" d="M11.814 3.056L5.576 9.058a.594.594 0 0 0-.178.366l-.316-1.198a.594.594 0 0 0-.363-.403L2.227 6.87zM5.504 9.83zm0 0c.041.056.092.106.15.146l1.27.86-.97.698zm2.798.507a.322.322 0 0 0-.016-.011l-1.358-.921 6.546-6.3-1.813 9.51-3.36-2.278zm3.773 3.87a.593.593 0 0 0 .584-.482l2.329-12.222a.578.578 0 0 0 .01-.162.591.591 0 0 0-.628-.55.594.594 0 0 0-.196.047l-13.8 5.49a.594.594 0 0 0 .008 1.107L4.01 8.824l1.016 3.849a.594.594 0 0 0 .92.33l2.023-1.455 3.772 2.558c.1.068.216.103.333.103z"/></g></g></svg><span><?=$company->telegram?></span></a>
            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><g><g clip-path="url(#clip-92c98f84-5560-49d3-b85a-ddb803d60b6f)"><g><path fill="" d="M13.67 10.86a2.812 2.812 0 0 1-2.81 2.81H4.14a2.812 2.812 0 0 1-2.81-2.81V4.14a2.812 2.812 0 0 1 2.81-2.81h6.72a2.812 2.812 0 0 1 2.81 2.81v6.72zM10.86 0H4.14A4.144 4.144 0 0 0 0 4.14v6.72A4.144 4.144 0 0 0 4.14 15h6.72A4.144 4.144 0 0 0 15 10.86V4.14A4.144 4.144 0 0 0 10.86 0z"/></g><g><path fill="" d="M7.5 10.034A2.537 2.537 0 0 1 4.966 7.5 2.537 2.537 0 0 1 7.5 4.966 2.537 2.537 0 0 1 10.034 7.5 2.537 2.537 0 0 1 7.5 10.034zm0-6.399A3.87 3.87 0 0 0 3.635 7.5 3.87 3.87 0 0 0 7.5 11.365 3.87 3.87 0 0 0 11.365 7.5 3.87 3.87 0 0 0 7.5 3.635z"/></g><g><path fill="" d="M11.527 2.507a.98.98 0 0 0-.976.976c0 .256.105.508.287.69a.983.983 0 0 0 .69.286.986.986 0 0 0 .69-.286.98.98 0 0 0 0-1.38.98.98 0 0 0-.69-.286z"/></g></g></g></svg><span><?=$company->instagram?></span></a>
          </div>
        </div>
        <h4><?=Yii::t('app','Telephone numbers')?></h4>
        <?php $i = 0; $arr = explode(',', $company->phone); $count = count($arr)?>
        <div class="row social_icons phones">
         <?php
          foreach ($arr as $value){
         ?>
          <div class="col-6">
            <a href="tel:+998 94 366 66 66"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><g><g><g><path fill="" d="M14.993 11.835a.725.725 0 0 1-.222.635l-2.112 2.096c-.096.106-.22.196-.374.27a1.542 1.542 0 0 1-.452.143l-.095.008a2.161 2.161 0 0 1-.207.008c-.201 0-.527-.034-.976-.103-.45-.069-1-.238-1.652-.508-.651-.27-1.39-.675-2.215-1.215-.826-.54-1.704-1.281-2.636-2.223A17.401 17.401 0 0 1 2.21 8.85 14.935 14.935 0 0 1 1.035 7a9.964 9.964 0 0 1-.667-1.54 8.172 8.172 0 0 1-.302-1.191 3.934 3.934 0 0 1-.063-.786c.01-.191.016-.297.016-.318.02-.148.068-.3.142-.453a1.19 1.19 0 0 1 .27-.373L2.543.227a.7.7 0 0 1 .509-.222c.137 0 .259.04.365.119.106.08.196.177.27.294L5.386 3.64c.095.17.122.355.08.556a.99.99 0 0 1-.27.508l-.779.778a.265.265 0 0 0-.055.104.392.392 0 0 0-.024.119c.042.222.137.476.286.762.127.254.322.564.587.929.265.365.64.786 1.128 1.262.476.487.9.866 1.27 1.136.37.27.68.468.929.595.249.127.44.204.572.23l.198.04a.379.379 0 0 0 .103-.024.265.265 0 0 0 .103-.055l.906-.921a.973.973 0 0 1 .666-.255.83.83 0 0 1 .43.096h.015l3.065 1.81c.222.138.354.312.397.524z"/></g></g></g></svg><span><?=$value?></span></a>
          </div>
          <?php }?>
        </div>
        <div>
            <h1><?=Yii::t('app','Feedback form')?></h1>
          <?php
            $session = Yii::$app->session;
            $flashes = $session->getAllFlashes();
            foreach ($flashes as $key => $value) {
                if($key == 'success')
                {
                  echo "<p class='alert alert-success'>$value</p>";
                }
                if($key == 'danger')
                {
                  echo "<p class='alert alert-danger'>$value</p>";
                }  
              }
          ?> 
          <?php $form = ActiveForm::begin(['enableClientScript' => false, 'id' => 'contact-form','enableAjaxValidation' => true,'options'=>['class'=>'contact_form input_styles','enableAjaxValidation' => true]]); ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app','Username'),'class'=>'my_input'])->label(false)?>
            <?= $form->field($model, 'email')->textInput(['placeholder'=>Yii::t('app','Email address'),'class'=>'my_input'])->label(false)?> 
            <?=$form->field($model, 'message')->textarea(['placeholder'=>Yii::t('app','Message'),'class'=>'my_input'])->label(false)?>
            
            
       
            <?= Html::submitButton(Yii::t('app','Send'), ['class'=>'btn_red']) ?>
          <?php ActiveForm::end(); ?>
        </div>
      </div>
      <div class="col-md-6">
        <div id="map">
        </div>
        <script>
          function initMap () {
            var element = document.getElementById('map');

            var options = {
              zoom : 15,
              center:{lat:<?=$company->coordinate_x?>,lng:<?=$company->coordinate_y?>}
            }

            var myMap = new google.maps.Map(element,options);

            var marker = new google.maps.Marker({
              position:{lat:<?=$company->coordinate_x?>,lng:<?=$company->coordinate_y?>},
              map: myMap
            });

            var InfoWindow = new google.maps.InfoWindow({
              content: '<?=$company->address?>'
            });


            marker.addListener('click',function(){
              InfoWindow.open(myMap, marker);
            });
          }
        </script>
      </div>
    </div>
  </div>
</section>
<script  async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0nNC2JY5h2LxGdKCTXSXMV5ZNDrpwvvA&callback=initMap"></script>