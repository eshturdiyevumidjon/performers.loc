<?php
use yii\bootstrap\Alert;
use yii\widgets\Breadcrumbs;
?>          
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <div class="page-content-wrap">             
        <div class="row">
            <div class="col-md-12">
                <?= $content ?>
            </div> 
        </div>
    </div>