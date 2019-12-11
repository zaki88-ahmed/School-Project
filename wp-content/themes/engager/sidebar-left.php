<?php if ( is_active_sidebar( 'left_sidebar' ) ) : ?>  
	<div class="col-md-4">  
        <aside class="sidebar" >
            <?php dynamic_sidebar( 'left_sidebar' ); ?>
        </aside>
    </div>       
<?php endif; ?>