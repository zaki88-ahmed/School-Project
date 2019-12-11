<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>   
	<div class="col-md-4"> 
        <aside class="sidebar" >
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </aside>
    </div>   
<?php endif; ?>