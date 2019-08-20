<style type="text/css">
  input{
    margin-bottom:15px;
  }
</style>
<section class="cabinet">
  <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb_nav">
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="/site/index">Главная</a></li>
        <li class="breadcrumb-item" aria-current="/profile/index">Личный кабинет</li>
        <li class="breadcrumb-item active" aria-current="page">Добавление автомобилей</li>
      </ol>
    </nav>

    
    <h1>Добавление автомобилей</h1>
    <div class="flex_cabinet">
      <div class="cabinet_left">
        <ul class="nav tab_styles_nav">
          <li><a data-toggle="tab" href="#ff0">Добавление автомобилей</a></li>
          <li><a data-toggle="tab" class="active show" href="#ff1">Добавление водителей</a></li>
        </ul>
        <form class="tab-content input_styles cab_st" action="/profile/add-autos" id="transport_form" method="post" enctype="multipart/form-data">
          <div id="ff0" class="tab-pane fade">
            <div id="newlink">
            <div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                   <input type="text" name="model[]" required="" placeholder="Модель автомобиля" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                   <input type="text" name="mark[]" required="" placeholder="Марка автомобиля" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="regitr_num[]" required="" placeholder="Регистрационный номер">
                  </div>
                </div>
              </div>
              <h4 class="mrte">Загрузить фото</h4>
              <div class="lert">
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                   <label class="" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <img src="/images/girll.jpg" alt="">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
              </div>
             </div>
            </div>
            <hr>
              <a href="javascript:new_link()" id="addnew" class="btn_red drug sobs1">Добавить водителя</a>
            <hr>
              <div id="newlinktpl" style="display:none">
                <hr>
                <div>
                  <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                   <input type="text" name="model[]" placeholder="Модель автомобиля" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                   <input type="text" name="mark[]" placeholder="Марка автомобиля" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="regitr_num[]" placeholder="Регистрационный номер">
                  </div>
                </div>
              </div>
              <h4 class="mrte">Загрузить фото</h4>
              <div class="lert">
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                   <label class="image_input" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image1[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <img src="/images/girll.jpg" alt="">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image2[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image3[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image4[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image5[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image6[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image7[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
              </div>
                </div>
              </div>
              <div class="text-right">
                <button id="auto" name="auto" type="submit" class="btn_red drug sobs1">Cохранить</button>
              </div>

          </div>
          <div id="ff1" class="tab-pane  in active"> 
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" placeholder="Фамилия и имя">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="tel" placeholder="Номер телефона">
                  </div>
                </div>
              </div>
              <h4 class="mrte">Загрузить фото</h4>
              <div class="lert">
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                   <label class="image_input" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image1[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <img src="/images/girll.jpg" alt="">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image2[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image3[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image4[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image5[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image6[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
                <div class="download_photos">
                  <button class="remove_photo"><img src="/images/minus_a.svg" alt=""></button>
                  <label class="add_photo" for="my-file-selector">
                    <input id="my-file-selector" type="file" class="d-none" name="image7[]">
                    <img src="/images/plus_a.svg" alt="">
                   </label>
                </div>
              </div>
              <div class="text-right">
                <button class="btn_red drug"><img src="/images/delete.svg" alt="">Удалить</button>
              </div>
              <hr>
                <a href="#" class="btn_red drug sobs1">Добавить водителя</a>
              <hr>
              <div class="text-right">
                <a href="#" class="btn_red drug sobs1">Cохранить</a>
              </div>
          </div>
        </form>
      </div>
      <div class="cabinet_right">
        <?=$this->render('cabinet_right',['company'=>$company]);?>
      </div>
    </div>
   
  </div>
</section>

<?php
$this->registerJs(<<<JS
  $(document).ready(function(){
    var fileCollection = new Array();
        $(document).on('change', '.image_input', function(e){
            var files = e.target.files;
            $.each(files, function(i, file){
                fileCollection.push(file);
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e){
                  alert();
                    var template = '<img style="width:100%; max-height:250px;" src="'+e.target.result+'"> ';
                    $('#image').html('');
                    $('#image').append(template);
                };
            });
        });
    });
JS
);
?>
