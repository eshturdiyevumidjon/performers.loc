<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\widgets\Alert;

$adminka = Yii::$app->params['adminka'];
//echo "d=".$adminka;die;

	$session = Yii::$app->session;
    if( isset($session['theme']) ) $theme = $adminka . $session['theme'];
    else $theme = $adminka . '/css/theme-default.css';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="body-full-height" >
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" type="text/css" id="theme" href="<?=$theme?>"/>
</head>
<body>

<?php $this->beginBody() ?>
    <div  class="login-container lightmode">
        <div class="login-box animated fadeInDown">
        	<?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>