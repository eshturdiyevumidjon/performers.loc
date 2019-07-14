<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
$model=new User();
?>

<div class="users-form" style="padding: 20px;">
    <?php $form = ActiveForm::begin(); ?>
	<div class="row">

	    <div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[image]" value="1" <?=($session['User[image]']===null || $session['User[image]'] == 1) ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('image')?>
	        </label>
	    </div>

	    <div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[fio]" value="1" <?= ($session['User[fio]']===null || $session['User[fio]'] == 1) ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('fio')?>
	        </label>
	    </div>

	    <div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[phone]" value="1" <?= ($session['User[phone]'] === null || $session['User[phone]'] == 1) ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('phone')?>
	        </label>
	    </div>
	</div>
	<hr/>
	<div class="row">
		
		<div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[created_at]" value="1" <?=$session['User[created_at]'] == 1 ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('created_at')?>
	        </label>
	    </div>
		
		<div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[birthday]" value="1" <?=$session['User[birthday]'] == 1 ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('birthday')?>
	        </label>
	    </div>

	    <div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[type]" value="1" <?=$session['User[type]'] == 1 ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('type')?>
	        </label>
	    </div>
	</div>
	<hr/>
	<div class="row">
		
		<div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[updated_at]" value="1" <?=$session['User[updated_at]'] == 1 ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('updated_at')?>
	        </label>
	    </div>
		
		<div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[status]" value="1" <?=$session['User[status]'] == 1 ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('status')?>
	        </label>
	    </div>
	    <div class="col-md-4">
	        <label>
	            <input type="checkbox" name="User[username]" value="1" <?=$session['User[username]'] == 1 ? 'checked=""' : '' ?> > 
	            <?=$model->getAttributeLabel('username')?>
	        </label>
	    </div>
	</div>

	<hr/>
    <?php ActiveForm::end();  ?>
</div>
