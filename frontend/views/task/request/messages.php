<?php
	$i=1;
?>
<?php if (count($messages) > 0): ?>
	<?php foreach ($messages as $key => $value): ?>
		
		<?php if($i != 1) $k = Yii::$app->formatter->asDate($value->date_cr, 'php:d') - Yii::$app->formatter->asDate($old_value->date_cr, 'php:d');?>
            <p align="center"><span><?=($i == 1 || $k == 1) ? $value->getDateCreate() : "";?></span></p>
            <?php if ($value->from == Yii::$app->user->identity->id): ?>
        	   <div class="user2 user_chats">
        	   	<?php if ($value->text != "" && $value->file): ?>
    	   		<div>
	                <div class="sms">
		                <p><?=$value->text?></p>
	                   <span class="time_sms"><?=$value->getDateTime()?></span>
	                </div>
	                <div class="sms down_file">
	                  <a href="#"><img src="/images/file-download.svg" alt=""></a>
	                  <!-- <p>Здравствуйте! Я могу Вам чем-то помочь?</p> -->
	                 <span class="size_file"><?=$value->getFileSize()?>&nbsp;&nbsp; <?=$value->getFileExtension()?></span>
	            	<span class="time_sms"><?=$value->getDateTime()?></span>
	                </div>
                </div>
        	   	<?php endif ?>
        	   	<?php if ($value->text != "" && !($value->file)): ?>
        	   		<div class="sms">
			            <p><?=$value->text?></p>
			            <span class="time_sms"><?=$value->getDateTime()?></span>
					</div>
        	   	<?php endif ?>
        	   	<?php if ($value->text == "" && $value->file): ?>
    	   		<div>
        	   		<div class="sms down_file">
		            	<a href="/task/download-file?id=<?=$value->id?>"><img src="/images/file-download.svg" alt=""></a>
		            	<span class="size_file"><?=$value->getFileSize()?>&nbsp;&nbsp; <?=$value->getFileExtension()?></span>
		            	<span class="time_sms"><?=$value->getDateTime()?></span>
		          	</div>
				</div>
        	   	<?php endif ?>
	            <div class="avatar">
				    <img src="<?=$value->from0->getImageAddress()?>" alt="">
	            </div>
            </div>
            <?php else: ?>
            	<div class="user1 user_chats">
	        		<div class="avatar">
					    <img src="<?=$value->from0->getImageAddress()?>" alt="">
		            </div>
	              	<?php if ($value->text != "" && $value->file): ?>
		    	   		<div>
			                <div class="sms">
				                <p><?=$value->text?></p>
			                   <span class="time_sms"><?=$value->getDateTime()?></span>
			                </div>
			               <div class="sms down_file">
				            	<a href="/task/download-file?id=<?=$value->id?>"><img src="/images/file-download.svg" alt=""></a>
				            	<span class="size_file"><?=$value->getFileSize()?>&nbsp;&nbsp; <?=$value->getFileExtension()?></span>
				            	<span class="time_sms"><?=$value->getDateTime()?></span>
				          	</div>
		                </div>
	        	   	<?php endif ?>
	        	   	<?php if ($value->text != "" && !($value->file)): ?>
	        	   		<div class="sms">
				            <p><?=$value->text?></p>
				            <span class="time_sms"><?=$value->getDateTime()?></span>
						</div>
	        	   	<?php endif ?>
	        	   	<?php if ($value->text == "" && $value->file): ?>
		    	   		<div>
		        	   		<div class="sms down_file">
				            	<a href="/task/download-file?id=<?=$value->id?>"><img src="/images/file-download.svg" alt=""></a>
				            	<span class="size_file"><?=$value->getFileSize()?>&nbsp;&nbsp; <?=$value->getFileExtension()?></span>
				            	<span class="time_sms"><?=$value->getDateTime()?></span>
				          	</div>
						</div>
	        	   	<?php endif ?>
                </div>
            <?php endif ?>
              	
        <?php $i++; ?>
        <?php $old_value = $value ?>

	<?php endforeach ?>
<?php endif ?>  

