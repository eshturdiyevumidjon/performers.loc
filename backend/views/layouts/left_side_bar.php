<?php
use yii\helpers\Url;
use backend\models\Lang;
$pathInfo = Yii::$app->request->pathInfo;
?>
<div class="page-sidebar">
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="<?= Yii::$app->homeUrl ?>"> <?=Yii::$app->name?> </a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="/extra/images/users/avatar.jpg" alt="John Doe"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="/extra/images/users/avatar.jpg" alt="John Doe"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?=Yii::$app->user->identity->username?></div>
                    <div class="profile-data-title">Web Developer/Designer</div>
                </div>
                <div class="profile-controls">
                    <a href="/user/profile" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>                                                                        
        </li>
        <li class="xn-title"><?=Yii::t('app','Navigation')?></li>
        <li <?= ($pathInfo == 'site/dashboard' ? 'class="active"' : '')?>>
            <a href="/site/dashboard"><span class="fa fa-desktop"></span> <span class="xn-text"><?=Yii::t('app','Dashboard')?></span></a>                        
        </li>                    
        
        <li <?= ($pathInfo == 'user/index' ? 'class="active"' : '')?>>
            <a href="/user/index"><span class="fa fa-user"></span> <span class="xn-text"><?=Yii::t('app','Users')?></span></a>                        
        </li>  
       <!--  <li class="xn-openable">
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text"><?=Yii::t('app','Clients')?></span></a>                        
            <ul>
                <li class=""><a href=""><span class="fa fa-tasks"></span><?=Yii::t('app','Customers')?></a></li>                            
                <li><a href=""><span class="fa fa-truck"></span><?=Yii::t('app','Performers')?></a></li>
            </ul>
        </li> -->  
        <?php if(Yii::$app->user->identity->type!=4):?>
        <li <?= ($pathInfo == 'transports/index' ? 'class="active"' : '')?>>
            <a href="/transports/index"><span class="fa fa-truck"></span> <span class="xn-text"><?=Yii::t('app','Transports')?></span></a>
        <?php endif;?>                       
        </li>          
        <?php if(Yii::$app->user->identity->type!=4&&Yii::$app->user->identity->type!=3):?>
        <li <?= (($pathInfo == 'language/index'||$pathInfo=='translation/index') ? 'class="xn-openable active"' : 'xn-openable ')?>>
            <a href="#"><span class="fa fa-gear"></span> <span class="xn-text"><?=Yii::t('app','Settings')?></span></a>
            <ul>                            
                <li  <?= ($pathInfo == 'language/index' ? 'class="active"' : '')?>>
                            <a href="/language/index"><span class="fa fa-language"></span><?=Yii::t('app','Language')?></a>
                </li>
            </ul>
        </li>
        <?php endif;?>                       
        
    </ul>
</div>