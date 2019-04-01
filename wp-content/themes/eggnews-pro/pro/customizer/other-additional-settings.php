<?php
/**
 * Customizer option for Color Settings
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
function eggnews_other_additional_settings( $wp_customize ) {

	/**
	 * Lightbox Settings
	 */
	$wp_customize->add_section(
		'eggnews_lightbox_additional_section',
		array(
			'title'    => __( 'Lightbox Settings', 'eggnews-pro' ),
			'priority' => 5,
			'panel'    => 'eggnews_additional_settings_panel',
		)
	);

	$lightbox = get_theme_mod( 'eggnews_lightbox_settings' );

	// Single Page Featured Image Lightbox
	$wp_customize->add_setting( 'eggnews_lightbox_settings[single_featured_ltbox]',
		array(
			'default'           => isset( $lightbox['single_featured_ltbox'] ) ? $lightbox['single_featured_ltbox'] : 0,
			'sanitize_callback' => 'eggnews_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eggnews_lightbox_settings[single_featured_ltbox]',
			array(
				'label'       => __( 'Show on single page Featured Image?', 'eggnews-pro' ),
				'description' => __( 'Applied lightbox to single page fatured image.', 'eggnews-pro' ),
				'settings'    => 'eggnews_lightbox_settings[single_featured_ltbox]',
				'type'        => 'checkbox',
				'section'     => 'eggnews_lightbox_additional_section',
			)
		)
	);

	// Single Page Featured Image Lightbox
	$wp_customize->add_setting( 'eggnews_lightbox_settings[single_content_ltbox]',
		array(
			'default'           => isset( $lightbox['single_content_ltbox'] ) ? $lightbox['single_content_ltbox'] : 0,
			'sanitize_callback' => 'eggnews_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eggnews_lightbox_settings[single_content_ltbox]',
			array(
				'label'       => __( 'Show on single content area image?', 'eggnews-pro' ),
				'description' => __( 'Applied lightbox to single page content area image.', 'eggnews-pro' ),
				'settings'    => 'eggnews_lightbox_settings[single_content_ltbox]',
				'type'        => 'checkbox',
				'section'     => 'eggnews_lightbox_additional_section',
			)
		)
	);


	/**
	 * Reading Indicator Section
	 */
	$wp_customize->add_section(
		'eggnews_reading_indicator_section',
		array(
			'title'    => __( 'Reading Indicator Settings', 'eggnews-pro' ),
			'priority' => 2,
			'panel'    => 'eggnews_additional_settings_panel',
		)
	);

	$indicator = get_theme_mod( 'eggnews_rading_indicator_settings' );

	// Show Reading Indicator
	$wp_customize->add_setting( 'eggnews_rading_indicator_settings[show_indicator]',
		array(
			'default'           => isset( $indicator['show_indicator'] ) ? $indicator['show_indicator'] : 0,
			'sanitize_callback' => 'eggnews_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eggnews_rading_indicator_settings[show_indicator]',
			array(
				'label'       => __( 'Show Reading Indicator?', 'eggnews-pro' ),
				'description' => __( 'Applied reading indicator for webiste.', 'eggnews-pro' ),
				'settings'    => 'eggnews_rading_indicator_settings[show_indicator]',
				'type'        => 'checkbox',
				'section'     => 'eggnews_reading_indicator_section',
			)
		)
	);
	
	/*
	 *=========================================================================
	=============================== MORE STORIES SETTINGS ====================
	*=========================================================================
	*/

	$wp_customize->add_section(
		'eggnews_more_stories_section',
		array(
			'title'    => __( 'More Stories Settings', 'eggnews-pro' ),
			'priority' => 6,
			'panel'    => 'eggnews_additional_settings_panel',
		)
	);
	$more_stories_section = get_theme_mod( 'eggnews_more_stories_settings' );

	// Show Reading Indicator
	$wp_customize->add_setting( 'eggnews_more_stories_settings[show_more_stories]',
		array(
			'default'           => isset( $more_stories_section['show_more_stories'] ) ? $more_stories_section['show_more_stories'] : 0,
			'sanitize_callback' => 'eggnews_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eggnews_more_stories_settings[show_more_stories]',
			array(
				'label'       => __( 'Show More Stories', 'eggnews-pro' ),
				'description' => __( 'Show more stories flying option on bottom right.', 'eggnews-pro' ),
				'settings'    => 'eggnews_more_stories_settings[show_more_stories]',
				'type'        => 'checkbox',
				'section'     => 'eggnews_more_stories_section',
			)
		)
	);
	// More Stories Text
	$wp_customize->add_setting( 'eggnews_more_stories_settings[more_stories_text]',
		array(
			'default'           => isset( $more_stories_section['more_stories_text'] ) ? $more_stories_section['more_stories_text'] : __( 'MORE STORIES', 'eggnews-pro' ),
			'sanitize_callback' => 'eggnews_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eggnews_more_stories_settings[more_stories_text]',
			array(
				'label'       => __( 'More stories text', 'eggnews-pro' ),
				'description' => __( 'Change More Stories Label.', 'eggnews-pro' ),
				'settings'    => 'eggnews_more_stories_settings[more_stories_text]',
				'type'        => 'text',
				'section'     => 'eggnews_more_stories_section',
			)
		)
	);


	// More stories Categories
	$categories_object = get_terms( 'category' ); // Get all Categories

	$eggnews_category_array = array();

	if ( count( $categories_object ) > 0 ) {

		$eggnews_category_array = wp_list_pluck( $categories_object, 'name', 'term_id' );

	}
	$eggnews_category_array[0] = __( 'Select category', 'eggnews-pro' );
	if ( is_array( $eggnews_category_array ) ) {
		ksort( $eggnews_category_array );
	}
	$wp_customize->add_setting( 'eggnews_more_stories_settings[more_stories_post_category]',
		array(
			'default'           => isset( $more_stories_section['more_stories_post_category'] ) ? $more_stories_section['more_stories_post_category'] : 0,
			'sanitize_callback' => 'eggnews_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eggnews_more_stories_settings[more_stories_post_category]',
			array(
				'label'       => __( 'More stories Post Category', 'eggnews-pro' ),
				'description' => __( 'Change More Stories Label.', 'eggnews-pro' ),
				'settings'    => 'eggnews_more_stories_settings[more_stories_post_category]',
				'type'        => 'select',
				'section'     => 'eggnews_more_stories_section',
				'choices'     => $eggnews_category_array

			)
		)
	);


	/*=========================================================================
	=============================== READING INDICATOR POSITION ====================
	*=========================================================================
	 	 */
	// Show Reading Indicator Position
	$wp_customize->add_setting( 'eggnews_rading_indicator_settings[position]',
		array(
			'default'           => isset( $indicator['position'] ) ? $indicator['position'] : 'top',
			'sanitize_callback' => 'eggnews_sanitize_site_indicator'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eggnews_rading_indicator_settings[position]',
			array(
				'label'       => __( 'Show Reading Indicator?', 'eggnews-pro' ),
				'description' => __( 'Applied position indicator for webiste.', 'eggnews-pro' ),
				'settings'    => 'eggnews_rading_indicator_settings[position]',
				'type'        => 'radio',
				'choices'     => array(
					'top'    => __( 'Top', 'eggnews-pro' ),
					'right'  => __( 'Right', 'eggnews-pro' ),
					'bottom' => __( 'Bottom', 'eggnews-pro' ),
					'left'   => __( 'Left', 'eggnews-pro' ),
				),
				'section'     => 'eggnews_reading_indicator_section',
			)
		)
	);

	// Read More Text
	$wp_customize->add_setting( 'eggnews_rading_indicator_settings[read_more_text]',
		array(
			'default'           => isset( $indicator['read_more_text'] ) ? $indicator['read_more_text'] : __( 'Read More...', 'eggnews-pro' ),
			'sanitize_callback' => 'eggnews_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eggnews_rading_indicator_settings[read_more_text]',
			array(
				'label'       => __( 'Read more text', 'eggnews-pro' ),
				'description' => __( 'Applied reading more text for webiste.', 'eggnews-pro' ),
				'settings'    => 'eggnews_rading_indicator_settings[read_more_text]',
				'type'        => 'text',
				'section'     => 'eggnews_reading_indicator_section',
			)
		)
	);
}

