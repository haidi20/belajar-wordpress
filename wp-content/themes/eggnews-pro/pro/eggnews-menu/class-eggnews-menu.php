<?php

/**
 * Class Eggnews_Menu
 * v 1.1  10 oct 2014
 */
// the menu

class Eggnews_Menu {

    private static $instance;
    var $is_header_menu_mobile = false;

    function __construct() {

        add_action('eggnews_primary_menu', array($this, 'eggnews_primary_menu_filter'));
        if (is_admin()) {
            add_action('wp_update_nav_menu_item', array($this, 'hook_wp_update_nav_menu_item'), 10, 3);
            add_filter('wp_edit_nav_menu_walker', array($this, 'hook_wp_edit_nav_menu_walker'));
        }
        add_action('wp_enqueue_scripts', array($this, 'mega_menu_script'));
        add_filter('wp_nav_menu_objects', array($this, 'hook_wp_nav_menu_objects'), 10, 2);
        add_action('wp_ajax_eggnews_mega_hover', array($this, 'eggnews_mega_hover'), 10);
        add_action('wp_ajax_nopriv_eggnews_mega_hover', array($this, 'eggnews_mega_hover'), 10);
    }

    public function eggnews_mega_hover() {

        check_ajax_referer('mega_menu_post_hover_nonce', 'security');
        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
        $category_id = absint($category_id);
        if ($category_id > 0) {
            include_once( 'class-eggnews-mega-menu.php' );
            $mega_menu = new Eggnews_Mega_Menu();
            $inner_html = $mega_menu->inner($category_id, true);
            wp_send_json_success(array('inner_html' => $inner_html));
        }
        wp_send_json_error();
    }

    public function mega_menu_script() {
        global $eggnews_version;

        wp_register_script('eggnews-mega-menu', get_template_directory_uri() . '/assets/js/mega-menu.js', array('jquery'), esc_attr($eggnews_version), true);

        $translation_array = array(
            'post_nonce' => wp_create_nonce('mega_menu_post_hover_nonce'),
            'primary_color' => get_theme_mod('eggnews_theme_color', 'rgb( 242, 93, 38 )'),
            'ajax_url' => admin_url('admin-ajax.php'),
        );
        wp_localize_script('eggnews-mega-menu', 'eggnews_mega_menu', $translation_array);
    }

