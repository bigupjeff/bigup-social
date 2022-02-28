<?php
/**
 * Bigup Web: Social - Widget.
 *
 * This template defines the widget including settings form,
 * front end html and saving settings.
 *
 * @package bigup_social
 * @author Jefferson Real <me@jeffersonreal.com>
 * @copyright Copyright (c) 2021, Jefferson Real
 * @license GPL2+
 */

class Bigup_Social_Widget extends WP_Widget {


    /**
     * Construct the widget.
     */
    function __construct() {

        $widget_options = array (
            'classname' => 'bigup_social_widget',
            'description' => 'A simple social link widget'
        );
        parent::__construct( 'bigup_social_widget', 'Bigup Web: Social', $widget_options );

    }


    /**
     * output widget settings form.
     */
    function form( $instance ) {

        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Connect with Me';
        $codepen = ! empty( $instance['codepen'] ) ? $instance['codepen'] : '';
        $instagram = ! empty( $instance['codepen'] ) ? $instance['codepen'] : '';
        $facebook = ! empty( $instance['codepen'] ) ? $instance['codepen'] : '';

        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'codepen' ); ?>">Codepen URL</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'codepen' ); ?>" name="<?php echo urldecode ( $this->get_field_name( 'codepen' ) ); ?>" value="<?php echo esc_attr( $codepen ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'instagram' ); ?>">Instagram URL</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo urldecode ( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instagram ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook URL</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo urldecode ( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $facebook ); ?>" />
        </p>
        <?php
    }


    /**
     * display the widget on the front end.
     */
    function widget( $args, $instance ) {

        // enqueue the styles
        wp_enqueue_style('bigup_social_widget_css');

        //Populate the title and social urls
        $title = apply_filters( 'widget_title', $instance['title'] );
        $codepen = $instance['codepen'];
        $instagram = $instance['instagram'];
        $facebook = $instance['facebook'];

        //Populate the icon urls
        $codepen_iconurl = plugin_dir_url( dirname( __FILE__ ) ) . 'imagery/icon_codepen-transparent.svg';
        $instagram_iconurl = plugin_dir_url( dirname( __FILE__ ) ) . 'imagery/icon_instagram-transparent.svg';
        $facebook_iconurl = plugin_dir_url( dirname( __FILE__ ) ) . 'imagery/icon_facebook-transparent.svg';

        //Check there is at least one social link to display otherwise exit

        if ( empty( $codepen ) && empty( $instagram ) && empty( $facebook ) ) {

            $noconfig = $args['before_widget'];

            if ( ! empty( $title ) ) {
                $noconfig .= $args['before_title'] . $title . $args['after_title'];
            };

            $noconfig .= '<div class="social social-inline">';
            $noconfig .= '<span>Error: No social links configured. Please configure widget settings.</span>';
            $noconfig .= '</div>';
            $noconfig .= $args['after_widget'];

            echo $noconfig;
            return;

        } else {

            echo $args['before_widget'];

                if ( ! empty( $title ) ) {
                    echo $args['before_title'] . $title . $args['after_title'];
                }; ?>

                <div class="social social-inline">

                    <?php
                    //Check if setting is populated and output html if true
                    if ( ! empty( $codepen ) ) {
                        ?>
                            <a  class="social_link" href="<?php echo $codepen; ?>" target="_blank" aria-label="Follow Me on Codepen">
                                <img height="100%" class="social_icon" src="<?php echo $codepen_iconurl; ?>" alt="Codepen Logo" title="Follow Me on Codepen">
                            </a>
                        <?php
                    };

                    if ( ! empty( $instagram ) ) {
                        ?>
                            <a class="social_link" href="<?php echo $instagram; ?>" target="_blank" aria-label="Follow Me on Instagram">
                                <img height="100%" class="social_icon" src="<?php echo $instagram_iconurl; ?>" alt="Instagram Logo" title="Follow Me on Instagram">
                            </a>
                        <?php
                    };

                    if ( ! empty( $facebook ) ) {
                        ?>
                            <a class="social_link" href="<?php echo $facebook; ?>" target="_blank" aria-label="Follow Me on Facebook">
                                <img height="100%" class="social_icon" src="<?php echo $facebook_iconurl; ?>" alt="Facebook Logo" title="Follow Me on Facebook">
                            </a>
                        <?php
                    };

                echo '</div>';

            echo $args['after_widget'];

        }//endif
    }//function widget


    /**
     * define the data saved by the widget.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['codepen'] = strip_tags( $new_instance['codepen'] );
        $instance['instagram'] = strip_tags( $new_instance['instagram'] );
        $instance['facebook'] = strip_tags( $new_instance['facebook'] );
        return $instance;
    }

} //Class Bigup_Social_Widget end

/**
 * Register and load the widget.
 */
function bigup_social_load_widget() {
    register_widget( 'bigup_social_widget' );
}
add_action( 'widgets_init', 'bigup_social_load_widget' );
