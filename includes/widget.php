<?php
/**
 * Instagram Live Stream Widget
 *
 * @package Instagram_Live_Stream
 * @subpackage Widget
 */

class Instagram_Live_Stream_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'instagram_live_stream_widget', // Base ID
            esc_html__( 'Instagram Live Stream', 'instagram-live-stream' ), // Name
            array( 'description' => esc_html__( 'Display Instagram Live Stream', 'instagram-live-stream' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['username'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
            echo do_shortcode( '[instagram_live_stream_with_feedback username="' . esc_attr( $instance['username'] ) . '"]' );
        }
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Instagram Live Stream', 'instagram-live-stream' );
        $username = ! empty( $instance['username'] ) ? $instance['username'] : 'instagram';
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'instagram-live-stream' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_attr_e( 'Username:', 'instagram-live-stream' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['username'] = ( ! empty( $new_instance['username'] ) ) ? sanitize_text_field( $new_instance['username'] ) : '';

        return $instance;
    }
}

// Register widget
function register_instagram_live_stream_widget() {
    register_widget( 'Instagram_Live_Stream_Widget' );
}
add_action( 'widgets_init', 'register_instagram_live_stream_widget' );
