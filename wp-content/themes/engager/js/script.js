jQuery('[data-spy="scroll"]').each(function ($) {
  var $spy = jQuery(this).scrollspy('refresh')
})

// slider
jQuery(".rslides").responsiveSlides({
  nav: true,             // Boolean: Show navigation, true or false
  prevText: "<i class='fa fa-chevron-left'></i>",   // String: Text for the "previous" button
  nextText: "<i class='fa fa-chevron-right'></i>",       // String: Text for the "next" button
});



// Remove Placeholder
jQuery('input,textarea').focus(function($){
   jQuery(this).data('placeholder',$(this).attr('placeholder'))
   jQuery(this).attr('placeholder','');
});
jQuery('input,textarea').blur(function($){
   jQuery(this).attr('placeholder',$(this).data('placeholder'));
});


    //Tab to top
    jQuery(window).scroll(function($) {
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

jQuery(window).scroll(function($) {
    if (jQuery(this).scrollTop() > 1){  
        jQuery('.logo-menu').addClass("organictop");
    }
    else{
        jQuery('.logo-menu').removeClass("organictop");
    }
});


//Pagination
jQuery('.pagination ul').addClass("pagination");
// Animations

jQuery(document).ready(function() {
        jQuery("#owl-demo").owlCarousel({

            navigation : false,
            autoPlay : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true           

        });
    });