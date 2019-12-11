<?php
// Callback functions

// Settings section description dummy placeholder function
function cryout_section_placeholder_fn() { };


////////////////////////////////
//// LAYOUT SETTINGS ///////////
////////////////////////////////

function cryout_setting_side_fn() {
	global $nirvanas;
	$values = array("1c", "2cSr", "2cSl", "3cSr" , "3cSl", "3cSs");
	$layout_text["1c"] = __("One column (no sidebars)","nirvana");
	$layout_text["2cSr"] = __("Two columns, sidebar on the right","nirvana");
	$layout_text["2cSl"] = __("Two columns, sidebar on the left","nirvana");
	$layout_text["3cSr"] = __("Three columns, sidebars on the right","nirvana");
	$layout_text["3cSl"] = __("Three columns, sidebars on the left","nirvana");
	$layout_text["3cSs"] = __("Three columns, one sidebar on each side","nirvana");

	foreach($values as $item) {
		$checkedClass = ($nirvanas['nirvana_side']==$item) ? ' checkedClass' : '';
		echo "<label id='$item' class='layouts $checkedClass'><input ";
		checked($nirvanas['nirvana_side'],$item);
		echo " value='$item' onClick=\"changeBorder('$item','layouts');\" name='nirvana_settings[nirvana_side]' type='radio' /><img title='$layout_text[$item]' src='".get_template_directory_uri()."/admin/images/".$item.".png'/></label>";
	}
	echo "<div><small>".__("Choose your layout. Possible options are: <br> No sidebar, a single sidebar on either left of right, two sidebars on either left or right and two sidebars on each side.<br>This can be overriden in pages by using Page Templates.","nirvana")."</small></div>";
}

function cryout_setting_sidewidth_fn() {
     global $nirvanas; ?>
     <script type="text/javascript">

	jQuery(function() {
		jQuery( "#slider-range" ).slider({
			range: true,
			step:10,
			min: 0,
			max: 1920,
			values: [ <?php echo $nirvanas['nirvana_sidewidth'] ?>, <?php echo ($nirvanas['nirvana_sidewidth']+$nirvanas['nirvana_sidebar']); ?> ],
			slide: function( event, ui ) {
          			range=ui.values[ 1 ] - ui.values[ 0 ];

           			if (ui.values[ 0 ]<500) {ui.values[ 0 ]=500; return false;};
          			if (	range<220 || range>800 ) { ui.values[ 1 ] = <?php echo $nirvanas['nirvana_sidebar']+$nirvanas['nirvana_sidewidth'];?>; return false; };

          			jQuery( "#nirvana_sidewidth" ).val( ui.values[ 0 ] );
          			jQuery( "#nirvana_sidebar" ).val( ui.values[ 1 ] - ui.values[ 0 ] );
          			jQuery( "#totalsize" ).html( ui.values[ 1 ]);
          			jQuery( "#contentsize" ).html( ui.values[ 0 ]);jQuery( "#barsize" ).html( ui.values[ 1 ]-ui.values[ 0 ]);

          			var percentage = parseInt( jQuery( "#slider-range .ui-slider-range" ).css('width') );
          			var leftwidth = parseInt( jQuery( "#slider-range .ui-slider-range" ).position().left );
          			jQuery( "#barb" ).css('left',-80+leftwidth+percentage/2+"px");
          			jQuery( "#contentb" ).css('left',-50+leftwidth/2+"px");
          			jQuery( "#totalb" ).css('width',(percentage+leftwidth)+"px");
               }
		});

		jQuery( "#nirvana_sidewidth" ).val( <?php echo $nirvanas['nirvana_sidewidth'];?> );
		jQuery( "#nirvana_sidebar" ).val( <?php echo $nirvanas['nirvana_sidebar'];?> );
		var percentage = <?php echo ($nirvanas['nirvana_sidebar']/1920)*100;?> ;
		var leftwidth = <?php echo ($nirvanas['nirvana_sidewidth']/1920)*100;?> ;

		jQuery( "#barb" ).css('left',(-18+leftwidth+percentage/2)+"%");
		jQuery( "#contentb" ).css('left',(-8+leftwidth/2)+"%");
		jQuery( "#totalb" ).css('width',(-2+percentage+leftwidth)+"%");
	});

     </script>

	<div id="absolutedim">
		<b id="contentb"><?php _e("Content =","nirvana");?> <span id="contentsize"><?php echo $nirvanas['nirvana_sidewidth'];?></span>px</b>
		<b id="barb"><?php _e("Sidebar(s) =","nirvana");?> <span id="barsize"><?php echo $nirvanas['nirvana_sidebar'];?></span>px</b>
		<b id="totalb"> <?php _e("Total width =","nirvana");?> <span id="totalsize"><?php echo $nirvanas['nirvana_sidewidth']+ $nirvanas['nirvana_sidebar'];?></span>px</b>
		<p><input type='hidden' name='nirvana_settings[nirvana_sidewidth]' id='nirvana_sidewidth' />
		<input type='hidden' name='nirvana_settings[nirvana_sidebar]' id='nirvana_sidebar' /></p>
		<div id="slider-range"></div>
		<div><small><?php _e("Select the width of your <b>content</b> and <b>sidebar(s)</b>. When using a 3 columns layout (with 2 sidebars) they will each have half the configured width.","nirvana"); ?></small></div>
	</div><!-- End absolutedim -->
	<?php 
} // cryout_setting_sidewidth_fn()

function cryout_setting_duality_fn() {
	global $nirvanas;
	$values = array ("Wide" , "Boxed");
	$labels = array( __("Wide","nirvana"), __("Boxed","nirvana"));
	echo "<span class='cryout_select'><select id='nirvana_duality' name='nirvana_settings[nirvana_duality]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_duality'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select></span>";
	echo "<div><small>".__("Select the layout format for your site.<br> <strong>Wide</strong> - full width layout. <br><strong>Boxed</strong> - fixed width layout.","nirvana")."</small></div>";
} // cryout_setting_mobile_fn()


function cryout_setting_magazinelayout_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_magazinelayout' name='nirvana_settings[nirvana_magazinelayout]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_magazinelayout'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Enable the Magazine Layout. This layout applies to pages with posts and shows 2 posts per row.","nirvana")."</small></div>";
} // cryout_setting_magazinelayout_fn()


function cryout_setting_mobile_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<span class='cryout_select'><select id='nirvana_mobile' name='nirvana_settings[nirvana_mobile]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_mobile'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select></span>&nbsp;";
	cryout_proto_field( $nirvanas, "checkbox", "nirvana_zoom", $nirvanas['nirvana_zoom'], __('Allow zoom','nirvana'));
	echo "<div><small>".__("Enable to make Nirvana fully responsive. The layout and general sizes of your blog will adjust depending on what device and what resolution it is viewed in.<br> Do not disable unless you have a good reason to.","nirvana")."</small></div>";
} // cryout_setting_mobile_fn()


//////////////////////////////
/////HEADER SETTINGS//////////
/////////////////////////////

function cryout_setting_hheight_fn() {
	global $nirvanas; $totally = $nirvanas['nirvana_sidebar']+$nirvanas['nirvana_sidewidth'];
	cryout_proto_field( $nirvanas, "input4", "nirvana_hheight", $nirvanas['nirvana_hheight'], " px");
	echo "<div><small>".__("Select the header's height. After saving the settings go and upload your new header image. The header's minimum width should be ","nirvana")."<strong>".$totally."px</strong>.</small></div>";
} // cryout_setting_hheight_fn()

function cryout_setting_himage_fn() {
	global $nirvanas;
	echo "<a href=\"?page=custom-header\" class=\"button\" target=\"_blank\">".__('Define header image','nirvana')."</a><br>";
	cryout_proto_field( $nirvanas, "checkbox", "nirvana_hcenter", $nirvanas['nirvana_hcenter'], __('Center the header image horizontally','nirvana'));
	echo "<br>";
	cryout_proto_field( $nirvanas, "checkbox", "nirvana_hratio", $nirvanas['nirvana_hratio'], __('Force header image responsiveness.', 'nirvana'));
	echo "<div><small>".__("By default the header has a minimum height set to accommodate the site title or custom logo. Enabling this option removes that minimum height and the header becomes fully responsive, scalling to any size.<br> Only enable this if you're <b>not</b> using a logo or site title and description in the header. Also make sure you have a header image uploaded. ","nirvana")."</small></div>";
} // cryout_setting_himage_fn()

function cryout_setting_siteheader_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_siteheader",
			array("Site Title and Description" , "Custom Logo" , "Clickable header image" , "Empty"),
			array( __("Site Title and Description","nirvana"), __("Custom Logo","nirvana"), __("Clickable header image","nirvana"), __("Empty","nirvana"))
	);
	echo "<div><small>".__("Choose what to display inside your header area.","nirvana")."</small></div>";
} // cryout_setting_siteheader_fn()

function cryout_setting_logoupload_fn() {
	global $nirvanas; ?>
	<div><img src='<?php echo ($nirvanas['nirvana_logoupload']!='') ? esc_url($nirvanas['nirvana_logoupload']) : get_template_directory_uri().'/admin/images/placeholder.gif'; ?>' class="imagebox" style="max-height:60px" /><br> <?php
	cryout_proto_field( $nirvanas, "input40url", "nirvana_logoupload", $nirvanas['nirvana_logoupload'], '','slideimages');
	echo "<div><small>".__("Custom Logo upload. The logo will appear over the header image if you have used one.","nirvana")."</small></div>"; ?>
	<span class="description"><br><a href="#" class="upload_image_button button"><?php _e( 'Select / Upload Image', 'nirvana' );?></a> </span> <?php
} // cryout_setting_logoupload_fn()

function cryout_setting_headermargin_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "input4str", "nirvana_headermargintop", $nirvanas['nirvana_headermargintop'], ' px '.__("top","nirvana")."&nbsp; &nbsp;" );
	cryout_proto_field( $nirvanas, "input4str", "nirvana_headermarginleft", $nirvanas['nirvana_headermarginleft'], ' px '.__("left","nirvana") );
	echo "<div><small>".__("Select the top and left spacing for the header content. Use it to better position your site title and description or custom logo inside the header. ","nirvana")."</small></div>";
} // cryout_setting_headermargin_fn()

function cryout_setting_favicon_fn() {
	global $nirvanas;?>
	<div>
		<img src='<?php echo  ($nirvanas['nirvana_favicon']!='')? esc_url($nirvanas['nirvana_favicon']):get_template_directory_uri().'/admin/images/placeholder.gif'; ?>' class="imagebox" width="64" height="64"/><br> <?php
		cryout_proto_field( $nirvanas, "input40url", "nirvana_favicon", $nirvanas['nirvana_favicon'], '','slideimages');
		echo "<div><small>".__("Limitations: It has to be an image. It should be max 64x64 pixels in dimensions. Recommended file extensions .ico and .png. <br> <strong>Note that some browsers do not display the changed favicon instantly.</strong>","nirvana")."</small></div>"; ?>
		<span class="description"><br><a href="#" class="upload_image_button button"><?php _e( 'Select / Upload Image', 'nirvana' );?></a> </span>
	</div> <?php
} // cryout_setting_favicon_fn()

function cryout_setting_headerwidgetwidth_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_headerwidgetwidth",
		array( "60%" , "50%" , "33%" , "25%" ),
		array( __("60%","nirvana"), __("50%","nirvana"), __("33%","nirvana"), __("25%","nirvana") )
	);
	echo "<div><small>".__("Limit the header widget area max width as percentage of the entire header width.","nirvana")."</small></div>";
} // cryout_setting_headerwidgetwidth_fn()


