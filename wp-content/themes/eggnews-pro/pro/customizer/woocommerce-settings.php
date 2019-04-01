<?php
/**
 * Customizer option for woocommerce
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.3.1
 */

function eggnews_woocommerce_settings_register( $wp_customize ) {

	 /**
     * WooCommerce Section
     */
    $wp_customize->add_section(
        'eggnews_woocommerce_sidebar_section',
        array(
            'title'    => __( 'Sidebar Option', 'eggnews-pro' ),
            'priority' => 30,
            'panel'    => 'woocommerce',
        )
    );


    // Show Woocommerce sidebar on single product page
    $wp_customize->add_setting( 'woocommerce_sidebar',
        array(
            'default'           => 0,
            'sanitize_callback' => 'eggnews_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'woocommerce_sidebar',
            array(
                'label'       => __( 'Show  Sidebar on single product page?', 'eggnews-pro' ),
                'description' => __( 'Applied  sidebar on single product page.', 'eggnews-pro' ),
                'settings'    => 'woocommerce_sidebar',
                'type'        => 'checkbox',
                'section'     => 'eggnews_woocommerce_sidebar_section',
            )
        )
    );


    // Show Woocommerce sidebar on archive product page
    $wp_customize->add_setting( 'woocommerce_sidebar_on_archive',
        array(
            'default'           => 0,
            'sanitize_callback' => 'eggnews_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'woocommerce_sidebar_on_archive',
            array(
                'label'       => __( 'Show  Sidebar on product archive page?', 'eggnews-pro' ),
                'description' => __( 'Applied  sidebar on product archive page.', 'eggnews-pro' ),
                'settings'    => 'woocommerce_sidebar_on_archive',
                'type'        => 'checkbox',
                'section'     => 'eggnews_woocommerce_sidebar_section',
            )
        )
    );


    //Show hide category image on woocommerce category page

     $wp_customize->add_section(
        'eggnews_woocommerce_category_image_section',
        array(
            'title'    => __( 'Product Category', 'eggnews-pro' ),
            'priority' => 30,
            'panel'    => 'woocommerce',
        )
    );

    $wp_customize->add_setting(
        'eggnews_woocommerce_category_image', array(
            'default'           => 'hide',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'eggnews_show_switch_sanitize'
        )
    );
    $wp_customize->add_control( new Eggnews_Customize_Switch_Control(
        $wp_customize, 'eggnews_woocommerce_category_image', array(
            'type'        => 'switch',
            'label'       => esc_html__( 'Category Images Option', 'eggnews-pro' ),
            'description' => esc_html__( 'Show/Hide Category images at Category page.', 'eggnews-pro' ),
            'section'     => 'eggnews_woocommerce_category_image_section',
            'choices'     => array(
                'show' => esc_html__( 'Show', 'eggnews-pro' ),
                'hide' => esc_html__( 'Hide', 'eggnews-pro' )
            )
        )
    )
);
}

add_action( 'customize_register', 'eggnews_woocommerce_settings_register' );
