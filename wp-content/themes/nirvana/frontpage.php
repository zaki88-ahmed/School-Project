<?php
/**
 * Frontpage generation
 *
 * @package nirvana
 * @subpackage Functions
 */

/**
 * Frontpage general generation call
 */
nirvana_frontpage_generator();

/**
 * Handles the entire presentation page structure and calls additional section functions
 */
function nirvana_frontpage_generator() {
	$nirvanas = nirvana_get_theme_options();
	extract($nirvanas); ?>
	<div id="frontpage">
		<?php
		// Slider
		if ($nirvana_slideType=="Slider Shortcode") { ?>
			<div class="slider-wrapper">
			<?php echo do_shortcode( $nirvana_slideShortcode ); ?>
			</div> <?php
		} else {
			nirvana_ppslider();
		} ?>

		<div id="pp-afterslider" class="entry-content">
		<?php
		// First FrontPage Title
		nirvana_pptext_output( $nirvana_fronttext1, $nirvana_fronttext3, 'pp-texttop', 1, 3 );

		// FrontPage Columns
		nirvana_ppcolumns();

		// Second FrontPage title
		nirvana_pptext_output( $nirvana_fronttext2, $nirvana_fronttext4, 'pp-textmiddle', 2, 4 );

		// restore excerpt filters
		if ($nirvanas['nirvana_excerpttype']=='Characters') {
			add_filter( 'get_the_excerpt', 'nirvana_excerpt_trim_chars' );
		} else {
			add_filter( 'excerpt_length', 'nirvana_excerpt_trim_words' );
			add_filter( 'get_the_excerpt', 'nirvana_excerpt_morelink', 20 );
		}
		if ($nirvana_frontposts=="Enable"): get_template_part('content/content', 'frontpage'); endif;

		// Third FrontPage Title/Text
		nirvana_pptext_output( $nirvana_fronttext5, $nirvana_fronttext6, 'pp-textbottom', 5, 6 );
		?>

		</div> <!-- #pp-afterslider -->
	</div> <!-- #frontpage -->
	<?php
} // nirvana_frontpage_generator()

/**
 * Handles slider output
 */
function nirvana_ppslider_output( $slides ) {
	$nirvanas = nirvana_get_theme_options();
	extract($nirvanas);

	if (count($slides)>0): ?>
	<div class="slider-wrapper theme-default <?php if($nirvana_fpsliderarrows=="Visible on Hover") echo "slider-navhover"; ?> slider-<?php echo  preg_replace("/[^a-z0-9]/i","", strtolower($nirvana_fpslidernav)); ?>">
		 <div class="ribbon"></div>
		 <div id="slider" class="nivoSlider">
		<?php foreach( $slides as $id => $slide ):
				if ( $slide['image'] ) { ?>
				<a href="<?php echo ($slide['link'] ? $slide['link'] : '#'); ?>">
					<img src="<?php echo $slide['image']; ?>" data-thumb="<?php echo $slide['image']; ?>" alt="<?php echo ( $slide['title'] ? esc_attr($slide['title']) : '' ); ?>" <?php if ($slide['title'] || $slide['text']) : ?>title="#caption<?php echo $id;?>" <?php endif; ?> />
				</a><?php } ?>
		 <?php endforeach; ?>
		 </div>
		 <?php foreach( $slides as $id => $slide ): ?>
				<div id="caption<?php echo $id;?>" class="nivo-html-caption">
					<h2> <?php echo $slide['title'] ?></h2>
					<div class="slider-text-separator"></div>
					<div class="slide-text"> <div class="inline-slide-text"> <?php echo $slide['text'] ?></div> </div>
					<?php if($nirvana_slidereadmore && $slide['link'] ) { ?>
					<div class="readmore">
						<a href="<?php echo esc_url($slide['link']) ?>"><?php echo esc_attr($nirvana_slidereadmore) ?> <i class="column-arrow"></i> </a>
					</div>
					<?php } ?>
				</div>

		<?php endforeach; ?>
		 </div>
	<?php endif;
} // nirvana_ppslider_output()