////////////////////////////////
//// PRESENTATION SETTINGS /////
////////////////////////////////

function cryout_setting_frontpage_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_frontpage",
		array("Enable" , "Disable"),
		array( __("Enable","nirvana"), __("Disable","nirvana"))
	); ?>
	<div><small> <?php _e("Enable the presentation front-page. This will become your new home page. <br><br>
	     <em> If you have this option enabled and you can't see the presentation page, make sure that the option under WordPress Dashboard &raquo; Settings &raquo; Reading &raquo; <strong>Front page displays</strong> is set to the default value <strong>Your Latest Posts</strong>.<br><br></em>
		If you want another page to hold your latest blog posts, choose 'Blog Template (Posts Page)' from Page Templates while creating or editing that page.","nirvana") ?></small></div> <?php
		if ($nirvanas['nirvana_frontpage'] == 'Enable' && get_option('show_on_front') != 'posts') {
			printf ( '<div class="slmini" style="color:#cb5920;">'.__('WordPress\' <em>Front page displays</em> option is set to use a static page. WordPress guidelines require that the static page option have priority over theme options.<br> Go to %1$s and set the <em>Front page displays</em> option to <em><strong>Your latest posts</strong></em> to enable the Presentation Page.',"nirvana").'</div>', '<a href="/wp-admin/options-reading.php" > Settings &raquo; Reading</a>');
		}
} // cryout_setting_frontpage_fn()

function cryout_setting_frontposts_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_frontposts",
		array("Enable" , "Disable"),
		array( __("Enable","nirvana"), __("Disable","nirvana"))
	);
 	echo "<div><small>".__("Enable to display the latest posts on the presentation page, below the columns. Sticky posts are always displayed and not counted.","nirvana")."</small></div>";
	echo "<div class='slmini'><b>".__("Show:","nirvana")."</b> ";
	echo "<input type='text' id='nirvana_frontpostscount' name='nirvana_settings[nirvana_frontpostscount]' size='3' value='";
 	echo $nirvanas['nirvana_frontpostscount']."'> ".__('posts','nirvana');
	echo "<div><small>".__("The number of posts to show on the Presentation Page. The same number of posts will be loaded with the <em>More Posts</em> button.","nirvana")."</small></div><br>";
	echo "</div>";

	echo "<div class='slmini'><b>".__("Posts per row:","nirvana")."</b> ";
	$values = array ("1", "2");
	echo "<select id='nirvana_frontpostsperrow' name='nirvana_settings[nirvana_frontpostsperrow]'>";
	foreach($values as $item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_frontpostsperrow'],$item);
		echo ">$item</option>";
	}
	echo "</select><small>".__("Select how many posts per row to display on the Presentation Page.","nirvana")."</small></div>"; ?>
	<div class='slmini'><b><?php _e("More Posts text:","nirvana");?></b>
		<input id='nirvana_frontmoreposts' name='nirvana_settings[nirvana_frontmoreposts]' size='30' type='text' value='<?php echo esc_attr( $nirvanas['nirvana_frontmoreposts'] ) ?>' />
		<small><?php _e("The label of the 'More Posts' button at the bottom of the Presentation Page.","nirvana") ?></small></div>
    </div> 
	<?php
} // cryout_setting_frontpage_fn()

function cryout_setting_frontslider_fn() {
	global $nirvanas;

	echo "<div class='slmini'><b>".__("Slider Dimensions:","nirvana")."</b> ";
	echo "<input id='nirvana_fpsliderwidth' name='nirvana_settings[nirvana_fpsliderwidth]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fpsliderwidth'] )."' /> px (".__("width","nirvana").") <strong>X</strong> ";
	echo "<input id='nirvana_fpsliderheight' name='nirvana_settings[nirvana_fpsliderheight]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fpsliderheight'] )."' /> px (".__("height","nirvana").")";
	echo "<small>".__("The dimensions of your slider. Make sure your images are of the same size.","nirvana")."</small></div>";

	echo "<div id='sliderParameters'><div class='slmini'><b>".__("Animation:","nirvana")."</b> ";
	$values = array ("random" , "fold", "fade", "slideInRight", "slideInLeft", "sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown" , "sliceUpDownLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow" , "boxRainGrowReverse");
	$labels = array( __("Random","nirvana"), __("Fold","nirvana"), __("Fade","nirvana"), __("SlideInRight","nirvana"), __("SlideInLeft","nirvana"), __("SliceDown","nirvana"), __("SliceDownLeft","nirvana"), __("SliceUp","nirvana"), __("SliceUpLeft","nirvana"), __("SliceUpDown","nirvana"), __("SliceUpDownLeft","nirvana"), __("BoxRandom","nirvana"), __("BoxRain","nirvana"), __("BoxRainReverse","nirvana"), __("BoxRainGrow","nirvana"), __("BoxRainGrowReverse","nirvana"));
	echo "<select id='nirvana_fpslideranim' name='nirvana_settings[nirvana_fpslideranim]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fpslideranim'],$item);
		echo ">$labels[$id]</option>";
	}

	echo "</select>";
	echo "<small>".__("The transition effect of your slides.","nirvana")."</small></div>";

	echo "<div class='slmini'><b>".__("Animation Time:","nirvana")."</b> ";
	echo "<input id='nirvana_fpslidertime' name='nirvana_settings[nirvana_fpslidertime]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fpslidertime'] )."' /> ".__("milliseconds","nirvana");
	echo "<small>".__("The time in which the transition animation will take place.","nirvana")."</small></div>";

	echo "<div class='slmini'><b>".__("Pause Time:","nirvana")."</b> ";
	echo "<input id='nirvana_fpsliderpause' name='nirvana_settings[nirvana_fpsliderpause]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fpsliderpause'] )."' /> ".__("milliseconds","nirvana");
	echo "<small>".__("The time in which a slide will be still and visible.","nirvana")."</small></div>";

	echo "<div class='slmini'><b>".__("Slider navigation:","nirvana")."</b> ";
	$values = array ("Numbers" , "Bullets" ,"None");
	$labels = array( __("Numbers","nirvana"), __("Bullets","nirvana"), __("None","nirvana"));
	echo "<select id='nirvana_fpslidernav' name='nirvana_settings[nirvana_fpslidernav]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fpslidernav'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<small>".__("Your slider navigation type. Shown under the slider.","nirvana")."</small></div>";

	echo "<div class='slmini'><b>".__("Slider arrows:","nirvana")."</b> ";
	$values = array ("Always Visible" , "Visible on Hover" ,"Hidden");
	$labels = array( __("Always Visible","nirvana"), __("Visible on Hover","nirvana"), __("Hidden","nirvana"));
	echo "<select id='nirvana_fpsliderarrows' name='nirvana_settings[nirvana_fpsliderarrows]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fpsliderarrows'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<small>".__("The Left and Right arrows on your slider","nirvana")."</small></div>";

		echo "<div class='slmini'><b>".__("Title font size:","nirvana")."</b> ";
	$values = array ("36px", "42px", "48px", "54px", "60px", "66px", "72px", "78px", "84px", "90px");
	echo "<select id='nirvana_fpslidertitlesize' name='nirvana_settings[nirvana_fpslidertitlesize]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fpslidertitlesize'],$item);
		echo ">$values[$id]</option>";
	}
	echo "</select> ";
	cryout_proto_field( $nirvanas, "checkbox", "nirvana_fpslider_titlecaps", $nirvanas['nirvana_fpslider_titlecaps'], __('All Caps','nirvana'));
	echo "<small>".__("Slider title Font size.","nirvana")."</small></div>";

	echo "<div class='slmini'><b>".__("Text font size:","nirvana")."</b> ";
	$values = array ("16px", "18px", "20px", "22px", "24px", "26px", "28px", "30px", "32px");
	echo "<select id='nirvana_fpslidertextsize' name='nirvana_settings[nirvana_fpslidertextsize]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fpslidertextsize'],$item);
		echo ">$values[$id]</option>";
	}
	echo "</select> ";
	cryout_proto_field( $nirvanas, "checkbox", "nirvana_fpslider_textcaps", $nirvanas['nirvana_fpslider_textcaps'], __('All Caps','nirvana'));
	cryout_proto_field( $nirvanas, "checkbox", "nirvana_fpslider_centertext", $nirvanas['nirvana_fpslider_centertext'], __('Center Align','nirvana'));
	echo "<small>".__("Text font size.","nirvana")."</small></div></div><!--sliderParameters-->";

	echo "<div class='slmini'><b>".__("Slider Border Width:","nirvana")."</b> ";
	echo "<input id='nirvana_fpslider_bordersize' name='nirvana_settings[nirvana_fpslider_bordersize]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fpslider_bordersize'] )."' /> ".__("px","nirvana");
	echo "<small>".__("The slider's border width. You can also edit its color from the Color Settings. Use a border width when your slider is smaller than the total site width.","nirvana")."</small></div>";

	echo "<div class='slmini'><b>".__("Slider Top/Bottom Margin:","nirvana")."</b> ";
	echo "<input id='nirvana_fpslider_topmargin' name='nirvana_settings[nirvana_fpslider_topmargin]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fpslider_topmargin'] )."' /> ".__("px","nirvana");
	echo "<small>".__("Add margins to the slider. By default this is set to 0 and you will want to increase this value when the slider is not full width.","nirvana")."</small></div>";

} // cryout_setting_frontslider_fn()

