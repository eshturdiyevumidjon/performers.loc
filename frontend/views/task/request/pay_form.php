<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$lang = Yii::$app->language;
?>
<?='<p class="opac">'.Yii::t('app','It\'s not hard. There are two steps in total: a questionnaire and a subscription to tasks. It will take about 5 minutes.').'</p>';?>

<?php $form = ActiveForm::begin(['id'=>"order_to_request_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles']]); ?>
 <div class="pay_div">
    <input type="radio" name="fwqq" id="tu1">
    <label for="tu1"><img src="/images/money_.svg" alt=""></label>
    <input type="radio" name="fwqq" id="tu2">
    <label for="tu2"><img src="/images/payme.svg" alt=""></label>
    <input type="radio" name="fwqq" id="tu3">
    <label for="tu3"><img src="/images/click.svg" alt=""></label>
    <input type="radio" name="fwqq" id="tu4">
    <label for="tu4"><img src="/images/yandex.svg" alt=""></label>
  </div>
  <p><?=Yii::t('app','On account')?>: <b>3 787.00 руб.</b></p>

<?php ActiveForm::end(); ?>

