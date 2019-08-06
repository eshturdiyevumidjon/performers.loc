$(document).ready(function () {
  $('.hdr_top .hamburger').on('click', function(){
  	if($(window).scrollTop()==0){
  		$('header.fixed_header').toggleClass('fixed');
  	}
    $('.hdr_bottom').slideToggle(150);
    $(this).toggleClass('active');
  })

  var fe = 0;

  $(window).bind('scroll',function(){
  	var target = $(window).scrollTop();

  	if(target>0){
  		if($(window).scrollTop()>120){
      		$('header.fixed_header').addClass('fixed');
  		}
  	}
    if(target - fe<0){
      if($(window).scrollTop()==0){
			$('header.fixed_header').removeClass('fixed')
		}
		else{
	      		$('header').addClass('fixed').slideDown(300);}
    }
    else{    	
      $('header').slideUp(300, function(){
      	$('.hdr_bottom').slideUp();
      	$('.hamburger').removeClass('active');
      	setTimeout(function(){ $('header').removeClass('fixed') }, 300)
      });
    } 
    fe = $(window).scrollTop();
});

    if ($(window).width() < 767) {
    	var string_a = $('a.enter_to_site'), string_b = $('.dropdown.user_h');
    	$('.users_btm .container').append(string_a);
    	$('.users_btm .container').append(string_b);
    }


})
// $(document).on("click.bs.dropdown.data-api", ".noclose", function (e) { e.stopPropagation() });
 


