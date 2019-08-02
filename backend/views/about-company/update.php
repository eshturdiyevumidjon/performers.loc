<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AboutCompany */

$this->title = Yii::t('app','Update');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
