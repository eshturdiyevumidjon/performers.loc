<?php
$adminka = Yii::$app->params['adminka'];
$i = 1;
?>
<div class="messages messages-img">
    <?=\common\widgets\Alert::widget()?>
    <?php if (count($models) == 0): ?>
         
    <?php else: ?>
    <?php foreach ($models as $key => $value): ?>
       
        <?php if($i != 1) $k = Yii::$app->formatter->asDate($value->date_cr, 'php:d') - Yii::$app->formatter->asDate($old_value->date_cr, 'php:d');?>

        <?php if ($value->from == $from): ?>
            <p align="center"><span><?=($i == 1 || $k == 1) ? $value->getDateCreate() : "";?></span></p>
            <div class="item in item-visible">
                <div class="image">
                    <?=$value->from0->getUserAvatar('head')?>
                </div>
                <div class="text">
                    <div class="heading">
                        <span class="date"><?=$value->getDateTime()?></span>
                    </div>
                    <?=$value->text?>
                    <?php if ($value->file): ?>
                        <div class="mail-attachments">
                            <a href="<?=$adminka?>/uploads/chat/<?=$value->file?>" target="_blank "><span class="fa fa-paperclip"></span> <?=$value->getFileExtension()?></a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>

        <?php if ($value->to == $from): ?>
            <p align="center"><span><?=($i == 1 || $k == 1) ? $value->getDateCreate() : "";?></span></p>
            <div class="item item-visible">
                <div class="image">
                    <?=$value->from0->getUserAvatar('head')?>
                </div>
                <div class="text">
                    <div class="heading">
                        <span class="date"><?=$value->getDateTime()?></span>
                    </div>
                    <?=$value->text?>
                    <?php if ($value->file): ?>
                        <div class="mail-attachments">
                            <a href="<?=$adminka?>/uploads/chat/<?=$value->file?>" target="_blank "><span class="fa fa-paperclip"></span> <?=$value->getFileExtension()?></a>
                        </div>
                    <?php endif ?>
                    
                </div>

            </div>
        <?php endif ?>
        <?php $i++; ?>
        <?php $old_value = $value ?>
    <?php endforeach ?>
    <?php endif ?>
</div>                        
