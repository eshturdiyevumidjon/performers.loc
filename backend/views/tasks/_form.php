<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'payed_sum')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'date_cr')->textInput() ?>

    <?= $form->field($model, 'date_close')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'shipping_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'delivery_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'shipping_coordinate_x')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_coordinate_y')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_coordinate_x')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_coordinate_y')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_begin')->textInput() ?>

    <?= $form->field($model, 'offer_your_price')->textInput() ?>

    <?= $form->field($model, 'promo_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'adult_passengers')->textInput() ?>

    <?= $form->field($model, 'child_count')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'flight_number_status')->textInput() ?>

    <?= $form->field($model, 'flight_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meeting_with_sign_status')->textInput() ?>

    <?= $form->field($model, 'meeting_with_sign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'car_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'car_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'car_on_the_go')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'length')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'classification')->textInput() ?>

    <?= $form->field($model, 'loading_required_status')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'lift')->textInput() ?>

    <?= $form->field($model, 'shipping_house_type')->textInput() ?>

    <?= $form->field($model, 'shipping_house_floor')->textInput() ?>

    <?= $form->field($model, 'shipping_house_lift')->textInput() ?>

    <?= $form->field($model, 'shipping_house_area')->textInput() ?>

    <?= $form->field($model, 'delivery_house_type')->textInput() ?>

    <?= $form->field($model, 'delivery_house_floor')->textInput() ?>

    <?= $form->field($model, 'delivery_house_lift')->textInput() ?>

    <?= $form->field($model, 'delivery_house_area')->textInput() ?>

    <?= $form->field($model, 'item_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alert_email')->textInput() ?>

    <?= $form->field($model, 'view_performers')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
