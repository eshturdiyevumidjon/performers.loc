<?php
use yii\helpers\Html;
$this->title = $name;

?>
<div class="error-container">

    <!-- <div class="error-code"><?=$name?></div> -->
    <div class="error-code"><?=Yii::$app->errorHandler->exception->statusCode?></div>
    <div class="error-text">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <div class="error-subtext">
        <!--  -->
        <?=Yii::t('app',
            'The above error occurred while the Web server was processing your request.
            Please contact us if you think this is a server error. Thank you.'
        )?>
       
    </div>

    <div class="error-actions">                                
        <div class="row">
            <div class="col-md-6">
               <button class="btn btn-info btn-block btn-lg" onClick="document.location.href = '/';"><?=Yii::t('app','Back to dashboard')?></button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary btn-block btn-lg" onClick="history.back();"><?=Yii::t('app','Previous page')?></button>
            </div>
        </div>                                                             
     </div>                            

</div>
