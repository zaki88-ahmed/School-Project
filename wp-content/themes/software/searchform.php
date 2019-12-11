<div class="input-group">
 <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <input type="text" class="form-control" placeholder="<?php echo esc_attr_x( 'Type Something ', 'placeholder' , 'software' ) ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'software'  ) ?>" />
  <span class="input-group-btn">
    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
  </span>
  </form>
</div>