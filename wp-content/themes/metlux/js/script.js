

jQuery('.carousel').carousel({
        interval: 5000 //changes the speed
})



jQuery(".main-menu .mega-menu").parent("li").css({"position":"static"});

//Sticky Header
jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 1){  
        jQuery('.logo-menu').addClass("sticky");
    }
    else{
        jQuery('.logo-menu').removeClass("sticky");
    }
});

// Slogon and Header padding
jQuery(document).ready(function(){
jQuery('header .site-description').parent('a').parent('div').parent('div').parent('div').addClass('has-slogon');
});
// Testimonials1

    jQuery(document).ready(function() {
     
      jQuery("#testimonials").owlCarousel({
     
          autoPlay: 6000, //Set AutoPlay to 6 seconds
     
          items : 4,
          itemsDesktop : [1199,3],
          itemsDesktopSmall : [979,3]
     
      });
     
    });

// brand-carousel
    jQuery(document).ready(function() {
     
      jQuery("#brand-carousel").owlCarousel({
     
          autoPlay: 6000, //Set AutoPlay to 6 seconds
          pagination:false,
     
          items : 6,
          itemsDesktop : [1199,4],
          itemsDesktopSmall : [979,3]
     
      });
     
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



// Remove Placeholder
jQuery('input,textarea').focus(function(){
   jQuery(this).data('placeholder',jQuery(this).attr('placeholder'))
   jQuery(this).attr('placeholder','');
});
jQuery('input,textarea').blur(function(){
   jQuery(this).attr('placeholder',jQuery(this).data('placeholder'));
});




// Smart Menu
(function($) {

  // init ondomready
  jQuery(function() {

    // init all navbars that don't have the "data-sm-skip" attribute set
    var $navbars = jQuery('ul.navbar-nav:not([data-sm-skip])');
    $navbars.each(function() {
      var $this = jQuery(this);
      $this.addClass('sm').smartmenus({

          // these are some good default options that should work for all
          // you can, of course, tweak these as you like
          subMenusSubOffsetX: 2,
          subMenusSubOffsetY: -6,
          subIndicators: false,
          collapsibleShowFunction: null,
          collapsibleHideFunction: null,
          rightToLeftSubMenus: $this.hasClass('navbar-right'),
          bottomToTopSubMenus: $this.closest('.navbar').hasClass('navbar-fixed-bottom')
        })
        .bind({
          // set/unset proper Bootstrap classes for some menu elements
          'show.smapi': function(e, menu) {
            var $menu = jQuery(menu),
              $scrollArrows = $menu.dataSM('scroll-arrows');
            if ($scrollArrows) {
              // they inherit border-color from body, so we can use its background-color too
              $scrollArrows.css('background-color', jQuery(document.body).css('background-color'));
            }
            $menu.parent().addClass('open');
          },
          'hide.smapi': function(e, menu) {
            jQuery(menu).parent().removeClass('open');
          }
        })
        // set Bootstrap's "active" class to SmartMenus "current" items (should someone decide to enable markCurrentItem: true)
        .find('a.current').parent().addClass('active');

      // keep Bootstrap's default behavior for parent items when the "data-sm-skip-collapsible-behavior" attribute is set to the ul.navbar-nav
      // i.e. use the whole item area just as a sub menu toggle and don't customize the carets
      var obj = $this.data('smartmenus');
      if ($this.is('[data-sm-skip-collapsible-behavior]')) {
        $this.bind({
          // click the parent item to toggle the sub menus (and reset deeper levels and other branches on click)
          'click.smapi': function(e, item) {
            if (obj.isCollapsible()) {
              var $item = jQuery(item),
                $sub = $item.parent().dataSM('sub');
              if ($sub && $sub.dataSM('shown-before') && $sub.is(':visible')) {
                obj.itemActivate($item);
                obj.menuHide($sub);
                return false;
              }
            }
          }
        });
      }

      var $carets = $this.find('.caret');

      // onresize detect when the navbar becomes collapsible and add it the "sm-collapsible" class
      var winW;
      function winResize() {
        var newW = obj.getViewportWidth();
        if (newW != winW) {
          if (obj.isCollapsible()) {
            $this.addClass('sm-collapsible');
            // set "navbar-toggle" class to carets (so they look like a button) if the "data-sm-skip-collapsible-behavior" attribute is not set to the ul.navbar-nav
            if (!$this.is('[data-sm-skip-collapsible-behavior]')) {
              $carets.addClass('navbar-toggle sub-arrow');
            }
          } else {
            $this.removeClass('sm-collapsible');
            if (!$this.is('[data-sm-skip-collapsible-behavior]')) {
              $carets.removeClass('navbar-toggle sub-arrow');
            }
          }
          winW = newW;
        }
      };
      winResize();
      jQuery(window).bind('resize.smartmenus' + obj.rootId, winResize);
    });

  });

  // fix collapsible menu detection for Bootstrap 3
  $.SmartMenus.prototype.isCollapsible = function() {
    return this.$firstLink.parent().css('float') != 'left';
  };

})(jQuery);