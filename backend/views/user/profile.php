<?php

use yii\helpers\Html;
use johnitvn\ajaxcrud\CrudAsset; 
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use common\models\User;

CrudAsset::register($this);
$this->title = 'Профиль';

$model = Yii::$app->user->identity;

if (!file_exists('avatars/'.$model->image) || $model->image == '') {
    $path = 'http://' . $_SERVER['SERVER_NAME'].'/uploads/nouser.jpg';
} else {
    $path = 'http://' . $_SERVER['SERVER_NAME'].'/uploads/avatar/'.$model->image;
}
?>

<?php Pjax::begin(['enablePushState' => false, 'id' => 'profile-pjax']) ?>
<div class="row">
    <div class="">
        <!-- CONTACT ITEM -->
        <div class="profile-container content-center">
            <div class="panel panel-default">
                <div class="panel-body profile">
                    <div class="profile-image">
                        <img src="<?=$path?>" alt="<?=$model->fio?>">
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name"><?=$model->fio?></div>
                        <div class="profile-data-title"><?=$model->getTypeDescription()?></div>
                    </div>
                    <div class="profile-controls">
                        <?= Html::a('<span class="fa fa-pencil"></span>', ['/user/change', 'id' => $model->id], [ 'role' => 'modal-remote', 'title'=> 'Профиль','class'=>'profile-control-left']); ?>
                        <?= Html::a('<span class="fa fa-envelope"></span>', ['/inbox/index'], [ 'data-pjax'=>0, 'title'=> 'Профиль','class'=>'profile-control-right']); ?>
                    </div>
                </div>                                
                <div class="panel-body">                                    
                    <div class="contact-info">
                        <div class="col-md-6">
                            <p><small><?= $model->getAttributeLabel('username')?></small><br><?=$model->username?></p>
                          
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                </div>                                
            </div>
    </div>
        <!-- END CONTACT ITEM -->
    </div>                       
</div>
<?php Pjax::end() ?>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "options" => [
        "tabindex" => false,
    ],
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>