<?php
use yii\helpers\Url;
use backend\models\Lang;
$pathInfo = Yii::$app->request->pathInfo;
$adminka = Yii::$app->params['adminka'];
$user = \common\models\User::find()->where(['id'=>Yii::$app->user->identity->id])->one();
?>
<div class="page-sidebar">
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="<?= Yii::$app->homeUrl ?>"> <?=Yii::$app->name?> </a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="<?=$adminka?>/extra/images/users/avatar.jpg" alt="John Doe"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="<?=$adminka?>/extra/images/users/avatar.jpg" alt="John Doe"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?=$user->username?></div>
                    <div class="profile-data-title"><?=$user->getTypeDescription()?></div>
                </div>
                <div class="profile-controls">
                    <a href="<?=$adminka?>user/profile" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>                                                                        
        </li>
        <li <?= ($pathInfo == 'site/dashboard' ? 'class="active"' : '')?>>
            <a href="<?=$adminka?>site/dashboard"><span class="fa fa-desktop"></span> <span class="xn-text"><?=Yii::t('app','Dashboard')?></span></a>                        
        </li>                    
        <li <?= ($pathInfo == 'about-company/index' ? 'class="active"' : '')?>>
            <a href="<?=$adminka?>about-company/index"><span class="fa fa-building"></span> <span class="xn-text"><?=Yii::t('app','About Company')?></span></a>
        </li>
        <li <?= ($pathInfo == 'user/index' ? 'class="active"' : '')?>>
            <a href="<?=$adminka?>user/index"><span class="fa fa-user"></span> <span class="xn-text"><?=Yii::t('app','Users')?></span></a>                        
        </li>  
         <!--<li <?php // ($pathInfo == 'chat/main' ? 'class="active"' : '')?>>
            <a href="<?php //$adminka?>chat/main"><span class="fa fa-envelope"></span> <span class="xn-text"><?php //Yii::t('app','Chat')?></span></a>
        </li>-->
        <li class="xn-openable <?= ((($pathInfo == 'tasks/index-passangers')||($pathInfo == 'tasks/index-vehicles')||($pathInfo == 'tasks/index-goods')||($pathInfo == 'tasks/index-help')) ? 'active' : '')?>">
            <a href="#"><span class="fa fa-tasks"></span> <span class="xn-text"><?=Yii::t('app','Tasks')?></span></a>                        
            <ul>
                <li  <?= ($pathInfo == 'tasks/index-passangers' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>tasks/index-passangers">
                                <span class="fa fa-caret-right"></span>
                                    <?=Yii::t('app','Passenger Transportation')?>
                            </a>
                </li>
                <li  <?= ($pathInfo == 'tasks/index-vehicles' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>tasks/index-vehicles">
                                <span class="fa fa-caret-right"></span>
                                <?=Yii::t('app','Transportation of cars and equipment')?>
                            </a>
                </li>
                <li  <?= ($pathInfo == 'tasks/index-goods' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>tasks/index-goods">
                                <span class="fa fa-caret-right"></span>
                                <?=Yii::t('app','Freight transportation')?>
                            </a>
                </li>
                <li  <?= ($pathInfo == 'tasks/index-help' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>tasks/index-help">
                                <span class="fa fa-caret-right"></span>
                                <?=Yii::t('app','Relocation assistance')?>
                            </a>
                </li>
            </ul>
        </li>  
        <li class="xn-openable <?= (($pathInfo == 'transports/index' || $pathInfo == 'drivers/index') ? 'active' : '')?>">
            <a href="#"><span class="fa fa-gear"></span> <span class="xn-text"><?=Yii::t('app','Transports')?></span></a>
            <ul>                            
                <li  <?= ($pathInfo == 'transports/index' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>transports/index"><span class="fa fa-truck"></span><?=Yii::t('app','Transports')?></a>
                </li>
                <li  <?= ($pathInfo == 'drivers/index' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>drivers/index"><span class="fa fa-users"></span><?=Yii::t('app','Drivers')?></a>
                </li>
            </ul>
        </li>
        <li <?= ($pathInfo == 'banners/index' ? 'class="active"' : '')?>>
            <a href="<?=$adminka?>banners/index"><span class="fa fa-flag"></span> <span class="xn-text"><?=Yii::t('app','Banners')?></span></a>
        </li>
        <li <?= ($pathInfo == 'news/index' ? 'class="active"' : '')?>>
            <a href="<?=$adminka?>news/index"><span class="fa fa-list-alt"></span> <span class="xn-text"><?=Yii::t('app','News')?></span></a>
        </li> 
        <li <?= ($pathInfo == 'transport-category/index' ? 'class="active"' : '')?>>
            <a href="<?=$adminka?>transport-category/index"><span class="fa fa-list"></span> <span class="xn-text"><?=Yii::t('app','Category of transports')?></span></a>
        </li>           
        <?php if(Yii::$app->user->identity->type!=4&&Yii::$app->user->identity->type!=3):?>
        <li class="xn-openable <?= (($pathInfo == 'language/index' || $pathInfo == 'settings/index' || $pathInfo == 'chavo/index') ? 'active' : '')?>">
            <a href="#"><span class="fa fa-gear"></span> <span class="xn-text"><?=Yii::t('app','Settings')?></span></a>
            <ul>                            
                <li  <?= ($pathInfo == 'language/index' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>language/index"><span class="fa fa-language"></span><?=Yii::t('app','Language')?></a>
                </li>
                <li  <?= ($pathInfo == 'settings/index' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>settings/index"><span class="fa fa-language"></span><?=Yii::t('app','Settings')?></a>
                </li>
                  <li  <?= ($pathInfo == 'chavo/index' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>chavo/index"><span class="fa fa-tasks"></span><?=Yii::t('app','Chavo')?></a>
                </li>
            </ul>
        </li>

         <li class="xn-openable <?= (($pathInfo == 'feedback/index' || $pathInfo == 'replies/index') ? 'active' : '')?>">
            <a href="#"><span class="fa fa-gear"></span> <span class="xn-text"><?=Yii::t('app','Feedbacks')?></span></a>
            <ul>                            
                <li  <?= ($pathInfo == 'feedback/index' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>feedback/index"><span class="fa fa-inbox"></span><?=Yii::t('app','Feedbacks')?></a>
                </li>
                <li  <?= ($pathInfo == 'replies/index' ? 'class="active"' : '')?>>
                            <a href="<?=$adminka?>replies/index"><span class="fa fa-reply"></span><?=Yii::t('app','Answers')?></a>
                </li>
            </ul>
        </li>
        
        <?php endif;?>                       
       
    </ul>
</div>