function cryout_setting_frontslider2_fn() {
	global $nirvanas;

	$values = array("Slider Shortcode", "Custom Slides", "Latest Posts", "Random Posts", "Sticky Posts", "Latest Posts from Category" , "Random Posts from Category", "Specific Posts","Disabled");
	$labels = array( __("Slider Shortcode","nirvana"), __("Custom Slides","nirvana"), __("Latest Posts","nirvana"), __("Random Posts","nirvana"),__("Sticky Posts","nirvana"), __("Latest Posts from Category","nirvana"), __("Random Posts from Category","nirvana"), __("Specific Posts","nirvana"), __("Disabled","nirvana"));
	_e("<strong>Slides content:</strong>","nirvana");
	echo "<select id='nirvana_slideType' name='nirvana_settings[nirvana_slideType]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_slideType'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Only the slides with a defined image will become active and visible in the live slider.<br>When using slides from posts, make sure the selected posts have featured images.<br>Read the FAQs for more info.","nirvana")."</small></div>"; ?>

	<div class="underSelector">
		<div id="sliderShortcode" class="slideDivs"> 
			<span><?php _e('Enter the desired slider plugin shortcode below:','nirvana'); ?> </span> 
			<input id='nirvana_slideShortcode' name='nirvana_settings[nirvana_slideShortcode]' size='44' type='text' value='<?php echo esc_attr( $nirvanas['nirvana_slideShortcode'] ) ?>' /> 
		</div> 
		<div id="sliderLatestPosts" class="slideDivs">
			<span><?php _e('Latest posts will be loaded into the slider.','nirvana'); ?> </span>
		</div>

		<div id="sliderRandomPosts" class="slideDivs">
			<span><?php _e('Random posts will be loaded into the slider.','nirvana'); ?> </span>
		</div>

		<div id="sliderLatestCateg" class="slideDivs">
			<span><?php _e('Latest posts from the category you choose will be loaded in the slider.','nirvana'); ?> </span>
		</div>

		<div id="sliderRandomCateg" class="slideDivs">
			<span><?php _e('Random posts from the category you choose will be loaded into the slider.','nirvana'); ?> </span>
		</div>

		<div id="sliderStickyPosts" class="slideDivs">
			<span><?php _e('Only sticky posts will be loaded into the slider.','nirvana'); ?> </span>
		</div>

		<div id="sliderSpecificPosts" class="slideDivs">
			<span><?php _e('List the post IDs you want to display (separated by a comma): ','nirvana'); ?> </span>
			<input id='nirvana_slideSpecific' name='nirvana_settings[nirvana_slideSpecific]' size='44' type='text' value='<?php echo esc_attr( $nirvanas['nirvana_slideSpecific'] ) ?>' />
		</div>

		<div id="slider-category">
			<span><?php _e('<br> Choose the category: ','nirvana'); ?> </span>
			<select id="nirvana_slideCateg" name='nirvana_settings[nirvana_slideCateg]'>
			<option value=""><?php echo esc_attr(__('Select Category','nirvana')); ?></option>
			<?php echo $nirvanas["nirvana_slideCateg"];
			$categories = get_categories();
			foreach ($categories as $category) {
				$option = '<option value="'.$category->category_nicename.'" ';
				$option .= selected($nirvanas["nirvana_slideCateg"], $category->category_nicename, false).' >';
				$option .= $category->cat_name;
				$option .= ' ('.$category->category_count.')';
				$option .= '</option>';
				echo $option;
			} ?>
			</select>
		</div>

		<span id="slider-post-number">
			<?php echo "<div class='slmini'><b>".__("Number of posts:","nirvana")."</b> ";
			echo "<input id='nirvana_slideNumber' name='nirvana_settings[nirvana_slideNumber]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_slideNumber'] )."' /> ".__("posts","nirvana");
			echo "<small>".__("The number of posts to show in the slider.","nirvana")."</small></div>"; 
			
			echo "<div class='slmini'><b>".__("Slider excerpt:","nirvana")."</b> ";
			echo "<input id='nirvana_fpsliderexcerptsize' name='nirvana_settings[nirvana_fpsliderexcerptsize]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fpsliderexcerptsize'] )."' /> ".__("words","nirvana");
			echo "<small>".__("The number of words for the slider excerpts.","nirvana")."</small></div>"; ?>
		</span>

		<div id="sliderCustomSlides" class="slideDivs">
			<span><?php _e('Custom slides are limited to a maximum of 5.','nirvana'); ?> </span> 
			<?php
			
			// let's generate the slides
			for ($i=1;$i<=5;$i++) { ?>
				<div class="slidebox">
					<h4 class="slidetitle" ><?php _e("Slide","nirvana");?> <?php echo $i; ?></h4>
					<div class="slidercontent">
						<h5><?php _e("Image","nirvana");?></h5>
						<input type="text" value="<?php echo esc_url($nirvanas['nirvana_sliderimg'.$i]); ?>" name="nirvana_settings[nirvana_sliderimg<?php echo $i; ?>]" id="nirvana_sliderimg<?php echo $i; ?>" class="slideimages" />
						<span class="description"><a href="#" class="upload_image_button button"><?php _e( 'Select / Upload Image', 'nirvana' );?></a> </span>
						<h5> <?php _e("Title","nirvana");?> </h5>
						<input id='nirvana_slidertitle<?php echo $i; ?>' name='nirvana_settings[nirvana_slidertitle<?php echo $i; ?>]' size='50' type='text'
						value='<?php echo esc_attr( $nirvanas['nirvana_slidertitle'.$i] ) ?>' />
						<h5> <?php _e("Text","nirvana");?> </h5>
						<textarea id='nirvana_slidertext<?php echo $i; ?>' name='nirvana_settings[nirvana_slidertext<?php echo $i; ?>]' rows='3' cols='50'
						type='textarea'><?php echo esc_attr($nirvanas['nirvana_slidertext'.$i]) ?></textarea>
						<h5> <?php _e("Link","nirvana");?> </h5>
						<input id='nirvana_sliderlink<?php echo $i; ?>' name='nirvana_settings[nirvana_sliderlink<?php echo $i; ?>]' size='50' type='text'
						value='<?php echo esc_url( $nirvanas['nirvana_sliderlink'.$i] ) ?>' />
					</div>
				</div>
			<?php }; ?>
			
		</div> <!-- customSlides -->
		<div class='slmini'>
			<b><?php _e("Read more text:","nirvana");?></b>
			<input id='nirvana_slidereadmore' name='nirvana_settings[nirvana_slidereadmore]' size='30' type='text' value='<?php echo esc_attr( $nirvanas['nirvana_slidereadmore'] ) ?>' />
			<small><?php _e("The linked text that appears at the bottom of each slide. Leave empty to hide the link.","nirvana") ?></small>
		</div>
	</div>
<?php
} // cryout_setting_frontslider2_fn()

function cryout_setting_frontcolumns_fn() {
	global $nirvanas; ?>
	
	<div class="slmini"> <?php
		$values = array("Widget Columns", "Latest Posts", "Random Posts", "Sticky Posts", "Latest Posts from Category" , "Random Posts from Category", "Specific Posts", "Disabled");
		$labels = array( __("Widget Columns","nirvana"), __("Latest Posts","nirvana"), __("Random Posts","nirvana"),__("Sticky Posts","nirvana"), __("Latest Posts from Category","nirvana"), __("Random Posts from Category","nirvana"), __("Specific Posts","nirvana"), __("Disabled","nirvana"));
		echo __("<strong>Columns content:</strong>","nirvana");
		echo "<select id='nirvana_columnType' name='nirvana_settings[nirvana_columnType]'>";
		foreach($values as $id=>$item) {
			echo "<option value='$item'";
			selected($nirvanas['nirvana_columnType'],$item);
			echo ">$labels[$id]</option>";
		}
		echo "</select>";
		echo "<div><small>".__("Only the columns with a defined image will become active and visible on the presentation page.<br>When using columns from posts, make sure the selected posts have featured images.<br>Read the FAQs for more info.","nirvana")."</small></div>"; ?>

		<div class="underSelector">
			<div id="columnLatestPosts" class="columnDivs">
				<span><?php _e('Latest posts will be loaded into the columns.','nirvana'); ?> </span>
			</div>

			<div id="columnRandomPosts" class="columnDivs">
				<span><?php _e('Random posts will be loaded into the columns.','nirvana'); ?> </span>
			</div>

			<div id="columnLatestCateg" class="columnDivs">
				<span><?php _e('Latest posts from the category you choose will be loaded in the columns.','nirvana'); ?> </span>
			</div>

			<div id="columnRandomCateg" class="columnDivs">
				<span><?php _e('Random posts from the category you choose will be loaded into the columns.','nirvana'); ?> </span>
			</div>

			<div id="columnStickyPosts" class="columnDivs">
				<span><?php _e('Only sticky posts will be loaded into the columns.','nirvana'); ?> </span>
			</div>

			<div id="columnSpecificPosts" class="columnDivs">
				<span><?php _e('List the post IDs you want to display (separated by a comma): ','nirvana'); ?> </span>
				<input id='nirvana_columnSpecific' name='nirvana_settings[nirvana_columnSpecific]' size='44' type='text' value='<?php echo esc_attr( $nirvanas['nirvana_columnSpecific'] ) ?>' />
			</div>

			<div id="columnWidgets" class="columnDivs">
				<span><?php _e('Load your custom Widgets as columns. Go to <a>Appearance >> Widgets</a> and create your custom columns using the Columns widget. You can use as many as you want.','nirvana'); ?> </span>
			</div>
			<script>jQuery('#columnWidgets span a').attr('href','<?php echo esc_url(get_admin_url());?>widgets.php');</script>

			<div id="column-category">
				<span><?php _e('<br> Choose the category: ','nirvana'); ?> </span>
				<select id="nirvana_columnCateg" name='nirvana_settings[nirvana_columnCateg]'>
				<option value=""><?php echo esc_attr(__('Select Category','nirvana')); ?></option>
				<?php echo $nirvanas["nirvana_columnCateg"];
				$categories = get_categories();
				foreach ($categories as $category) {
					$option = '<option value="'.$category->category_nicename.'" ';
					$option .= selected($nirvanas["nirvana_columnCateg"], $category->category_nicename, false).' >';
					$option .= $category->cat_name;
					$option .= ' ('.$category->category_count.')';
					$option .= '</option>';
					echo $option;
				} ?>
				</select>
			</div>
			<span id="column-post-number">
				<?php _e('Number of posts to show:','nirvana'); ?>
				<input id='nirvana_columnNumber' name='nirvana_settings[nirvana_columnNumber]' size='3' type='text' value='<?php echo esc_attr( $nirvanas['nirvana_columnNumber'] ) ?>' />
			</span>

		</div>
	</div>

	<?php
	echo "<div class='slmini'><b>".__("Column Display:","nirvana")."</b> ";
	$values = array ("0" , "1", "2");
	$labels = array( __("Animated","nirvana"), __("Static on Image","nirvana"), __("Static under Image","nirvana"));
	echo "<select id='nirvana_coldisplay' name='nirvana_settings[nirvana_coldisplay]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_coldisplay'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<small>".__("How to display your Presentation Page Columns.", "nirvana")."</small></div>";

	echo "<div class='slmini'><b>".__("Columns per row:","nirvana")."</b> ";
	$values = array ("1", "2" , "3" , "4");
	echo "<select id='nirvana_nrcolumns' name='nirvana_settings[nirvana_nrcolumns]'>";
	foreach($values as $item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_nrcolumns'],$item);
		echo ">$item</option>";
	}
	echo "</select></div>";

	echo "<div class='slmini'><b>".__("Image Size:","nirvana")."</b> ";
	echo __("Height: ","nirvana")."<input id='nirvana_colimageheight' name='nirvana_settings[nirvana_colimageheight]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_colimageheight'] )."' /> px &nbsp;&nbsp;";
	echo __("Width: ","nirvana")."<span id='nirvana_colimagewidth_show'></span> px"."<input id='nirvana_colimagewidth' type='hidden' name='nirvana_settings[nirvana_colimagewidth]' value='".esc_attr( $nirvanas['nirvana_colimagewidth'] )."' />";
	echo "<small>".__("The sizes for your column images. The width is dependent on total site width and the number of columns per row so it isn't configurable.","nirvana")."</small></div>";

	echo "<div class='slmini'><b>".__("Column spacing:","nirvana")."</b> ";
	echo "<input style='text-align:right;' id='nirvana_colspace' name='nirvana_settings[nirvana_colspace]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_colspace'] )."' /> % &nbsp;&nbsp;";
	echo "<small>".__("The space between your columns. Increasing the column spacing will naturally decrease the visible area of your images.","nirvana")."</small></div>";
	?>
	<div class='slmini'><b><?php _e("Columns Title:","nirvana");?></b>
    <input id='nirvana_columnstitle' name='nirvana_settings[nirvana_columnstitle]' size='30' type='text' value='<?php echo esc_attr( $nirvanas['nirvana_columnstitle'] ) ?>' /> <?php
	echo "<small>".__("The title for the columns area on the presentation page.","nirvana")."</small></div>"; ?>
	<div class="slmini"><b><?php _e("Photo Frames","nirvana");?></b>
	<?php cryout_proto_field( $nirvanas, "checkbox", "nirvana_column_frames", $nirvanas['nirvana_column_frames'], __('Enable','nirvana'));
	echo "<div><small>".__("Enable subtle foto frames around your column images. Your columns will have white borders and a small shadow around them and will be slightly skewed.","nirvana")."</small></div></div>";

} // cryout_setting_frontcolumns_fn()

