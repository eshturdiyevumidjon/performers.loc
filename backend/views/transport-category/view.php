<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TransportCategory */
$langs=backend\models\Lang::getLanguages();

?>
<div class="transport-category-view">
 <ul class="nav nav-tabs" style="margin-top:2px;">
    <?php foreach($langs as $lang):?>
    <li class="<?=($i==0)?'active':''?>">
        <a data-toggle="tab" href="#<?=$lang->url?>"><?=explode('-',$lang->name)[1]?></a>
    </li>
    <?php $i++; endforeach;?>
   </ul>

  <div class="tab-content">   
     
    <?php $i=0; foreach($langs as $lang):?>
     <div id="<?=$lang->url?>" class="tab-pane fade <?=($i==0)?'in active':''?>">
        <p>
              <?php
          
              echo DetailView::widget([
                'model' => $model,
                 'attributes' => [ 
                    [
                        'attribute'=>'name',
                        'format'=>'html',
                        'label'=>Yii::t('app','Title'),
                        'value'=>(($lang->url=="ru")?$model->name:$names[$lang->url]),
                    ],
        ],
    ]) ?>
            
        </p>
     </div>
    <?php $i++; endforeach;?>
  </div>
</div>
