<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package education-one
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body id="home" data-spy="scroll" data-target="#onepage-nav" <?php body_class(); ?>>

<!--============================
=            Header            =
* Make header class="light" for light header
* Make header class="dark" for dark header
* Make header class="custom" for custom header
=============================-->

<header class="custom">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<!-- Navbar -->
				<div class="navbar navbar-default" role="navigation">
				  <div class="navbar-header">
				    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				      <span class="sr-only"><?php esc_html_e('Toggle navigation','education-one');?></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				    </button>
				     <?php if ( has_custom_logo() ): ?>
                        <div class="site_logo">
                                          <?php  the_custom_logo();  ?>
                        </div>
                        <?php else : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(get_site_url()); ?>" rel="home"><?php bloginfo('title'); ?></a></h1>
                    <?php endif;?>

                    <?php $description = get_bloginfo( 'description', 'display' ); ?>

                    <?php if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
				  </div>
				  <div id="onepage-nav" class="navbar-collapse collapse">
				  <?php $active_menu_items = 0; if ( 'posts' != get_option( 'show_on_front' ) && is_front_page() ): ?>
				    <ul class="nav navbar-nav navbar-right">
				    <?php
					    $home = get_theme_mod('slider_disable',0);
					    if($home==1){					    	
					 ?>
				      <li class="active"><a href="#home"><?php echo esc_html(get_theme_mod('section_title',__('Home','education-one'))); ?></a></li>
				      <?php
				       $active_menu_items++;}
					    $about = get_theme_mod('about_disable',0);
					    if($about==1){					    	
					 ?>
				      <li><a href="#about"><?php echo esc_html(get_theme_mod('about_menu_title',__('About','education-one'))); ?></a></li>
				      <?php 
				  		}
					    $about = get_theme_mod('service_disable',0);
					    if($about==1){					    	
					 ?>
				      <li><a href="#services"><?php echo esc_html(get_theme_mod('service_menu_title',__('Services','education-one'))); ?></a></li>
				       <?php
				   			$active_menu_items++;}
					    $about = get_theme_mod('portfolio_disable',0);
					    if($about==1){					    	
					 ?>
				      <li><a href="#works"><?php echo esc_html(get_theme_mod('portfolio_menu_title',__('Portfolio','education-one'))); ?></a></li>
				       <?php
				        $active_menu_items++;}
					    $about = get_theme_mod('team_disable',0);
					    if($about==1){					    	
					 ?>
				      <li><a href="#team"><?php echo esc_html(get_theme_mod('team_menu_title',__('Team','education-one'))); ?></a></li>

				       <?php
				        $active_menu_items++;}
					    $about = get_theme_mod('blog_disable',0);
					    if($about==1){					    	
					 ?>
				      <li><a href="#blog"><?php echo esc_html(get_theme_mod('blog_menu_title',__('Blog','education-one'))); ?></a></li>
				       <?php
				        $active_menu_items++;}
					    $about = get_theme_mod('contact_disable',0);
					    if($about==1){					    	
					 ?>
				      <li><a href="#contact"><?php echo esc_html(get_theme_mod('contact_menu_title',__('Contact','education-one'))); ?></a></li>
				      <?php $active_menu_items++;}?>
				    </ul>
                     <?php endif; ?>
					<?php if ($active_menu_items == 0) : ?>					 
				    <?php if (1)  : ?>
                            <?php
                            wp_nav_menu( array(
                                    'theme_location'    => 'primary',
                                    'depth'             => 8,                              
                                    'menu_class'        => 'nav navbar-nav navbar-right',
                                    'fallback_cb'       => 'education_one_wp_page_menu',
                                    'walker'            => new wp_bootstrap_navwalker())
                            );
                            ?>
                       
                        <?php endif; ?><!-- end of navbar-collapse -->
					<?php endif; ?>
				  </div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
	</div>
</header>
