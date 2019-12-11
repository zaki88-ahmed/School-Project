jQuery('.carousel').carousel({
        interval: 5000 //changes the speed
    })

jQuery('[data-spy="scroll"]').each(function () {
  var $spy = jQuery(this).scrollspy('refresh')
})

// Smooth scroll
jQuery(function() {
  jQuery('#navbar-html-example a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});


// Remove Placeholder
jQuery('input,textarea').focus(function(){
   jQuery(this).data('placeholder',jQuery(this).attr('placeholder'))
   jQuery(this).attr('placeholder','');
});
jQuery('input,textarea').blur(function(){
   jQuery(this).attr('placeholder',jQuery(this).data('placeholder'));
});


    //Tab to top
    jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 1){  
        jQuery('.scroll-top-wrapper').addClass("show");
    }
    else{
        jQuery('.scroll-top-wrapper').removeClass("show");
    }
});
    jQuery(".scroll-top-wrapper").on("click", function() {
     jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});


  //Sticky Header

jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 1){  
        jQuery('.logo-menu').addClass("sticky-menu");
    }
    else{
        jQuery('.logo-menu').removeClass("sticky-menu");
    }
});


// Animations
new WOW().init();