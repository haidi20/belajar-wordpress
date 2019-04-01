<?php
/**
 * Eggnews: Homepage Featured Slider
 *
 * Homepage slider section with featured section
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
add_action('widgets_init', 'eggnews_register_post_carousel_widget');

function eggnews_register_post_carousel_widget() {
    register_widget('Eggnews_Post_Carousel');
}

if (!class_exists('Eggnews_Post_Carousel')):
    class Eggnews_Post_Carousel extends WP_Widget {
        /**
         * Register widget with WordPress.
         */
        public function __construct() {
            $widget_ops = array(
                'classname' => 'eggnews_post_carousel clearfix',
                'description' => esc_html__('Display carousel with posts.', 'eggnews-pro')
            );
            parent::__construct('eggnews_post_carousel', esc_html__('Carousel Posts', 'eggnews-pro'), $widget_ops);
        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        private function widget_fields() {

            $eggnews_category_dropdown = eggnews_category_dropdown();

            $fields = array(
                'eggnews_carousel_title' => array(
                    'eggnews_widgets_name' => 'eggnews_carousel_title',
                    'eggnews_widgets_title' => esc_html__('Carousel title', 'eggnews-pro'),
                    'eggnews_widgets_default' => '',
                    'eggnews_widgets_field_type' => 'text',
                ),
                'eggnews_carousel_category' => array(
                    'eggnews_widgets_name' => 'eggnews_carousel_category',
                    'eggnews_widgets_title' => esc_html__('Category for Slider', 'eggnews-pro'),
                    'eggnews_widgets_default' => 0,
                    'eggnews_widgets_field_type' => 'select',
                    'eggnews_widgets_field_options' => $eggnews_category_dropdown
                ),
                'eggnews_carousel_count' => array(
                    'eggnews_widgets_name' => 'eggnews_carousel_count',
                    'eggnews_widgets_title' => esc_html__('No. of slides', 'eggnews-pro'),
                    'eggnews_widgets_default' => 5,
                    'eggnews_widgets_field_type' => 'number'
                ),
                'eggnews_carousel_time_ms' => array(
                    'eggnews_widgets_name' => 'eggnews_carousel_time_ms',
                    'eggnews_widgets_title' => esc_html__('Slide time in ms', 'eggnews-pro'),
                    'eggnews_widgets_default' => 500,
                    'eggnews_widgets_field_type' => 'number'
                ),
                'eggnews_carousel_autoplay_speed' => array(
	                'eggnews_widgets_name'       => 'eggnews_carousel_autoplay_speed',
	                'eggnews_widgets_title'      => esc_html__( 'Carousel Autoplay Speed ( in microsecond )', 'eggnews-pro' ),
	                'eggnews_widgets_default'    => 2200,
	                'eggnews_widgets_field_type' => 'number'
                ),
                'eggnews_carousel_category_random' => array(
                    'eggnews_widgets_name' => 'eggnews_carousel_category_random',
                    'eggnews_widgets_title' => esc_html__('Show Random', 'eggnews-pro'),
                    'eggnews_widgets_default' => 1,
                    'eggnews_widgets_field_type' => 'checkbox',
                ),
                'eggnews_carousel_category_show' => array(
                    'eggnews_widgets_name' => 'eggnews_carousel_category_show',
                    'eggnews_widgets_title' => esc_html__('Show post category', 'eggnews-pro'),
                    'eggnews_widgets_default' => 1,
                    'eggnews_widgets_field_type' => 'checkbox',
                ),
            );

            return $fields;
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance) {
            extract($args);
            if (empty($instance)) {
                return;
            }

            $eggnews_carousel_title = isset($instance['eggnews_carousel_title']) ? $instance['eggnews_carousel_title'] : '';
            $eggnews_carousel_category_id = intval(empty($instance['eggnews_carousel_category']) ? null : $instance['eggnews_carousel_category']);
            $eggnews_carousel_count = intval(empty($instance['eggnews_carousel_count']) ? 5 : $instance['eggnews_carousel_count']);
            $eggnews_carousel_time_ms = intval(empty($instance['eggnews_carousel_time_ms']) ? 500 : $instance['eggnews_carousel_time_ms']);
	        $eggnews_carousel_autoplay_speed  = intval( empty( $instance['eggnews_carousel_autoplay_speed'] ) ? 2200 : $instance['eggnews_carousel_autoplay_speed'] );
	        $eggnews_featured_category_id = intval(empty($instance['eggnews_featured_category']) ? null : $instance['eggnews_featured_category']);
            $eggnews_carousel_category_random = intval(empty($instance['eggnews_carousel_category_random']) ? null : $instance['eggnews_carousel_category_random']);
            $eggnews_carousel_category_show = intval(empty($instance['eggnews_carousel_category_show']) ? null : $instance['eggnews_carousel_category_show']);

            echo $before_widget;

            $slider_args = eggnews_query_args($eggnews_carousel_category_id, $eggnews_carousel_count);

            if (1 === $eggnews_carousel_category_random) {
                $slider_args['orderby'] = 'rand';
            }
            $carousel_query = new WP_Query($slider_args);
            if ($carousel_query->have_posts()) {

                wp_enqueue_style('owl-carousel2-style');
                wp_enqueue_style('owl-carousel2-theme');
                wp_enqueue_script('owl-carousel2-script');
                ?>
                <?php if ($eggnews_carousel_title): ?>
                    <div class="block-header">
                        <h3 class="widget-title"><?php echo esc_html($eggnews_carousel_title); ?></h3>
                    <?php if ($eggnews_carousel_category_id) { ?>
                            <a href="<?php echo get_category_link($eggnews_carousel_category_id); ?>" class="widget-read"><?php _e('View All', 'eggnews-pro'); ?></a>
                    <?php } ?>
                    </div>
                <?php endif; ?>
                <div class="owl-carousel owl-theme eggnews-carousel"  data-timer="<?php echo esc_attr( $eggnews_carousel_autoplay_speed ); ?>" data-duration="<?php echo $eggnews_carousel_time_ms; ?>">

                    <?php
                    while ($carousel_query->have_posts()) {
                        $carousel_query->the_post();
                        ?>
                        <div class="item">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <figure
                                    class="carousel-image-wrap"><?php the_post_thumbnail('eggnews-carousel-image'); ?></figure>
                            </a>
                            <div class="carousel-content-wrapper">
                        <?php
                        if ($eggnews_carousel_category_show === 1) {
                            do_action('eggnews_post_categories');
                        }
                        ?>
                                <h3 class="carousel-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                            </div>
                        </div>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>


                </div>
                <?php } ?>
            <div style="clear:both"></div>


            <?php
            echo $after_widget;
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see     WP_Widget::update()
         *
         * @param    array $new_instance Values just sent to be saved.
         * @param    array $old_instance Previously saved values from database.
         *
         * @uses    eggnews_widgets_updated_field_value()        defined in eggnews-widget-fields.php
         *
         * @return    array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;

            $widget_fields = $this->widget_fields();

            // Loop through fields
            foreach ($widget_fields as $widget_field) {

                extract($widget_field);

                // Use helper function to get updated field values
                $new_widget_value = isset($new_instance[$eggnews_widgets_name]) ? $new_instance[$eggnews_widgets_name] : '';
                $instance[$eggnews_widgets_name] = eggnews_widgets_updated_field_value($widget_field, $new_widget_value);

            }

            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see     WP_Widget::form()
         *
         * @param    array $instance Previously saved values from database.
         *
         * @uses    eggnews_widgets_show_widget_field()        defined in eggnews-widget-fields.php
         */
        public function form($instance) {
            $widget_fields = $this->widget_fields();

            // Loop through fields
            foreach ($widget_fields as $widget_field) {

                // Make array elements available as variables
                extract($widget_field);
                $eggnews_widgets_field_value = !empty($instance[$eggnews_widgets_name]) ? wp_kses_post($instance[$eggnews_widgets_name]) : '';
                eggnews_widgets_show_widget_field($this, $widget_field, $eggnews_widgets_field_value);
            }
        }

    }
endif;
