<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\News */
$langs=backend\models\Lang::getLanguages();

?>
<div class="news-view">
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
                        'attribute'=>'fone',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->getImage('_columns');
                        },
                    ],

                    [
                        'attribute'=>'title',
                        'format'=>'html',
                        'label'=>Yii::t('app','Title'),
                        'value'=>(($lang->url=="ru")?$model->title:$titles[$lang->url]),
                    ],
                    [
                        'attribute'=>'text',
                        'format'=>'html',
                        'label'=>Yii::t('app','Text'),
                        'value'=>($lang->url=="ru")?$model->text:$texts[$lang->url],
                        'contentOptions' => ['class' => 'bg-red','style'=>'word-break: break-all;'],
                    ],
                    'date_cr',
                    
        ],
    ]) ?>
            
        </p>
     </div>
    <?php $i++; endforeach;?>
  </div>
</div>
