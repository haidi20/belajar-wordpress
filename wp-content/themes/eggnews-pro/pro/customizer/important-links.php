<?php
add_action( 'customize_register', 'eggnews_important_links' );
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	require_once ABSPATH . WPINC . DIRECTORY_SEPARATOR . 'class-wp-customize-control.php';
}

class EggNews_Important_Links extends WP_Customize_Control {

	public $type = "eggnews-important-links";

	public function render_content() {
		//Add Theme instruction, Support Forum, Demo Link, Rating Link
		$important_links = array(
			'support'       => array(
				'link' => esc_url( 'https://themeegg.com/support-forum/' ),
				'text' => __( 'Support', 'eggnews-pro' ),
			),
			'documentation' => array(
				'link' => esc_url( 'https://docs.themeegg.com/docs/eggnews-pro/' ),
				'text' => __( 'Documentation', 'eggnews-pro' ),
			),
			'demo'          => array(
				'link' => esc_url( 'https://demo.themeegg.com/themes/eggnews-pro/' ),
				'text' => __( 'View Demo', 'eggnews-pro' ),
			),
			'rating'        => array(
				'link' => esc_url( 'https://wordpress.org/support/view/theme-reviews/eggnews' ),
				'text' => __( 'Rate This Theme', 'eggnews-pro' ),
			)
		);
		foreach ( $important_links as $important_link ) {
			echo '<p><a class="button " target="_blank" href="' . $important_link['link'] . '" >' . esc_attr( $important_link['text'] ) . ' </a></p>';
		}
	}

}

function eggnews_important_links( $wp_customize ) {

	$wp_customize->add_section( 'eggnews_important_links', array(
		'priority' => 700,
		'title'    => __( 'Important Links', 'eggnews-pro' ),
	) );

	/**
	 * This setting has the dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'eggnews_important_links', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'eggnews_links_sanitize'
	) );

	$wp_customize->add_control( new EggNews_Important_Links( $wp_customize, 'important_links', array(
		'label'    => __( 'Important Links', 'eggnews-pro' ),
		'section'  => 'eggnews_important_links',
		'settings' => 'eggnews_important_links'
	) ) );

// Theme Important Links Ended
}

?>
