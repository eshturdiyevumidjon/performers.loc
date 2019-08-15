<section class="equation"> 
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="/site/index"><?=Yii::t('app','Home')?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=Yii::t('app','FAQ')?></li>
      </ol>
    </nav>
    <h1><?=Yii::t('app','FAQ')?></h1>
    <div class="flex_equation">
      <div class="equ_left">
        <h3><?=Yii::t('app','Frequently Asked Questions')?></h3>
        <ul class="nav">
          <?php $i=0; foreach($chavos as $chavo): ?>
            <li><a data-toggle="tab" class=" <?=($i == 0) ? 'active show' : ''?>" href="#fu<?=$i?>"><?=$chavo->title?></a></li>
          <?php $i++; endforeach;?>
         
        </ul>
      </div>
      <div class="equ_right tab-content">
         <?php $i=0; foreach($chavos as $chavo): ?>
            <div class="tab-pane <?=($i == 0) ? 'in active' : 'fade'?>" id="fu<?=$i?>">
              <h4><?=$chavo->title?></h4>
              <p><?=$chavo->text?></p>
            </div>
          <?php $i++; endforeach;?>
      </div>
    </div>
  </div>
</section>