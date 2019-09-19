<?php


use yii\helpers\Html;

$this->title = $name;
?>
<section class="contact">
  <div class="container">


    <?php 
    if(Yii::$app->session->hasFlash('success'))
        echo "string";
    ?>
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
        <?=Yii::t('app',
            'The above error occurred while the Web server was processing your request.
            Please contact us if you think this is a server error. Thank you.'
        )?>
    </div>

    <div class="error-actions">                                
        <div class="row">
            <div class="col-md-6">
               <button class="btn btn_red btn-block" onClick="document.location.href = '/';"><?=Yii::t('app','Back to dashboard')?></button>
            </div>
            <div class="col-md-6">
                <button class="btn btn_red btn-block" onClick="history.back();"><?=Yii::t('app','Previous page')?></button>
            </div>
        </div>                                                             
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
</div>
</section>