function cryout_setting_fronttext_fn() {
	global $nirvanas;

	echo "<div class='slidebox'><h4 class='slidetitle'> ".__("Text Area","nirvana")." 1 </h4><div class='slidercontent'>";

	echo "<div style='width:100%;'><span>".__("Text for the Presentation Page","nirvana")."</span><small>".
	__("More text for the Presentation Page. The top title is just below the slider, the second title is below the columns. A text area supporting HTML tags and shortcodes below each title<br> It's all optional so leave any input field empty to not display it.","nirvana")."</small></div>";

	echo "<h5>".__("Title","nirvana")."</h5><br>";
	echo "<input id='nirvana_fronttext1' name='nirvana_settings[nirvana_fronttext1]' size='50' type='text' value='".esc_attr( $nirvanas['nirvana_fronttext1'] )."' />";
	echo "<h5>".__("Text","nirvana")."</h5>";
	echo "<textarea id='nirvana_fronttext3' name='nirvana_settings[nirvana_fronttext3]' rows='8' cols='50' type='textarea' >".esc_attr($nirvanas['nirvana_fronttext3'])." </textarea></div></div>";

	echo "<div class='slidebox'><h4 class='slidetitle'> ".__("Text Area","nirvana")." 2 </h4><div class='slidercontent'>";

	echo "<h5>".__("Title","nirvana")."</h5>";
	echo "<input id='nirvana_fronttext2' name='nirvana_settings[nirvana_fronttext2]' size='50' type='text' value='".esc_attr( $nirvanas['nirvana_fronttext2'] )."' />";
	echo "<h5>".__("Text","nirvana")." </h5>";
	echo "<textarea id='nirvana_fronttext4' name='nirvana_settings[nirvana_fronttext4]' rows='8' cols='50' type='textarea' >".esc_attr($nirvanas['nirvana_fronttext4'])." </textarea></div></div>";

	echo "<div class='slidebox'><h4 class='slidetitle'> ".__("Text Area","nirvana")." 3 </h4><div class='slidercontent'>";

	echo "<h5>".__("Title","nirvana")."</h5>";
	echo "<input id='nirvana_fronttext5' name='nirvana_settings[nirvana_fronttext5]' size='50' type='text' value='".esc_attr( $nirvanas['nirvana_fronttext5'] )."' />";
	echo "<h5>".__("Text","nirvana")." </h5>";
	echo "<textarea id='nirvana_fronttext6' name='nirvana_settings[nirvana_fronttext6]' rows='8' cols='50' type='textarea' >".esc_attr($nirvanas['nirvana_fronttext6'])." </textarea></div></div>";
} // cryout_setting_fronttext_fn()

function cryout_setting_frontextras_fn() {
	global $nirvanas;

    echo "<div class='slidebox'><h4 class='slidetitle'>".__("Hide areas","nirvana")." </h4><div  class='slidercontent'>";

    echo "<div style='width:100%;'>".__("Choose the areas to hide on the Presentation Page:","nirvana")."</div><br>";

	$values = array( "TopBar", "FrontHeader", "FrontMenu", "FrontWidget", "FrontFooter");

	$checkedClass0 = ($nirvanas['nirvana_fronthidetopbar']=='1') ? ' checkedClass0' : '';
	$checkedClass1 = ($nirvanas['nirvana_fronthideheader']=='1') ? ' checkedClass1' : '';
	$checkedClass2 = ($nirvanas['nirvana_fronthidemenu']=='1') ? ' checkedClass2' : '';
	$checkedClass3 = ($nirvanas['nirvana_fronthidewidget']=='1') ? ' checkedClass3' : '';
	$checkedClass4 = ($nirvanas['nirvana_fronthidefooter']=='1') ? ' checkedClass4' : '';

	echo " <label id='$values[0]' for='$values[0]$values[0]' class='hideareas $checkedClass0'><input "; checked($nirvanas['nirvana_fronthidetopbar'],'1');
	echo " value='1' id='$values[0]$values[0]'  name='nirvana_settings[nirvana_fronthidetopbar]' type='checkbox' /> ".__("Hide the topbar (includes the top social area and top menu).","nirvana")." </label>";

	echo " <label id='$values[1]' for='$values[1]$values[1]' class='hideareas $checkedClass1'><input "; checked($nirvanas['nirvana_fronthideheader'],'1');
	echo " value='1' id='$values[1]$values[1]'  name='nirvana_settings[nirvana_fronthideheader]' type='checkbox' /> ".__("Hide the header area (logo/title and/or image/empty area).","nirvana")." </label>";

	echo " <label id='$values[2]' for='$values[2]$values[2]' class='hideareas $checkedClass2'><input "; checked($nirvanas['nirvana_fronthidemenu'],'1');
	echo " value='1' id='$values[2]$values[2]'  name='nirvana_settings[nirvana_fronthidemenu]' type='checkbox' /> ".__("Hide the main menu.","nirvana")." </label>";

	echo " <label id='$values[3]' for='$values[3]$values[3]' class='hideareas $checkedClass3'><input "; checked($nirvanas['nirvana_fronthidewidget'],'1');
	echo " value='1' id='$values[3]$values[3]'  name='nirvana_settings[nirvana_fronthidewidget]' type='checkbox' /> ".__("Hide the footer widgets. ","nirvana")." </label>";

	echo " <label id='$values[4]' for='$values[4]$values[4]' class='hideareas $checkedClass4'><input "; checked($nirvanas['nirvana_fronthidefooter'],'1');
	echo " value='1' id='$values[4]$values[4]'  name='nirvana_settings[nirvana_fronthidefooter]' type='checkbox' /> ".__("Hide the footer (copyright area).","nirvana")." </label>";

    echo "</div></div>";
} // cryout_setting_frontextras_fn()


////////////////////////////////
//// TEXT SETTINGS /////////////
////////////////////////////////

function cryout_setting_fontfamily_fn() {
	global $nirvanas;
	global $nirvana_fonts;
	$sizes = array ("12px", "13px" , "14px" , "15px" , "16px", "17px", "18px", "19px", "20px");
	cryout_proto_font(
		$nirvana_fonts,
		$sizes,
		$nirvanas['nirvana_fontsize'],
		$nirvanas['nirvana_fontfamily'],
		$nirvanas['nirvana_googlefont'],
		'nirvana_fontsize',
		'nirvana_fontfamily',
		'nirvana_googlefont'
	); ?>
	<div><small><?php _e("Select the general font family and size or insert the Google Font name you'll use in your blog. This will affect all text except the text controlled by the options below.<br><br> <strong>Additional Info:</strong><br>The fonts under the <em>General Theme Fonts</em> category are suggested for this because they have all the font weights used througout the theme.<br> When using Google Fonts for General Font make sure they also have multiple font weights and that you specify them all, eg.: <em>Roboto:400,300,500,700</em>","nirvana") ?></small></div><br>
	<?php
} // cryout_setting_fontfamily_fn()

function cryout_setting_fonttitle_fn() {
	global $nirvanas;
	global $nirvana_fonts;
	$sizes = array( "18px" , "20px", "22px" , "24px" , "26px" , "28px" , "30px" , "32px" , "34px" , "36px", "38px" , "40px", "42px", "44px","46px","48px","50px" );
	cryout_proto_font(
		$nirvana_fonts,
		$sizes,
		$nirvanas['nirvana_headfontsize'],
		$nirvanas['nirvana_fonttitle'],
		$nirvanas['nirvana_googlefonttitle'],
		'nirvana_headfontsize',
		'nirvana_fonttitle',
		'nirvana_googlefonttitle',
		__('General Font','nirvana')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want for your titles. It will affect post titles and page titles. Leave 'General Font' and the general font values you selected will be used.","nirvana")."</small></div><br>";
} // cryout_setting_fonttitle_fn()

function cryout_setting_fontside_fn() {
	global $nirvanas;
	global $nirvana_fonts;
	for ($i=14;$i<31;$i+=2): $sizes[] = "${i}px"; endfor;
	cryout_proto_font(
		$nirvana_fonts,
		$sizes,
		$nirvanas['nirvana_sidefontsize'],
		$nirvanas['nirvana_fontside'],
		$nirvanas['nirvana_googlefontside'],
		'nirvana_sidefontsize',
		'nirvana_fontside',
		'nirvana_googlefontside',
		__('General Font','nirvana')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your widget titles to have. Leave 'General Font' and the general font values you selected will be used.","nirvana")."</small></div><br>";
} // cryout_setting_fontside_fn()

function cryout_setting_fontwidget_fn() {
	global $nirvanas;
	global $nirvana_fonts;
	for ($i=12;$i<23;$i+=1): $sizes[] = "${i}px"; endfor;
	cryout_proto_font(
		$nirvana_fonts,
		$sizes,
		$nirvanas['nirvana_widgetfontsize'],
		$nirvanas['nirvana_fontwidget'],
		$nirvanas['nirvana_googlefontwidget'],
		'nirvana_widgetfontsize',
		'nirvana_fontwidget',
		'nirvana_googlefontwidget',
		__('General Font','nirvana')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your widgets to have. Leave 'General Font' and the general font values you selected will be used.","nirvana")."</small></div><br>";
} // cryout_setting_fontwidget_fn()

function cryout_setting_sitetitlefont_fn() {
	global $nirvanas;
	global $nirvana_fonts;
	for ($i=30;$i<51;$i+=2): $sizes[] = "${i}px"; endfor;
	cryout_proto_font(
		$nirvana_fonts,
		$sizes,
		$nirvanas['nirvana_sitetitlesize'],
		$nirvanas['nirvana_sitetitlefont'],
		$nirvanas['nirvana_sitetitlegooglefont'],
		'nirvana_sitetitlesize',
		'nirvana_sitetitlefont',
		'nirvana_sitetitlegooglefont',
		__('General Font','nirvana')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your site title and tagline to use. Leave 'General Font' and the general font values you selected will be used.","nirvana")."</small></div><br>";
} // cryout_setting_sitetitlefont_fn()

function cryout_setting_menufont_fn() {
	global $nirvanas;
	global $nirvana_fonts;
	$sizes = array ( "8px" , "9px" , "10px" , "11px", "12px" , "13px" , "14px" , "15px" , "16px" , "17px" , "18px", "19px", "20px");
	cryout_proto_font(
		$nirvana_fonts,
		$sizes,
		$nirvanas['nirvana_menufontsize'],
		$nirvanas['nirvana_menufont'],
		$nirvanas['nirvana_menugooglefont'],
		'nirvana_menufontsize',
		'nirvana_menufont',
		'nirvana_menugooglefont',
		__('General Font','nirvana')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your main menu to use. Leave 'General Font' and the general font values you selected will be used.","nirvana")."</small></div><br>";
} // cryout_setting_menufont_fn()

function cryout_setting_fontheadings_fn() {
	global $nirvanas;
	global $nirvana_fonts;
	$sizes = array("60%","70%","80%","90%","100%","110%","120%","130%","140%","150%");
	cryout_proto_font(
		$nirvana_fonts,
		$sizes,
		$nirvanas['nirvana_headingsfontsize'],
		$nirvanas['nirvana_headingsfont'],
		$nirvanas['nirvana_headingsgooglefont'],
		'nirvana_headingsfontsize',
		'nirvana_headingsfont',
		'nirvana_headingsgooglefont',
		__('General Font','nirvana')
	);
	echo "<div><small>".__("Select the font family and size or insert the Google Font name you want your headings to have (h1 - h6 tags will be affected). Leave 'General Font' and the general font values you selected will be used.","nirvana")."</small></div><br>";
} // cryout_setting_fontheadings_fn()

function cryout_setting_textalign_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_textalign",
		array("Default" , "Left" , "Right" , "Justify" , "Center"),
		array( __("Default","nirvana"), __("Left","nirvana"), __("Right","nirvana"), __("Justify","nirvana"), __("Center","nirvana"))
	);
	echo "<div><small>".__("This overwrites the text alignment in posts and pages. Leave 'Default' for normal settings (alignment will remain as declared in posts, comments etc.).","nirvana")."</small></div>";
} // cryout_setting_textalign_fn()

function cryout_setting_parindent_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_parindent",
		array("0px" , "5px" , "10px" , "15px" , "20px"),
		array("0px" , "5px" , "10px" , "15px" , "20px")
	);
	echo "<div><small>".__("Choose the indent for your paragraphs.","nirvana")."</small></div>";
} // cryout_setting_parindent_fn()

function cryout_setting_headingsindent_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_headingsindent",
		array("Enable" , "Disable"),
		array( __("Enable","nirvana"), __("Disable","nirvana"))
	);
	echo "<div><small>".__("Disable the default headings indent (left margin).","nirvana")."</small></div>";
} // cryout_setting_headingsindent_fn()

