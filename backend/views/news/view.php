<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\News */
?>
<div class="news-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'text:ntext',
            'fone',
            'date_cr',
        ],
    ]) ?>

</div>
