<?php
use yii\helpers\Url;
use yii\helpers\Html;
use \backend\models\Tasks;
use yii\widgets\Pjax;

$language=Yii::$app->language;
$langs=\backend\models\Lang::getLanguages();
$pathInfo=Yii::$app->request->pathInfo;
$user=\common\models\User::find()->where(['id' => Yii::$app->user->identity->id])->one();
$hot_tasks = \backend\models\Tasks::find()->orderBy([
    'id' => SORT_DESC
    ])->limit(4)->all();
?>
<header <?=( $pathInfo == 'site/index' || $pathInfo == '')?'class="fixed_header"':''?>>
  <div class="container">
    <div class="d-flex justify-content-between align-items-center hdr_top">
      <div class="d-flex align-items-center">
        <a href="/site/index" class="logo"><img src="/images/logo.svg" alt=""></a>
        <div class="d-flex align-items-center notif">
          <div class="hamburger">
              <i class="fa fa-bars" aria-hidden="true"></i>
              <i class="fa fa-times" aria-hidden="true"></i>
          </div>
          <?php if(!Yii::$app->user->isGuest):?>
          <div class="dropdown notif_dropdown">
                  <a href="#" class="notification dropdown-toggle" data-toggle="dropdown" ><img src="/images/notification.svg" alt=""><img src="/images/notification_white.svg" alt=""></a>
                <!-- </button> -->
                <div class="dropdown-menu flex-column" aria-labelledby="dropdownMenuButton">
                  <?php foreach ($hot_tasks as $value): ?>
                    <a class="" href="/task/view?id=<?=$value->id?>">
                    <h5><?=Tasks::getInf()[$value->type-1][0]?></h5>
                    <p><?=$value->comment?></p>
                  </a>
                  </a>
                  <?php endforeach ?>
                </div>
              </div>
        <?php endif;?>
        </div>
      </div>
      <div class="d-flex align-items-center">
        <div class="dropdown language_h">
           <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" >
              <?=ucfirst($language)?>
            </button>
            <?php
              $str = "";
              $i=0;
              foreach (Yii::$app->request->queryParams as $key => $value) {
                $i++;
                $str .= $key."=".$value;
                if(count(Yii::$app->request->queryParams) != $i)$str .= '&';
              }
              $pathInfo = $pathInfo."?".$str;
            ?>
            <div class="dropdown-menu flex-column" aria-labelledby="dropdownMenuButton">
              <?php foreach($langs as $lang):?>
              <a <?=( $language == $lang->url ) ? 'class="active"':''?> href="<?= Url::to([$pathInfo, 'language' => $lang->url]) ?>">
                <?=ucfirst($lang->url)?>
                </a>
            <?php endforeach;?>
            </div>
        </div>
        <?php Pjax::begin(['enablePushState' => false, 'id' => 'personal-pjax']) ?>
        <?php if(Yii::$app->user->isGuest):?>
       <?=Html::a('<span class="aft_back"></span>'.Yii::t('app','Login / Register').' <i class="glyphicon glyphicon-plus"></i>', ['/site/login'],
        ['role'=>'modal-remote'/*'data-pjax'=>0*/, 'class'=>'enter_to_site'])?>
      <?php else:?>
        <div class="dropdown user_h">
          <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" >
            <?=$user->getUserAvatar('head')?>
            <span><?=$user->username?></span>
          </button>
          <div class="dropdown-menu flex-column" aria-labelledby="dropdownMenuButton2">
            <a href="/profile/index"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g><g><path fill="" d="M6 6.355c1.486 0 2.69-1.41 2.69-3.15C8.69.794 7.487.056 6 .056s-2.69.738-2.69 3.15c0 1.739 1.204 3.149 2.69 3.149z"/></g><g><path fill="" d="M11.941 10.99l-1.357-3.058a.681.681 0 0 0-.307-.327L8.17 6.51a.136.136 0 0 0-.144.012A3.337 3.337 0 0 1 6 7.21c-.73 0-1.43-.239-2.026-.69a.136.136 0 0 0-.144-.011L1.723 7.605a.681.681 0 0 0-.307.327L.06 10.99a.676.676 0 0 0 .62.954h10.642a.676.676 0 0 0 .62-.954z"/></g></g></g></svg><?=Yii::t('app','My profile')?></a>
           <a href="/profile/index"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g><g><path fill="" d="M6 6.355c1.486 0 2.69-1.41 2.69-3.15C8.69.794 7.487.056 6 .056s-2.69.738-2.69 3.15c0 1.739 1.204 3.149 2.69 3.149z"/></g><g><path fill="" d="M11.941 10.99l-1.357-3.058a.681.681 0 0 0-.307-.327L8.17 6.51a.136.136 0 0 0-.144.012A3.337 3.337 0 0 1 6 7.21c-.73 0-1.43-.239-2.026-.69a.136.136 0 0 0-.144-.011L1.723 7.605a.681.681 0 0 0-.307.327L.06 10.99a.676.676 0 0 0 .62.954h10.642a.676.676 0 0 0 .62-.954z"/></g></g></g></svg><?=Yii::t('app','My Orders')?></a>
            <?php if ($user->type_of_user == 3): ?>
              <?php if($user->type == 4): ?>
                <a href="/profile/change-type"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g><g><path fill="" d="M6 6.355c1.486 0 2.69-1.41 2.69-3.15C8.69.794 7.487.056 6 .056s-2.69.738-2.69 3.15c0 1.739 1.204 3.149 2.69 3.149z"/></g><g><path fill="" d="M11.941 10.99l-1.357-3.058a.681.681 0 0 0-.307-.327L8.17 6.51a.136.136 0 0 0-.144.012A3.337 3.337 0 0 1 6 7.21c-.73 0-1.43-.239-2.026-.69a.136.136 0 0 0-.144-.011L1.723 7.605a.681.681 0 0 0-.307.327L.06 10.99a.676.676 0 0 0 .62.954h10.642a.676.676 0 0 0 .62-.954z"/></g></g></g></svg><?=Yii::t('app','Performer\'s profile')?></a>
                <?php endif;
                 if($user->type == 3):?>
                <a href="/profile/change-type"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g><g><path fill="" d="M6 6.355c1.486 0 2.69-1.41 2.69-3.15C8.69.794 7.487.056 6 .056s-2.69.738-2.69 3.15c0 1.739 1.204 3.149 2.69 3.149z"/></g><g><path fill="" d="M11.941 10.99l-1.357-3.058a.681.681 0 0 0-.307-.327L8.17 6.51a.136.136 0 0 0-.144.012A3.337 3.337 0 0 1 6 7.21c-.73 0-1.43-.239-2.026-.69a.136.136 0 0 0-.144-.011L1.723 7.605a.681.681 0 0 0-.307.327L.06 10.99a.676.676 0 0 0 .62.954h10.642a.676.676 0 0 0 .62-.954z"/></g></g></g></svg><?=Yii::t('app','Customer\'s Profile')?></a>
              <?php endif;?>
              
            <?php endif ?>
            <a href="/profile/change-profile" class="settings_li"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-c82ad319-16e3-4f8b-946e-84e918a56e45)"><g><path fill="" d="M6.019 8.25a2.25 2.25 0 1 1 0-4.5 2.25 2.25 0 0 1 0 4.5zm5.542-3.124l-1.189-.198a4.478 4.478 0 0 0-.376-1.006l.76-.943a.524.524 0 0 0-.015-.68l-.473-.531a.525.525 0 0 0-.672-.096l-1.017.639a4.473 4.473 0 0 0-1.5-.677L6.88.439A.524.524 0 0 0 6.362 0H5.65a.523.523 0 0 0-.517.439l-.2 1.195a4.47 4.47 0 0 0-1.262.525l-.967-.69a.525.525 0 0 0-.676.055l-.503.504a.525.525 0 0 0-.056.677l.692.968c-.233.384-.41.805-.52 1.253l-1.202.2A.525.525 0 0 0 0 5.644v.712c0 .257.186.476.439.518l1.202.2c.09.369.222.72.397 1.047l-.757.938a.525.525 0 0 0 .016.679l.472.532a.525.525 0 0 0 .673.096l1.031-.648c.437.298.93.518 1.46.648l.2 1.195c.04.253.26.439.517.439h.712a.524.524 0 0 0 .518-.439l.2-1.195c.445-.11.864-.285 1.247-.516l1.007.72c.208.149.494.125.676-.057l.503-.503a.523.523 0 0 0 .056-.676l-.717-1.005a4.46 4.46 0 0 0 .52-1.257l1.19-.198A.524.524 0 0 0 12 6.356v-.712a.525.525 0 0 0-.44-.518z"/></g></g></g></svg><?=Yii::t('app','Settings')?></a>
            <?=Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-a040538d-a6d2-4680-971e-057cd608bf3d)"><g><g><path fill="" d="M7.572 10.388H1.407V1.612h6.165c.136 0 .247-.11.247-.247V.453a.248.248 0 0 0-.247-.247H.248A.248.248 0 0 0 0 .453v11.094c0 .137.11.247.248.247h7.324c.136 0 .247-.11.247-.247v-.912a.247.247 0 0 0-.247-.247z"/></g><g><path fill="" d="M11.927 5.825L8.595 2.493a.255.255 0 0 0-.35 0l-.791.79a.248.248 0 0 0 0 .35L8.959 5.14H2.443a.248.248 0 0 0-.247.248v1.227c0 .136.11.247.247.247H8.96L7.454 8.367a.248.248 0 0 0 0 .35l.79.79a.248.248 0 0 0 .351 0l3.332-3.332a.248.248 0 0 0 0-.35z"/></g></g></g></g></svg>'.Yii::t('app','Logout').'<i class="glyphicon glyphicon-plus"></i>', ['/site/logout'],
              ['data-pjax'=>0,'data-method' => 'post'])?>
          </div>
        </div>
        <?php endif;?>
        <?php Pjax::end() ?>
      </div>
    </div>
  </div>
  <div class="hdr_bottom" style="display: none;">
    <div class="users_btm"><div class="container"></div></div>
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <ul class="nav">
          <li><a href="/site/index" class="active"><?=Yii::t('app','Home')?></a></li>
          <li><a href="/site/chavo"><?=Yii::t('app','FAQ')?></a></li>
          <li><a href="/site/privacy"><?=Yii::t('app','Service')?></a></li>
          <li><a href="/site/contact"><?=Yii::t('app','Contact')?></a></li>
          <li><a href="/site/news"><?=Yii::t('app','Blog')?></a></li>
        </ul>
      </div>
       <p class="create_equ"><?=Yii::t('app','Create Task')?></p>
          <div class="row hdr_svgs">
            <?php
              for ($i=0; $i < 4; $i++) { 
            ?>
               <div class="col-md-3">
                  <a href="<?=Tasks::getInf()[$i][1]?>" class="enter_to_site">
                    <span class="aft_back"></span>
                    <?=Tasks::getTypeIconSvg($i+1)?>
                    <span><?=Tasks::getInf()[$i][0]?></span>
                  </a>
              </div>
            <?php
              }
            ?>
           
           
          </div>
    </div>
  </div>
</header>
