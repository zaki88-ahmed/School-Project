<?php
/**
 * Template Name: Frontpage
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package education-one
 */

get_header(); ?>


<?php
    $slider = esc_attr(get_theme_mod('slider_disable',1));
    if($slider==1){
    	
 ?>
<section id="myCarousel" class="carousel slide">
       
       <ol class="carousel-indicators">
		<?php
				$cid = esc_attr(get_theme_mod('slider_category_display'));
				$category_link = get_category_link($cid);
				$education_one_cat = get_category($cid);
				if ($education_one_cat) {
    		?>

      		<?php
      			$posts_per_page = esc_attr(get_theme_mod('slider_no_of_posts',5));
                $args = array(
                  'posts_per_page' => $posts_per_page,
                  'paged' => 1,
                  'cat' => $cid
                );
                $loop = new WP_Query($args);
                
                $cn = -1;
                if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
            ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo esc_html($cn); ?>" class="<?php if($cn==0){echo 'active';} ?>"></li>
            <?php endwhile;wp_reset_postdata(); endif; }?>
            
        </ol> 

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
		 <?php
			$cid = esc_attr(get_theme_mod('slider_category_display'));
			$category_link = get_category_link($cid);
			$education_one_cat = get_category($cid);
			if ($education_one_cat) {
		?>

  		<?php
  			$posts_per_page = esc_attr(get_theme_mod('slider_no_of_posts',5));
            $args = array(
              'posts_per_page' => $posts_per_page,
              'paged' => 1,
              'cat' => $cid
            );
            $loop = new WP_Query($args);
            
            $cn = 0;
            if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
             $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'education-one-slider-thumb' );
       		 $readmore    = esc_attr(get_theme_mod('readmore_slider_disable',1));
       		 $buttontitle = esc_html(get_theme_mod('section_Button_title',__('Services','education-one')));
       		 $buttonlink  = esc_url(get_theme_mod('section_Button_link','#'));
			 $readmoretitle = esc_html(get_theme_mod('section_readmore_title',__('Read More','education-one')));
			 if ($readmoretitle == '') $readmoretitle = __('Read More','education-one');
        ?>
            <div class="item <?php echo $cn == 1 ? 'active' : ''; ?>">
                <div class="fill" style="background-image:url('<?php echo esc_url($image[0]); ?>');"></div>
                <div class="carousel-caption outer center-caption">
                    <div class="inner">
                    <h1><?php the_title(); ?></h1>
                    <?php the_excerpt(); ?>
                    <?php if($readmore==1): ?>
                   		 <a href="<?php the_permalink(); ?>" class="btn btn-theme" title=""><?php echo esc_html($readmoretitle);?></a>
                    <?php endif;?>
                    <?php if($buttontitle): ?>
                    	 <a href="<?php echo esc_url($buttonlink); ?>" class="btn btn-dark" title=""><?php echo esc_html($buttontitle); ?></a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
          <?php                 
			endwhile;
				wp_reset_postdata();  
			endif;                             
				}
			?> 
           
        </div>

  
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>


</section>
<?php } ?>


