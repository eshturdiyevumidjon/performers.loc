$(document).ready(function () {
  $('.hdr_top .hamburger').on('click', function(){
    $('.hdr_bottom').slideToggle(150);
    $(this).toggleClass('active');
  })

})
// $(document).on("click.bs.dropdown.data-api", ".noclose", function (e) { e.stopPropagation() });
 


