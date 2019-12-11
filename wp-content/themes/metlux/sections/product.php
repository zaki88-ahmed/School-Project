<!--=======================================
=            Portfolio section            =
========================================-->
<?php 
global $post;
	$sectionenable = esc_attr(get_theme_mod('product_enable',1));
	if($sectionenable==1){
		$title = esc_html(get_theme_mod('product_title',__('Product Title','metlux')));
		$desc	= esc_html(get_theme_mod('product_content',__('Product Subtitle','metlux')));
		$catId = esc_attr(get_theme_mod('metlux_product_category_display',1)); 
        $cat   = esc_attr(get_the_category_by_ID($catId)); 
 
    	 $product='<section class="portfolio" >
                <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Section Title -->
                        <div class="section-title">
                            <h2>'.$title.'</h2>
                            <div class="divider"></div>
                            <p>'.$desc.'</p>
                        </div>
                    </div>
                </div>';
                //end of row

    $product.='<div class="row">
                <div class="col-sm-12">
                <div>
                    
                    <ul class="nav nav-tabs" role="tablist">';
    $product.='<li role="presentation" class="active"><a href="#'.$cat.'" aria-controls="'.$cat.'" role="tab" data-toggle="tab">'.__('All','metlux').'</a></li>';
                  // Parent Category name
                        $category = get_category_by_slug( $cat );

                                $args = array(
                                'type'                     => 'post',
                                'child_of'                 => $catId,
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
   
    $product.='<li role="presentation"><a href="#'.$term_slug.'" aria-controls="'.$term_slug.'" role="tab" data-toggle="tab">'.$term_name.'</a></li>';
                    endforeach;
    $product.='</ul>
                  <div class="tab-content">';

    // start all category
    $product.='<div role="tabpanel" class="tab-pane fade in active" id="'.$cat.'">
                        <div class="row">';
    
   
                        $the_query = new WP_Query( array ( 'category_name'=>$cat  ) );
                       
                        while ( $the_query->have_posts()): 
                        $the_query->the_post();
                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-products' );
                        $featured_image = esc_url($featured_image[0]);
                        $title          = get_the_title();
                        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all','parent' => $catId,);
                        $term =wp_get_post_terms(get_the_ID(),'category',$args);
                        foreach ($term as $terms) {
                            $term_name = $terms->name;
                        }


    
     $product.='              <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="single">';
                                if ( !has_post_thumbnail() ) {
                                                $product.='<img src="'.esc_url(get_template_directory_uri()).'/images/portfolio/p1.jpg"  alt="">';
                                }
                                else{   
                                                $product.='<img src="'.$featured_image.'"  alt="">';
                                }                
    $product.='                     <div class="on-hover">
                                        <a href="'.esc_url(get_permalink()).'" title="">
                                            <div class="inner">
                                            <h2>'.$cat.'</h2>
                                            
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>';
                        endwhile;
                        wp_reset_postdata();  
     $product.='       </div>
                    </div>
                    <!-- end of tabpanel-->';

                  //end all category


                        
                        $counter=0;
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
                        $counter++;
                        if($counter==1){
                            $active="active";
                        }else{
                            $active="";
                        }
   
   
    $product.='<div role="tabpanel" class="tab-pane fade in " id="'.$term_slug.'">
                        <div class="row">';
    
   
                            $the_query = new WP_Query( array ('category_name'=>$term_slug  ) );
                           
                            while ( $the_query->have_posts()): 
                            $the_query->the_post();
                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-products' );
                            $featured_image = esc_url($featured_image[0]);
                            
     $product.='              <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="single">';
                                if ( !has_post_thumbnail() ) {
                                                $product.='<img src="'.esc_url(get_template_directory_uri()).'/images/portfolio/p1.jpg"  alt="">';
                                }
                                else{   
                                                $product.='<img src="'.$featured_image.'"  alt="">';
                                }                
    $product.='                     <div class="on-hover">
                                        <a href="'.esc_url(get_permalink()).'" title="">
                                            <div class="inner">
                                            <h2>'.$cat.'</h2>
                                            <p>'.$term_name.'</p>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>';
                            endwhile;
                            wp_reset_postdata();  
     $product.='       </div>
                    </div>';
             
                     endforeach;               
    $product.='</div></div></div></div></div></section>';
    echo $product;

 }?>

<!--====  End of Portfolio section  ====-->
