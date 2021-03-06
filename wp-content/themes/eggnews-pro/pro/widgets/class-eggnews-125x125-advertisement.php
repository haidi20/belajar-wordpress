<?php

if ( ! class_exists( 'Eggnews_125x125_Advertisement' ) ):

	class Eggnews_125x125_Advertisement extends WP_Widget {

		function __construct() {
			$widget_ops  = array(
				'classname'   => 'eggnews_widget_125x125_advertisement',
				'description' => __( 'Add your 125x125 Advertisement here', 'eggnews-pro' )
			);
			$control_ops = array( 'width' => 200, 'height' => 250 );
			parent::__construct( false, $name = __( '125x125 Advertisement', 'eggnews-pro' ), $widget_ops );
		}

		function form( $instance ) {
			$instance = wp_parse_args( ( array ) $instance, array(
				'title'                => '',
				'125x125_image_url_1'  => '',
				'125x125_image_url_2'  => '',
				'125x125_image_url_3'  => '',
				'125x125_image_url_4'  => '',
				'125x125_image_url_5'  => '',
				'125x125_image_url_6'  => '',
				'125x125_image_link_1' => '',
				'125x125_image_link_2' => '',
				'125x125_image_link_3' => '',
				'125x125_image_link_4' => '',
				'125x125_image_link_5' => '',
				'125x125_image_link_6' => ''
			) );
			$title    = esc_attr( $instance['title'] );
			for ( $i = 1; $i < 7; $i ++ ) {
				$image_link = '125x125_image_link_' . $i;
				$image_url  = '125x125_image_url_' . $i;

				$instance[ $image_link ] = esc_url( $instance[ $image_link ] );
				$instance[ $image_url ]  = esc_url( $instance[ $image_url ] );
			}
			?>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'eggnews-pro' ); ?> </label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>"
				       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
				       value="<?php echo $title; ?>"
				       style="width:100%;"/>
			</p>
			<label><?php _e( 'Add your Advertisement 125x125 Images Here', 'eggnews-pro' ); ?></label>
			<?php
			for ( $i = 1; $i < 7; $i ++ ) {
				$image_link = '125x125_image_link_' . $i;
				$image_url  = '125x125_image_url_' . $i;
				?>
				<p>
					<label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php
						_e( 'Advertisement Image Link ', 'eggnews-pro' );
						echo $i;
						?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>"
					       name="<?php echo $this->get_field_name( $image_link ); ?>"
					       value="<?php echo $instance[ $image_link ]; ?>"/>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php
						_e( 'Advertisement Image ', 'eggnews-pro' );
						echo $i;
						?></label>
				<div class="media-uploader" id="<?php echo $this->get_field_id( $image_url ); ?>">
					<div class="custom_media_preview">
						<?php if ( $instance[ $image_url ] != '' ) : ?>
							<img class="custom_media_preview_default"
							     src="<?php echo esc_url( $instance[ $image_url ] ); ?>" style="max-width:100%;"/>
						<?php endif; ?>
					</div>
					<input type="text" class="widefat custom_media_input"
					       id="<?php echo $this->get_field_id( $image_url ); ?>"
					       name="<?php echo $this->get_field_name( $image_url ); ?>"
					       value="<?php echo esc_url( $instance[ $image_url ] ); ?>" style="margin-top:5px;"/>
					<button class="custom_media_upload button button-secondary button-large"
					        id="<?php echo $this->get_field_id( $image_url ); ?>"
					        data-choose="<?php esc_attr_e( 'Choose an image', 'eggnews-pro' ); ?>"
					        data-update="<?php esc_attr_e( 'Use image', 'eggnews-pro' ); ?>"
					        style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'eggnews-pro' ); ?></button>
				</div>
				</p>
			<?php } ?>

			<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance          = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			for ( $i = 1; $i < 7; $i ++ ) {
				$image_link = '125x125_image_link_' . $i;
				$image_url  = '125x125_image_url_' . $i;

				$instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
				$instance[ $image_url ]  = esc_url_raw( $new_instance[ $image_url ] );
			}

			return $instance;
		}

		function widget( $args, $instance ) {
			extract( $args );
			extract( $instance );

			$title       = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
			$image_array = array();
			$link_array  = array();

			$j = 0;
			for ( $i = 1; $i < 7; $i ++ ) {
				$image_link = '125x125_image_link_' . $i;
				$image_url  = '125x125_image_url_' . $i;

				$image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
				$image_url  = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';
				array_push( $link_array, $image_link );
				array_push( $image_array, $image_url );

				// For WPML plugin compatibility
				if ( function_exists( 'icl_register_string' ) ) {
					icl_register_string( 'Eggnews Pro', '125x125 Image Link' . $this->id . $j, $image_array[ $j ] );
				}
				if ( function_exists( 'icl_register_string' ) ) {
					icl_register_string( 'Eggnews Pro', '125x125 Image URL' . $this->id . $j, $link_array[ $j ] );
				}
				$j ++;
			}
			echo $before_widget;
			?>

			<div class="advertisement_125x125">
				<?php if ( ! empty( $title ) ) { ?>
					<div class="advertisement-title">
						<?php echo $before_title . esc_html( $title ) . $after_title; ?>
					</div>
					<?php
				}
				$output = '';
				if ( ! empty( $image_array ) ) {
					$output .= '<div class="advertisement-content">';
					for ( $i = 1; $i < 7; $i ++ ) {
						$j = $i - 1;
						if ( ! empty( $image_array[ $j ] ) ) {
							$image_id  = attachment_url_to_postid( $image_url );
							$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
							// For WPML plugin compatibility
							if ( function_exists( 'icl_t' ) ) {
								$image_array[ $j ] = icl_t( 'Eggnews Pro', '125x125 Image Link' . $this->id . $j, $image_array[ $j ] );
							}
							if ( function_exists( 'icl_t' ) ) {
								$link_array[ $j ] = icl_t( 'Eggnews Pro', '125x125 Image URL' . $this->id . $j, $link_array[ $j ] );
							}

							if ( ! empty( $link_array[ $j ] ) ) {
								$output .= '<a href="' . $link_array[ $j ] . '" class="single_ad_125x125" target="_blank" rel="nofollow">
											<img src="' . $image_array[ $j ] . '" width="125" height="125" alt="' . $image_alt . '">
										</a>';
							} else {
								$output .= '<img src="' . $image_array[ $j ] . '" width="125" height="125" alt="' . $image_alt . '">';
							}
						}
					}
					$output .= '</div>';
					echo $output;
				}
				?>
			</div>
			<?php
			echo $after_widget;
		}

	}
endif;
