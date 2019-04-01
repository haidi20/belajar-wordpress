<?php
/**
 * Eggnews: Posts List
 *
 * Widget show latest or random posts in list view
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
add_action('widgets_init', 'eggnews_register_posts_list_widget');

function eggnews_register_posts_list_widget() {
    register_widget('Eggnews_Posts_List');
}

if (!class_exists('Eggnews_Posts_List')):

    class Eggnews_Posts_List extends WP_widget {

        /**
         * Register widget with WordPress.
         */
        public function __construct() {
            $widget_ops = array(
                'classname' => 'eggnews_posts_list',
                'description' => esc_html__('Display latest or random posts in list view.', 'eggnews-pro')
            );
            parent::__construct('eggnews_posts_list', esc_html__('Posts Lists', 'eggnews-pro'), $widget_ops);
        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        private function widget_fields() {

            $eggnews_post_list_option = array(
                'latest' => esc_html__('Latest Posts', 'eggnews-pro'),
                'random' => esc_html__('Random Posts', 'eggnews-pro'),
                //'mostly viewed' => esc_html__('Mostely viewed Posts', 'eggnews-pro'),
            );

            $fields = array(
                'eggnews_block_title' => array(
                    'eggnews_widgets_name' => 'eggnews_block_title',
                    'eggnews_widgets_title' => esc_html__('Widget title', 'eggnews-pro'),
                    'eggnews_widgets_field_type' => 'text'
                ),
                'eggnews_block_posts_count' => array(
                    'eggnews_widgets_name' => 'eggnews_block_posts_count',
                    'eggnews_widgets_title' => esc_html__('No. of Posts', 'eggnews-pro'),
                    'eggnews_widgets_default' => 4,
                    'eggnews_widgets_field_type' => 'number'
                ),
                'eggnews_block_posts_type' => array(
                    'eggnews_widgets_name' => 'eggnews_block_posts_type',
                    'eggnews_widgets_title' => esc_html__('Posts Type', 'eggnews-pro'),
                    'eggnews_widgets_default' => 'latest',
                    'eggnews_widgets_field_options' => $eggnews_post_list_option,
                    'eggnews_widgets_field_type' => 'radio'
                ),
                'eggnews_show_excerpt' => array(
                    'eggnews_widgets_name' => 'eggnews_show_excerpt',
                    'eggnews_widgets_title' => esc_html__('Show Desctiption?', 'eggnews-pro'),
                    'eggnews_widgets_default' => 1,
                    'eggnews_widgets_field_type' => 'checkbox',
                ),
                'eggnews_excerpt_length' => array(
                    'eggnews_widgets_name' => 'eggnews_excerpt_length',
                    'eggnews_widgets_title' => esc_html__('Desctiption length in words.', 'eggnews-pro'),
                    'eggnews_widgets_default' => 10,
                    'eggnews_widgets_field_type' => 'number',
                ),
                'eggnews_show_loadmore' => array(
                    'eggnews_widgets_name' => 'eggnews_show_loadmore',
                    'eggnews_widgets_title'=>  esc_html__('Show Loadmore?', 'eggnews-pro'),
                    'eggnews_widgets_default' => 0,
                    'eggnews_widgets_field_type' => 'checkbox',
                ),
                'eggnews_hide_author'                       => array(
                    'eggnews_widgets_name'       => 'eggnews_hide_author',
                    'eggnews_widgets_title'      => esc_html__( 'Hide Author?', 'eggnews-pro' ),
                    'eggnews_widgets_default'    => 0,
                    'eggnews_widgets_field_type' => 'checkbox',
                ),
                'eggnews_hide_post_date'                    => array(
                    'eggnews_widgets_name'       => 'eggnews_hide_post_date',
                    'eggnews_widgets_title'      => esc_html__( 'Hide Post Date?', 'eggnews-pro' ),
                    'eggnews_widgets_default'    => 0,
                    'eggnews_widgets_field_type' => 'checkbox',
                ),
                'eggnews_loadmore_text' => array(
                    'eggnews_widgets_name' => 'eggnews_loadmore_text',
                    'eggnews_widgets_title' => esc_html__('Load More Text', 'eggnews-pro'),
                    'eggnews_widgets_default' => esc_html__('Load more', 'eggnews-pro') ,
                    'eggnews_widgets_field_type' => 'text'
                ),
                'eggnews_loading_text' => array(
                    'eggnews_widgets_name' => 'eggnews_loading_text',
                    'eggnews_widgets_title' => esc_html__('Loading Text', 'eggnews-pro'),
                    'eggnews_widgets_default' => esc_html__('Loading...', 'eggnews-pro') ,
                    'eggnews_widgets_field_type' => 'text'
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
            $eggnews_block_posts_count = intval(empty($instance['eggnews_block_posts_count']) ? 4 : $instance['eggnews_block_posts_count']);
            $eggnews_block_posts_type = empty($instance['eggnews_block_posts_type']) ? '' : $instance['eggnews_block_posts_type'];
            $eggnews_show_excerpt = isset($instance['eggnews_show_excerpt']) ? absint($instance['eggnews_show_excerpt']) : '';
            $eggnews_excerpt_length = isset($instance['eggnews_excerpt_length']) ? absint($instance['eggnews_excerpt_length']) : 10;
            $eggnews_show_loadmore = isset($instance['eggnews_show_loadmore']) ? absint($instance['eggnews_show_loadmore']) : 0;
            $eggnews_hide_author    = intval( empty( $instance['eggnews_hide_author'] ) ? null : $instance['eggnews_hide_author'] );
            $eggnews_hide_post_date = intval( empty( $instance['eggnews_hide_post_date'] ) ? null : $instance['eggnews_hide_post_date'] );
            $eggnews_loadmore_text = isset($instance['eggnews_loadmore_text']) ? esc_html($instance['eggnews_loadmore_text']) : '';
            $eggnews_loading_text = isset($instance['eggnews_loading_text']) ? esc_attr($instance['eggnews_loading_text']) : '';

            echo $before_widget;
            ?>

            <div class="widget-block-wrapper">
                <?php if ($eggnews_block_title): ?>
                    <div class="block-header">
                        <h3 class="block-title"><?php echo esc_html($eggnews_block_title); ?></h3>
                    </div><!-- .block-header -->
                <?php endif; ?>

                <div class="posts-list-wrapper list-posts-block">
                   <?php
                    $popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_get_post_views', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
                   
                            while ( $popularpost->have_posts() ) : $popularpost->the_post();
                             print_r($popularpost);

                             the_title();
                            endwhile;
                    $posts_list_args = eggnews_query_args($cat_id = null, $eggnews_block_posts_count);
                    if ($eggnews_block_posts_type == 'random') {
                        $posts_list_args['orderby'] = 'rand';
                    }
                    $posts_list_query = new WP_Query($posts_list_args);
                    if ($posts_list_query->have_posts()) {
                        while ($posts_list_query->have_posts()) {
                            $posts_list_query->the_post();
                            ?>
                            <?php 
                            $posts_list_args = eggnews_query_args($cat_id = null, $eggnews_block_posts_count);
                            
                            ?>

                            <div class="single-post-wrapper clearfix" data-id="<?php echo get_the_ID(); ?>">
                                <div class="post-thumb-wrapper">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <figure><?php the_post_thumbnail('eggnews-block-thumb'); ?></figure>
                                    </a>
                                </div>
                                <div class="post-content-wrapper">
                                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-meta-wrapper">
                                        <?php eggnews_posted_on($eggnews_hide_post_date, $eggnews_hide_author); ?>
                                    </div><!-- .post-meta-wrapper -->
                                    <?php if ($eggnews_show_excerpt): ?>
                                        <div class="post-excerpt">
                                            <?php 
                                            //echo get_the_excerpt();
                                            eggnews_excerpt($eggnews_excerpt_length); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .single-post-wrapper -->
                            <?php
                        }
                    }
                    ?>
                    <?php       
                        /**                 
                        * Load more Feature                 
                        * @package Theme Egg                 
                        * @subpackage eggnews-pro                 
                        * @since 1.2.0
                        */ 
                        ?> 
                    </div><!-- .posts-list-wrapper -->        
                    <?php 
                    //checks wherther the variable is set or not
                    if(isset($instance['eggnews_show_loadmore']) && $instance['eggnews_show_loadmore']){
                        ?>
                        <div class="loadmore-wrapper">
                            <span class="post_listing_loadmore" data-loading="<?php echo esc_attr($eggnews_loading_text); ?>" data-page="2" data-per-page="<?php echo esc_attr($eggnews_block_posts_count); ?>" data-post_type="<?php echo esc_attr($eggnews_block_posts_type); ?>" data-hide_post_date="<?php echo esc_attr($eggnews_hide_post_date); ?>"  data-hide_author="<?php echo esc_attr($eggnews_hide_author); ?>" data-excerpt = "<?php echo esc_attr($eggnews_show_excerpt); ?>" data-excerpt-length="<?php echo esc_attr($eggnews_excerpt_length); ?>" data-classs = "eggnews_posts_list"><?php echo esc_html($eggnews_loadmore_text); ?></span>
                        </div>
                        <?php
                    } 
                    ?>
                </div>
                <!-- .widget-block-wrapper -->
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
                
                $new_widget_value = isset($new_instance[$eggnews_widgets_name]) ? $new_instance[$eggnews_widgets_name] : '';
                $instance[$eggnews_widgets_name] = eggnews_widgets_updated_field_value($widget_field, $new_widget_value);
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
         * @uses    eggnews_widgets_show_widget_field()       defined in widget-fields.php
         */
        public function form($instance) {
            $widget_fields = $this->widget_fields();

            // Loop through fields
            foreach ($widget_fields as $widget_field) {

                // Make array elements available as variables
                extract($widget_field);
                $eggnews_widgets_default = isset($eggnews_widgets_default) ? $eggnews_widgets_default : '';
                $eggnews_widgets_field_value =isset($instance[$eggnews_widgets_name]) ? wp_kses_post($instance[$eggnews_widgets_name]) : $eggnews_widgets_default;
                eggnews_widgets_show_widget_field($this, $widget_field, $eggnews_widgets_field_value);
            }
        }
    }
endif;


