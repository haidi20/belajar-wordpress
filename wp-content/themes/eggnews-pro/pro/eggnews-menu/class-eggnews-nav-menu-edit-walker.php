<?php

class Eggnews_Nav_Menu_Edit_Walker extends Walker_Nav_Menu_Edit {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {


		$control_buffy = '';

		//read the menu setting from post meta (menu id, key, single)
		$te_mega_menu_cat     = get_post_meta( $item->ID, 'te_mega_menu_cat', true );
		$te_mega_menu_page_id = get_post_meta( $item->ID, 'te_mega_menu_page_id', true );

		//make the tree
		$te_category_tree = array_merge( array( ' - Not mega menu - ' => '' ), Eggnews_Utils::get_category2id_array( false ) );

		//make a new ui control ( dropdown )
		$control_buffy .= '<p class="description description-wide"><br><br>';
		$control_buffy .= '<label>';
		$control_buffy .= 'Make this a category mega menu';
		$control_buffy .= '</label>';
		$control_buffy .= '<select name="te_mega_menu_cat[' . $item->ID . ']" id="" class="widefat code edit-menu-item-url">';
		foreach ( $te_category_tree as $category => $category_id ) {
			$control_buffy .= '<option value="' . $category_id . '"' . selected( $te_mega_menu_cat, $category_id, false ) . '>' . $category . '</option>';
		}
		$control_buffy .= ' </select>';
		$control_buffy .= '</p>';

		$control_settings = '<div class="eggnews_megamenu_settings">';
		$control_settings .= '<span class="eggnews_toggle">' . esc_html__( 'Settings', 'eggnews-pro' ) . '</span>';
		$control_settings .= '<div class="eggnews_megamenu_settings_wraper">';

		$te_mega_menu_order_by = get_post_meta( $item->ID, 'te_mega_menu_order_by', true );
		$control_settings .= '<p>';
		$control_settings .= '<label>' . esc_html__( 'Order By', 'eggnews-pro' ) . '</label><br/>';
		$control_settings .= '<select name="te_mega_menu_order_by[' . $item->ID . ']" class="widefat code edit-menu-item-url">';
		$control_settings .= '<option value="asc" ' . selected( $te_mega_menu_order_by, 'asc', false ) . '>' . esc_html__( 'ASC', 'eggnews-pro' ) . '</opton>';
		$control_settings .= '<option value="desc" ' . selected( $te_mega_menu_order_by, 'desc', false ) . '>' . esc_html__( 'DESC', 'eggnews-pro' ) . '</opton>';
		$control_settings .= '</select>';
		$control_settings .= '</p>';

		$te_mega_menu_order = get_post_meta( $item->ID, 'te_mega_menu_order', true );
		$control_settings .= '<p>';
		$control_settings .= '<label>' . esc_html__( 'Order', 'eggnews-pro' ) . '</label><br/>';
		$control_settings .= '<select name="te_mega_menu_order[' . $item->ID . ']" class="widefat code edit-menu-item-url">';
		$control_settings .= '<option value="name" ' . selected( $te_mega_menu_order, 'name', false ) . '>' . esc_html__( 'Name', 'eggnews-pro' ) . '</opton>';
		$control_settings .= '<option value="id" ' . selected( $te_mega_menu_order, 'id', false ) . '>' . esc_html__( 'ID', 'eggnews-pro' ) . '</opton>';
		$control_settings .= '</select>';
		$control_settings .= '</p>';
		$control_settings .= '</div>';
		$control_settings .= '</div>';

		$control_buffy .= $control_settings;

		/*$control_buffy .= '<br>OR<br>';

		//make a new ui control ( dropdown )
		$control_buffy .= '<p class="description description-wide">';

		$control_buffy .= '<label>';
		$control_buffy .= 'Load a page in the menu (enter the page ID)';
		$control_buffy .= '</label><br>';
		$control_buffy .= '<input name="te_mega_menu_page_id[' . $item->ID . ']" type="text" value="' . $te_mega_menu_page_id . '" />';
		$control_buffy .= '<span class="te-wpa-info"><strong>Just a tip:</strong> If you choose to load a mega menu or a page, please do not add submenus to this item. The mega menu and mega page menu have to be the top most menu item. <a href="http://forum.tagdiv.com/menus-newsmag/" target="_blank">Read more</a></span>';


		$control_buffy .= '</p>';*/


		//run the parent and add in $buffy (byref) our code via regex
		$buffy = '';
		parent::start_el( $buffy, $item, $depth, $args, $id );
		$buffy = preg_replace( '/(?=<div.*submitbox)/', $control_buffy, $buffy );


		$output .= $buffy;
	}
}
