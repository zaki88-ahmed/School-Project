<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package software
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
	</head>
    <body <?php body_class(); ?>>
    	<section class="logo-menu">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-4 col-sm-3">
                        <?php
                        if (has_custom_logo()):
                        ?>
                        <div class="logo">
                        <?php the_custom_logo(); ?>
                            <?php $description = get_bloginfo( 'description', 'display' ); ?>
                            <?php if ( $description || is_customize_preview() ) : ?>
                            <p class="site-description"><?php bloginfo('description');?></p>
                            <?php endif;?>
                        </div>
                        <?php else: ?>
                            <?php $description = get_bloginfo( 'description', 'display' ); ?>
                            <?php if ( $description || is_customize_preview() ) : ?>
                            <div class="logo">
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                            rel="home"><?php bloginfo('name'); ?></a></h1>
                            <p class="site-description"><?php bloginfo('description');?></p>
                            </div>
                            <?php endif;?>
                         <?php endif;?>
    				</div>
    				<div class="col-md-8 col-sm-9">
    					<div class="main-menu">
    						<nav class="navbar navbar-default" role="navigation">
    							
    							<div class="navbar-header">
    								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
    									<span class="sr-only"><?php echo esc_html(__('Toggle navigation','software'));?></span>
    									<span class="icon-bar"></span>
    									<span class="icon-bar"></span>
    									<span class="icon-bar"></span>
    								</button>
    							</div>
    						
    							
    							<div class="collapse navbar-collapse navbar-ex1-collapse">
    							
                                     <?php
                                    wp_nav_menu( array(
                                            'theme_location'    => 'primary',
                                            'depth'             => 8,
                                            'container'         => '',
                                            'items_wrap'      => '<ul id="main-search" class="nav navbar-nav navbar-right">%3$s</ul>',
                                            'menu_class'        => 'nav navbar-nav navbar-right',
                                            'fallback_cb'       => 'software_wp_bootstrap_navwalker::fallback',
                                            'walker'            => new software_wp_bootstrap_navwalker())
                                    );

                                    ?>
    							</div>
    						</nav>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>