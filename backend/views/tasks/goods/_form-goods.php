<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form3">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'payed_sum')->textInput() ?> -->

    <!-- <?= $form->field($model, 'status')->textInput() ?> -->

    <!-- <?= $form->field($model, 'date_cr')->textInput() ?> -->

    <!-- <?= $form->field($model, 'date_close')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>
 -->
    <!-- <?= $form->field($model, 'user_id')->textInput() ?> -->

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

    <hr>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'offer_your_price')->widget(\yii\widgets\MaskedInput::className(),['mask' => '9','clientOptions' => ['repeat' => 10, 'greedy' => false]]) ?>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'weight')->textInput() ?>
        </div>
        <div class="col-md-6">
             <?= $form->field($model, 'width')->textInput() ?>
        </div>

        <div class="col-md-6">
             <?= $form->field($model, 'length')->textInput() ?>

        </div>
        <div class="col-md-6">
             <?= $form->field($model, 'height')->textInput() ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'items')->checkboxList(
                [
                       '1' => Yii::t('app','Oversized'),'2' => Yii::t('app','Fragile'),'3' => Yii::t('app','Dangerous')
            ],
            [
                'item' => function($index, $label, $name, $checked, $value) {
                    $checked = $checked ? 'checked' : '';
                    return "<label class='checkbox col-md-3' style='font-weight: normal;'><input type='checkbox' {$checked} name='{$name}' value='{$value}'>{$label}</label>";
                }
            ]
            ) ?>
        </div>
    </div>        






    <?= $form->field($model, 'loading_required_status')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'lift')->textInput() ?>

    <hr>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
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
