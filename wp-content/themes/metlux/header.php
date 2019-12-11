<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package metlux
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		
		
		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?> >
		
		<!--====================================
		=            Site Container            =
		=====================================-->
		
		
		<div class="site-container">
			
			<!--===============================
			=            Logo Menu            =
			================================-->
			
			<header class="logo-menu">
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<!--==========================
							=            Logo            =
							===========================-->
							
			<?php
              if (has_custom_logo()){ ?>
              <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="">
                  <?php the_custom_logo(); ?>                  
                </a>
                <p class="site-description"><?php bloginfo('description');?></p>
              </div>
              <?php }else{ ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                rel="home"><?php bloginfo('name'); ?></a></h1>
                <p class="site-description"><?php bloginfo('description');?></p>
              <?php }?>
							
							<!--====  End of Logo  ====-->
							
						</div>
						<div class="col-sm-9">
							<!--==================================
							=            Primary Menu            =
							===================================-->
							
							<div class="main-menu">
								
                    <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"><?php esc_html_e('Toggle navigation','metlux');?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse">

          <!-- Right nav -->
           <?php
                    wp_nav_menu( array(
                      'theme_location'    => 'primary',
                      'depth'             => 8,
                      'container'         => 'div',
                      'container_class'   => 'collapse navbar-collapse',
                      'container_id'      => 'bs-example-navbar-collapse-1',
                      'menu_class'        => 'nav navbar-nav navbar-left',
                      'fallback_cb'       => 'metlux_wp_bootstrap_navwalker::fallback',
                      'walker'            => new metlux_wp_bootstrap_navwalker()
                      ));
                    
                    ?><!--/.nav-collapse -->     

        </div><!--/.nav-collapse -->
      </div>

            
							</div>
							
							<!--====  End of Primary Menu  ====-->
							
						</div>
					</div>
				</div>
			</header>
			
			<!--====  End of Logo Menu  ====-->
