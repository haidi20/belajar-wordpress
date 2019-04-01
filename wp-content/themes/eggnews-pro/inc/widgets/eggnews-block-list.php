<?php
/**
 * Eggnews: Block Posts (List)
 *
 * Widget shows the posts in list view
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
add_action('widgets_init', 'eggnews_register_block_list_widget');

function eggnews_register_block_list_widget() {
    register_widget('Eggnews_Block_List');
}

if (!class_exists('Eggnews_Block_List')):

    class Eggnews_Block_List extends WP_widget {

        /**
         * Register widget with WordPress.
         */
        public function __construct() {
            $widget_ops = array(
                'classname' => 'eggnews_block_list',
                'description' => __('Display posts in block list layout', 'eggnews-pro')
            );
            parent::__construct('eggnews_block_list', __('Block Posts List', 'eggnews-pro'), $widget_ops);
        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        private function widget_fields() {
            $eggnews_category_dropdown = eggnews_category_dropdown();

            $fields = array(
                'eggnews_block_title' => array(
                    'eggnews_widgets_name' => 'eggnews_block_title',
                    'eggnews_widgets_title' => esc_html__('Block Title', 'eggnews-pro'),
                    'eggnews_widgets_field_type' => 'text'
                ),
                'eggnews_block_cat_id' => array(
                    'eggnews_widgets_name' => 'eggnews_block_cat_id',
                    'eggnews_widgets_title' => esc_html__('Category for Block Layout', 'eggnews-pro'),
                    'eggnews_widgets_default' => 0,
                    'eggnews_widgets_field_type' => 'select',
                    'eggnews_widgets_field_options' => $eggnews_category_dropdown
                ),
                'eggnews_block_posts_count' => array(
                    'eggnews_widgets_name' => 'eggnews_block_posts_count',
                    'eggnews_widgets_title' => esc_html__('No. of Posts', 'eggnews-pro'),
                    'eggnews_widgets_default' => 5,
                    'eggnews_widgets_field_type' => 'number'
                ),
                'eggnews_block_hide_post_date' => array(
                    'eggnews_widgets_name' => 'eggnews_block_hide_post_date',
                    'eggnews_widgets_title' => esc_html__('Hide date?', 'eggnews-pro'),
                    'eggnews_widgets_default' => 0,
                    'eggnews_widgets_field_type' => 'checkbox'
                ),
                'eggnews_block_hide_author' => array(
                    'eggnews_widgets_name' => 'eggnews_block_hide_author',
                    'eggnews_widgets_title' => esc_html__('Hide author?', 'eggnews-pro'),
                    'eggnews_widgets_default' => 0,
                    'eggnews_widgets_field_type' => 'checkbox'
                ),
                'eggnews_block_show_category' => array(
                    'eggnews_widgets_name' => 'eggnews_block_show_category',
                    'eggnews_widgets_title' => esc_html__('Show category?', 'eggnews-pro'),
                    'eggnews_widgets_default' => 0,
                    'eggnews_widgets_field_type' => 'checkbox'
                ),
                'eggnews_block_show_description' => array(
                    'eggnews_widgets_name' => 'eggnews_block_show_description',
                    'eggnews_widgets_title' =>esc_html__('Show description?', 'eggnews-pro'),
                    'eggnews_widgets_default' => 1,
                    'eggnews_widgets_field_type' => 'checkbox'
                ),
                'eggnews_excerpt_length' => array(
                    'eggnews_widgets_name' => 'eggnews_excerpt_length',
                    'eggnews_widgets_title' => esc_html__('description length in words.', 'eggnews-pro'),
                    'eggnews_widgets_default' => 10,
                    'eggnews_widgets_field_type' => 'number'
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
            $eggnews_block_cat_id = empty($instance['eggnews_block_cat_id']) ? '' : intval($instance['eggnews_block_cat_id']);
            $eggnews_block_posts_count = empty($instance['eggnews_block_posts_count']) ? 4 : intval($instance['eggnews_block_posts_count']);
            $eggnews_block_show_category = empty($instance['eggnews_block_show_category']) ? 0 : intval($instance['eggnews_block_show_category']);
            $eggnews_block_hide_post_date = intval( empty( $instance['eggnews_block_hide_post_date'] ) ? null : $instance['eggnews_block_hide_post_date'] );
            $eggnews_block_hide_author    = intval( empty( $instance['eggnews_block_hide_author'] ) ? null : $instance['eggnews_block_hide_author'] );
            $eggnews_block_show_description = isset($instance['eggnews_block_show_description']) ? intval($instance['eggnews_block_show_description']) : 1;
            $eggnews_excerpt_length = isset($instance['eggnews_excerpt_length']) ? intval($instance['eggnews_excerpt_length']) : 10;
            echo $before_widget;
            ?>
            <div class="block-list-wrapper">

                <?php eggnews_block_title($eggnews_block_title, $eggnews_block_cat_id); ?>

                <div class="posts-list-wrapper clearfix column-posts-block">
                    <?php
                    $block_list_args = eggnews_query_args($eggnews_block_cat_id, $eggnews_block_posts_count);
                    $block_list_query = new WP_Query($block_list_args);
                    if ($block_list_query->have_posts()) {
                        while ($block_list_query->have_posts()) {
                            $block_list_query->the_post();
                            ?>
                            <div class="single-post-wrapper clearfix">
                                <div class="post-thumb-wrapper">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <figure><?php the_post_thumbnail('eggnews-block-medium'); ?></figure>
                                    </a>
                                </div>
                                <div class="post-content-wrapper">
                                    <?php if ($eggnews_block_show_category) { ?>
                                        <?php do_action('eggnews_post_categories'); ?>
                                    <?php } ?>
                                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-meta-wrapper">
                                        <?php eggnews_posted_on($eggnews_block_hide_post_date, $eggnews_block_hide_author); ?>
                                    </div><!-- .post-meta-wrapper -->
                                    <?php if ($eggnews_block_show_description): ?>
                                        <div class="post-content">
                                            <?php eggnews_excerpt($eggnews_excerpt_length); ?>
                                        </div><!-- .post-content -->
                                    <?php endif; ?>
                                </div><!-- .post-content-wrapper -->
                            </div><!-- .single-post-wrapper -->
                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div><!-- .posts-list-wrapper-->
            </div><!-- .block-list-wrapper -->
            <?php
            echo $after_widget;
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param   array   $new_instance   Values just sent to be saved.
         * @param   array   $old_instance   Previously saved values from database.
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
                if ( isset( $new_instance[ $eggnews_widgets_name ] ) ) {
                    $instance[ $eggnews_widgets_name ] = eggnews_widgets_updated_field_value( $widget_field, $new_instance[ $eggnews_widgets_name ] );
                } else {
                    $instance[ $eggnews_widgets_name ] = eggnews_widgets_updated_field_value( $widget_field, null );
                }
            }

            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
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