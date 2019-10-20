<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$lang = Yii::$app->language;
?>


<?php $form = ActiveForm::begin(['id'=>"order_to_request_form",'options'=>['enctype'=>'multipart/form-data', 'class'=>'input_styles']]); ?>
   <?= $form->field($model, 'amount')->widget(\yii\widgets\MaskedInput::className(),
        [
            'mask' => '9',
            'clientOptions' => [
                'repeat' => 10, 
                'greedy' => false,
            ],
            'options'=>[
                'class'=>'my_input',
                'placeholder'=>$model->getAttributeLabel('amount'),
                'onkeyup'=>'
                    var amount = $("#amount").val();
                    var price = $(this).val();
                    var protsent = price/amount;
                    protsent = 100 * protsent;
                    $("#protsent").html(protsent.toFixed(2));
                '
            ]
        ]
    )->label(false) ?>
    <?='<p class="opac">'.Yii::t('app','It\'s not hard. There are two steps in total: a questionnaire and a subscription to tasks. It will take about 5 minutes.').'</p>';?>
    <input type="hidden" name="" id="amount" class="hide" value="<?=$model->request->price?>">
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
  <p><?=Yii::t('app','Paid')?>: <b><span id="protsent"><?php printf("%.2f", 1100*$model->amount/$model->request->price);?></span> %</b></p>
  

<?php ActiveForm::end(); ?>

