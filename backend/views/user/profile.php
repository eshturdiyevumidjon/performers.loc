<?php

use yii\helpers\Html;
use johnitvn\ajaxcrud\CrudAsset; 
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use common\models\User;

CrudAsset::register($this);
$this->title = Yii::t('app','Profile');

$model = Yii::$app->user->identity;
if (!file_exists('avatars/'.$model->image) || $model->image == '') {
    $path = '/uploads/nouser.jpg';
} else {
    $path = '/uploads/avatars/'.$model->image;
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
                        <br>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name"><?=$model->username?></div>
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
                            <p><span class="fa fa-envelope"></span>
                            <small><?= $model->getAttributeLabel('email')?></small><br><?=$model->email?></p>

                            <p><span class="fa fa-users"></span>
                            <small><?= $model->getAttributeLabel('type')?></small><br><?=$model->getTypeDescription()?></p>

                            <p><span class="fa fa-calendar"></span>
                            <small><?= $model->getAttributeLabel('birthday')?></small><br><?=$model->birthday?></p>

                            <p><span class="fa fa-phone"></span>
                            <small><?= $model->getAttributeLabel('phone')?></small><br><?=($model->phone)?$model->phone:Yii::t('app','not-set')?></p>

                            <p><span class="fa fa-pencil"></span>
                            <small><?= $model->getAttributeLabel('updated_at')?></small><br><?=$model->updated_at?></p>

                            
                            
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