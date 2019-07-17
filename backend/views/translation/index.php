<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\models\Lang;
use kartik\select2\Select2;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TranslationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Translations';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="translation-index">
    <div id="ajaxCrudDatatable">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="glyphicon glyphicon-list"></i>&nbsp;&nbsp;Translations listing</h3>
                        <ul class="panel-controls">
                            <?=Html::a('Добавить <i class="glyphicon glyphicon-plus"></i>', ['create'],
                            ['role'=>'modal-remote','title'=> 'Добавить', 'class'=>'btn btn-info'])?>
                        </ul>   
            </div>                             
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <?= Select2::widget([
                                        'name' => 'default_language',
                                        'data' => $data,
                                        'value'=>Lang::getDefaultLang()->name,
                                        'disabled' => true
                                    ]);
                                ?>
                            </th>
                            <th>
                                <?= Select2::widget([
                                    'name' => 'choosen_lang',
                                    'value'=> Lang::getCurrent()->name,
                                    'data' => $data,
                                    'options' => ['placeholder' => 'Select'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]);?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
