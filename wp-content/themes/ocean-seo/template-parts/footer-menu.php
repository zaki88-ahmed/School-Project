<?php
if( has_nav_menu( 'footer' ) ) {
?>
	<div id="footernavbarouter" class="footernavbarouter">
	<?php
	if( class_exists( 'Mega_Menu' ) && max_mega_menu_is_enabled( 'footer' ) ) {
		wp_nav_menu( array( 'theme_location' => 'footer' ) );
	} else {
	?>
		<div class="container-fluid">		
			<?php
			wp_nav_menu( array(
				'theme_location'    => 'footer',
				'depth'             =>  1,
				'container'         => 'ul',
				'container_id'      => 'collapse-navbarfooter',
				'container_class'   => 'collapse navbar-collapse',
				'menu_id' 			=> 'footer-menu',
				'menu_class'        => 'nav navbar-nav footer-menu',
				));
			?>
		</div>
	<?php
	}
	?>
	</div>
<?php
}