<!--================================
=            Video Play            =
=================================-->
<?php 
$sectionenable = esc_attr(get_theme_mod('video_enable',1));
if($sectionenable==1){
	$title = esc_attr(get_theme_mod('video_title', __('Video Title','metlux')));
	$desc	= esc_html(get_theme_mod('video_content',__('Video Subtitle','metlux')));
	
	
	
	?>
	<section class="metlux-video img-bg" >
		<div class="container">
			<div class="row">
				<!-- Button trigger modal -->
				<button type="button" class="play-button" data-toggle="modal" data-target="#myModal">
					<i class="fa fa-play"></i>
				</button>

				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="pause-button">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
							</div>
							<div class="modal-body">
								<div class="embed-responsive embed-responsive-16by9">
									
									<?php dynamic_sidebar('video_section'); ?>
								</div>
							</div>
							<div class="modal-footer">
								<p><?php echo $desc; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>
<!--====  End of Video Play  ====-->
