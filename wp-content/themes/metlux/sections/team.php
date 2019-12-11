<!--==============================
=            Our Team            =
===============================-->
<?php 
	$sectionenable = esc_attr(get_theme_mod('team_enable',1));
	if($sectionenable==1){
		$title = esc_attr(get_theme_mod('team_title', __('Team Title ','metlux')));
		$desc  = esc_html(get_theme_mod('team_content',__('Team Subtitle','metlux')));
		$postn = esc_attr(get_theme_mod('team_no_of_posts','4'));
		$catId = esc_attr(get_theme_mod('metlux_team_category_display',1));
		
?>
 <section class="our-team"  >
    <div class="container">
    <div class="row">
            <div class="col-sm-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2><?php echo $title; ?></h2>
                    <div class="divider"></div>
                    <p><?php echo $desc; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
        <?php 
        global $post;
    $counter=0;
    $the_query = new WP_Query( array ( 'posts_per_page' => $postn,'cat'=>$catId) );
    while ( $the_query->have_posts() ):$counter++;
        $the_query->the_post();
        $feat_team_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-team' );
        $feat_team_image = esc_url($feat_team_image[0]);
      ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single">
                    <div class="image">
                    <?php 
                        if ( !has_post_thumbnail() ) {
                                      echo  $team='<img src="'.esc_url(get_template_directory_uri()).'/images/team/team1.png" alt="">';
                                    }
                        else{   
                                     echo    $team= '<img src="'.$feat_team_image.'" alt="">';
                        }
                        ?>
                    </div>
                    <div class="info">
                        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                       
                    </div>
                </div>
        </div>
            <?php if($counter%4==0){ echo '<div class="clearfix"></div>';}
            
    endwhile;
    ?>
    
   		 </div>
   		</div>
   	</section>
   	<?php 
    wp_reset_postdata();
    ?>

<?php }?>
