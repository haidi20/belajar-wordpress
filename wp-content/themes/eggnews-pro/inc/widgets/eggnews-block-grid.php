<?php
/**
 * Eggnews: Block Posts (Grid)
 *
 * Widget show block posts in grid layout
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
add_action('widgets_init', 'eggnews_register_block_grid_widget');

function eggnews_register_block_grid_widget() {
    register_widget('Eggnews_Block_Grid');
}

if (!class_exists('Eggnews_Block_Grid')):

    class Eggnews_Block_Grid extends WP_Widget {

        /**
         * Register widget with WordPress.
         */
        public function __construct() {
            $widget_ops = array(
                'classname' => 'eggnews_block_grid',
                'description' => __('Display block posts in grid layout.', 'eggnews-pro')
            );
            parent::__construct('eggnews_block_grid', __('Grid Block Posts', 'eggnews-pro'), $widget_ops);
        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        private function widget_fields() {

            global $eggnews_grid_columns;
            $eggnews_category_dropdown = eggnews_category_dropdown();

            $fields = array(
                'eggnews_block_title' => array(
                    'eggnews_widgets_name' => 'eggnews_block_title',
                    'eggnews_widgets_title' => __('Block Title', 'eggnews-pro'),
                    'eggnews_widgets_field_type' => 'text'
                ),
                'eggnews_block_cat_id' => array(
                    'eggnews_widgets_name' => 'eggnews_block_cat_id',
                    'eggnews_widgets_title' => __('Category for Block Post', 'eggnews-pro'),
                    'eggnews_widgets_default' => 0,
                    'eggnews_widgets_field_type' => 'select',
                    'eggnews_widgets_field_options' => $eggnews_category_dropdown
                ),
                'eggnews_block_grid_column' => array(
                    'eggnews_widgets_name' => 'eggnews_block_grid_column',
                    'eggnews_widgets_title' => __('No. of columns', 'eggnews-pro'),
                    'eggnews_widgets_default' => 2,
                    'eggnews_widgets_field_type' => 'select',
                    'eggnews_widgets_field_options' => $eggnews_grid_columns
                ),
                'eggnews_block_posts_count' => array(
                    'eggnews_widgets_name' => 'eggnews_block_posts_count',
                    'eggnews_widgets_title' => __('No. of posts', 'eggnews-pro'),
                    'eggnews_widgets_default' => 4,
                    'eggnews_widgets_field_type' => 'number'
                ),
                'eggnews_block_hide_category' => array(
                    'eggnews_widgets_name' => 'eggnews_block_hide_category',
                    'eggnews_widgets_title' => __('Hide category?', 'eggnews-pro'),
                    'eggnews_widgets_default' => 0,
                    'eggnews_widgets_field_type' => 'checkbox'
                ),
                'eggnews_hide_author'                       => array(
                    'eggnews_widgets_name'       => 'eggnews_hide_author',
                    'eggnews_widgets_title'      => esc_html__( 'Hide author?', 'eggnews-pro' ),
                    'eggnews_widgets_default'    => 0,
                    'eggnews_widgets_field_type' => 'checkbox',
                ),
                'eggnews_hide_post_date'                    => array(
                    'eggnews_widgets_name'       => 'eggnews_hide_post_date',
                    'eggnews_widgets_title'      => esc_html__( 'Hide post date?', 'eggnews-pro' ),
                    'eggnews_widgets_default'    => 0,
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

            $eggnews_block_title = empty($instance['eggnews_block_title']) ? '' : $instance['eggnews_block_title'];
            $eggnews_block_cat_id = intval(empty($instance['eggnews_block_cat_id']) ? 0 : $instance['eggnews_block_cat_id']);
            $eggnews_block_grid_column = intval(empty($instance['eggnews_block_grid_column']) ? 2 : $instance['eggnews_block_grid_column']);
            $eggnews_block_posts_count = intval(empty($instance['eggnews_block_posts_count']) ? 4 : $instance['eggnews_block_posts_count']);
            $eggnews_block_hide_category = empty($instance['eggnews_block_hide_category']) ? 0 : absint($instance['eggnews_block_hide_category']);
            $eggnews_hide_author    = intval( empty( $instance['eggnews_hide_author'] ) ? null : $instance['eggnews_hide_author'] );
            $eggnews_hide_post_date = intval( empty( $instance['eggnews_hide_post_date'] ) ? null : $instance['eggnews_hide_post_date'] );
            echo $before_widget;
            ?>
            <div class="block-grid-wrapper clearfix column-<?php echo esc_attr($eggnews_block_grid_column); ?>-layout">

                <?php if ($eggnews_block_title) { ?>
                    <?php eggnews_block_title($eggnews_block_title, $eggnews_block_cat_id); ?>
                <?php } ?>

                <div class="block-posts-wrapper">
                    <?php
                    $block_grid_args = eggnews_query_args($eggnews_block_cat_id, $eggnews_block_posts_count);
                    $block_grid_query = new WP_Query($block_grid_args);
                    if ($block_grid_query->have_posts()) {
                        while ($block_grid_query->have_posts()) {
                            $block_grid_query->the_post();
                            ?>
                            <div class="single-post-wrapper">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <figure><?php the_post_thumbnail('eggnews-block-medium'); ?></figure>
                                </a>
                                <div class="post-content-wrapper">

                                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="post-meta-wrapper">
                                        <?php eggnews_posted_on($eggnews_hide_post_date, $eggnews_hide_author); ?>
                                    </div>
                                    <?php if (!$eggnews_block_hide_category) { ?>
                                        <?php do_action('eggnews_post_categories'); ?>
                                    <?php } ?>
                                </div><!-- .post-meta-wrapper -->
                            </div><!-- .single-post-wrapper -->
                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div><!-- .block-posts-wrapper -->
            </div><!-- .block-grid-wrapper -->

            <?php
            echo $after_widget;
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see     WP_Widget::update()
         *
         * @param   array $new_instance Values just sent to be saved.
         * @param   array $old_instance Previously saved values from database.
         *
         * @uses    eggnews_widgets_updated_field_value()     defined in eggnews-widget-fields.php
         *
         * @return  array Updated safe values to be saved.
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
         * @param   array $instance Previously saved values from database.
         *
         * @uses    eggnews_widgets_show_widget_field()       defined in eggnews-widget-fields.php
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