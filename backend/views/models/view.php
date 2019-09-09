<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Models */
?>
<div class="models-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_model',
            'mark_id',
        ],
    ]) ?>

</div>
