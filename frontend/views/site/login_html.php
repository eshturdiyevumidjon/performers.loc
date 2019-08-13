<?php
use yii\bootstrap\ActiveForm;
?>
  <?php 
  echo "<pre>";
  print_r($post);
  echo "</pre>";
  ?>
   <?php $form = ActiveForm::begin(['options'=>['class'=>'input_styles']]); ?>
      <div class="form-group">
        <input type="email" name="LoginForm[email]" placeholder="Номер телефона или E-mail" required="">
      </div>
      <div class="form-group">
        <input type="password" name="LoginForm[password]" placeholder="Пароль" required="">
      </div>
      <div class="d-flex align-items-center justify-content-between defau">
        <div class="form-group_checkbox">
            <input type="checkbox" id="sdvs" name="LoginForm[rememberMe]">
            <label for="sdvs">Запомнить меня</label>
        </div>
        <a href="/site/request-password-reset" class="forget_pass"><?=Yii::t('app','Forgot your password?')?></a>
      </div>
    <?php ActiveForm::end(); ?> 