function cryout_setting_lineheight_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_lineheight",
		array("0.8em" , "0.9em", "1.0em" , "1.1em" , "1.2em" , "1.3em", "1.4em" , "1.5em" , "1.6em" , "1.7em" , "1.8em" , "1.9em" , "2.0em"),
		array( "0.8em" , "0.9em", "1.0em" , "1.1em" , "1.2em" , "1.3em", "1.4em" , "1.5em" , "1.6em" , "1.7em" , "1.8em" , "1.9em" , "2.0em")
	);
	echo "<div><small>".__("Text line height. The height between 2 rows of text.","nirvana")."</small></div>";
} // cryout_setting_lineheight_fn()

function cryout_setting_wordspace_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_wordspace",
		array("Default" ,"-3px" , "-2px", "-1px" , "0px" , "1px" , "2px", "3px" , "4px" , "5px" , "10px"),
		array( __("Default","nirvana"),"-3px" , "-2px", "-1px" , "0px" , "1px" , "2px", "3px" , "4px" , "5px" , "10px")
	);
	echo "<div><small>".__("The space between <i>words</i>. Leave 'Default' for normal settings (size value will be as set in the CSS).","nirvana")."</small></div>";
} // cryout_setting_wordspace_fn()

function cryout_setting_letterspace_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_letterspace",
		array("Default" ,"-0.05em" , "-0.04em", "-0.03em" , "-0.02em" , "-0.01em" , "0.01em", "0.02em" , "0.03em" , "0.04em" , "0.05em"),
		array( __("Default","nirvana"),"-0.05em" , "-0.04em", "-0.03em" , "-0.02em" , "-0.01em" , "0.01em", "0.02em" , "0.03em" , "0.04em" , "0.05em")
	);
	echo "<div><small>".__("The space between <i>letters</i>. Leave 'Default' for normal settings (size value will be as set in the CSS).","nirvana")."</small></div>";
} // cryout_setting_letterspace_fn()

function cryout_setting_paragraphspace_fn() {
	global $nirvanas;
	$values[] = "0.0em"; 
	for ($i=0.5;$i<=1.5;$i+=0.1) {
		$values[] = number_format($i,1)."em";  
	}
	cryout_proto_field( $nirvanas, "select", "nirvana_paragraphspace", $values, $values );
	echo "<div><small>".__("Select the spacing between the paragraphs.","nirvana")."</small></div>";
} // cryout_setting_paragraphspace_fn()

function cryout_setting_uppercasetext_fn() {
	global $nirvanas;
	cryout_proto_field( $nirvanas, "select", "nirvana_uppercasetext", array(0, 1, 2),
		array( __("Default","nirvana"), __("Force Uppercase","nirvana"), __("Force Lowercase","nirvana"))
	);
	echo "<div><small>".__("Force text case on specific elements. This option doesn't apply to content.","nirvana")."</small></div>";
} // cryout_setting_uppercasetext_fn()


////////////////////////////////
//// APPEARANCE SETTINGS ///////
////////////////////////////////

function cryout_setting_sitebackground_fn() {
	?><a href="?page=custom-background" class="button" target="_blank"><?php _e('Define background image','nirvana') ?></a><?php
} // cryout_setting_sitebackground_fn()

function cryout_setting_generalcolors_fn() {
	global $nirvanas;
	echo '<h4>'.__('Background:','nirvana').'</h4>';
	cryout_color_field('nirvana_backcolorheader',__('Header Background','nirvana'),$nirvanas['nirvana_backcolorheader']);
	cryout_color_field('nirvana_backcolormain',__('Main Site Background','nirvana'),$nirvanas['nirvana_backcolormain']);
	cryout_color_field('nirvana_backcolorfooterw',__('Footer Widgets Area Background','nirvana'),$nirvanas['nirvana_backcolorfooterw']);
	cryout_color_field('nirvana_backcolorfooter',__('Footer Background','nirvana'),$nirvanas['nirvana_backcolorfooter']);
	echo '<br class="colors-br" /><h4>'.__('Text:','nirvana').'</h4>';
	cryout_color_field('nirvana_contentcolortxt',__('General Text','nirvana'),$nirvanas['nirvana_contentcolortxt']);
	cryout_color_field('nirvana_contentcolortxtlight',__('General Lighter Text','nirvana'),$nirvanas['nirvana_contentcolortxtlight']);
	cryout_color_field('nirvana_footercolortxt',__('Footer Text','nirvana'),$nirvanas['nirvana_footercolortxt']);
	echo "<div><small>".__("The site background features 4 separately coloured areas.<br />The general text colour applies to all text on the website that is not controlled by any other option.","nirvana")."</small></div>";
} // cryout_setting_generalcolors_fn()

function cryout_setting_accentcolors_fn() {
	global $nirvanas;
	cryout_color_field('nirvana_accentcolora',__('Accent Color #1','nirvana'),$nirvanas['nirvana_accentcolora']);
	cryout_color_field('nirvana_accentcolorb',__('Accent Color #2','nirvana'),$nirvanas['nirvana_accentcolorb']);
	cryout_color_field('nirvana_accentcolorc',__('Accent Color #3','nirvana'),$nirvanas['nirvana_accentcolorc']);
	cryout_color_field('nirvana_accentcolord',__('Accent Color #4','nirvana'),$nirvanas['nirvana_accentcolord']);
	cryout_color_field('nirvana_accentcolore',__('Accent Color #5','nirvana'),$nirvanas['nirvana_accentcolore']);
	echo "<div><small>".__("Accents #1 and #2 should either be the same as the link colours or be separate from all other colours on the site.<br />Accent #5 is used for input fields and buttons backgrounds, borders and lines.<br />Accents #3 and #4 should be the lighter/darker than the content background colour, being used as borders/shades on elements where accent #5 is background colour.","nirvana")."</small></div>";
} // cryout_setting_accentcolors_fn()

function cryout_setting_titlecolors_fn() {
	global $nirvanas;
	echo '<h4>'.__('Background:','nirvana').'</h4>';
	cryout_color_field('nirvana_descriptionbg',__('Site Description Background','nirvana'),$nirvanas['nirvana_descriptionbg']);
	echo '<br class="colors-br" /><h4>'.__('Text:','nirvana').'</h4>';
	cryout_color_field('nirvana_titlecolor',__('Site Title','nirvana'),$nirvanas['nirvana_titlecolor']);
	cryout_color_field('nirvana_descriptioncolor',__('Site Description','nirvana'),$nirvanas['nirvana_descriptioncolor']);
} // cryout_setting_titlecolors_fn()

function cryout_setting_menucolors_fn() {
	global $nirvanas;
	echo '<h4>'.__('Menu:','nirvana').'</h4>';
	cryout_color_field('nirvana_menucolorbgdefault',__('Menu Background','nirvana'),$nirvanas['nirvana_menucolorbgdefault']);
	cryout_color_field('nirvana_menucolortxtdefault',__('Menu Text','nirvana'),$nirvanas['nirvana_menucolortxtdefault']);
	echo '<br class="colors-br" /><h4>'.__('Submenu:','nirvana').'</h4>';
	cryout_color_field('nirvana_submenucolorbgdefault',__('Submenu Background','nirvana'),$nirvanas['nirvana_submenucolorbgdefault']);
	cryout_color_field('nirvana_submenucolortxtdefault',__('Submenu Text','nirvana'),$nirvanas['nirvana_submenucolortxtdefault']);
	cryout_color_field('nirvana_submenucolorshadow',__('Submenu Shadow','nirvana'),$nirvanas['nirvana_submenucolorshadow']);
	echo "<div><small>".__("These colours apply to the main site menu (and dropdown elements).","nirvana")."</small></div>";
} // cryout_setting_menucolors_fn()

function cryout_setting_topmenucolors_fn() {
	global $nirvanas;
	echo '<h4>'.__('Background:','nirvana').'</h4>';
	cryout_color_field('nirvana_topbarcolorbg',__('Top Bar Background','nirvana'),$nirvanas['nirvana_topbarcolorbg']);
	echo '<br class="colors-br" /><h4>'.__('Text:','nirvana').'</h4>';
	cryout_color_field('nirvana_topmenucolortxt',__('Top Bar Menu Link','nirvana'),$nirvanas['nirvana_topmenucolortxt']);
	cryout_color_field('nirvana_topmenucolortxthover',__('Top Bar Menu Link Hover','nirvana'),$nirvanas['nirvana_topmenucolortxthover']);
	echo "<div><small>".__("These colours apply to the top bar menu.","nirvana")."</small></div>";
} // cryout_setting_topmenucolors_fn()

function cryout_setting_contentcolors_fn() {
	global $nirvanas;
	cryout_color_field('nirvana_contentcolorbg',__('Content Background','nirvana'),$nirvanas['nirvana_contentcolorbg']);
	cryout_color_field('nirvana_contentcolortxttitle',__('Page/Post Title','nirvana'),$nirvanas['nirvana_contentcolortxttitle']);
	cryout_color_field('nirvana_contentcolortxttitlehover',__('Page/Post Title Hover','nirvana'),$nirvanas['nirvana_contentcolortxttitlehover']);
	cryout_color_field('nirvana_contentcolortxtheadings',__('Content Headings','nirvana'),$nirvanas['nirvana_contentcolortxtheadings']);
	echo "<div><small>".__("Content colours apply to post and page areas of the site.","nirvana")."</small></div>";
} // cryout_setting_contentcolors_fn()

