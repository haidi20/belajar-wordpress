<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Social_Icons_Lite_Widget extends WP_Widget {

	/**
	 * Plugin version for enqueued static resources.
	 *
	 * @var string
	 */
	protected $version = '1.0.3';

	/**
	 * Default widget values.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Default widget values.
	 *
	 * @var array
	 */
	protected $sizes;

	/**
	 * Default widget profile values.
	 *
	 * @var array
	 */
	protected $profiles;

	/**
	 * Constructor method.
	 *
	 * Set some global values and create widget.
	 */
	function __construct() {

		/**
		 * Default widget option values.
		 */
		$this->defaults = apply_filters( 'simple_social_default_styles', array(
			'title'                       => '',
			'new_window'                  => 0,
			'size'                        => 36,
			'border_radius'               => 3,
			'border_width'                => 0,
			'border_color'                => '#ffffff',
			'border_color_hover'          => '#ffffff',
			'icon_color'                  => '#ffffff',
			'icon_color_hover'            => '#ffffff',
			'background_color'            => '#1e73be',
			'background_color_hover'      => '#dd9933',
			'alignment'                   => 'alignleft',
			'email'                       => '',
			'facebook'                    => '',
			'gplus'                       => '',
			'instagram'                   => '',
			'linkedin'                    => '',
			'phone'                       => '',
			'pinterest'                   => '',
			'rss'                         => '',
			'twitter'                     => '',
			'vimeo'                       => '',
			'youtube'                     => '',
			'social_icons_lite_templates' => 'default',
		) );
		$symbol_url     = ( SIL_PLUGIN_URL . 'assets/icons/symbol.svg' );

		/**
		 * Social profile choices.
		 */
		$this->profiles = apply_filters( 'simple_social_default_profiles', array(


			'twitter'  => array(
				'label'   => __( 'Twitter URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-twitter"><a href="%s" %s><svg role="img" class="social-twitter" aria-labelledby="social-twitter"><title id="social-twitter">' . __( 'Twitter', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-twitter' ) . '"></use></svg></a></li>',
			),
			'facebook' => array(
				'label'   => __( 'Facebook URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-facebook"><a href="%s" %s><svg role="img" class="social-facebook" aria-labelledby="social-facebook"><title id="social-facebook">' . __( 'Facebook', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-facebook' ) . '"></use></svg></a></li>',
			),

			'gplus'     => array(
				'label'   => __( 'Google+ URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-gplus"><a href="%s" %s><svg role="img" class="social-gplus" aria-labelledby="social-gplus"><title id="social-gplus">' . __( 'Google+', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-gplus' ) . '"></use></svg></a></li>',
			),
			'instagram' => array(
				'label'   => __( 'Instagram URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-instagram"><a href="%s" %s><svg role="img" class="social-instagram" aria-labelledby="social-instagram"><title id="social-instagram">' . __( 'Instagram', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-instagram' ) . '"></use></svg></a></li>',
			),
			'linkedin'  => array(
				'label'   => __( 'Linkedin URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-linkedin"><a href="%s" %s><svg role="img" class="social-linkedin" aria-labelledby="social-linkedin"><title id="social-linkedin">' . __( 'Linkedin', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-linkedin' ) . '"></use></svg></a></li>',
			),

			'email'     => array(
				'label'   => __( 'Email URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-email"><a href="%s" %s><svg role="img" class="social-email" aria-labelledby="social-email"><title id="social-email">' . __( 'Email', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-email' ) . '"></use></svg></a></li>',
			),
			'phone'     => array(
				'label'   => __( 'Phone URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-phone"><a href="%s" %s><svg role="img" class="social-phone" aria-labelledby="social-phone"><title id="social-phone">' . __( 'Phone', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-phone' ) . '"></use></svg></a></li>',
			),
			'pinterest' => array(
				'label'   => __( 'Pinterest URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-pinterest"><a href="%s" %s><svg role="img" class="social-pinterest" aria-labelledby="social-pinterest"><title id="social-pinterest">' . __( 'Pinterest', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-pinterest' ) . '"></use></svg></a></li>',
			),
			'rss'       => array(
				'label'   => __( 'RSS URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-rss"><a href="%s" %s><svg role="img" class="social-rss" aria-labelledby="social-rss"><title id="social-rss">' . __( 'RSS', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-rss' ) . '"></use></svg></a></li>',
			),

			'vimeo'   => array(
				'label'   => __( 'Vimeo URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-vimeo"><a href="%s" %s><svg role="img" class="social-vimeo" aria-labelledby="social-vimeo"><title id="social-vimeo">' . __( 'Vimeo', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-vimeo' ) . '"></use></svg></a></li>',
			),
			'youtube' => array(
				'label'   => __( 'YouTube URI', 'social-icons-lite' ),
				'pattern' => '<li class="ssi-youtube"><a href="%s" %s><svg role="img" class="social-youtube" aria-labelledby="social-youtube"><title id="social-youtube">' . __( 'YouTube', 'social-icons-lite' ) . '</title><use xlink:href="' . esc_url( $symbol_url . '#social-youtube' ) . '"></use></svg></a></li>',
			),
		) );

		$widget_ops = array(
			'classname'   => 'social-icons-lite',
			'description' => __( 'Displays select social icons.', 'social-icons-lite' ),
		);

		$control_ops = array(
			'id_base' => 'social-icons-lite',
		);

		parent::__construct( 'social-icons-lite', __( 'Social Icons Lite', 'social-icons-lite' ), $widget_ops, $control_ops );

		/** Enqueue scripts and styles */
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ) );

		/** Load CSS in <head> */
		add_action( 'wp_head', array( $this, 'css' ) );

		/** Load color picker */
		add_action( 'admin_enqueue_scripts', array( $this, 'load_color_picker' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );

	}

	/**
	 * Color Picker.
	 *
	 * Enqueue the color picker script.
	 *
	 */
	function load_color_picker( $hook ) {
		if ( 'widgets.php' != $hook ) {
			return;
		}
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );
	}

	/**
	 * Print scripts.
	 *
	 * Reference https://core.trac.wordpress.org/attachment/ticket/25809/color-picker-widget.php
	 *
	 */
	function print_scripts() {
		?>
        <script>
            ( function ($) {
                function initColorPicker(widget) {
                    widget.find('.sil-color-picker').wpColorPicker({
                        change: function (event) {
                            var $picker = $(this);
                            _.throttle(setTimeout(function () {
                                $picker.trigger('change');
                            }, 5), 250);
                        },
                        width: 235,
                    });
                }

                function onFormUpdate(event, widget) {
                    initColorPicker(widget);
                }

                $(document).on('widget-added widget-updated', onFormUpdate);

                $(document).ready(function () {
                    $('#widgets-right .widget:has(.sil-color-picker)').each(function () {
                        initColorPicker($(this));
                    });
                });
            }(jQuery) );
        </script>
		<?php
	}

	/**
	 * Widget Form.
	 *
	 * Outputs the widget form that allows users to control the output of the widget.
	 *
	 */
	function form( $instance ) {

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
        <div class="social-icon-lite-widget">

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'social-icons-lite' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                       value="<?php echo esc_attr( $instance['title'] ); ?>"/></p>

            <p><label><input id="<?php echo $this->get_field_id( 'new_window' ); ?>" type="checkbox"
                             name="<?php echo $this->get_field_name( 'new_window' ); ?>"
                             value="1" <?php checked( 1, $instance['new_window'] ); ?>/> <?php esc_html_e( 'Open links in new window?', 'social-icons-lite' ); ?>
                </label></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Icon Size in pixel', 'social-icons-lite' ); ?>
                    :</label> <input id="<?php echo $this->get_field_id( 'size' ); ?>"
                                     name="<?php echo $this->get_field_name( 'size' ); ?>" type="text"
                                     value="<?php echo esc_attr( $instance['size'] ); ?>" size="3"/></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'border_radius' ); ?>"><?php _e( 'Icon Border Radius in pixel:', 'social-icons-lite' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'border_radius' ); ?>"
                       name="<?php echo $this->get_field_name( 'border_radius' ); ?>" type="text"
                       value="<?php echo esc_attr( $instance['border_radius'] ); ?>" size="3"/></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'border_width' ); ?>"><?php _e( 'Border Width in pixel:', 'social-icons-lite' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'border_width' ); ?>"
                       name="<?php echo $this->get_field_name( 'border_width' ); ?>" type="text"
                       value="<?php echo esc_attr( $instance['border_width'] ); ?>" size="3"/></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alignment' ); ?>"><?php _e( 'Alignment', 'social-icons-lite' ); ?>
                    :</label>
                <select id="<?php echo $this->get_field_id( 'alignment' ); ?>"
                        name="<?php echo $this->get_field_name( 'alignment' ); ?>">
                    <option value="alignleft" <?php selected( 'alignright', $instance['alignment'] ) ?>><?php _e( 'Align Left', 'social-icons-lite' ); ?></option>
                    <option value="aligncenter" <?php selected( 'aligncenter', $instance['alignment'] ) ?>><?php _e( 'Align Center', 'social-icons-lite' ); ?></option>
                    <option value="alignright" <?php selected( 'alignright', $instance['alignment'] ) ?>><?php _e( 'Align Right', 'social-icons-lite' ); ?></option>
                </select>
            </p>

            <hr style="background: #ccc; border: 0; height: 1px; margin: 20px 0;"/>

            <p>
                <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Icon Color:', 'social-icons-lite' ); ?></label><br/>
                <input id="<?php echo $this->get_field_id( 'icon_color' ); ?>"
                       name="<?php echo $this->get_field_name( 'icon_color' ); ?>" type="text" class="sil-color-picker"
                       data-default-color="<?php echo esc_attr( $this->defaults['icon_color'] ); ?>"
                       value="<?php echo esc_attr( $instance['icon_color'] ); ?>" size="6"/></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'background_color_hover' ); ?>"><?php _e( 'Icon Hover Color:', 'social-icons-lite' ); ?></label><br/>
                <input id="<?php echo $this->get_field_id( 'icon_color_hover' ); ?>"
                       name="<?php echo $this->get_field_name( 'icon_color_hover' ); ?>" type="text"
                       class="sil-color-picker"
                       data-default-color="<?php echo esc_attr( $this->defaults['icon_color_hover'] ); ?>"
                       value="<?php echo esc_attr( $instance['icon_color_hover'] ); ?>" size="6"/></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:', 'social-icons-lite' ); ?></label><br/>
                <input id="<?php echo $this->get_field_id( 'background_color' ); ?>"
                       name="<?php echo $this->get_field_name( 'background_color' ); ?>" type="text"
                       class="sil-color-picker"
                       data-default-color="<?php echo esc_attr( $this->defaults['background_color'] ); ?>"
                       value="<?php echo esc_attr( $instance['background_color'] ); ?>" size="6"/></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'background_color_hover' ); ?>"><?php _e( 'Background Hover Color:', 'social-icons-lite' ); ?></label><br/>
                <input id="<?php echo $this->get_field_id( 'background_color_hover' ); ?>"
                       name="<?php echo $this->get_field_name( 'background_color_hover' ); ?>" type="text"
                       class="sil-color-picker"
                       data-default-color="<?php echo esc_attr( $this->defaults['background_color_hover'] ); ?>"
                       value="<?php echo esc_attr( $instance['background_color_hover'] ); ?>" size="6"/></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'border_color' ); ?>"><?php _e( 'Border Color:', 'social-icons-lite' ); ?></label><br/>
                <input id="<?php echo $this->get_field_id( 'border_color' ); ?>"
                       name="<?php echo $this->get_field_name( 'border_color' ); ?>" type="text"
                       class="sil-color-picker"
                       data-default-color="<?php echo esc_attr( $this->defaults['border_color'] ); ?>"
                       value="<?php echo esc_attr( $instance['border_color'] ); ?>" size="6"/></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'border_color_hover' ); ?>"><?php _e( 'Border Hover Color:', 'social-icons-lite' ); ?></label><br/>
                <input id="<?php echo $this->get_field_id( 'border_color_hover' ); ?>"
                       name="<?php echo $this->get_field_name( 'border_color_hover' ); ?>" type="text"
                       class="sil-color-picker"
                       data-default-color="<?php echo esc_attr( $this->defaults['border_color_hover'] ); ?>"
                       value="<?php echo esc_attr( $instance['border_color_hover'] ); ?>" size="6"/></p>

            <hr style="background: #ccc; border: 0; height: 1px; margin: 20px 0;"/>
            <style>
                .social-icon-lite-widget label {
                    display: block;

                }

                .social-icon-lite-widget input[type="text"], select {

                    width: 100%;
                }
            </style>
        </div>

		<?php
		foreach ( (array) $this->profiles as $profile => $data ) {

			printf( '<p><label for="%s">%s:</label></p>', esc_attr( $this->get_field_id( $profile ) ), esc_attr( $data['label'] ) );
			printf( '<p><input type="text" id="%s" name="%s" value="%s" class="widefat" />', esc_attr( $this->get_field_id( $profile ) ), esc_attr( $this->get_field_name( $profile ) ), esc_url( $instance[ $profile ] ) );
			printf( '</p>' );

		}
		$social_icon_lite_templates = social_icons_lite_icon_templates();

		$selected_template = isset( $instance['social_icons_lite_templates'] ) ? $instance['social_icons_lite_templates'] : $this->defaults['social_icons_lite_templates'];

		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'social_icons_lite_templates' ); ?>"><?php _e( 'Templates:', 'social-icons-lite' ); ?></label><br/>

            <select
                    id="<?php echo $this->get_field_id( 'social_icons_lite_templates' ); ?>"
                    name="<?php echo $this->get_field_name( 'social_icons_lite_templates' ); ?>"
            >
				<?php foreach ( $social_icon_lite_templates as $template_key => $template_value ) {

					$selected = $template_key === $selected_template ? 'selected="selected"' : '';
					?>

                    <option <?php echo $selected; ?>
                            value="<?php echo esc_attr( $template_key ); ?>"><?php echo esc_html( $template_value ); ?></option>

				<?php } ?>

            </select>
        </p>
		<?php

	}

	/**
	 * Form validation and sanitization.
	 *
	 * Runs when you save the widget form. Allows you to validate or sanitize widget options before they are saved.
	 *
	 */
	function update( $newinstance, $oldinstance ) {

		foreach ( $newinstance as $key => $value ) {

			/** Border radius and Icon size must not be empty, must be a digit */
			if ( ( 'border_radius' == $key || 'size' == $key ) && ( '' == $value || ! ctype_digit( $value ) ) ) {
				$newinstance[ $key ] = 0;
			}

			if ( ( 'border_width' == $key || 'size' == $key ) && ( '' == $value || ! ctype_digit( $value ) ) ) {
				$newinstance[ $key ] = 0;
			} /** Validate hex code colors */
			elseif ( strpos( $key, '_color' ) && 0 == preg_match( '/^#(([a-fA-F0-9]{3}$)|([a-fA-F0-9]{6}$))/', $value ) ) {
				$newinstance[ $key ] = $oldinstance[ $key ];
			} /** Sanitize Profile URIs */
			elseif ( array_key_exists( $key, (array) $this->profiles ) ) {
				$newinstance[ $key ] = esc_url( $newinstance[ $key ] );
			}

		}

		return $newinstance;

	}

	/**
	 * Widget Output.
	 *
	 * Outputs the actual widget on the front-end based on the widget options the user selected.
	 *
	 */
	function widget( $args, $instance ) {

		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;

		if ( ! empty( $instance['title'] ) ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		$output = '';

		$new_window = $instance['new_window'] ? 'target="_blank"' : '';

		$profiles = (array) $this->profiles;

		foreach ( $profiles as $profile => $data ) {

			if ( empty( $instance[ $profile ] ) ) {
				continue;
			}

			if ( is_email( $instance[ $profile ] ) ) {
				$output .= sprintf( $data['pattern'], 'mailto:' . esc_attr( $instance[ $profile ] ), $new_window );
			} else {
				$output .= sprintf( $data['pattern'], esc_url( $instance[ $profile ] ), $new_window );
			}

		}
		$template = isset( $instance['social_icons_lite_templates'] ) ? $instance['social_icons_lite_templates'] : 'default';

		if ( $output ) {
			printf( '<div class="sil-wrap %s"><ul class="sli-list %s">%s</ul></div>', $template, $instance['alignment'], $output );
		}

		echo $after_widget;

	}

	function enqueue_css() {

		$cssfile = apply_filters( 'simple_social_default_stylesheet', SIL_PLUGIN_URL . 'assets/css/social-icons-lite.css' );

		wp_enqueue_style( 'social-icons-lite-font', esc_url( $cssfile ), array(), $this->version, 'all' );

		wp_enqueue_script( 'svg-x-use', SIL_PLUGIN_URL . 'assets/js/svgxuse.js', array(), '1.1.21' );
	}

	/**
	 * Custom CSS.
	 *
	 * Outputs custom CSS to control the look of the icons.
	 */
	function css() {

		/** Pull widget settings, merge with defaults */
		$all_instances = $this->get_settings();
		if ( ! isset( $this->number ) || ! isset( $all_instances[ $this->number ] ) ) {
			return;
		}

		$instance = wp_parse_args( $all_instances[ $this->number ], $this->defaults );

		$font_size    = round( (int) $instance['size'] / 2 );
		$icon_padding = round( (int) $font_size / 2 );

		/** The CSS to output */
		$css = '
		.social-icons-lite ul li a,
		.social-icons-lite ul li a:hover,
		.social-icons-lite ul li a:focus {
			background-color: ' . $instance['background_color'] . ' !important;
			border-radius: ' . $instance['border_radius'] . 'px;
			color: ' . $instance['icon_color'] . ' !important;
			border: ' . $instance['border_width'] . 'px ' . $instance['border_color'] . ' solid !important;
			font-size: ' . $font_size . 'px;
			padding: ' . $icon_padding . 'px;
		}

		.social-icons-lite ul li a:hover,
		.social-icons-lite ul li a:focus {
			background-color: ' . $instance['background_color_hover'] . ' !important;
			border-color: ' . $instance['border_color_hover'] . ' !important;
			color: ' . $instance['icon_color_hover'] . ' !important;
		}

		.social-icons-lite ul li a:focus {
			outline: 1px dotted ' . $instance['background_color_hover'] . ' !important;
		}';

		/** Minify a bit */
		$css = str_replace( "\t", '', $css );
		$css = str_replace( array( "\n", "\r" ), ' ', $css );

		/** Echo the CSS */
		echo '<style type="text/css" media="screen">' . $css . '</style>';

	}

}

function sil_load_widget() {

	register_widget( 'Social_Icons_Lite_Widget' );

}

add_action( 'widgets_init', 'sil_load_widget' );
