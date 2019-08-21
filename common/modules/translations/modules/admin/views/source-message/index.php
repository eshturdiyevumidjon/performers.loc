<?php

use common\modules\langs\models\Langs;
use common\modules\langs\widgets\LangsWidgets;
use common\modules\translations\models\SourceMessage;
use yii\helpers\Html;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\translations\models\SourceMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Source Messages';
$this->params['breadcrumbs'][] = $this->title;
$langs = \backend\models\Lang::getLanguages();
$searc=[];
foreach ($langs as $key => $value) {
    $searc[] = $value->url;
};
// print_r($searc);
// die;
$sources = SourceMessage::find()->messages()->all();
echo "<pre>";
print_r($sources);
echo "</pre>";
$s = 0;
?>

