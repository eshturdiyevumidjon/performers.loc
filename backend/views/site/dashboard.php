<?php
use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;
use app\models\Inbox;
$this->title = 'Рабочий стол';

$userId = Yii::$app->user->identity->id;
?>   

    <div class="site-index">
        <div class="page-content-wrap">
            <br>                    
        </div>
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="widget widget-success widget-item-icon">
                    <div class="widget-item-left">
                        <span class="fa fa-file"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count"></div>
                        <div class="widget-title"></div>
                        <div class="widget-subtitle"><?= Html::a('<b style="color:#25547c;font-size:14px;">Подробнее... <i class="fa fa-arrow-circle-right"></i></b>', ['/contracts/index'], []); ?></div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="widget widget-success widget-item-icon">
                    <div class="widget-item-left">
                        <span class="fa fa-th"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count"></div>
                        <div class="widget-title"></div>
                        <div class="widget-subtitle"><?= Html::a('<b style="color:#25547c;font-size:14px;">Подробнее... <i class="fa fa-arrow-circle-right"></i></b>', ['/filials/index'], []); ?></div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="widget widget-success widget-item-icon">
                    <div class="widget-item-left">
                        <span class="fa fa-users"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count"></div>
                        <div class="widget-title"></div>
                        <div class="widget-subtitle"><?= Html::a('<b style="color:#25547c;font-size:14px;">Подробнее... <i class="fa fa-arrow-circle-right"></i></b>', ['/users/index'], []); ?></div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="widget widget-success widget-item-icon">
                    <div class="widget-item-left">
                        <span class="fa fa-envelope"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count"></div>
                        <div class="widget-title"></div>
                        <div class="widget-subtitle"><?= Html::a('<b style="color:#25547c;font-size:14px;">Подробнее... <i class="fa fa-arrow-circle-right"></i></b>', ['/inbox/index'], []); ?></div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success panel-hidden-controls">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title"></h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span> Refresh</a></li>
                            </ul>                                        
                        </li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>                                
                </div>
                    <div class="panel-body">
                    
                    <div class="col-md-12">
                        
                    </div>

                </div>      
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
</div>