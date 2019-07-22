<?php

use yii\widgets\DetailView;
$langs=backend\models\Lang::getLanguages();
/* @var $this yii\web\View */
/* @var $model backend\models\Transports */
?>
<div class="transports-view">
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
                        'attribute'=>'driver',
                        'label'=>Yii::t('app','Driver',null,$lang->url),
                        'value'=>($lang->url=="ru")?$model->driver:$drivers[$lang->url],
                    ],
                    [
                        'attribute'=>'model',
                        'label'=>Yii::t('app','Model',null,$lang->url),
                        'value'=>($lang->url=="ru")?$model->model:$models[$lang->url],
                    ],
                    [
                        'attribute'=>'mark',
                        'label'=>Yii::t('app','Mark',null,$lang->url),
                        'value'=>($lang->url=="ru")?$model->mark:$marks[$lang->url],
                    ],
        ],
    ]) ?>
            
        </p>
     </div>
    <?php $i++; endforeach;?>
  </div>
   

</div>
