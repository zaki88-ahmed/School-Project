<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package engager
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
      
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<section class="logo-menu">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">           
				<div class="logo">
					<?php if(has_custom_logo()):?>
						<?php the_custom_logo();?>
					<?php endif;?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/'));?>" rel="home"><?php bloginfo('name');?></a></h1>
                    <h5 class="site-description"><?php bloginfo('description'); ?></h5>
				</div>			
			</div>
			<div class="col-sm-8">				
			<nav class="navbar navbar-default navbar-right" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only"><?php esc_html_e('Toggle navigation','engager');?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<?php if(has_nav_menu( 'primary' )):?>
						<?php wp_nav_menu( array(
							'theme_location'	=>'primary',
							'menu'				=>'primary',
							'depth'				=>8,
							'menu_class'		=>'nav navbar-nav navbar-right',
							'fallback_cb'		=>'wp_bootstrap_navwalker::fallback',
							'walker'			=> new Engager_wp_bootstrap_navwalker()
						));?>

					<?php else:?>
				
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right">
							<?php 
							$args= array(
								'depth'			=>0,
								'echo'			=>1,	
								'post_type'		=>'page',	
								'post_status'	=>'publish',	
								'show_date'		=>'',
								'sort_coloum'	=>'menu_order',
								'title_li'		=>'',
								'walker'		=> new Engager_Walker_Page
							);
							wp_list_pages( $args );
							?>
						</ul>
					<?php endif;?>
					</div>
				</div><!-- /.navbar-collapse -->				
			</nav>
		
			</div>
		</div>
	</div>
</section>