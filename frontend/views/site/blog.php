<?php
  $lang = Yii::$app->language;
?>
<section class="cabinet">
      <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb_nav">
          <ol class="breadcrumb"> 
            <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','Blog')?></li>
          </ol>
        </nav>
        <h1><?=Yii::t('app','Blog')?></h1>
        <div class="flex_cabinet">
          <div class="cabinet_left">
            <div class="input_styles cab_st">
              <div id="ff1" class="tab-pane in active"> 
                <div class="filter_block">
                  <p><?=Yii::t('app','Filter')?></p>
                </div>
                <div class="ot_do">
                  <label for=""><?=Yii::t('app','Cost')?>:</label>
                  <div class="ine_ot">
                    <label for=""><?=Yii::t('app','from')?></label>
                    <div class="form-group">
                      <input type="text" placeholder="...">
                    </div>
                  </div>
                  <div class="ine_ot">
                    <label for=""><?=Yii::t('app','to')?></label>
                    <div class="form-group">
                      <input type="text" placeholder="...">
                    </div>
                  </div>
                </div>
                <div class="ot_do">
                  <label for=""><?Yii::t('app','Date')?>:</label>
                  <div class="ine_ot">
                    <label for=""><?=Yii::t('app','from')?></label>
                    <div class="form-group">
                      <input type="date" placeholder="...">
                    </div>
                  </div>
                  <div class="ine_ot">
                    <label for=""><?=Yii::t('app','to')?></label>
                    <div class="form-group">
                      <input type="date" placeholder="...">
                    </div>
                  </div>
                </div>
                <div class="clear_and_chen">
                  <a href="#" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Reset')?></a>
                  <a href="#" class="enter_to_site"><span class="aft_back"></span><?=Yii::t('app','Apply')?></a>
                </div>

                <div class="blog_main">
                  <div class="row">
                    <?php foreach ($news as $key => $value): ?>
                       <div class="col-xl-4 col-sm-6">
                      <a href="/<?=$lang?>/site/single-page?id=<?=$value->id?>" class="blog_item">
                        <img src="http://itake.loc/uploads/news/<?= $value->fone?>" alt="">
                         
                         <img src="/uploads/news/1.jpg" alt="">
                        <div class="blog_text">
                          <span><?=$value->date_cr?></span>
                          <h5><?=$value->title?></h5>
                        </div>
                      </a>
                    </div>
                    <?php endforeach ?>
                   
                  </div>
                </div>
                <ul class="pagination">
                  <li class="page-item"><a class="" href="#">1</a></li>
                  <li class="page-item"><a class="" href="#">2</a></li>
                  <li class="page-item"><a class="" href="#">3</a></li>
                  <li class="page-item"><a class="" href="#">...</a></li>
                  <li class="page-item"><a class="" href="#">346</a></li>
                  <li class="page-item prev toogle_pag">
                    <a class="btn_red" href="#">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"/></g></g></g></g></svg>
                    </a>
                  </li>
                  <li class="page-item next toogle_pag">
                    <a class="btn_red" href="#">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g><g clip-path="url(#clip-67c7ecfe-51a6-4606-85cb-9c7ae5002df6)"><g><g><path fill="" d="M6 0L4.95 1.05l4.2 4.2H0v1.5h9.15l-4.2 4.2L6 12l6-6z"/></g></g></g></g></svg>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="cabinet_right">
            <div class="gree_moder">
              <img src="/images/shield.svg" alt=""><span><?=Yii::t('app','Passed verification')."<br>".Yii::t('app','Moderator')?></span>
            </div>
            <div class="banner_bl"></div>
          </div>
        </div>
       
      </div>
    </section>
