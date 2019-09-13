<?php $models = $dataProvider->getModels(); ?>
<div class="messages messages-img" style="height: 75%; overflow-y: scroll;">
    <?php if (count($models) == 0): ?>
         <h4 style="text-align: center;"><?=Yii::t('app','You don’t have anything yet')?></h4>
    <?php else: ?>
    <?php foreach ($models() as $key => $value): ?>
        <div class="item item-visible">
            <div class="image">
                <img src="<?=$adminka?>/extra/images/users/user.jpg" alt="Dmitry Ivaniuk">
            </div>                                
            <div class="text">
                <div class="heading">
                    <a href="#">Dmitry Ivaniuk</a>
                    <span class="date">08:39</span>
                </div>                                    
                Integer et ipsum vitae urna mattis dictum. Sed eu sollicitudin nibh, in luctus velit.
            </div>
        </div>
         <div class="item in item-visible">
            <div class="image">
                <img src="<?=$adminka?>/extra/images/users/user2.jpg" alt="John Doe">
            </div>
            <div class="text">
                <div class="heading">
                    <a href="#">John Doe</a>
                    <span class="date">08:58</span>
                </div>
                Curabitur et euismod urna?
            </div>
        </div>
    <?php endforeach ?>
    <?php endif ?>
</div>                        

<div class="panel panel-default push-up-10">
    <div class="panel-body panel-body-search">
        <div class="input-group">
            <div class="input-group-btn">
                <input type="file" class="file_input" id="filesw" style="display: none;">
                <label class="btn btn-default" for="filesw"><img src="/images/file_chat.svg" alt=""></label>
            </div>
            
            <input type="text" class="form-control" placeholder="Your message...">
            <div class="input-group-btn">
                <button class="btn btn-default">Send</button>
            </div>
        </div>
    </div>
</div>