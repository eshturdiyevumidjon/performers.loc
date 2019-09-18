<?php
	$i=1;

?>

<?php if (count($messages) > 0): ?>
	<?php foreach ($messages as $key => $value): ?>
		

		<?php if($i != 1) $k = Yii::$app->formatter->asDate($value->date_cr, 'php:d') - Yii::$app->formatter->asDate($old_value->date_cr, 'php:d');?>
            <p align="center"><span><?=($i == 1 || $k == 1) ? $value->getDateCreate() : "";?></span></p>
            <div class="user<?=($value->from == Yii::$app->user->identity->id)? '2' : '1'?> user_chats">
            	<div class="avatar">
                    <?=$value->from0->getUserAvatar('head')?>
		        </div>
                <div>
		          <div class="sms" style="width: 100%;">
		            <p><?=$value->text?></p>
		            <span class="time_sms"><?=$value->getDateTime()?></span>
		          </div>
		          <?php if ($value->file): ?>
		          <div class="sms down_file">
		            <a href="/admin/uploads/chat/<?=$value->file?>"><img src="/images/file-download.svg" alt=""></a>
		            <span class="size_file"><?=$value->getFileSize()?>&nbsp;&nbsp; <?=$value->getFileExtension()?></span>
		            <span class="time_sms"><?=$value->getDateTime()?></span>
		          </div>
                  <?php endif ?>
		        </div>
            </div>
       
        <?php $i++; ?>
        <?php $old_value = $value ?>
		
      
	 

	<?php endforeach ?>
<?php endif ?>     <!-- <div class="user1 user_chats">
	        <div class="avatar">
	          <img src="/images/user.jpg" alt="">
	        </div>
	        <div>
	          <div class="sms">
	            <img src="/images/girll.jpg" alt="">
	            <span class="time_sms">12:15</span>
	          </div>
	        </div> -->
