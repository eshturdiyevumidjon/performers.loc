<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form4">

    <?php $form = ActiveForm::begin(); ?>

   <!--  <?= $form->field($model, 'payed_sum')->textInput() ?> -->

    <?= $form->field($model, 'status')->textInput() ?>

   <!--  <?= $form->field($model, 'date_cr')->textInput() ?> -->

    <?= $form->field($model, 'date_close')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <!-- <?= $form->field($model, 'user_id')->textInput() ?> -->

    <?= $form->field($model, 'shipping_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'delivery_address')->textarea(['rows' => 6]) ?>

<!--     <?= $form->field($model, 'shipping_coordinate_x')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_coordinate_y')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_coordinate_x')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_coordinate_y')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'date_begin')->textInput() ?>

    <?= $form->field($model, 'offer_your_price')->textInput() ?>

    <?= $form->field($model, 'promo_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

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