function cryout_setting_frontpagecolors_fn(){
	global $nirvanas;
	echo '<h4>'.__('Slider:','nirvana').'</h4>';
	cryout_color_field('nirvana_fpsliderbgcolor',__('Slider Background Color','nirvana'),$nirvanas['nirvana_fpsliderbgcolor']);
	cryout_color_field('nirvana_fpsliderbordercolor',__('Slider Border Color','nirvana'),$nirvanas['nirvana_fpsliderbordercolor']);
	cryout_color_field('nirvana_fpslidercaptioncolor',__('Slider Caption Text Color','nirvana'),$nirvanas['nirvana_fpslidercaptioncolor']);
	cryout_color_field('nirvana_fpslidercaptionbg',__('Slider Caption Background','nirvana'),$nirvanas['nirvana_fpslidercaptionbg']);
	echo '<h4>'.__('Areas:','nirvana').'</h4>';
	cryout_color_field('nirvana_fronttextbgcolortop',__('Text Area 1 Background Color','nirvana'),$nirvanas['nirvana_fronttextbgcolortop']);
	cryout_color_field('nirvana_fronttextbgcolormiddle',__('Text Area 2 Background Color','nirvana'),$nirvanas['nirvana_fronttextbgcolormiddle']);
	cryout_color_field('nirvana_fronttextbgcolorbottom',__('Text Area 3 Background Color','nirvana'),$nirvanas['nirvana_fronttextbgcolorbottom']);
	cryout_color_field('nirvana_frontcolumnsbgcolor',__('Columns Background Color','nirvana'),$nirvanas['nirvana_frontcolumnsbgcolor']);
	echo '<h4>'.__('Text:','nirvana').'</h4>';
	cryout_color_field('nirvana_fronttitlecolor',__('Titles Color','nirvana'),$nirvanas['nirvana_fronttitlecolor']);
    echo "<div><small>".__("These colours apply to specific areas of the presentation page.","nirvana")."</small></div>";
} // cryout_setting_frontpagecolors_fn()

function cryout_setting_sidecolors_fn() {
	global $nirvanas;
	echo '<h4>'.__('Background:','nirvana').'</h4>';
	cryout_color_field('nirvana_sidebg',__('Sidebars Background','nirvana'),$nirvanas['nirvana_sidebg']);
	cryout_color_field('nirvana_sidetitlebg',__('Sidebars Widget Title Background','nirvana'),$nirvanas['nirvana_sidetitlebg']);
	echo '<br class="colors-br" /><h4>'.__('Text:','nirvana').'</h4>';
	cryout_color_field('nirvana_sidetxt',__('Sidebars Text','nirvana'),$nirvanas['nirvana_sidetxt']);
	cryout_color_field('nirvana_sidetitletxt',__('Sidebars Widget Title Text','nirvana'),$nirvanas['nirvana_sidetitletxt']);
	echo "<div><small>".__("These colours apply to the widgets placed in either sidebar.","nirvana")."</small></div>";
} // cryout_setting_sidecolors_fn()

function cryout_setting_widgetcolors_fn() {
	global $nirvanas;
	echo '<h4>'.__('Background:','nirvana').'</h4>';
	cryout_color_field('nirvana_widgetbg',__('Footer Widgets Background','nirvana'),$nirvanas['nirvana_widgetbg']);
	cryout_color_field('nirvana_widgettitlebg',__('Footer Widgets Title Background','nirvana'),$nirvanas['nirvana_widgettitlebg']);
	echo '<br class="colors-br" /><h4>'.__('Text:','nirvana').'</h4>';
	cryout_color_field('nirvana_widgettxt',__('Footer Widget Text','nirvana'),$nirvanas['nirvana_widgettxt']);
	cryout_color_field('nirvana_widgettitletxt',__('Footer Widgets Title Text','nirvana'),$nirvanas['nirvana_widgettitletxt']);
	echo "<div><small>".__("These colours apply to the widgets in the footer area.","nirvana")."</small></div>";
} // cryout_setting_widgetcolors_fn()

function cryout_setting_linkcolors_fn() {
	global $nirvanas;
	echo '<h4>'.__('General:','nirvana').'</h4>';
	cryout_color_field('nirvana_linkcolortext',__('General Links','nirvana'),$nirvanas['nirvana_linkcolortext']);
	cryout_color_field('nirvana_linkcolorhover',__('General Links Hover','nirvana'),$nirvanas['nirvana_linkcolorhover']);
	echo '<br class="colors-br" /><h4>'.__('Sidebar Widgets:','nirvana').'</h4>';
	cryout_color_field('nirvana_linkcolorside',__('Sidebar Widgets Links','nirvana'),$nirvanas['nirvana_linkcolorside']);
	cryout_color_field('nirvana_linkcolorsidehover',__('Sidebar Widgets Links Hover','nirvana'),$nirvanas['nirvana_linkcolorsidehover']);
	echo '<br class="colors-br" /><h4>'.__('Footer Widgets:','nirvana').'</h4>';
	cryout_color_field('nirvana_linkcolorwooter',__('Footer Widgets Links','nirvana'),$nirvanas['nirvana_linkcolorwooter']);
	cryout_color_field('nirvana_linkcolorwooterhover',__('Footer Widgets Links Hover','nirvana'),$nirvanas['nirvana_linkcolorwooterhover']);
	echo '<br class="colors-br" /><h4>'.__('Footer:','nirvana').'</h4>';
	cryout_color_field('nirvana_linkcolorfooter',__('Footer Links','nirvana'),$nirvanas['nirvana_linkcolorfooter']);
	cryout_color_field('nirvana_linkcolorfooterhover',__('Footer Links Hover','nirvana'),$nirvanas['nirvana_linkcolorfooterhover']);
	echo "<div><small>".__("Footer colours include the footer menu colours.","nirvana")."</small></div>";
} // cryout_setting_linkcolors_fn()

function cryout_setting_metacolors_fn() {
	global $nirvanas;
	cryout_color_field('nirvana_metacoloricons',__('Meta Icons','nirvana'),$nirvanas['nirvana_metacoloricons']);
	cryout_color_field('nirvana_metacolorlinks',__('Meta Links','nirvana'),$nirvanas['nirvana_metacolorlinks']);
	cryout_color_field('nirvana_metacolorlinkshover',__('Meta Links Hover','nirvana'),$nirvanas['nirvana_metacolorlinkshover']);
	echo "<div><small>".__("Colours for your meta area (post information).","nirvana")."</small></div>";
} // cryout_setting_metacolors_fn()

function cryout_setting_socialcolors_fn() {
	global $nirvanas;
	cryout_color_field('nirvana_socialcolorbg',__('Social Icons Background','nirvana'),$nirvanas['nirvana_socialcolorbg']);
	cryout_color_field('nirvana_socialcolorbghover',__('Social Icons Background Hover','nirvana'),$nirvanas['nirvana_socialcolorbghover']);
	echo "<div><small>".__("Background colours for your social icons.","nirvana")."</small></div>";
} // cryout_setting_socialcolors_fn()

function cryout_setting_caption_fn() {
    global $nirvanas;
	$values = array ( "caption-light", "caption-dark","caption-simple" ,);
	$labels = array( __("Light","nirvana"), __("Dark","nirvana"),__("Simple","nirvana"));
	echo "<select id='nirvana_caption' name='nirvana_settings[nirvana_caption]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_caption'],$item);
		echo ">$labels[$id]</option>";
	};
	echo "</select>";
	echo "<div><small>".__("This setting changes the look of your captions. Images that are not inserted through captions will not be affected.","nirvana")."</small></div>";
} // cryout_setting_caption_fn()


////////////////////////////////
//// GRAPHICS SETTINGS /////////
////////////////////////////////

function cryout_setting_topbar_fn() {
	global $nirvanas;
	$values = array ("Normal" , "Fixed", "Hide");
	$labels = array( __("Normal","nirvana"), __("Fixed","nirvana"), __("Hide","nirvana"));
	echo "<select id='nirvana_topbar' name='nirvana_settings[nirvana_topbar]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_topbar'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";

	$values2 = array ("Site width" , "Full width");
	$labels2 = array( __("Site width","nirvana"), __("Full width","nirvana"));
	echo " - <select id='nirvana_topbarwidth' name='nirvana_settings[nirvana_topbarwidth]'>";
	foreach($values2 as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_topbarwidth'],$item);
		echo ">$labels2[$id]</option>";
	}
	echo "</select>";

	echo "<div><small>".__("Show the topbar that can include social icons and the top menu.","nirvana")."</small></div>";
} // cryout_setting_topbar_fn()

function cryout_setting_breadcrumbs_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_breadcrumbs' name='nirvana_settings[nirvana_breadcrumbs]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_breadcrumbs'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Show breadcrumbs at the top of the content area. Breadcrumbs are a form of navigation that keeps track of your location withtin the site.","nirvana")."</small></div>";
} // cryout_setting_breadcrumbs_fn()

function cryout_setting_pagination_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_pagination' name='nirvana_settings[nirvana_pagination]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_pagination'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Show numbered pagination. Where there is more than one page, instead of the bottom <b>Older Posts</b> and <b>Newer posts</b> links you have a numbered pagination. ","nirvana")."</small></div>";
} // cryout_setting_pagination_fn()

function cryout_setting_menualign_fn() {
	global $nirvanas;
	$values = array ("left" , "center", "right", "rightmulti");
	$labels = array( __("Left","nirvana"), __("Center","nirvana"), __("Right", "nirvana"), __("Right (multiline)", "nirvana"));
	echo "<select id='nirvana_menualign' name='nirvana_settings[nirvana_menualign]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_menualign'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Sets the desired menu items alignment.","nirvana")."</small></div>";
} // cryout_setting_menualign_fn()

function cryout_setting_searchbar_fn() {
	global $nirvanas;
	$values = array( "top", "main", "footer");
	$labels = array( __("Top Menu", "nirvana"), __("Main Menu", "nirvana"), __("Footer Menu", "nirvana"));
	$i=0;
	foreach($values as $item):
		echo " <label id='$item' for='search$item' class='socialsdisplay'><input ";
		 checked($nirvanas['nirvana_searchbar'][$item],'1');
		echo " value='1' id='search$item' name='nirvana_settings[nirvana_searchbar][$item]' type='checkbox' /> ".$labels[$i]."</label>";
		$i++;
	endforeach;
	echo "<div><small>".__("Select the menus where to add a search bar.","nirvana")."</small></div>";
} // cryout_setting_searchbar_fn()

function cryout_setting_contentmargins_fn() {
	global $nirvanas;
	echo __('Margin top: ','nirvana');cryout_proto_field( $nirvanas, "input4str", "nirvana_contentmargintop", $nirvanas['nirvana_contentmargintop'], ' px ' );
	echo "<div><small>".__("Set the margin between the content and the menu. It can be set to 0px if you want the content area and menu to join.","nirvana")."</small></div><br><br>";

	echo __('Padding left/right: ','nirvana');cryout_proto_field( $nirvanas, "input4str", "nirvana_contentpadding", $nirvanas['nirvana_contentpadding'], ' px' );
	echo "<div><small>".__("Set the left/right padding around the content area. Only works with Boxed layouts.","nirvana")."</small></div>";
} // cryout_setting_contentmargins_fn()

function cryout_setting_image_fn() {
	global $nirvanas;
	$values = array("nirvana-image-none", "nirvana-image-one", "nirvana-image-two", "nirvana-image-three", "nirvana-image-four","nirvana-image-five");
	echo "<div>";
	foreach($values as $item) {
		$checkedClass = ($nirvanas['nirvana_image_style']==$item) ? ' checkedClass' : '';
		echo " <label id='$item' for='$item$item' class='images $checkedClass'><input ";
			checked($nirvanas['nirvana_image_style'],$item);
		echo " value='$item' id='$item$item' onClick=\"changeBorder('$item','images');\" name='nirvana_settings[nirvana_image_style]' type='radio' /><img class='$item'  src='".get_template_directory_uri()."/admin/images/testimg.jpg'/></label>";
	}
	echo "</div>";
	echo "<div><small>".__("The border style for your images. Only images inserted in your posts and pages will be affected. ","nirvana")."</small></div>";
} // cryout_setting_image_fn()

