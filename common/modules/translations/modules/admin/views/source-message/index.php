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

$sources = SourceMessage::find()->messages()->all();
$s = 0;
?>
<div class="container-fluid container-fixed-lg m-t-20">

    <div class="panel panel-transparent">

        <div class="panel-body no-padding">

            <div class="panel panel-default">

                <div class="panel-body page-header-block">

                    <h2><?= Html::encode($this->title) ?></h2>

                    <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>

                </div>

            </div>

        </div>

        <div class="panel-body no-padding">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td><?=Yii::t('app','Sources')?></td>
                            <?php foreach ($langs as $lang):?>
                                <td>
                                    <?php echo $lang->url;?>
                                </td>
                            <?php endforeach;?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sources as $source): $messages = $source->messages;?>
                            <?php $s++;?>
                            <tr>
                                <td>
                                    <?=$source->id?>
                                </td>
                                <td>
                                    <?=$source->message?>
                                </td>
                                <?php foreach ($messages as $message): ?>
                                    <?php

                                        $value_lang = $message->translation;
                                    ?>
                                    <td>
                                        <?php
                                        $lang_code = $message->language;
                                        echo Editable::widget([
                                            'name'=>'translation['.$lang_code.']['.$source->id.']',
                                            'asPopover' => true,
                                            'value' => $value_lang,
                                            'header' => 'Name',
                                            'size'=>'md',
                                            'options' => ['class'=>'form-control', 'placeholder'=>'Enter person name...']
                                        ]);
                                        ?>
                                    </td>
                                <?php endforeach;?>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                        </table>
                    </div>

                </div>



            </div>

        </div>

    </div>

</div>
