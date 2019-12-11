<?php /**
 * Class metlux_Contact_Widget
 */
class metlux_Contact_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'metlux-contact-widget',
            __('metlux Contact Widget','metlux'),
            array(
                'description' => __('Displays Contact in sidebar.','metlux'),
                'classname' => 'widget-contact')
        );
    }

     /**
     * @param array $instance
     */
    public function form( $instance ) {
        $title      = isset($instance['title']) ? esc_html($instance['title']) : '';
        $address    = isset($instance['address']) ? esc_html($instance['address']) : '';
        $phone      = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
        $email      = isset($instance['email']) ? esc_attr($instance['email']) : '';
        $twitter    = isset($instance['twitter']) ? esc_url($instance['twitter']) : '';

        $facebook   = isset($instance['facebook']) ? esc_url($instance['facebook']) : '';
        $google_plus= isset($instance['google_plus']) ? esc_url($instance['google_plus']) : '';
        $instagram  = isset($instance['instagram']) ? esc_url($instance['instagram']) : '';
        $linkedin   = isset($instance['linkedin']) ? esc_url($instance['linkedin']) : '';
        $ytube      = isset($instance['ytube']) ? esc_url($instance['ytube']) : '';
        $skype      = isset($instance['skype']) ? esc_url($instance['skype']) : '';

        ?>
        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('address'); ?>"><?php esc_html_e('Address:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('phone'); ?>"><?php esc_attr_e('Phone:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('email'); ?>"><?php esc_attr_e('E-mail:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

         <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php esc_html_e('Facebook Link:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php esc_html_e('Twitter Link:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

         <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('google_plus'); ?>"><?php esc_html_e('Google Plus Link:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('google_plus'); ?>" name="<?php echo $this->get_field_name('google_plus'); ?>" type="text" value="<?php echo $google_plus; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

         <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php esc_html_e('Instagram Link:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo $instagram; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

         <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php esc_html_e('Linkedin Link:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $linkedin; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('ytube'); ?>"><?php esc_html_e('Youtube Link:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('ytube'); ?>" name="<?php echo $this->get_field_name('ytube'); ?>" type="text" value="<?php echo $ytube; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->

        <div class="widget-input-wrapper">
            <div class="widget-label">
                <label for="<?php echo $this->get_field_id('skype'); ?>"><?php esc_html_e('Skype Link:', 'metlux'); ?></label>
            </div>
            <div class="widget-input">
                <input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo $skype; ?>" />
            </div>
        </div><!--- end widget-input-wrapper -->



        <?php
    }
     

    /**
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
        $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
        $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
        $instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['google_plus'] = ( ! empty( $new_instance['google_plus'] ) ) ? strip_tags( $new_instance['google_plus'] ) : '';
        $instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        $instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
        $instance['ytube'] = ( ! empty( $new_instance['ytube'] ) ) ? strip_tags( $new_instance['ytube'] ) : '';
        $instance['skype'] = ( ! empty( $new_instance['skype'] ) ) ? strip_tags( $new_instance['skype'] ) : '';
        return $instance;
    }
     /**
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $address = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
        $phone = isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
        $email = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
        $twitter = isset( $instance['twitter'] ) ? esc_url( $instance['twitter'] ) : '';
        $facebook = isset( $instance['facebook'] ) ? esc_url( $instance['facebook'] ) : '';
        $google_plus = isset( $instance['google_plus'] ) ? esc_url( $instance['google_plus'] ) : '';
        $instagram = isset( $instance['instagram'] ) ? esc_url( $instance['instagram'] ) : '';
        $linkedin = isset( $instance['linkedin'] ) ? esc_url( $instance['linkedin'] ) : '';
        $ytube = isset( $instance['ytube'] ) ? esc_url( $instance['ytube'] ) : '';
        $skype = isset( $instance['linkedin'] ) ? esc_url( $instance['skype'] ) : '';

?>
        <?php echo $before_widget; ?>
        <?php if ( ! empty( $title ) ) : ?>
            <?php echo $before_title . $title . $after_title; ?>
        <?php endif; ?>
        <!-- Display Widget area -->
            <div class="contact-info">
                    <h2 class="footer-title hidden"><?php echo $title; ?></h2>
                    <?php if($address){ ?>
                        <div class="single">
                            <i class="fa fa-map-marker"></i>
                            <p><?php echo esc_attr($address); ?></p>
                        </div>
                    <?php }?>
                     <?php if($phone){ ?>
                        <div class="single">
                            <i class="fa fa-phone"></i>
                            <p><?php echo esc_attr($phone); ?></p>
                        </div>
                    <?php }?>
                    <?php if($email){ ?>
                    <div class="single">
                        <i class="fa fa-envelope"></i>
                        <p><?php echo esc_attr($email); ?></p>
                    </div>
                    <?php }?>

                    <div class="social-icon">
                        <ul class="list-inline">
                        <?php if($facebook){ ?>
                            <li><a href="<?php echo esc_url($facebook); ?>" title=""><i class="fa fa-facebook"></i></a></li>
                        <?php }?>
                        <?php if($twitter){ ?>
                            <li><a href="<?php echo esc_url($twitter); ?>" title=""><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if($instagram){ ?>
                            <li><a href="<?php echo esc_url($instagram); ?>" title=""><i class="fa fa-instagram"></i></a></li>
                        <?php } ?>
                        <?php if($linkedin){ ?>
                            <li><a href="<?php echo esc_url($linkedin); ?>" title=""><i class="fa fa-linkedin"></i></a></li>
                        <?php }?>
                        <?php if($skype){ ?>
                            <li><a href="<?php echo esc_url($skype); ?>" title=""><i class="fa fa-skype"></i></a></li>
                        <?php }?>
                        <?php if($google_plus){ ?>
                            <li><a href="<?php echo esc_url($google_plus); ?>" title=""><i class="fa fa-google-plus"></i></a></li>
                        <?php }?>
                        <?php if($ytube){ ?>
                            <li><a href="<?php echo esc_url($ytube); ?>" title=""><i class="fa fa-youtube-play"></i></a></li>
                        <?php }?>
                        

                        </ul>
                    </div>
            </div>
        <!--- end widget display area -->
        <?php echo $after_widget; ?>

        <?php
    }

}


/**
 * Register custom widgets.
 */
function metlux_widget_init() {

   
    register_widget( 'metlux_Contact_Widget' );
    
 
}

add_action( 'widgets_init', 'metlux_widget_init' );
