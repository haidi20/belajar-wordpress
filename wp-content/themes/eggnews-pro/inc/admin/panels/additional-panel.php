<?php
/**
 * Customizer settings for Additional Settings
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

add_action( 'customize_register', 'eggnews_additional_settings_register' );

function eggnews_additional_settings_register( $wp_customize ) {

	/**
     * Add Additional Settings Panel
     */
    $wp_customize->add_panel(
        'eggnews_additional_settings_panel',
        array(
            'priority'       => 7,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__( 'Additional Settings', 'eggnews-pro' ),
        )
    );
/*--------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------*/
	//Social icons
	$wp_customize->add_section(
        'eggnews_social_media_section',
        array(
            'title'         => esc_html__( 'Social Media Icons', 'eggnews-pro' ),
            'priority'      => 10,
            'panel'         => 'eggnews_additional_settings_panel',
        )
    );

	//Add Facebook Link
    $wp_customize->add_setting(
        'social_fb_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_fb_link',
        array(
            'type' => 'text',
            'priority' => 5,
            'label' => esc_html__( 'Facebook', 'eggnews-pro' ),
            'description' =>esc_html__( 'Your Facebook Account URL', 'eggnews-pro' ),
            'section' => 'eggnews_social_media_section'
        )
    );

    //Add twitter Link
    $wp_customize->add_setting(
        'social_tw_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_tw_link',
        array(
            'type' => 'text',
            'priority' => 6,
            'label' => esc_html__( 'Twitter', 'eggnews-pro' ),
            'description' => esc_html__( 'Your Twitter Account URL', 'eggnews-pro' ),
            'section' => 'eggnews_social_media_section'
       )
    );

    //Add Google plus Link
    $wp_customize->add_setting(
        'social_gp_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_gp_link',
        array(
            'type' => 'text',
            'priority' => 7,
            'label' => esc_html__( 'Google Plus', 'eggnews-pro' ),
            'description' => esc_html__( 'Your Google Plus Account URL', 'eggnews-pro' ),
            'section' => 'eggnews_social_media_section'
        )
    );

    //Add LinkedIn Link
    $wp_customize->add_setting(
        'social_lnk_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_lnk_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => esc_html__( 'LinkedIn', 'eggnews-pro' ),
            'description' => esc_html__( 'Your LinkedIn Account URL', 'eggnews-pro' ),
            'section' => 'eggnews_social_media_section'
        )
    );

    //Add youtube Link
    $wp_customize->add_setting(
        'social_yt_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_yt_link',
        array(
            'type' => 'text',
            'priority' => 9,
            'label' => esc_html__( 'YouTube', 'eggnews-pro' ),
            'description' => esc_html__( 'Your YouTube Account URL', 'eggnews-pro' ),
            'section' => 'eggnews_social_media_section'
        )
    );

    //Add vimeo Link
    $wp_customize->add_setting(
        'social_vm_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_vm_link',
        array(
            'type' => 'text',
            'priority' => 10,
            'label' => esc_html__( 'Vimeo', 'eggnews-pro' ),
            'description' => esc_html__( 'Your Vimeo Account URL', 'eggnews-pro' ),
            'section' => 'eggnews_social_media_section'
        )
    );

    //Add Pinterest link
    $wp_customize->add_setting(
        'social_pin_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_pin_link',
        array(
            'type' => 'text',
            'priority' => 11,
            'label' => esc_html__( 'Pinterest', 'eggnews-pro' ),
            'description' => esc_html__( 'Your Pinterest Account URL', 'eggnews-pro' ),
            'section' => 'eggnews_social_media_section'
        )
    );

    //Add Instagram link
    $wp_customize->add_setting(
        'social_insta_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_insta_link',
        array(
            'type' => 'text',
            'priority' => 12,
            'label' => esc_html__( 'Instagram', 'eggnews-pro' ),
            'description' => esc_html__( 'Your Instagram Account URL', 'eggnews-pro' ),
            'section' => 'eggnews_social_media_section'
        )
    );

    $wp_customize->add_setting(
        'eggnews_social_share_count_option', array(
            'default'           => 'disable',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'eggnews_enable_switch_sanitize'
        )
    );
    
    $wp_customize->add_control( new Eggnews_Customize_Switch_Control(
            $wp_customize, 'eggnews_social_share_count_option', array(
                'type'        => 'switch',
                'label'       => esc_html__( 'Social Share Count Option', 'eggnews-pro' ),
                'description' => esc_html__( 'enable/disable share count on social media.', 'eggnews-pro' ),
                'priority'    => 25,
                'section'     => 'eggnews_social_media_section',
                'choices'     => array(
                    'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
                    'disable' => esc_html__( 'Disable', 'eggnews-pro' )
                )
            )
        )
    );  


        /**                 
        * Preload image                
        * @package Theme Egg                 
        * @subpackage eggnews-pro                 
        * @since 1.2.0
        */ 
        $wp_customize->add_section(
            'eggnews_preload_section',
            array(
                'title'         => esc_html__( 'Website Preloader', 'eggnews-pro' ),
                'priority'      => 10,
                'panel'         => 'eggnews_additional_settings_panel',
            )
        );

        $wp_customize->add_setting('eggnews_preloader_section_option',
            array(
                'sanitize_callback' => 'esc_url',
            ));


        $wp_customize->add_control(  
           new WP_Customize_Image_Control(
            $wp_customize,
            'eggnews_preloader_section_option', array(
                'label'      => esc_html__('Upload preload image', 'eggnews-pro' ), 
                'description' => esc_html__( 'Upload preload image/.gif files.', 'eggnews-pro' ),           
                'section'    => 'eggnews_preload_section',
            )       
        )
       );

    }
