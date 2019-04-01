<?php

class Eggnews_Utils {

    private static $td_category2id_array_walker_buffer = array();

    static function get_category2id_array($add_all_category = true) {

        if (is_admin() === false) {
            return array();
        }

        if (empty(self::$td_category2id_array_walker_buffer)) {
            $categories = get_categories(array(
                'hide_empty' => 0,
                'number' => 1000
                    ));

            $td_category2id_array_walker = new td_category2id_array_walker;
            $td_category2id_array_walker->walk($categories, 4);
            self::$td_category2id_array_walker_buffer = $td_category2id_array_walker->td_array_buffer;
        }


        if ($add_all_category === true) {
            $categories_buffer['- All categories -'] = '';

            return array_merge(
                    $categories_buffer, self::$td_category2id_array_walker_buffer
            );
        } else {
            return self::$td_category2id_array_walker_buffer;
        }
    }

    static function strpos_array($haystack_string, $needle_array, $offset = 0) {
        foreach ($needle_array as $query) {
            if (strpos($haystack_string, $query, $offset) !== false) {
                return true; // stop on first true result
            }
        }

        return false;
    }

}

//end class Eggnews_Utils

class td_category2id_array_walker extends Walker {

    var $tree_type = 'category';
    var $db_fields = array('parent' => 'parent', 'id' => 'term_id');
    var $td_array_buffer = array();

    function start_lvl(&$output, $depth = 0, $args = array()) {
        
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        
    }

    function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
        $this->td_array_buffer[str_repeat(' - ', $depth) . $category->name . ' - [ id: ' . $category->term_id . ' ]'] = $category->term_id;
    }

    function end_el(&$output, $page, $depth = 0, $args = array()) {
        
    }

}

/*  ----------------------------------------------------------------------------
  mbstring support - if missing from host
 */
if (!function_exists('mb_strlen')) {

    function mb_strlen($string, $encoding = '') {
        return strlen($string);
    }

}
if (!function_exists('mb_strpos')) {

    function mb_strpos($haystack, $needle, $offset = 0) {
        return strpos($haystack, $needle, $offset);
    }

}
if (!function_exists('mb_strrpos')) {

    function mb_strrpos($haystack, $needle, $offset = 0) {
        return strrpos($haystack, $needle, $offset);
    }

}
if (!function_exists('mb_strtolower')) {

    function mb_strtolower($string) {
        return strtolower($string);
    }

}
if (!function_exists('mb_strtoupper')) {

    function mb_strtoupper($string) {
        return strtoupper($string);
    }

}
if (!function_exists('mb_substr')) {

    function mb_substr($string, $start, $length, $encoding = '') {
        return substr($string, $start, $length);
    }

}
if (!function_exists('mb_convert_encoding')) {

    function mb_convert_encoding($string, $to_encoding = '', $from_encoding = '') {
        return htmlspecialchars_decode(utf8_decode(htmlentities($string, ENT_QUOTES | ENT_HTML5, 'utf-8', false)));
    }

}

if (!function_exists('eggnews_wp_nav_menu_args')) {
    function eggnews_wp_nav_menu_args($args) {
        $args['menu_class'] = $args['menu_class'] . ' ' . 'teg_mega_menu';
        return $args;
    }
}
add_filter('wp_nav_menu_args', 'eggnews_wp_nav_menu_args', 10, 1);
