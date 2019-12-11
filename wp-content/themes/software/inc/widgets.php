<?php /**
 * Class Software_Socialize_Widget
 */
class Software_Socialize_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'Software-socialize-widget',
            __('Software - Socialize','software'),
            array(
                'description' => __('Displays socialize in sidebar.','software'),
                'classname' => 'widget-socialize')
        );
    }

    /**
     * @param array $instance
     */
    public function form( $instance ) {
        $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
        $subtitle = isset($instance['subtitle']) ? esc_attr($instance['subtitle']) : '';
        $fb_page_url = isset($instance['fb_page_url']) ? esc_attr($instance['fb_page_url']) : '';
        $pinterest_user_name = isset($instance['pinterest_un']) ? esc_attr($instance['pinterest_un']) : '';
        $twitter_user_name = isset($instance['twitter_un']) ? esc_attr($instance['twitter_un']) : '';
        $google_user_name = isset($instance['g_un']) ? esc_attr($instance['g_un']) : '';
        $instagram_user_name = isset($instance['instagram_un']) ? esc_attr($instance['instagram_un']) : '';
        $linkedin_user_name = isset($instance['li_un']) ? esc_attr($instance['li_un']) : '';
        $yt_user_name = isset($instance['yt_un']) ? esc_attr($instance['yt_un']) : '';

        ?>
        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php esc_attr_e('Subtitle:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>"/>
            </div>
        </div><!--- end widget-input-wrapper -->

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('fb_page_url')); ?>"><?php esc_attr_e('Facebook page url:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('fb_page_url')); ?>" name="<?php echo esc_attr($this->get_field_name('fb_page_url')); ?>" type="url" value="<?php echo esc_attr($fb_page_url); ?>" />
            </div>
        </div>

      

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('pinterest_un')); ?>"><?php esc_attr_e('Pinterest Url:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest_un')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest_un')); ?>" type="text" value="<?php echo esc_attr($pinterest_user_name); ?>" />
            </div>
        </div>

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('twitter_un')); ?>"><?php esc_attr_e('Twitter Url:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter_un')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_un')); ?>" type="text" value="<?php echo esc_attr($twitter_user_name); ?>" />
            </div>
        </div>

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('g_un')); ?>"><?php esc_attr_e('Google+ Url:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('g_un')); ?>" name="<?php echo esc_attr($this->get_field_name('g_un')); ?>" type="text" value="<?php echo esc_attr($google_user_name); ?>" />
            </div>
        </div>
        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('instagram_un')); ?>"><?php esc_attr_e('Instagram Url:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_un')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_un')); ?>" type="text" value="<?php echo esc_attr($instagram_user_name); ?>" />
            </div>
        </div>
        
        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('li_un')); ?>"><?php esc_attr_e('Linked In Url:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('li_un')); ?>" name="<?php echo esc_attr($this->get_field_name('li_un')); ?>" type="text" value="<?php echo esc_attr($linkedin_user_name); ?>" />
            </div>
        </div>
        
         <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo esc_attr($this->get_field_id('yt_un')); ?>"><?php esc_attr_e('Youtube Url:', 'software'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('yt_un')); ?>" name="<?php echo esc_attr($this->get_field_name('yt_un')); ?>" type="text" value="<?php echo esc_attr($yt_user_name); ?>" />
            </div>
        </div>


        <?php
    }

    /**
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['subtitle'] = sanitize_text_field( $new_instance['subtitle'] );
        $instance['fb_page_url'] = esc_url_raw( $new_instance['fb_page_url'] );
        $instance['pinterest_un'] = esc_url_raw( $new_instance['pinterest_un'] );
        $instance['twitter_un'] = esc_url_raw( $new_instance['twitter_un'] );
        $instance['g_un'] = esc_url_raw( $new_instance['g_un'] );
        $instance['instagram_un'] = esc_url_raw( $new_instance['instagram_un'] );
        $instance['li_un'] = esc_url_raw( $new_instance['li_un'] );
        $instance['yt_un'] = esc_url_raw( $new_instance['yt_un'] );
        return $instance;
    }

    /**
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
		$title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
        $subtitle = isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : '';
        $fb_page_url = isset( $instance['fb_page_url'] ) ? esc_url( $instance['fb_page_url'] ) : '';
        $youtube_video = isset( $instance['yt_un'] ) ? esc_attr( $instance['yt_un'] ) : '';
        $vimeo_un = isset( $instance['vimeo_un'] ) ? esc_attr( $instance['vimeo_un'] ) : '';
        $pinterest_un = isset( $instance['pinterest_un'] ) ? esc_attr( $instance['pinterest_un'] ) : '';
        $twitter_un = isset( $instance['twitter_un'] ) ? esc_attr( $instance['twitter_un'] ) : '';
        $g_userName = isset( $instance['g_un'] ) ? esc_attr( $instance['g_un'] ) : '';
        $instagram_userName = isset( $instance['instagram_un'] ) ? esc_attr( $instance['instagram_un'] ) : '';
        $li_userName = isset( $instance['li_un'] ) ? esc_attr( $instance['li_un'] ) : '';



        ?>
        <?php echo wp_kses_post($before_widget); ?>
        <?php if ( ! empty( $title ) ) : ?>
            <?php echo wp_kses_post($before_title . $title . $after_title); ?>
            <p><?php echo wp_kses_post($subtitle); ?></p>
        <?php endif; ?>
        <!-- Display Widget area -->
                <ul class="list-inline social-share">
          <?php if($fb_page_url){ ?>
               <?php echo  '<li><a target="_blank" href="'.esc_url($fb_page_url). '"><i class="fa fa-facebook"></i></a></li>'; ?>
           <?php }?> 
            
           <?php if($twitter_un){ ?>
                <?php echo '<li><a target="_blank" href="'. esc_url($twitter_un).'"><i class="fa fa-twitter"></i></a></li>';?>
            <?php }?>
          
            <?php if($g_userName){?>
                <?php echo '<li><a target="_blank" href="'.esc_url($g_userName).'"><i class="fa fa-google-plus"></i></a></li>';?>
            <?php }?>
            <?php if($pinterest_un){ ?>
                <?php echo '<li><a target="_blank" href="'.esc_url($pinterest_un).'"><i class="fa fa-pinterest"></i></a></li>';?>
            <?php } ?>
            
             <?php if($instagram_userName){ ?>
                <?php echo'<li><a target="_blank" href="'.esc_url($instagram_userName) .'"><i class="fa fa-instagram"></i></a></li>';?>
            <?php } ?>
            
             <?php if($li_userName){ ?>
                <?php echo '<li><a target="_blank" href="'.esc_url($li_userName) .'"><i class="fa fa-linkedin"></i></a></li>';?>
            <?php } ?>
            
             <?php if($youtube_video){ ?>
                <?php echo '<li><a target="_blank" href="'.esc_url($youtube_video) .'"><i class="fa fa-youtube"></i></a></li>';?>
            <?php } ?>
                </ul>

      
        <?php echo wp_kses_post($after_widget); ?>

        <?php
    }

}

/**
 * Register custom widgets.
 */
function Software_widget_init() {
   
    register_widget( 'Software_Socialize_Widget' );  
}

add_action( 'widgets_init', 'Software_widget_init' );


