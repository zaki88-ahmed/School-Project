
<form role="search" method="get" class="searchform input-group" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" placeholder="<?php echo esc_html(__("Search","education-one"));?>" id="search" class="form-control" value="<?php echo get_search_query(); ?>">
	<span class="input-group-btn">
		<button type="submit" id="searchsubmit" value="<?php echo esc_html(__("Search","education-one"));?>">
			<span class="glyphicon glyphicon-search" aria-hidden="true">
			</span>
		</button>
	</span>
</form>