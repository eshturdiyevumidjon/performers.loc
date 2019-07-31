<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 

$this->title=Yii::t('app','Chat');
$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
?>
<div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2><span class="fa fa-inbox"></span> Inbox <small>(3 unread)</small></h2>
        </div>                                                                                
        
        <div class="pull-right">                            
            <button class="btn btn-default"><span class="fa fa-cogs"></span> Settings</button>
            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
        </div>                        
    </div>
    <!-- END CONTENT FRAME TOP -->
    
    <!-- START CONTENT FRAME LEFT -->
    <div class="content-frame-left" style="display: none;">
        <div class="block">
            <?= Html::a(Yii::t('app','COMPOSE').' <i class="fa fa-edit"></i>', ['create'],
                            ['role'=>'modal-remote','title'=> Yii::t('app','COMPOSE'), 'class'=>'btn-block btn-lg btn btn-info'])?>
        </div>
        <div class="block">
            <div class="list-group border-bottom">
                <a href="#" class="list-group-item active"><span class="fa fa-inbox"></span> Inbox <span class="badge badge-success">3</span></a>
                <a href="#" class="list-group-item"><span class="fa fa-star"></span> Starred <span class="badge badge-warning">6</span></a>
                <a href="#" class="list-group-item"><span class="fa fa-rocket"></span> Sent</a>
                <a href="#" class="list-group-item"><span class="fa fa-flag"></span> Flagged</a>
                <a href="#" class="list-group-item"><span class="fa fa-trash-o"></span> Deleted <span class="badge badge-default">1.4k</span></a>                            
            </div>                        
        </div>
        <div class="block">
            <h4>Labels</h4>
            <div class="list-group list-group-simple">                                
                <a href="#" class="list-group-item"><span class="fa fa-circle text-success"></span> Clients</a>
                <a href="#" class="list-group-item"><span class="fa fa-circle text-warning"></span> Social</a>
                <a href="#" class="list-group-item"><span class="fa fa-circle text-danger"></span> Work</a>
                <a href="#" class="list-group-item"><span class="fa fa-circle text-info"></span> Family</a>
                <a href="#" class="list-group-item"><span class="fa fa-circle text-primary"></span> Friends</a>
            </div>
        </div>
    </div>
    <!-- END CONTENT FRAME LEFT -->
    
    <!-- START CONTENT FRAME BODY -->
    <div class="content-frame-body" style="height: 855px;">
        
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">
                <label class="check mail-checkall">
                    <div class="btn-group">
                        <input type="checkbox" id="select_all">
                    </div>
                </label>
                <div class="btn-group">
                    <button class="btn btn-default"><span class="fa fa-mail-reply"></span></button>
                    <button class="btn btn-default"><span class="fa fa-mail-forward"></span></button>
                </div>
                <div class="btn-group">

                    <button class="btn btn-default"><span class="fa fa-star"></span></button>                               
                </div>                                
                <a class="btn btn-default" href="chat/test"><span class="fa fa-trash-o"></span></a>                                                                    
                <div class="pull-right" style="width: 180px;">
                    <div class="input-group">
                        <?php echo kartik\date\DatePicker::widget([
                                 'name' => 'search',
                                 'language'=>'ru',
                                 'type' => kartik\date\DatePicker::TYPE_COMPONENT_PREPEND,
                                 'value' => '23-Feb-1982',
                                 'pluginOptions' => [
                                     'autoclose'=>true,
                                     'todayBtn' => true,
                                     'todayHighlight' => true,
                                     'format' => 'dd-M-yyyy'
                                 ]
                           ]);
                        ?>                                    
                    </div>
                </div>
            </div>
            <div class="panel-body mail">
                <div class="mail-item mail-unread mail-info">                                    
                    <div class="mail-checkbox">
                       <input type="checkbox" name="check[]" >
                    </div>
                    <div class="mail-star">
                        <span class="fa fa-star-o"></span>
                    </div>
                    <div class="mail-user">Dmitry Ivaniuk</div>                                    
                    <a href="pages-mailbox-message.html" class="mail-text">Product development</a>                                    
                    <div class="mail-date">Today, 11:21</div>
                </div>
                
                <div class="mail-item mail-unread mail-danger">                                    
                    <div class="mail-checkbox">
                      <input type="checkbox" name="check[]" >
                    </div>
                    <div class="mail-star">
                        <span class="fa fa-star-o"></span>
                    </div>
                    <div class="mail-user">John Doe</div>                                    
                    <a href="pages-mailbox-message.html" class="mail-text">New Windows 9 App</a>                                    
                    <div class="mail-date">Today, 10:36</div>
                </div>
                
                <div class="mail-item mail-success">
                    <div class="mail-checkbox">
                       <input type="checkbox" name="check[]" >
                    </div>
                    <div class="mail-star">
                        <span class="fa fa-star-o"></span>
                    </div>
                    <div class="mail-user">Nadia Ali</div>                                    
                    <a href="pages-mailbox-message.html" class="mail-text">Check my new song</a>                                    
                    <div class="mail-date">Yesterday, 20:19</div>
                </div>
                
                <div class="mail-item mail-warning">
                    <div class="mail-checkbox">
              <input type="checkbox" name="check[]" >
                    </div>
                    <div class="mail-star starred">
                        <span class="fa fa-star-o"></span>
                    </div>
                    <div class="mail-user">Brad Pitt</div>                                    
                    <a href="pages-mailbox-message.html" class="mail-text">How are you? Need some work?</a>                                    
                    <div class="mail-date">Sep 15</div>
                </div>
                
                <div class="mail-item mail-info">
                    <div class="mail-checkbox">
                     <input type="checkbox" name="check[]" >
                    </div>
                    <div class="mail-star">
                        <span class="fa fa-star-o"></span>
                    </div>
                    <div class="mail-user">Dmitry Ivaniuk</div>                                    
                    <a href="pages-mailbox-message.html" class="mail-text">Can you check this docs?</a>                                    
                    <div class="mail-date">Sep 14</div>
                    <div class="mail-attachments">
                        <span class="fa fa-paperclip"></span> 11Kb
                    </div>
                </div>
                
                <div class="mail-item">
                    <div class="mail-checkbox">
                      <input type="checkbox" name="check[]" >
                    </div>
                    <div class="mail-star starred">
                        <span class="fa fa-star-o"></span>
                    </div>
                    <div class="mail-user">HTC</div>                                    
                    <a href="pages-mailbox-message.html" class="mail-text">New updates on your phone HD7</a>
                    <div class="mail-date">Sep 13</div>
                    <div class="mail-attachments">
                        <span class="fa fa-paperclip"></span> 58Mb
                    </div>
                </div>
            </div>
            <div class="panel-footer">                                
                <button class="btn btn-default"><span class="fa fa-warning"></span></button>
                <button class="btn btn-default"><span class="fa fa-trash-o"></span></button>                                    
            </div>                            
        </div>
        
    </div>
    <!-- END CONTENT FRAME BODY -->
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "options" => [
        "tabindex" => false,
    ],
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?php 
$this->registerJs(<<<JS
    $('#select_all').change(function(){
     if($(this).is(":checked")){
       $(':checkbox').prop('checked',true);
           }else{
       $(':checkbox').prop('checked',false);
    }
});
JS
);
?>