/**
 * Handles generated columns section output
 */
function nirvana_columns_output($columns, $count){
	$counter=0;
	$nirvanas = nirvana_get_theme_options(); ?>
	<div id="front-columns-box">
	<div id="front-columns" class="ppbox nirvana-custom-columns">
	<?php if (!empty($nirvanas['nirvana_columnstitle'])) { ?> <h2> <?php echo do_shortcode($nirvanas['nirvana_columnstitle']) ?> </h2> <?php } ?>
	<?php
	foreach ($columns as $column):
		if($column['image']) :
			$counter++;
			if (!isset($column['blank'])) $column['blank'] = 0;
			$coldata = array(
				'colno' => (($counter%$count)?$counter%$count:$count),
				'counter' => $counter,
				'image' => esc_url($column['image']),
				'link' => esc_url($column['link']),
				'blank' => ($column['blank']?'target="_blank"':''),
				'title' =>  $column['title'],
				'text' => $column['text'],
			);
			nirvana_singlecolumn_output($coldata); // defined in includes/widgets.php
		endif;
	endforeach; ?>
</div> </div><?php
} // nirvana_columns_output()

// nirvana_singlecolumn_output() located in includes/widget.php (pluggable)

/**
 * Handles widget columns section output
 */
function nirvana_widgetcolumns_output( $title = '' ) {
	?>
	<div id="front-columns-box">
		<div id="front-columns" class="ppbox nirvana-widget-columns">
			<?php if (!empty($title)) { ?><h2> <?php echo do_shortcode($title) ?> </h2> <?php } ?>
			<?php dynamic_sidebar( 'presentation-page-columns-area' ); ?>
			</div>
	</div><!--front-columns-box-->
	<?php
} // nirvana_widgetcolumns_output()

/**
 * Handles text areas section output
 */
function nirvana_pptext_output( $title, $text, $id, $title_id, $text_id ) {
	if (!empty($title) || !empty($text)) { ?>
		<div id="<?php echo $id ?>"><?php
			if (!empty($title)) { ?><div id="front-text<?php echo $title_id ?>" class="ppbox"> <h2><?php echo do_shortcode($title) ?> </h2></div><?php }
			if (!empty($text)) { ?><div id="front-text<?php echo $text_id ?>" class="ppbox"> <?php echo force_balance_tags( do_shortcode($text) ) ?> </div><?php } ?>
		</div><!--pp-text--><?php }
} // nirvana_pptext_output()

/**
 * Handles slider init script output
 */
function nirvana_pp_slider() {
	$nirvanas = nirvana_get_theme_options(); ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#slider').nivoSlider({
			effect: '<?php  echo esc_html($nirvanas['nirvana_fpslideranim']); ?>',
			animSpeed: <?php echo esc_html($nirvanas['nirvana_fpslidertime']); ?>,
			<?php if ($nirvanas['nirvana_fpsliderarrows']=="Hidden"): ?>directionNav: false,<?php endif;
			if ($nirvanas['nirvana_fpsliderarrows']=="Always Visible"): ?>directionNavHide: false,<?php endif; ?>
			//controlNavThumbs: true,
			beforeChange: function(){
				jQuery('.nivo-caption h2').addClass('nivo-caption-mate');
				jQuery('.inline-slide-text').fadeOut(500);
				jQuery('.inline-slide-text').css({'opacity':'100','display':'inline'});
				jQuery('.readmore').fadeOut(500);
				jQuery('.readmore').css({'opacity':'100','display':'table'});
			},
			pauseTime: <?php echo esc_html($nirvanas['nirvana_fpsliderpause']); ?>
		});
	});
	</script>
	<?php
} // nirvana_pp_slider()

// FIN