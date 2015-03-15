$(document).ready(function() {
  var menuToggle = $('#js-mobile-menu').unbind();
  var navigationMenu = $('#js-navigation-menu');
  navigationMenu.removeClass("show");

  menuToggle.on('click', function(e) {
    e.preventDefault();
    navigationMenu.slideToggle(function(){
      if(navigationMenu.is(':hidden')) {
        navigationMenu.removeAttr('style');
      }
    });
  });
});