add_action( 'customize_register', 'eggnews_other_additional_settings' );

function eggnews_body_class_for_lightbox( $class ) {

	$lightbox = get_theme_mod( 'eggnews_lightbox_settings', array( 'no-lightbox' => 1 ) );
	if ( ! $lightbox ) {
		return $class;
	}
	foreach ( $lightbox as $key => $value ) {
		if ( $value ) {
			$class[] = $key;
		}
	}

	return $class;

}

add_filter( 'body_class', 'eggnews_body_class_for_lightbox' );

function eggnews_reading_indicator() {
	$default        = array( 'show_indicator' => 1, 'position' => 'top' );
	$indicator      = get_theme_mod( 'eggnews_rading_indicator_settings', $default );
	$show_indicator = isset( $indicator['show_indicator'] ) ? absint( $indicator['show_indicator'] ) : __( 'Read More...', 'eggnews-pro' );
	$position       = isset( $indicator['position'] ) ? esc_attr( $indicator['position'] ) : 'top';
	if ( ! $show_indicator ) {
		return;
	}
	?>
	<div class="progress-indicator-wraper <?php echo $position; ?>">
		<progress value="0" id="reading-progress-indicator">
			<div class="progress-container">
				<span class="progress-bar"></span>
			</div>
		</progress>
	</div>
	<?php
}

add_action( 'eggnews_before_header', 'eggnews_reading_indicator' );


function eggnews_excerpt_more( $more ) {
	global $post;
	$default        = array( 'read_more_text' => esc_html__( ' Read More...', 'eggnews-pro' ) );
	$indicator      = get_theme_mod( 'eggnews_rading_indicator_settings', $default );
	$read_more_text = isset( $indicator['read_more_text'] ) ? esc_html($indicator['read_more_text']) : esc_html__( 'Read More...', 'eggnews-pro' );

	$permalink = get_permalink( $post->ID );

	return '<a class="read-more-link" href="' . esc_url( $permalink ) . '"> ' . esc_html($read_more_text) . '</a>';

}

add_filter( 'excerpt_more', 'eggnews_excerpt_more' );
