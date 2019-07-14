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
        <!-- The above error occurred while the Web server was processing your request.

        Please contact us if you think this is a server error. Thank you. -->
        Вышеуказанная ошибка произошла, когда веб-сервер обрабатывал ваш запрос. Пожалуйста, свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо.
    </div>

    <div class="error-actions">                                
        <div class="row">
            <div class="col-md-6">
               <button class="btn btn-info btn-block btn-lg" onClick="document.location.href = '/';">Вернуться к рабочий стол<!-- Back to dashboard --></button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary btn-block btn-lg" onClick="history.back();">Предыдущая страница<!-- Previous page --></button>
            </div>
        </div>                                                             
     </div>                            

</div>
