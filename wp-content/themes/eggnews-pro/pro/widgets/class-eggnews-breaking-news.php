<?php
/**
 * Breaking news Widget
 */
if ( ! class_exists( 'Eggnews_Breaking_News' ) ) {

	class Eggnews_Breaking_News extends WP_Widget {

		function __construct() {
			$widget_ops  = array(
				'classname'   => 'eggnews_breaking_news widget_featured_posts',
				'description' => __( 'Displays the breaking news in the news ticker way. Suitable for the left and right sidebar', 'eggnews-pro' )
			);
			$control_ops = array( 'width' => 200, 'height' => 250 );
			parent::__construct( false, $name = __( 'Breaking News', 'eggnews-pro' ), $widget_ops );
		}

		/**
		 * Helper function that holds widget fields
		 * Array is used in update and form functions
		 */
		private function widget_fields() {

			$eggnews_category_dropdown = eggnews_category_dropdown();

			$fields = array(
				'title'                           => array(
					'eggnews_widgets_name'       => 'title',
					'eggnews_widgets_title'      => esc_html__( 'Title', 'eggnews-pro' ),
					'eggnews_widgets_field_type' => 'text'
				),
				'eggnews_noof_post_show'          => array(
					'eggnews_widgets_name'       => 'eggnews_noof_post_show',
					'eggnews_widgets_title'      => esc_html__( 'No of posts to show.', 'eggnews-pro' ),
					'eggnews_widgets_default'    => 4,
					'eggnews_widgets_field_type' => 'number',
				),
				'eggnews_show_post_from'          => array(
					'eggnews_widgets_name'          => 'eggnews_show_post_from',
					'eggnews_widgets_title'         => esc_html__( 'No. of Posts', 'eggnews-pro' ),
					'eggnews_widgets_default'       => 'latest',
					'eggnews_widgets_field_type'    => 'radio',
					'eggnews_widgets_field_options' => array(
						'latest'   => esc_html__( 'Show latest posts.', 'eggnews-pro' ),
						'category' => esc_html__( 'Show from category', 'eggnews-pro' ),
					),
				),
				'eggnews_select_category'         => array(
					'eggnews_widgets_name'          => 'eggnews_select_category',
					'eggnews_widgets_title'         => esc_html__( 'Select Category', 'eggnews-pro' ),
					'eggnews_widgets_default'       => 0,
					'eggnews_widgets_field_type'    => 'select',
					'eggnews_widgets_field_options' => $eggnews_category_dropdown,
				),
				'eggnews_show_random_posts'       => array(
					'eggnews_widgets_name'       => 'eggnews_show_random_posts',
					'eggnews_widgets_title'      => esc_html__( 'Show Random?', 'eggnews-pro' ),
					'eggnews_widgets_default'    => 1,
					'eggnews_widgets_field_type' => 'checkbox'
				),
				'eggnews_hide_author'                       => array(
					'eggnews_widgets_name'       => 'eggnews_hide_author',
					'eggnews_widgets_title'      => esc_html__( 'Hide Author?', 'eggnews-pro' ),
					'eggnews_widgets_default'    => 0,
					'eggnews_widgets_field_type' => 'checkbox',
				),
				'eggnews_hide_comment'                      => array(
					'eggnews_widgets_name'       => 'eggnews_hide_comment',
					'eggnews_widgets_title'      => esc_html__( 'Hide Comment?', 'eggnews-pro' ),
					'eggnews_widgets_default'    => 0,
					'eggnews_widgets_field_type' => 'checkbox',
				),
				'eggnews_hide_post_date'                    => array(
					'eggnews_widgets_name'       => 'eggnews_hide_post_date',
					'eggnews_widgets_title'      => esc_html__( 'Hide Post Date?', 'eggnews-pro' ),
					'eggnews_widgets_default'    => 0,
					'eggnews_widgets_field_type' => 'checkbox',
				),
				/* //Slide Option
				 'eggnews_breaking_slide_direction' => array(
					 'eggnews_widgets_name' => 'eggnews_breaking_slide_direction',
					 'eggnews_widgets_title' => esc_html__('Show slider as', 'eggnews-pro'),
					 'eggnews_widgets_default' => 'vertical',
					 'eggnews_widgets_field_type' => 'select',
					 'eggnews_widgets_field_options' => array(
						 'vertical' => esc_html__('Vertical', 'eggnews-pro'),
						 //'horizantal' => esc_html__('Horizantal', 'eggnews-pro'),
						 'fade' => esc_html__('Fade', 'eggnews-pro'),
					 ),
				 ),*/
				'eggnews_breaking_slide_duration' => array(
					'eggnews_widgets_name'       => 'eggnews_breaking_slide_duration',
					'eggnews_widgets_title'      => esc_html__( 'Slider duration(in ms)', 'eggnews-pro' ),
					'eggnews_widgets_default'    => '400',
					'eggnews_widgets_field_type' => 'number',
				),
			);

			return $fields;
		}

		function form( $instance ) {

			$widget_fields = $this->widget_fields();

			// Loop through fields
			foreach ( $widget_fields as $widget_field ) {

				// Make array elements available as variables
				extract( $widget_field );
				$eggnews_widgets_field_value = ! empty( $instance[ $eggnews_widgets_name ] ) ? wp_kses_post( $instance[ $eggnews_widgets_name ] ) : '';
				eggnews_widgets_show_widget_field( $this, $widget_field, $eggnews_widgets_field_value );

			}

		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$widget_fields = $this->widget_fields();

			// Loop through fields
			foreach ( $widget_fields as $widget_field ) {

				extract( $widget_field );

				// Use helper function to get updated field values
				if ( isset( $new_instance[ $eggnews_widgets_name ] ) ) {
                    $instance[ $eggnews_widgets_name ] = eggnews_widgets_updated_field_value( $widget_field, $new_instance[ $eggnews_widgets_name ] );
                } else {
                    $instance[ $eggnews_widgets_name ] = eggnews_widgets_updated_field_value( $widget_field, null );
                }
            }

            return $instance;
        }

		function widget( $args, $instance ) {

			extract( $args );
			if ( empty( $instance ) ) {
				return;
			}
			$title                            = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$eggnews_noof_post_show           = empty( $instance['eggnews_noof_post_show'] ) ? 3 : intval( $instance['eggnews_noof_post_show'] );
			$eggnews_show_post_from           = empty( $instance['eggnews_show_post_from'] ) ? 'latest' : esc_attr( $instance['eggnews_show_post_from'] );
			$eggnews_select_category          = empty( $instance['eggnews_select_category'] ) ? 0 : intval( $instance['eggnews_select_category'] );
			$eggnews_show_random_posts        = empty( $instance['eggnews_show_random_posts'] ) ? 0 : intval( $instance['eggnews_show_random_posts'] );
			$eggnews_hide_author    = intval( empty( $instance['eggnews_hide_author'] ) ? null : $instance['eggnews_hide_author'] );
			$eggnews_hide_comment   = intval( empty( $instance['eggnews_hide_comment'] ) ? null : $instance['eggnews_hide_comment'] );
			$eggnews_hide_post_date = intval( empty( $instance['eggnews_hide_post_date'] ) ? null : $instance['eggnews_hide_post_date'] );
			$eggnews_breaking_slide_direction = empty( $instance['eggnews_breaking_slide_direction'] ) ? 'fade' : esc_attr( $instance['eggnews_breaking_slide_direction'] );
			$eggnews_breaking_slide_duration  = empty( $instance['eggnews_breaking_slide_duration'] ) ? 0 : intval( $instance['eggnews_breaking_slide_duration'] );

			echo $before_widget;
			if ( $eggnews_show_post_from == 'category' && $eggnews_select_category ) {
				eggnews_block_title( $title, $eggnews_select_category );
			} elseif ( $title ) {
				echo $before_title . $title . $after_title;
			}

			$breaking_news_args = array(
				'post_status'    => 'publish',
				'post_type'      => 'post',
				'posts_per_page' => $eggnews_noof_post_show,
			);

			if ( $eggnews_show_post_from == 'category' && $eggnews_select_category ) {
				$breaking_news_args['tax_query'] = array(
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $eggnews_select_category,
					)
				);
			}

			if ( $eggnews_show_random_posts ) {
				$breaking_news_args['orderby'] = 'rand';
			}

			$eggnews_result = new WP_Query( $breaking_news_args );
			if ( $eggnews_result->have_posts() ):
				$eggnews_result->the_post();
				?>
				<div class="breaking_news_wrap <?php echo esc_attr( $eggnews_breaking_slide_direction ); ?>">
					<ul class="breaking-news-slider"
					    data-direction="<?php echo esc_attr( $eggnews_breaking_slide_direction ); ?>"
					    data-duration="<?php echo esc_attr( $eggnews_breaking_slide_duration ); ?>">
						<?php
						while ( $eggnews_result->have_posts() ):$eggnews_result->the_post();
							?>
							<li <?php post_class(); ?>>

								<?php
								$no_feature_slider = '';
								if ( has_post_thumbnail() ) {
									$no_feature_slider = 'feature_image';
									?>
									<figure class="tabbed-images">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail( 'eggnews-carousel-image' ); ?>
										</a>
									</figure>
								<?php } ?>
								<div class="article-content  <?php echo esc_attr( $no_feature_slider ); ?>">
									<h6 class="post-title">
										<a href="<?php the_permalink(); ?>"
										   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h6>
									<div class="post-meta-wrapper">
										<?php eggnews_posted_on($eggnews_hide_post_date, $eggnews_hide_author); 
										?>
										<?php
										if ( ! $eggnews_hide_comment ) {
											eggnews_post_comment();
										} ?>
									</div>
								</div>
							</li>
							<?php
						endwhile;
						// Reset Post Data
						wp_reset_query();
						?>
					</ul>
				</div>
				<?php
			endif;

			echo $after_widget;
		}
	}
}
