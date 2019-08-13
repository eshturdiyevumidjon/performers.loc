<h1><?=$this->title?></h1>
  <ul class="nav tab_styles_nav">
    <li><a data-toggle="tab" class="active show" href="#ff0"><?=Yii::t('app','Customer')?></a></li>
    <li><a data-toggle="tab" href="#ff1"><?=Yii::t('app','Performer')?></a></li>
  </ul>
      <?php $form = ActiveForm::begin(['options'=>['class'=>'input_styles','id'=>'customer']]); ?>

    <div id="ff0" class="tab-pane in active">
            <?=$form->field($modelCustomer,'username')->textInput(['placeholder'=>$modelCustomer->getAttributeLabel('username'),'class'=>'my_input'])->label(false)?>
            <?=$form->field($modelCustomer,'phone')->textInput(['placeholder'=>$modelCustomer->getAttributeLabel('phone'),'class'=>'my_input'])->label(false)?>
            <?=$form->field($modelCustomer,'email')->textInput(['placeholder'=>$modelCustomer->getAttributeLabel('email'),'class'=>'my_input'])->label(false)?>
            <?=$form->field($modelCustomer,'password')->textInput(['placeholder'=>$modelCustomer->getAttributeLabel('password'),'class'=>'my_input'])->label(false)?>
           <?=$form->field($modelCustomer,'repassword')->textInput(['placeholder'=>$modelCustomer->getAttributeLabel('repassword'),'class'=>'my_input'])->label(false)?>
    </div>
    
    <div id="ff1" class="tab-pane fade">
      <ul class="nav inner_nav">
        <li><a href="#d1" data-toggle="tab" class="active show">1</a></li>
        <li><a href="#d2" data-toggle="tab">2</a></li>
      </ul>
      <div class="tab-content">
        <div id="d1" class="tab-pane in active">
          <?=$form->field($modelPerformer,'username')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('username'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelPerformer,'phone')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('phone'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelPerformer,'email')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('email'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelPerformer,'password')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('password'),'class'=>'my_input'])->label(false)?>
          <?=$form->field($modelPerformer,'repassword')->textInput(['placeholder'=>$modelPerformer->getAttributeLabel('repassword'),'class'=>'my_input'])->label(false)?>
        </div>
        <div id="d2" class="tab-pane fade">
          <label for=""><?=Yii::t('app','Verify phone number')?> </label>
          <div class="form_big_groups d-flex justify-content-between">
            <div class="form-group">
              <input type="tel" placeholder="<?=Yii::t('app','Phone number')?>" value="+998 90 937 86 04">
            </div>
            <a href="#" class="reload"><span class="aft_back"></span><img src="/images/reload.svg" alt=""></a>
          </div>
          <div class="form-group">
            <input type="password" placeholder="<?=Yii::t('app','Code')?>">

          </div>
            <a href="#" class="backto"><span class="aft_back"></span><img src="/images/arrow-left.svg" alt=""></a>
        </div>
      </div>
    </div>
      <?php ActiveForm::end()?>

