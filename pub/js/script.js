$(document).ready(function () {
  $('.menu-toggler').click(function(e){
    $('.nav-menu').toggle();
    $('.overlay').toggle();
    e.preventDefault();
  });
  // $('.login-toggler').click(function(e){
  //   $('.login-menu').toggle();
  //   $('.overlay').toggle();
  //   e.preventDefault();
  // });
  $(document).click(function(e){
    if(!$(e.target).closest('.menu-toggler, .nav-menu').length){
      $('.nav-menu').hide();
      $('.login-menu').hide();
      $('.overlay').hide();
    }
  })
});
