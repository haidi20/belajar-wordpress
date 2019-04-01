<?php
/**
 * Eggnews: Random News
 *
 * Widget show random news
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
add_action('widgets_init', 'eggnews_register_random_news');

function eggnews_register_random_news() {
    register_widget('Eggnews_Random_News');
}

if (!class_exists('Eggnews_Random_News')):

    class Eggnews_Random_News extends WP_widget {

        /**
         * Register widget with WordPress.
         */
        public function __construct() {
            $widget_ops = array(
                'classname' => 'eggnews_random_news',
                'description' => __('Displays the random news.', 'eggnews-pro')
            );
            parent::__construct('eggnews_random_news', __('Random News', 'eggnews-pro'), $widget_ops);
        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        private function widget_fields() {

            $fields = array(
                'banner_title' => array(
                    'eggnews_widgets_name' => 'random_news_title',
                    'eggnews_widgets_title' => __('Title.', 'eggnews-pro'),
                    'eggnews_widgets_field_type' => 'text',
                    'eggnews_widgets_default' => '',
                ),
                'banner_rel' => array(
                    'eggnews_widgets_name' => 'number_post_to_display',
                    'eggnews_widgets_title' => __('Number of post to display.', 'eggnews-pro'),
                    'eggnews_widgets_field_type' => 'number',
                    'eggnews_widgets_default' => 5,
                ),
                'excerpt_word_length' => array(
                    'eggnews_widgets_name' => 'excerpt_word_length',
                    'eggnews_widgets_title' => __('Excerpt length.', 'eggnews-pro'),
                    'eggnews_widgets_field_type' => 'number',
                    'eggnews_widgets_default' => 20,
                ),
                'show_description' => array(
                    'eggnews_widgets_name' => 'show_post_description',
                    'eggnews_widgets_title' => __('Show post description?', 'eggnews-pro'),
                    'eggnews_widgets_field_type' => 'checkbox',
                    'eggnews_widgets_default' => 1,
                )
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
            if (is_active_widget(false, false, $this->id_base) || is_customize_preview()) {
                wp_enqueue_script('eggnews-easy-tabs');
            }
            $number_post_to_display = empty($instance['number_post_to_display']) ? 5 : $instance['number_post_to_display'];
            $random_news_title = empty($instance['random_news_title']) ? '' : $instance['random_news_title'];
            $show_post_description = empty($instance['show_post_description']) ? 0 : absint($instance['show_post_description']);
            $excerpt_word_length = empty($instance['excerpt_word_length']) ? 0 : absint($instance['excerpt_word_length']);

            echo $before_widget;
            ?>
            <div class="random-posts-widget">
                <?php
                global $post;
                $get_featured_posts = new WP_Query(array(
                    'posts_per_page' => $number_post_to_display,
                    'post_type' => 'post',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'rand',
                    'no_found_rows' => true,
                ));
                ?>
                <?php $featured = 'eggnews-pro-featured-post-small'; ?>
                <?php
                if (!empty($random_news_title)) {
                    echo $before_title . esc_html($random_news_title) . $after_title;
                }
                ?>
                <div class="random_posts_widget_inner_wrap">
                    <?php
                    $i = 1;
                    while ($get_featured_posts->have_posts()):$get_featured_posts->the_post();
                        ?>
                        <div class="single-article clearfix">
                            <?php
                            if (has_post_thumbnail()) {
                                $image = '';
                                $title_attribute = get_the_title($post->ID);
                                $image .= '<figure class="random-images">';
                                $image .= '<a href="' . get_permalink() . '" title="' . the_title('', '', false) . '">';
                                $image .= get_the_post_thumbnail($post->ID, $featured, array(
                                            'title' => esc_attr($title_attribute),
                                            'alt' => esc_attr($title_attribute)
                                        )) . '</a>';
                                $image .= '</figure>';
                                echo $image;
                            }
                            ?>
                            <div class="article-content">
                                <h3 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"
                                       title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="below-entry-meta">
                                    <?php
                                    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                                    $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date())
                                    );
                                    printf(__('<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'eggnews-pro'), esc_url(get_permalink()), esc_attr(get_the_time()), $time_string
                                    );
                                    ?>
                                    <span class="byline"><span class="author vcard"><a
                                                class="url fn n"
                                                href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                                title="<?php echo get_the_author(); ?>"><?php echo esc_html(get_the_author()); ?></a></span></span>
                                    <span class="comments"><i
                                            class="fa fa-comment"></i> <?php comments_popup_link(__('No Comments', 'eggnews-pro'), __('1 Comment', 'eggnews-pro'), __('% Comments', 'eggnews-pro')); ?></span>
                                </div>
                                <?php if ($show_post_description) { ?>
                                    <div class="post-excerpt">
                                        <?php  eggnews_excerpt($excerpt_word_length); ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        <?php
                        $i ++;
                    endwhile;
                    // Reset Post Data
                    wp_reset_query();
                    ?>
                </div>
            </div>
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
