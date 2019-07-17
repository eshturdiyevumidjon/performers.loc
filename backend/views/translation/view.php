<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Translation */
?>
<div class="translation-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url_id:url',
            'text:ntext',
        ],
    ]) ?>

</div>