<?php
    $about = esc_attr(get_theme_mod('about_disable',1));
    if($about==1){
    	
 ?>
<section id="about" class="section about-us">
	<div class="container">
		<div class="row">

		<!-- Section Title -->
<!-- 
* for section title make option to laign left, right and center by adding class name left and right to 'section-title'. Center is default so, no need to add class center.
 -->
			<div class="col-sm-12">
				<div class="section-title wow slideInDown">
					<h1><?php echo esc_html(get_theme_mod('about_title')); ?></h1>
					<p><?php echo esc_html(get_theme_mod('about_text')); ?></p>
				</div>
			</div>

		<?php
			$cid = esc_attr(get_theme_mod('about_category_display'));
			$category_link = get_category_link($cid);
			$education_one_cat = get_category($cid);
			if ($education_one_cat) {
		?>

  		<?php
  			$posts_per_page = esc_attr(get_theme_mod('about_no_of_posts',4));
            $args = array(
              'posts_per_page' => $posts_per_page,
              'paged' => 1,
              'cat' => $cid
            );
            $loop = new WP_Query($args);
            
            $cn = 0;
            if ($posts_per_page > 0 && $loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
            
        ?>
			<div class="col-md-3 col-sm-6 column">
				<div class="feature-single">
					<i class="<?php echo esc_attr(get_theme_mod('about_icon','fa fa-laptop')); ?>"></i>
					<a href="<?php the_permalink(); ?>"> <h2><?php the_title(); ?></h2></a>
					<?php the_excerpt(); ?>
				</div>
			</div>
		<?php                 
			endwhile;
			if($cn%4==0): 
				echo '<div class="clearfix"></div>';
			endif;
				wp_reset_postdata();  
			endif;                             
				}
			?> 

		</div>
	</div>
</section>

<?php }?>
<?php
    $timer = esc_attr(get_theme_mod('about_timer_disable',1));
    if($timer==1){
    	$imageurl = esc_url(get_theme_mod('timer_background',get_template_directory_uri().'/images/background.jpg'));
    	
 ?>

<section class="section facts image" style="background-image:url('<?php echo esc_url($imageurl);?>');">
	<div class="container">
		<div class="row">
		<?php
        for ( $i = 1; $i <= 4; $i++ ) { 
            
        ?>
			<div class="col-md-3 col-sm-6 column">
				<div class="single">
					<h3 class="count"><?php echo esc_attr(get_theme_mod('education_one_counter'.$i)); ?></h3>
					<p><?php echo esc_html(get_theme_mod('education_one_title'.$i)); ?></p>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</section>

<?php }?>
<!--====  End of Facts  ====-->


<!--==============================
=            Services            =
* To make background of this section dark, add class dark to section, theme for brand color, image if there is background image. White is default.
===============================-->
<?php
    $services = esc_attr(get_theme_mod('service_disable',1));
    if($services==1){
    	
 ?>
<section id="services" class="section our-services">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="section-title wow slideInDown">
					<h1><?php echo esc_html(get_theme_mod('service_title')); ?></h1>
					<p><?php echo esc_html(get_theme_mod('service_text')); ?></p>
				</div>
			</div>
<?php
			$cid = esc_attr(get_theme_mod('service_category_display'));
			$category_link = get_category_link($cid);
			$education_one_cat = get_category($cid);
			if ($education_one_cat) {
		?>

  		<?php
  			$posts_per_page = esc_attr(get_theme_mod('service_no_of_posts',4));
            $args = array(
              'posts_per_page' => $posts_per_page,
              'paged' => 1,
              'cat' => $cid
            );
            $loop = new WP_Query($args);
            
            $cn = 0;
            if ($posts_per_page >0 && $loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
            
        ?>
			<div class="col-md-4 col-sm-6">
				<div class="single">
					<div class="icon"><i class="<?php echo esc_attr(get_theme_mod('service_icon','fa fa-laptop')); ?>"></i></div>
					<div class="content">
						<a href="<?php  the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>

			<?php                 
			endwhile;
			if($cn%3==0): 
				echo '<div class="clearfix"></div>';
			endif;
				wp_reset_postdata();  
			endif;                             
				}
			?> 
		</div>
	</div>
</section>
<?php }?>
<?php
    $cta = esc_attr(get_theme_mod('cta_disable',1));
    if($cta==1){
    	$imageurl = esc_url(get_theme_mod('cta_background',get_template_directory_uri().'/images/background.jpg'));


 ?>
<section class="section lead image" style="background-image:url('<?php echo esc_url($imageurl); ?>');">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 no-padding"></div>
			<div class="col-sm-6 no-padding">
				<div class="block">

<!-- 
* Add class 'text-right' to align content to right and 'text-left' to align left. Left is default.
 -->
					<div class="content">
						<h2><?php echo esc_html(get_theme_mod('cta_title')); ?></h2>
					<p><?php echo esc_html(get_theme_mod('cta_text')); ?></p>
					<a class="btn" href="<?php echo esc_url(get_theme_mod('cta_button_link')); ?>" title=""><?php echo esc_html(get_theme_mod('cta_button_title')); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php }?>
<!--====  End of Lead to contact  ====-->


<!--===============================
=            Portfolio            =
* To make background of this section dark, add class dark to section, light for white, image if there is background image. theme should be default.
================================-->
<?php
    $portfolio = esc_attr(get_theme_mod('portfolio_disable',1));
    if($portfolio==1){
    	
 ?>
<section id="works" class="section portfolio theme">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="section-title wow slideInDown">
					<h1><?php echo esc_html(get_theme_mod('portfolio_title')); ?></h1>
					<p><?php echo esc_html(get_theme_mod('portfolio_text')); ?></p>
				</div>
			</div>
			<div class="col-sm-12">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<?php 
						$cid = esc_attr(get_theme_mod('portfolio_category_display',1));
						$category_link = get_category_link($cid);
						$cat = get_the_category_by_ID($cid);
					?>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#<?php echo esc_html($cat); ?>" aria-controls="<?php echo esc_html($cat); ?>" role="tab" data-toggle="tab"><?php echo esc_html($cat); ?></a>
						</li>
						<?php

							 $category = get_category_by_slug( $cat );

                                $args = array(
                                'type'                     => 'post',
                                'child_of'                 => $cid,
                                'orderby'                  => 'name',
                                'order'                    => 'ASC',
                                'hide_empty'               => FALSE,
                                'hierarchical'             => 1,
                                'taxonomy'                 => 'category',
                                ); 

		                    $termchildren = get_categories($args );
		                       
		                        foreach($termchildren as $termchildren):
		                            $term_name = $termchildren->name;
		                            $term_slug = $termchildren->slug;
						 ?>
						<li role="presentation">
							<a href="#<?php echo esc_html($term_slug); ?>" aria-controls="<?php echo esc_html($term_slug); ?>" role="tab" data-toggle="tab"><?php echo esc_html($term_name); ?></a>
						</li>
							<?php endforeach; ?>
						
					</ul>
				
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="<?php echo esc_html($cat); ?>">
							<?php 
								$the_query = new WP_Query( array ( 'category_name'=>$cat  ) );
		                       
		                        while ( $the_query->have_posts()): 
		                        $the_query->the_post();
		                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'education-one-portfolio-thumb' );
		                        $featured_image = $featured_image[0];
		                        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all','parent' => $cid,);
		                        $term =wp_get_post_terms(get_the_ID(),'category',$args);
		                        foreach ($term as $terms) {
		                            $term_name = $terms->name;
		                        }
							?>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="single">
									<img src="<?php echo esc_url($featured_image); ?>" class="center-block" alt="">
									<div class="info">
										<div class="outer">
											<h3 class="inner"><a href="<?php the_permalink(); ?>" title=""><?php if($term_name): echo esc_html($term_name); else: echo esc_html($cat); endif; ?></a></h3>
										</div>
									</div>
								</div>
							</div>
							<?php 
							  endwhile;
                       		 wp_reset_postdata(); 
                        	 ?>
						</div>
						<?php 
						$category = get_category_by_slug( $cat );

                                $args = array(
                                'type'                     => 'post',
                                'child_of'                 => $category->term_id,
                                'orderby'                  => 'name',
                                'order'                    => 'ASC',
                                'hide_empty'               => FALSE,
                                'hierarchical'             => 1,
                                'taxonomy'                 => 'category',
                                ); 

                        $termchildren = get_categories($args );
                        
                        foreach($termchildren as $termchildren):
                            $term_name = $termchildren->name;
                            $term_slug = $termchildren->slug; 
   						?>
   						<div role="tabpanel" class="tab-pane " id="<?php echo esc_html($term_slug); ?>">
   						<?php 
   						 $the_query = new WP_Query( array ('category_name'=>$term_slug  ) );
                           
                            while ( $the_query->have_posts()): 
                            $the_query->the_post();
                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'products' );
                            $featured_image = $featured_image[0];
   						?>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="single">
									<img src="<?php echo esc_url($featured_image); ?>" class="center-block" alt="">
									<div class="info">
										<div class="outer">
											<h3 class="inner"><a href="<?php the_permalink(); ?>" title=""><?php if($term_name): echo esc_html($term_name); else: echo esc_html($cat); endif; ?></a></h3>
										</div>
									</div>
								</div>
							</div>
							<?php 
							  endwhile;
                       		 wp_reset_postdata(); 
                        	 ?>
						</div>	
						<?php endforeach; ?>				
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>
<!--====  End of Portfolio  ====-->


<!--==============================
=            Our Team            =
* To make background of this section dark, add class dark to section, theme for brand color, image if there is background image. light is default.
===============================-->
<?php
    $team = esc_attr(get_theme_mod('team_disable',1));
    if($team==1){
    	
 ?>

<section id="team" class="section our-team">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="section-title wow slideInDown">
					<h1><?php echo esc_html(get_theme_mod('team_title')); ?></h1>
					<p><?php echo esc_attr(get_theme_mod('team_text')); ?></p>
				</div>
			</div>

			<div class="col-sm-12">
				<!-- Set up your HTML -->
				<div id="our-team">
				<?php
					$cid = esc_attr(get_theme_mod('team_category_display'));
					$category_link = get_category_link($cid);
					$education_one_cat = get_category($cid);
					if ($education_one_cat) {
				?>

		  		<?php
		  			$posts_per_page = esc_attr(get_theme_mod('team_no_of_posts',5));
		            $args = array(
		              'posts_per_page' => $posts_per_page,
		              'paged' => 1,
		              'cat' => $cid
		            );
		            $loop = new WP_Query($args);
		            
		       
		            if ($posts_per_page > 0 && $loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
		            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'education-one-team-thumb' );
		            $featured_image = $featured_image[0];
		            
		        ?>
				  <div class="team single">
				  	<div class="team-img"><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($featured_image); ?>" alt=""></a></div>
				  	<div class="info">
				  		<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="pull-right"><i class="fa fa-ellipsis-v"></i>
				        </span></h3>
				       <?php the_excerpt(); ?>
				  	</div>
				  </div>
				  <?php                 
					endwhile;
						wp_reset_postdata();  
					endif;                             
						}
					?> 
				</div>
			</div>

		</div>
	</div>
</section>

<?php } ?>

<!--====  End of Our Team  ====-->



<?php
    $blog = esc_attr(get_theme_mod('blog_disable',1));
    if($blog==1){
    	
 ?>
<section id="blog" class="section blog light">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="section-title wow slideInDown">
					<h1><?php echo esc_html(get_theme_mod('blog_title')); ?></h1>
				</div>
			</div>

		<?php
			$cid = esc_attr(get_theme_mod('blog_category_display'));
			$category_link = get_category_link($cid);
			$education_one_cat = get_category($cid);
			if ($education_one_cat) {
		?>

  		<?php
  			$posts_per_page = esc_attr(get_theme_mod('blog_no_of_posts',4));
            $args = array(
              'posts_per_page' => $posts_per_page,
              'paged' => 1,
              'cat' => $cid
            );
            $loop = new WP_Query($args);
            
            $cn = 0;
            if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
             $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'education-one-blog-thumb' );
		     $featured_image = $featured_image[0];
        ?>
			<div class="col-md-3 col-sm-6 col-xs-12 column">
				<div class="single">
					<div class="image">
						<img src="<?php echo esc_url($featured_image); ?>" class="center-block" alt="">
						<h5 class="date"><?php echo esc_attr(get_the_date()); ?></h5>
							   
					</div>
					<div class="content">
						<a href="<?php the_permalink(); ?>"><h2><?php the_title() ?></h2></a>
						<?php the_excerpt(); ?>
						
					</div>
				</div>
			</div>
			<?php                 
			endwhile;
			if($cn%4==0): 
				echo '<div class="clearfix"></div>';
			endif;
				wp_reset_postdata();  
			endif;                             
				}
			?> 

		

		</div>
	</div>
</section>
<?php } ?>
<?php if ( is_active_sidebar( 'newsletter' ) ) :
$imageurl = esc_url(get_theme_mod('newsletter_background',get_template_directory_uri().'/images/background.jpg'));
 ?>

<section class="section newsletter-sec image" style="background-image:url('<?php echo esc_url($imageurl); ?>');">
	<div class="container">
		<div class="row">
		
		<div class="col-md-12 newsletter-section">
			<?php dynamic_sidebar('newsletter'); ?>
		</div>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
    $contact = esc_attr(get_theme_mod('contact_disable',1));
    if($contact==1){
    	
 ?>

<section id="contact" class="section contact">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="contact-form">
					<div class="row">
					
						<div class="col-sm-12">
						<?php echo do_shortcode(get_theme_mod('contact_form'));?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				
				<?php dynamic_sidebar('contact-info'); ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php
    $map = esc_attr(get_theme_mod('map_disable',1));
    if($map==1){
    	
 ?>
<section class="google-map">
	<div class="container-fluid">
		<div class="row">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <?php echo esc_html(get_theme_mod('map_menu_title')); ?><br>
          <i class="fa fa-angle-double-down"></i>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
		<section id="cd-google-map">
			<iframe src="<?php echo esc_url(get_theme_mod('map_iframe')); ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			
		</section>
      </div>
    </div>
  </div>
  

</div>
		</div>
	</div>
</section>
<?php } ?>


<!--====  End of Contact Us  ====-->

<?php 
get_footer();