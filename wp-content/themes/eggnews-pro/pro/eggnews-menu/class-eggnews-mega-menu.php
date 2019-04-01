<?php

/**
 * this short code does not have the map function so it dosn't appear in the mega menu @see te_global_blocks::te_vc_map_all
 * Class Eggnews_Mega_Menu
 */
class Eggnews_Mega_Menu {

    function render($atts, $content = null) {

        $buffy_categories = '';

        $shortcode_atts = shortcode_atts(
                array(
            'limit' => 5,
            'sort' => '',
            'category_id' => '',
            'category_ids' => '',
            'custom_title' => '',
            'custom_url' => '',
            'show_child_cat' => '', //the child category number
            'sub_cat_ajax' => '' //empty we use ajax
                ), $atts);

        extract($shortcode_atts);


        if (!empty($show_child_cat) and ! empty($category_id)
        ) {

            $get_categories_args = array(
                'child_of' => $category_id,
                'number' => 1
            );


            // check for subcats existence
            $te_subcats = get_categories($get_categories_args);

            if (!empty($te_subcats)) {
                $atts['limit'] = 4; //alter the loop because we don't have space now with the categories
            }
        }

        $get_block_sub_cats = $this->get_mega_menu_subcategories($atts);

        $additional_classes = array();

        //we have subcategories
        if ($get_block_sub_cats !== false) {
            $buffy_categories .= '<div class="te_mega_menu_sub_cats">';
            //get the sub category filter for this block
            $buffy_categories .= $get_block_sub_cats;
            $buffy_categories .= '</div>';
        } else {
            $additional_classes [] = 'te-no-subcats';
        }


        $this->load_megamenu_script();

        $buffy = ''; //output buffer

        $buffy .= '<div class="teg-classes">';

        //add the categories IF we have some
        $buffy .= $buffy_categories;

        $buffy .= '<div class="te_block_inner">';

        $buffy .= $this->inner($category_id);

        $buffy .= '</div>';

        $buffy .= '<div class="clearfix"></div>';

        $buffy .= '</div> <!-- ./block1 -->';

        return $buffy;
    }

    function load_megamenu_script() {
        wp_enqueue_script('eggnews-mega-menu');
    }

    function inner($category_id, $is_ajax = false) {
        global $post;

        $buffy = '';
        $category_post = new WP_Query(array(
            'posts_per_page' => 4,
            'cat' => $category_id,
            'post_type' => 'post',
            'ignore_sticky_posts' => true,
            'orderby' => 'rand',
            'no_found_rows' => true,
        ));
        $featured = 'eggnews-featured-medium';

        $mega_id = ( $is_ajax ) ? $category_id : 0;
        $buffy .= '<div class="te-mega-row active" data-mega-id="' . $mega_id . '">';
        while ($category_post->have_posts()):$category_post->the_post();
            $buffy .= '<div class="te-mega-post">';
?>
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
                $buffy .= $image;
            }
            $buffy .= '<div class="article-content">';
            ob_start();
            do_action('eggnews_post_categories');
            $buffy .= ob_get_clean();
            $buffy .= '<h3 class="entry-title">';
            $buffy .= '<a href="' . get_the_permalink() . '" >' . get_the_title() . '</a>';
            $buffy .= '</h3></div></div>';

        endwhile;
        $buffy .= '</div>';
        // Reset Post Data
        wp_reset_query();

        return $buffy;
    }

    /**
     * gets the mega menu subcategories - it works on $atts (NOT ON $this->atts ) because we have to modify the $atts (limit 4 if we have subcategories or limit 5 if we don't)
     *
     * @param $atts
     *
     * @return bool|string
     */
    function get_mega_menu_subcategories($atts) {


        $eggnews_shortcode_atts = shortcode_atts(
                array(
            'eggnews_order' => '',
            'eggnews_order_by' => '',
            'limit' => 5,
            'sort' => '',
            'category_id' => '',
            'category_ids' => '',
            'custom_title' => '',
            'custom_url' => '',
            'show_child_cat' => '5',
            //the child category number - if none is specify, extract just 5 @since 11.june.2015
            'sub_cat_ajax' => ''
                //empty we use ajax
                ), $atts);
        extract($eggnews_shortcode_atts);
        $buffy = '';

        if (!empty($show_child_cat) and ! empty($category_id)) {
            $get_categories_args = array(
                'child_of' => $category_id,
                'number' => $show_child_cat,
            );
            if ($eggnews_order) {
                $get_categories_args['order'] = $eggnews_order;
            }
            if ($get_categories_args) {
                $get_categories_args['order_by'] = $eggnews_order_by;
            }
            $te_subcategories = get_categories($get_categories_args);

            // $te_mega_menu_order = get_post_meta( $item->ID, 'te_mega_menu_order', true );
            //$te_mega_menu_order_by = get_post_meta( $item->ID, 'te_mega_menu_order_by', true );

            if (!empty($te_subcategories)) {

                $buffy .= '<div class="block-mega-child-cats">';

                //show all categories only on ajax
                if (empty($sub_cat_ajax)) {
                    $buffy .= '<a class="cur-sub-cat mega-menu-sub-cat"  data-cat-id="0" href="' . get_category_link($category_id) . '">' . esc_html('All', 'eggnews-pro') . '</a>';
                }

                foreach ($te_subcategories as $te_category) {
                    $buffy .= '<a class="mega-menu-sub-cat"   data-cat-id="' . $te_category->cat_ID . '" href="' . get_category_link($te_category->cat_ID) . '">' . $te_category->name . '</a>';
                }


                $buffy .= '</div>';
            } else {
                //there are no subcategories, return false - this is used by the mega menu block to alter it's structure
                return false;
            }
        }

        return $buffy;
    }

}

//te_global_blocks::add_lazy_shortcode('Eggnews_Mega_Menu');

