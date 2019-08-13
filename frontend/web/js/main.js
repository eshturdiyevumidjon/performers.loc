$(document).ready(function () {
  $('.hdr_top .hamburger').on('click', function(){
  	if($(window).scrollTop()==0){
  		$('header.fixed_header').toggleClass('fixed');
  	}
    $('.hdr_bottom').slideToggle(150);
    $(this).toggleClass('active');
  })

    $("#textfield").on('keyup paste', function(){ // <---remove ',' comma
        var Characters = $("#textfield").val().replace(/(<([^>]+)>)/ig,"").length; // '$' is missing from the selector
        $("#counter").text(Characters);
    });

    $('.minus_count').on('click', function(e){
      e.preventDefault();
      var value_input = parseInt($(this).next().val(), 10);
      if(value_input>0){
        $(this).next().val(value_input-1);
      }
    })

    $('.plus_count').on('click', function(e){
      e.preventDefault();
      var value_input = parseInt($(this).prev().val(), 10);
        $(this).prev().val(value_input+1);
    })

    $('body').click(function (e) {
        if (!$(e.target).is('header, header *')) {
          $('.hdr_bottom').slideUp(150);
          $('.hamburger').removeClass('active');
        }
    });

//   var fe = 0;

//   $(window).bind('scroll',function(){
//   	var target = $(window).scrollTop();

//   	if(target>0){
//   		if($(window).scrollTop()>120){
//       		$('header.fixed_header').addClass('fixed');
//   		}
//   	}
//     if(target - fe<0){
//       if($(window).scrollTop()==0){
// 			$('header.fixed_header').removeClass('fixed')
// 		}
// 		else{
// 	      		$('header').addClass('fixed');}
//     }
//     fe = $(window).scrollTop();
// });


// $(window).on('scroll', function(){
//     var currentScrollPos = window.pageYOffset,
//         nav = $('#navbar'),
//         gmb = $('.menu__btn');

//     if (prevScrollPos > currentScrollPos) {
//         nav.css('top', '0px');
//         gmb.css('background-color', 'rgba(32, 60, 144, 0.2)').css('top', '0px').css('margin-top', '30px');
//     } else {
//         nav.css('top', '-80px');
//         gmb.css('background-color', 'rgba(32, 60, 144, 0.15)').css('top', '-80px');
//     }

//     if(currentScrollPos == 0) {
//      document.getElementById('navbar').style.backgroundColor = "";
//      document.getElementById('logo').style.backgroundImage = "";
    
//     } else {
//      // document.getElementById('navbar').style.backgroundColor = "#fff";
//      // document.getElementById('logo').style.backgroundImage = "url(/frontend/img/header-logo.svg)";
    
//     }

//     prevScrollPos = currentScrollPos;
// });



    if ($(window).width() < 767) {
    	var string_a = $('header .hdr_top a.enter_to_site'), string_b = $('.dropdown.user_h'), string_c = $('.dropdown.language_h');
      $('.users_btm .container').append(string_a);
    	$('.users_btm .container').append(string_c);
    	$('.users_btm .container').append(string_b);
      $('div#map_for_mobile').html($('div#map'));
      // $('.user_h button.dropdown-toggle').on('click', function(e){
      //   e.preventDefault();
      // })
    }


})
// $(document).on("click.bs.dropdown.data-api", ".noclose", function (e) { e.stopPropagation() });
 