function cryout_setting_pagetitle_fn() {
	global $nirvanas;
	$values = array ("Show" , "Hide");
	$labels = array( __("Show","nirvana"), __("Hide","nirvana"));
	echo "<select id='nirvana_pagetitle' name='nirvana_settings[nirvana_pagetitle]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_pagetitle'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Hide or show titles on pages.","nirvana")."</small></div>";
} // cryout_setting_pagetitle_fn()

function cryout_setting_categtitle_fn() {
	global $nirvanas;
	$values = array ("Show" , "Hide");
	$labels = array( __("Show","nirvana"), __("Hide","nirvana"));
	echo "<select id='nirvana_categtitle' name='nirvana_settings[nirvana_categtitle]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_categtitle'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Hide or show titles on Categories and Archives.","nirvana")."</small></div>";
} // cryout_setting_categtitle_fn()

function cryout_setting_tables_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_tables' name='nirvana_settings[nirvana_tables]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_tables'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Hide table borders and background color.","nirvana")."</small></div>";
} // cryout_setting_tables_fn()

function cryout_setting_backtop_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_backtop' name='nirvana_settings[nirvana_backtop]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_backtop'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Enable the Back to Top button. The button appears after scrolling the page down.","nirvana")."</small></div>";
} // cryout_setting_backtop_fn()


////////////////////////////////
//// POST SETTINGS /////////////
////////////////////////////////

function cryout_setting_metapos_fn() {
	global $nirvanas;
	$values = array ("Top","Bottom","Hide" );
	$labels = array(__("Top","nirvana"), __("Bottom","nirvana"), __("Hide","nirvana"));
	echo "<select id='nirvana_metapos' name='nirvana_settings[nirvana_metapos]'>";
	foreach($values as $id=>$item):
		echo "<option value='$item'";
		selected($nirvanas['nirvana_metapos'],$item);
		echo ">$labels[$id]</option>";
	endforeach;
	echo "</select>";
	echo "<div><small>".__("The position of your meta bar (author, date, category, tags and edit button).","nirvana")."</small></div>";
} // cryout_setting_metapos_fn()

function cryout_setting_metashowblog_fn() {
	global $nirvanas;
	$values = array( "author", "date", "time" , "category" ,"tag", "comments");
	$labels = array( __("Author","nirvana"), __("Date","nirvana"),__("Time","nirvana") , __("Category","nirvana") ,__("Tag","nirvana"), __("Comments","nirvana"));
	$i=0;
	foreach($values as $item):
		echo " <label id='$item' for='blog$item' class='socialsdisplay'><input ";
		checked($nirvanas['nirvana_blog_show'][$item],'1');
		echo " value='1' id='blog$item' name='nirvana_settings[nirvana_blog_show][$item]' type='checkbox' /> ".$labels[$i]."</label>";
		$i++;
	endforeach;
	echo "<div><small>".__("Choose the post metas you want to show on multiple post pages (home, blog, category, archive etc.)","nirvana")."</small></div>";
} // cryout_setting_metashowblog_fn()

function cryout_setting_metashowsingle_fn() {
	global $nirvanas;
	$values = array( "author", "date", "time" , "category" ,"tag", "bookmark");
	$labels = array( __("Author","nirvana"), __("Date","nirvana"),__("Time","nirvana") , __("Category","nirvana") ,__("Tag","nirvana"), __("Bookmark","nirvana"));
	$i=0;
	foreach($values as $item):
		echo " <label id='$item' for='single$item' class='socialsdisplay'><input ";
		checked($nirvanas['nirvana_single_show'][$item],'1');
		echo " value='1' id='single$item' name='nirvana_settings[nirvana_single_show][$item]' type='checkbox' /> ".$labels[$i]."</label>";
		$i++;
	endforeach;
	echo "<div><small>".__("Choose the post metas you want to show on sigle post pages.","nirvana")."</small></div>";
} // cryout_setting_metashowsingle_fn()

function cryout_setting_comtext_fn() {
	global $nirvanas;
	$values = array ("Show" , "Hide");
	$labels = array( __("Show","nirvana"), __("Hide","nirvana"));
	echo "<select id='nirvana_comtext' name='nirvana_settings[nirvana_comtext]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_comtext'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Hide the explanatory text under the comments form (starts with  <i>You may use these HTML tags and attributes:...</i>).","nirvana")."</small></div>";
} // cryout_setting_comtext_fn()

function cryout_setting_comclosed_fn() {
	global $nirvanas;
	$values = array ("Show" , "Hide in posts", "Hide in pages", "Hide everywhere");
	$labels = array( __("Show","nirvana"), __("Hide in posts","nirvana"), __("Hide in pages","nirvana"), __("Hide everywhere","nirvana"));
	echo "<select id='nirvana_comclosed' name='nirvana_settings[nirvana_comclosed]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_comclosed'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Hide the <b>Comments are closed</b> text that by default shows up on pages or posts with comments disabled.","nirvana")."</small></div>";
} // cryout_setting_comclosed_fn()

function cryout_setting_comoff_fn() {
	global $nirvanas;
	$values = array ("Show" , "Hide");
	$labels = array( __("Show","nirvana"), __("Hide","nirvana"));
	echo "<select id='nirvana_comoff' name='nirvana_settings[nirvana_comoff]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_comoff'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Hide the <b>Comments off</b> text next to posts that have comments disabled.","nirvana")."</small></div>";
} // cryout_setting_comoff_fn()


////////////////////////////////
//// EXCERPT SETTINGS /////////////
////////////////////////////////

function cryout_setting_excerpthome_fn() {
	global $nirvanas;
	$values = array ("Excerpt" , "Full Post");
	$labels = array( __("Excerpt","nirvana"), __("Full Post","nirvana"));
	echo "<select id='nirvana_excerpthome' name='nirvana_settings[nirvana_excerpthome]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_excerpthome'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Excerpts on the main page. Only standard posts will be affected. All other post formats (aside, image, chat, quote etc.) have their specific formating.","nirvana")."</small></div>";
} // cryout_setting_excerpthome_fn()

function cryout_setting_excerptsticky_fn() {
	global $nirvanas;
	$values = array ("Excerpt" , "Full Post");
	$labels = array( __("Excerpt","nirvana"), __("Full Post","nirvana"));
	echo "<select id='nirvana_excerptsticky' name='nirvana_settings[nirvana_excerptsticky]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_excerptsticky'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Choose if you want the sticky posts on your home page to be visible in full or just the excerpts. ","nirvana")."</small></div>";
} // cryout_setting_excerptsticky_fn()

function cryout_setting_excerptarchive_fn() {
	global $nirvanas;
	$values = array ("Excerpt" , "Full Post");
	$labels = array( __("Excerpt","nirvana"), __("Full Post","nirvana"));
	echo "<select id='nirvana_excerptarchive' name='nirvana_settings[nirvana_excerptarchive]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_excerptarchive'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Excerpts on archive, categroy and search pages. Same as above, only standard posts will be affected.","nirvana")."</small></div>";
} // cryout_setting_excerptarchive_fn()

function cryout_setting_excerptlength_fn() {
	global $nirvanas;
	echo "<input id='nirvana_excerptlength' name='nirvana_settings[nirvana_excerptlength]' size='6' type='text' value='".esc_attr( $nirvanas['nirvana_excerptlength'] )."'  />";
	$values = array ("Words" , "Characters");
	$labels = array( __("Words","nirvana"), __("Characters","nirvana"));
	echo "<select id='nirvana_excerpttype' name='nirvana_settings[nirvana_excerpttype]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_excerpttype'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("The number of characters/words for excerpts. When that number is reached the post will be interrupted by a <i>Continue reading</i> link that will take the reader to the full post page." , "nirvana")."</small></div>";
} // cryout_setting_excerptlength_fn()

function cryout_setting_excerptdots_fn() {
	global $nirvanas;
	echo "<input id='nirvana_excerptdots' name='nirvana_settings[nirvana_excerptdots]' size='40' type='text' value='".esc_attr( $nirvanas['nirvana_excerptdots'] )."'  />";
	echo "<div><small>".__("Replaces the three dots ('[...])' that are appended automatically to excerpts.","nirvana")."</small></div>";
} // cryout_setting_excerptdots_fn()

function cryout_setting_excerptcont_fn() {
	global $nirvanas;
	echo "<input id='nirvana_excerptcont' name='nirvana_settings[nirvana_excerptcont]' size='40' type='text' value='".esc_attr( $nirvanas['nirvana_excerptcont'] )."'  />";
	echo "<div><small>".__("Edit the 'Continue Reading' link added to your post excerpts.","nirvana")."</small></div>";
} // cryout_setting_excerptcont_fn()

function cryout_setting_excerpttags_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable *UNSUPPORTED*","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_excerpttags' name='nirvana_settings[nirvana_excerpttags]'";
	if ($nirvanas['nirvana_excerpttags'] != 'Enable') echo " disabled='disabled'";
	echo ">";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		if ('Enable' == $item) echo " disabled='disabled'";
		selected($nirvanas['nirvana_excerpttags'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("By default WordPress excerpts remove all HTML tags (&lt;pre&gt;, &lt;a&gt;, &lt;b&gt and all others) and only clean text is left in the excerpt. Enabling this option allows HTML tags to remain in excerpts so all your default formating will be kept.<br /> <b>Just a warning: </b>If HTML tags are enabled, you have to make sure they are not left open. So if within your post you have an opened HTML tag but the except ends before that tag closes, the rest of the site will be contained in that HTML tag. -- Leave 'Disable' if unsure -- ","nirvana").'<br><strong><em style="color:#880000;">'.__('This option is deprecated and no longer supported since Nirvana v1.4.0','nirvana')."</strong></em></small></div>";
} // cryout_setting_excerpttags_fn()


////////////////////////////////
/// FEATURED IMAGE SETTINGS ////
////////////////////////////////

function cryout_setting_fpost_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_fpost' name='nirvana_settings[nirvana_fpost]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fpost'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	$checkedClass = ($nirvanas['nirvana_fpostlink']=='1') ? ' checkedClass' : '';
	echo " <label style='border:none;margin-left:10px;' id='$values[0]' for='$values[0]$values[0]' class='socialsdisplay $checkedClass'><input type='hidden' name='nirvana_settings[nirvana_fpostlink]' value='0' /><input ";
	checked($nirvanas['nirvana_fpostlink'],'1');
	echo " value='1' id='$values[0]$values[0]'  name='nirvana_settings[nirvana_fpostlink]' type='checkbox' /> ".__("Link the thumbnail to the post","nirvana")."</label>";
	echo "<div><small>".__("Show featured images as thumbnails on posts. The images must be selected for each post in the Featured Image section.","nirvana")."</small></div>";
} // cryout_setting_fpost_fn()

function cryout_setting_fauto_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_fauto' name='nirvana_settings[nirvana_fauto]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fauto'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Show the first image that you inserted in a post as a thumbnail. If there is a Featured Image selected for that post, it will have priority.","nirvana")."</small></div>";
} // cryout_setting_fauto_fn()

function cryout_setting_falign_fn() {
	global $nirvanas;
	$values = array ("Left" , "Center", "Right");
	$labels = array( __("Left","nirvana"), __("Center","nirvana"), __("Right","nirvana"));
	echo "<select id='nirvana_falign' name='nirvana_settings[nirvana_falign]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_falign'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Thumbnail alignment.","nirvana")."</small></div>";
} // cryout_setting_falign_fn()

