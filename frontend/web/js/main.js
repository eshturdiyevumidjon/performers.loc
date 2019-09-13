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

  $(window).bind('scroll', function(){
  	var target = $(window).scrollTop();

  	if(target>76){
  		$('header.fixed_header').addClass('fixed');
  	}
    else{
      $('header.fixed_header+section').trigger('click');
			$('header.fixed_header').removeClass('fixed')
    }
});


    if ($(window).width() < 767) {
    	var string_a = $('header .hdr_top a.enter_to_site'), 
          string_b = $('.dropdown.user_h'), 
          string_c = $('.dropdown.language_h');
      $('.users_btm .container').append(string_a);
    	$('.users_btm .container').append(string_c);
    	$('.users_btm .container').append(string_b);
      $('div#map_for_mobile').html($('div#map'));
      // $('.user_h button.dropdown-toggle').on('click', function(e){
      //   e.preventDefault();
      // })
      $('.hamburger').on('click', function(){
        $('body').toggleClass('ovx');
      })
      $('.users_btm .enter_to_site').on('click',function(){
        $('body').removeClass('ovx');
      })
    }


})
$('#reww').trigger('click');
// $(document).on("click.bs.dropdown.data-api", ".noclose", function (e) { e.stopPropagation() });
 /************HEADER*****************************************************************/
// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
        $('.hdr_bottom').slideUp(150);
        $('.hamburger').removeClass('active');
        $('header+section').trigger('click');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}

 /************HEADER*****************************************************************/
