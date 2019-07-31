<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form1">

    <?php $form = ActiveForm::begin(); ?>

  <!--   <?= $form->field($model, 'payed_sum')->textInput() ?> -->

  <!--   <?= $form->field($model, 'status')->textInput() ?> -->

   <!--  <?= $form->field($model, 'date_cr')->textInput() ?> -->

    

 <!--    <?= $form->field($model, 'position')->textInput() ?> -->

   <!--  <?= $form->field($model, 'user_id')->textInput() ?> -->
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'shipping_address')->textarea(['rows' => 2]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'delivery_address')->textarea(['rows' => 2]) ?>
        </div>
    </div>

<!--     <?= $form->field($model, 'shipping_coordinate_x')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_coordinate_y')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_coordinate_x')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_coordinate_y')->textInput(['maxlength' => true]) ?> -->
    <div class="row">
        <div class="col-md-6">
                <?= $form->field($model, 'date_begin')->widget(DatePicker::classname(), [
                        'pluginOptions' => [
                             'autoclose'=>true
                         ]
                     ])->hint(Yii::t('app',"Start date and time when the passengers is ready to ship"));?>
        </div>
         <div class="col-md-6">
                <?= $form->field($model, 'date_close')->widget(DatePicker::classname(), [
                        'pluginOptions' => [
                             'autoclose'=>true
                         ]
                     ])->hint(Yii::t('app',"The maximum possible date and time when the passengers must be a destination point"));?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <label><?=Yii::t('app','Passengers')?></label>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'adult_passengers')->widget(\yii\widgets\MaskedInput::className(),[
                                'mask' => '9',
                                'clientOptions' => ['repeat' => 2, 'greedy' => false]
                            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'child_count')->widget(\yii\widgets\MaskedInput::className(),[
                                'mask' => '9',
                                'clientOptions' => ['repeat' => 2, 'greedy' => false]
                            ]) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'offer_your_price')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false]]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->widget(\kartik\select2\Select2::classname(),[
                'data'=>$model->category,
                'language'=>'ru',
                'size'=>\kartik\select2\Select2::SMALL,
                'pluginOptions'=>[
                    'tags'=>true,
                ]
            ]) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'flight_number_status')->checkbox(['id'=>'sign']) ?>
            <?= $form->field($model, 'flight_number')->textInput(['maxlength' => true,'id'=>'sign_input'])->label(false) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'meeting_with_sign_status')->checkbox(['id'=>'meeting']) ?>
            <?= $form->field($model, 'meeting_with_sign')->textInput(['maxlength' => true,'id'=>'meeting_input'])->label(false) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <label><?=Yii::t('app','Additional terms')?></label>
        </div>
        <div class="col-md-12">
            <div class="form-group">
            <?= $form->field($model, 'alert_email')->checkbox() ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'promo_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">

        <div class="col-md-12">
            <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    
    
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?php
$this->registerJS(<<<JS
    $(document).ready(function(){
            if($(this).is(":checked")){
                    //$("#sign_input").attr("disabled","false");
                    $('#sign_input').show();
                }
                else
                {
                    //$("#sign_input").attr("disabled","true");
                    $('#sign_input').hide();
                }
            $('#sign').change(function(){
                if($(this).is(":checked")){
                    //$("#sign_input").attr("disabled","false");
                    $('#sign_input').show();
                }
                else
                {
                    //$("#sign_input").attr("disabled","true");
                    $('#sign_input').hide();
                }
                });
             if($(this).is(":checked")){
                    $('#meeting_input').show();
                }
                else
                {
                    $('#meeting_input').hide();
                }
            $('#meeting').change(function(){
                if($(this).is(":checked")){
                    $('#meeting_input').show();
                }
                else
                {
                    $('#meeting_input').hide();
                }
                });
        });
JS
);
?>