function cryout_setting_fsize_fn() {
	global $nirvanas;
	echo "<input id='nirvana_fwidth' name='nirvana_settings[nirvana_fwidth]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fwidth'] )."'  />px ".__("(width)","nirvana")." <b> X </b> ";
	echo "<input id='nirvana_fheight' name='nirvana_settings[nirvana_fheight]' size='4' type='text' value='".esc_attr( $nirvanas['nirvana_fheight'] )."'  />px ".__("(height)","nirvana")."";

	$checkedClass = ($nirvanas['nirvana_fcrop']=='1') ? ' checkedClass' : '';
	echo " <label id='fcrop' for='nirvana_fcrop' class='socialsdisplay $checkedClass'><input  ";
	checked($nirvanas['nirvana_fcrop'],'1');
	echo "value='1' id='nirvana_fcrop'  name='nirvana_settings[nirvana_fcrop]' type='checkbox' /> ".__("Crop images to exact size.","nirvana")." </label>";

	echo "<div><small>".__("The size (in pixels) for your thumbnails. By default imges will be scaled with aspect ratio kept. Choose to crop the images if you want the exact size.","nirvana")."</small></div>";
} // cryout_setting_fsize_fn()

function cryout_setting_fheader_fn() {
	global $nirvanas;
	$values = array ("Enable" , "Disable");
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_fheader' name='nirvana_settings[nirvana_fheader]'>";
	foreach ($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fheader'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Show featured images on headers. The header will be replaced with a featured image if you selected it as a Featured Image in the post and if it is bigger or at least equal to the current header size.","nirvana")."</small></div>";
} // cryout_setting_fheader_fn()


////////////////////////
/// SOCIAL SETTINGS ////
////////////////////////

function cryout_setting_social_master($i) {
	global $nirvanas, $nirvana_socialNetworks;
	
	$cryout_special_keys = array( 'Mail', 'Skype' );
	$cryout_social_small = array(
		'', __('Select your desired Social network from the left dropdown menu and insert your corresponding address in the right input field. (ex: <i>http://www.facebook.com/yourname</i> )','nirvana'),
		'', __("You can also choose if you want the link to open in a new window and what title to display while hovering over the icon.",'nirvana'),
		'', __("You can show up to 5 different social icons from over 35 social networks.",'nirvana'),
		'', __("You can leave any number of inputs empty.",'nirvana'),
		'', __("You can change the background for your social colors from the colors settings section.",'nirvana')
		);
	$j=$i+1;
	
	echo "<select id='nirvana_social$i' name='nirvana_settings[nirvana_social$i]'>";
		foreach($nirvana_socialNetworks as $item) {
			echo "<option value='$item'";
			selected($nirvanas['nirvana_social'.$i],$item);
			echo ">$item</option>";
		}
	echo "</select><span class='address_span'> &raquo; </span>";

	if (in_array($nirvanas['nirvana_social'.$i],$cryout_special_keys)) :
		$cryout_current_social = esc_html( $nirvanas['nirvana_social'.$j] );
	else :
		$cryout_current_social = esc_url( $nirvanas['nirvana_social'.$j] );
	endif;
	
	// Social Link
	echo "<input id='nirvana_social$j' placeholder='".__("Social Network Link","nirvana")."' name='nirvana_settings[nirvana_social$j]' size='32' type='text'  value='$cryout_current_social' />";
	// Social Open in new window
	$checkedClass = ($nirvanas['nirvana_social_target'.$i]=='1') ? ' checkedClass' : '';
	echo " <label id='nirvana_social_target$i' for='nirvana_social_target$i$i' class='$checkedClass'><input ";
	checked($nirvanas['nirvana_social_target'.$i],'1');
	echo " value='1' id='nirvana_social_target$i$i' name='nirvana_settings[nirvana_social_target$i]' type='checkbox' /> ".__("Open in new window","nirvana")." </label>";
	// Social Title
	echo "<input id='nirvana_social_title$i$i' name='nirvana_settings[nirvana_social_title$i]' size='32' type='text' placeholder='".__("Social Network Title","nirvana")."' value='".$nirvanas['nirvana_social_title'.$i]."' />";

	echo "<div><small>".$cryout_social_small[$i]."</small></div>";
} // cryout_setting_social_master()

function cryout_setting_socials1_fn() {
	cryout_setting_social_master(1);
}

function cryout_setting_socials2_fn() {
	cryout_setting_social_master(3);
}

function cryout_setting_socials3_fn() {
	cryout_setting_social_master(5);
}

function cryout_setting_socials4_fn() {
	cryout_setting_social_master(7);
}

function cryout_setting_socials5_fn() {
	cryout_setting_social_master(9);
}


function cryout_setting_socialsdisplay_fn() {
	global $nirvanas;
	$values = array( "Header", "CLeft", "CRight" , "Footer" ,"SLeft", "SRight");

	echo " <label id='$values[0]' for='$values[0]$values[0]' class='socialsdisplay'><input ";
	checked($nirvanas['nirvana_socialsdisplay0'],'1');
	echo " value='1' id='$values[0]$values[0]' name='nirvana_settings[nirvana_socialsdisplay0]' type='checkbox' /> ".__("Top Bar","nirvana")."</label>";

	echo " <label id='$values[3]' for='$values[3]$values[3]' class='socialsdisplay'><input ";
	checked($nirvanas['nirvana_socialsdisplay3'],'1');
	echo " value='1' id='$values[3]$values[3]' name='nirvana_settings[nirvana_socialsdisplay3]' type='checkbox' /> ".__("Footer","nirvana")." </label>";

	echo " <label id='$values[4]' for='$values[4]$values[4]' class='socialsdisplay'><input ";
	checked($nirvanas['nirvana_socialsdisplay4'],'1');
	echo " value='1' id='$values[4]$values[4]' name='nirvana_settings[nirvana_socialsdisplay4]' type='checkbox' /> ".__("Left side","nirvana")." </label>";

	echo " <label id='$values[5]' for='$values[5]$values[5]' class='socialsdisplay'><input ";
	checked($nirvanas['nirvana_socialsdisplay5'],'1');
	echo " value='1' id='$values[5]$values[5]' name='nirvana_settings[nirvana_socialsdisplay5]' type='checkbox' /> ".__("Right side","nirvana")." </label>";

	echo "<br/>";

	echo " <label id='$values[1]' for='$values[1]$values[1]' class='socialsdisplay'><input ";
	checked($nirvanas['nirvana_socialsdisplay1'],'1');
	echo " value='1' id='$values[1]$values[1]' name='nirvana_settings[nirvana_socialsdisplay1]' type='checkbox' /> ".__("Left Sidebar","nirvana")." </label>";

	echo " <label id='$values[2]' for='$values[2]$values[2]' class='socialsdisplay'><input ";
	checked($nirvanas['nirvana_socialsdisplay2'],'1');
	echo " value='1' id='$values[2]$values[2]' name='nirvana_settings[nirvana_socialsdisplay2]' type='checkbox' /> ".__("Right Sidebar","nirvana")." </label>";

	echo "<div><small>".__("Choose the <b>areas</b> where to display the social icons.","nirvana")."</small></div>";
} // cryout_setting_socialsdisplay_fn()


////////////////////////
/// MISC SETTINGS ////
////////////////////////

function cryout_setting_copyright_fn() {
	global $nirvanas;
	echo "<textarea id='nirvana_copyright' name='nirvana_settings[nirvana_copyright]' rows='3' cols='70' type='textarea' >".esc_textarea($nirvanas['nirvana_copyright'])." </textarea>";
	echo "<div><small>".__("Insert custom text or HTML code that will appear in you footer. <br /> You can use HTML to insert links, images and special characters like &copy;.","nirvana")."</small></div>";
} // cryout_setting_copyright_fn()

function cryout_setting_customcss_fn() {
	global $nirvanas;
	echo "<textarea id='nirvana_customcss' name='nirvana_settings[nirvana_customcss]' rows='8' cols='70' type='textarea' >".esc_textarea(htmlspecialchars_decode($nirvanas['nirvana_customcss'], ENT_QUOTES))." </textarea>";
	echo "<div><small>".__("Insert your custom CSS here. Any CSS declarations made here will overwrite Nirvana's (even the custom options specified right here in the Nirvana Settings page). <br /> Your custom CSS will be preserved when updating the theme.","nirvana")."</small></div>";
} // cryout_setting_customcss_fn()

function cryout_setting_customjs_fn() {
	global $nirvanas;
	echo "<textarea id='nirvana_customjs' name='nirvana_settings[nirvana_customjs]' rows='8' cols='70' type='textarea' >".esc_textarea(htmlspecialchars_decode($nirvanas['nirvana_customjs']))." </textarea>";
	echo "<div><small>".__("Insert your custom Javascript code here. (Google Analytics and any other forms of Analytic software).","nirvana")."</small></div>";
} // cryout_setting_customjs_fn

function cryout_setting_iecompat_fn() {
	global $nirvanas;
	$values = array (1, 0);
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_iecompat' name='nirvana_settings[nirvana_iecompat]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_iecompat'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<input type='hidden' name='nirvana_settings[nirvana_postboxes]' id='nirvana-postboxes' value='". $nirvanas['nirvana_postboxes']."'>";
	echo "<input type='hidden' name='nirvana_settings[nirvana_current_admin_menu]' id='nirvana_current' value='". $nirvanas['nirvana_current_admin_menu']."'>";
	echo "<div><small>".__("Enable extra compatibility tag for older Internet Explorer versions. Turning this option on will trigger W3C validation errors.","nirvana")."</small></div>";
} // cryout_setting_iecompat_fn()

function cryout_setting_protectionoutput_fn() {
	global $nirvanas;
	$values = array (1, 0);
	$labels = array( __("Display","nirvana"), __("Hide","nirvana"));
	echo "<select id='nirvana_protectionoutput' name='nirvana_settings[nirvana_protectionoutput]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_protectionoutput'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Enable output from Nirvana's injection protection engine. Will display which extensions attempted to interfere with the theme. Uses some memory when enabled and a large number of injections are detected.","nirvana")."</small></div>";
} // cryout_setting_protectionoutput_fn()

/*function cryout_setting_masonry_fn() {
	global $nirvanas;
	$values = array (1, 0);
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_masonry' name='nirvana_settings[nirvana_masonry]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_masonry'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Disable to troubleshoot compatibility with plugins that dynamically add content to post lists and change length.","nirvana")."</small></div>";
} // cryout_setting_masonry_fn() */

function cryout_setting_fitvids_fn() {
	global $nirvanas;
	$values = array (1, 0);
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_fitvids' name='nirvana_settings[nirvana_fitvids]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_fitvids'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Disable to troubleshoot embedded video resize issues.","nirvana")."</small></div>";
} // cryout_setting_fitvids_fn()

function cryout_setting_editorstyle_fn() {
	global $nirvanas;
	$values = array (1, 0);
	$labels = array( __("Enable","nirvana"), __("Disable","nirvana"));
	echo "<select id='nirvana_editorstyle' name='nirvana_settings[nirvana_editorstyle]'>";
	foreach($values as $id=>$item) {
		echo "<option value='$item'";
		selected($nirvanas['nirvana_editorstyle'],$item);
		echo ">$labels[$id]</option>";
	}
	echo "</select>";
	echo "<div><small>".__("Disable to turn off the theme's styling in the Visual Editor.","nirvana")."</small></div>";
} // cryout_setting_editorstyle_fn()

// FIN