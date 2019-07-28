<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AboutCompany */
?>
<div class="about-company-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'logo',
            'name',
            'phone',
            'email:email',
            'facebook',
            'instagram',
            'address:ntext',
            'coordinate_x',
            'coordinate_y',
        ],
    ]) ?>

</div>