    public function eggnews_primary_menu_filter($args) {

        include_once( 'class-eggnews-walker-nav-menu.php' );

        $args['walker'] = new Eggnews_Walker_Nav_Menu();

        return $args;
    }

    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new Eggnews_Menu();
        }

        return self::$instance;
    }

    function hook_wp_edit_nav_menu_walker() {

        include_once( 'class-eggnews-nav-menu-edit-walker.php' );

        return 'Eggnews_Nav_Menu_Edit_Walker';
    }

    function hook_wp_update_nav_menu_item($menu_id, $menu_item_db_id, $args) {

        //mega menu category
        if (isset($_POST['te_mega_menu_cat'][$menu_item_db_id])) {
            //print_r($_POST);
            update_post_meta($menu_item_db_id, 'te_mega_menu_cat', $_POST['te_mega_menu_cat'][$menu_item_db_id]);
        }
        if (isset($_POST['te_mega_menu_order'][$menu_item_db_id])) {
            //print_r($_POST);
            update_post_meta($menu_item_db_id, 'te_mega_menu_order', $_POST['te_mega_menu_order'][$menu_item_db_id]);
        }
        if (isset($_POST['te_mega_menu_order_by'][$menu_item_db_id])) {
            //print_r($_POST);
            update_post_meta($menu_item_db_id, 'te_mega_menu_order_by', $_POST['te_mega_menu_order_by'][$menu_item_db_id]);
        }
        //mega menu page
        if (isset($_POST['te_mega_menu_page_id'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, 'te_mega_menu_page_id', $_POST['te_mega_menu_page_id'][$menu_item_db_id]);
        }
    }

    /**
     * adds mega menu support
     *
     * @param $items
     * @param string $args
     *
     * @return array
     */
    function hook_wp_nav_menu_objects($items, $args = '') {


        $_items_ref = array();

        $items_buffy = array();


        foreach ($items as &$item) {

            $_items_ref[$item->ID] = $item;

            // fix the down arros + shortcodes
            if (strpos($item->title, '[') === false) {
                
            } else {
                $item->classes[] = 'te-no-down-arrow';
            }

            $te_mega_menu_cat = get_post_meta($item->ID, 'te_mega_menu_cat', true);
            $te_mega_menu_order = get_post_meta( $item->ID, 'te_mega_menu_order', true );
            $te_mega_menu_order_by = get_post_meta( $item->ID, 'te_mega_menu_order_by', true );

            if ($te_mega_menu_cat != '') {
                // a item with a category mega menu
                // the parent item (the one that appears in the main menu)
                $item->classes[] = 'te-menu-item';
                $item->classes[] = 'te-mega-menu';
                $items_buffy[] = $item;

                //create a new mega menu item: - this is just the dropdown menu / not the parrent
                $new_item = $this->generate_wp_post();
                /*
                 * it's a mega menu,
                 * - set the is_mega_menu flag
                 * - alter the last item classes  $last_item
                 * - change the title and url of the current item
                 */
                $new_item->is_mega_menu = true; //this is sent to the menu walkers
                $new_item->menu_item_parent = $item->ID;
                $new_item->url = '';
                $new_item->title = '<div class="te-container-border"><div class="te-mega-grid">';

                $te_render_atts['show_child_cat'] = 10;

                include_once( 'class-eggnews-mega-menu.php' );
                $mega_menu = new Eggnews_Mega_Menu();
                $new_item->title .= $mega_menu->render(
                        array(
                            'limit' => '5',
                            'te_column_number' => 3,
                            'ajax_pagination' => 'next_prev',
                            'category_id' => $te_mega_menu_cat,
                            'show_child_cat' => $te_render_atts['show_child_cat'],
                            'te_ajax_filter_type' => 'te_category_ids_filter',
                            'te_ajax_preloading' => false,
                            'eggnews_order'=> $te_mega_menu_order,
                            'eggnews_order_by'=> $te_mega_menu_order_by,
                        ));
                $new_item->title .= '</div></div>';
                $items_buffy[] = $new_item;
            } else {
                // normal menu item
                $item->classes[] = 'te-menu-item';
                $item->classes[] = 'te-normal-menu';
                $items_buffy[] = $item;
            }

            /**
             * - Because 'current_item_parent' (true/false) item property is not set by wp,
             * we use an additional flag 'te_is_parent' to mark the parent elements of the tree menu
             * - For the moment, the 'te_is_parent' flag is used just by the 'te_walker_mobile_menu'
             * walker of the mobile theme version @see te_walker_mobile_menu
             */
            if (isset($item->menu_item_parent) && 0 !== intval($item->menu_item_parent) && array_key_exists(intval($item->menu_item_parent), $_items_ref)) {
                $_items_ref[intval($item->menu_item_parent)]->te_is_parent = true;


                // WPML FIX!
                // When WPML language switcher is set in menu, on mobile it didn't render right (the first level element did not allow to open its submenu)
            } else if (strpos($item->ID, 'wpml') === 0 && in_array('menu-item-has-children', $item->classes)) {
                if (array_key_exists($item->ID, $_items_ref)) {
                    $_items_ref[$item->ID]->te_is_parent = true;
                }
            }
        } //end foreach
        // we have two header-menu locations and the fist one is the mobile menu
        // the second one is the header menu
        if ($args->theme_location == 'header-menu') {
            $this->is_header_menu_mobile = false;
        }

        return $items_buffy;
    }

    function hook_init() {
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu (Main)', 'eggnews-pro'),
            'top-header' => esc_html__('Top Header Menu', 'eggnews-pro'),
            'footer' => esc_html__('Footer Menu', 'eggnews-pro'),
        ));
    }

    function generate_wp_post() {
        $post = new stdClass;
        $post->ID = 0;
        $post->post_author = '';
        $post->post_date = '';
        $post->post_date_gmt = '';
        $post->post_password = '';
        $post->post_type = 'menu_tes';
        $post->post_status = 'draft';
        $post->to_ping = '';
        $post->pinged = '';
        $post->comment_status = '';
        $post->ping_status = '';
        $post->post_pingback = '';
        //$post->post_category = '';
        $post->page_template = 'default';
        $post->post_parent = 0;
        $post->menu_order = 0;

        return new WP_Post($post);
    }

}

// Here's created the instance of 'Eggnews_Menu' class
Eggnews_Menu::get_instance();


