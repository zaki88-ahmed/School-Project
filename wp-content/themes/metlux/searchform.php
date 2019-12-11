
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">

		<input type="text" class="form-control" placeholder="<?php echo esc_attr_x( 'Search for...', 'placeholder' , 'metlux' ) ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'metlux'  ) ?>" />
		<span class="input-group-btn">
			<button type="submit" class="btn"><i class="fa fa-search"></i></button>
		</span>	
	</div>
</form>