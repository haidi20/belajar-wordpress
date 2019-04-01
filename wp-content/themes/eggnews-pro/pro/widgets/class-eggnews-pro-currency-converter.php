<?php
/**
 * Class Eggnews_Currency_Converter
 */
if (!class_exists('Eggnews_Currency_Converter')):

    class Eggnews_Currency_Converter extends WP_Widget {

        function __construct() {
            #Widget settings
            $widget_ops = array('description' => __('Currency Converter for any currency in the world', 'eggnews-pro'));

            #Widget control settings
            $control_ops = array('width' => 200, 'height' => 550);

            #Create the widget
            parent::__construct('eggnews_currency_converter', __('Currency Converter', 'eggnews-pro'), $widget_ops, $control_ops);
        }

        function print_currency_list($currency_code, $currency_list) {

            foreach ($currency_list as $currency_key => $currency_details) {
                $country_code = $currency_details['country_code'];
                $currency_name = $currency_details['currency_name'];
                ?>
                <option value="<?php echo $currency_key; ?>" <?php selected($currency_code, $currency_key, true); ?>><?php echo $currency_name; ?></option>
                <?php
            }
        }

        function print_thewidth_list($size) {
            $size_list = array("60", "85", "100", "128", "140", "150", "160", "165", "170", "175", "180", "185", "190", "200", "210", "220", "230", "240", "250", "275", "300", "320", "375", "400", "474", "500", "525", "550", "574", "600", "650", "700");
            foreach ($size_list as $isize) {
                ?>
                <option value="<?php echo $isize; ?>" <?php selected($size, $isize, true); ?>><?php echo UCWords($isize); ?></option>
                <?php
            }
        }

        function print_layout_list($type) {

            $type_list = array(
                "horizontal" => "Horizontal",
                "vertical" => "Vertical",
            );
            foreach ($type_list as $key => $ttype) {
                ?>
                <option value="<?php echo $key; ?>" style="background-color:<?php echo $key; ?>" <?php selected($type, $key, true); ?>><?php echo $ttype; ?></option>
                <?php
            }
        }

        function print_textcolor_list($text_color) {

            $color_list = array(
                "#FF0000" => "Red",
                "#CC033C" => "Crimson",
                "#FF6F00" => "Orange",
                "#FFCC00" => "Gold",
                "#009000" => "Green",
                "#00FF00" => "Lime",
                "#0000FF" => "Blue",
                "#000090" => "Navy",
                "#FE00FF" => "Indigo",
                "#F99CF9" => "Pink",
                "#900090" => "Purple",
                "#000000" => "Black",
                "#FFFFFF" => "White",
                "#DDDDDD" => "Grey",
                "#666666" => "Gray"
            );

            foreach ($color_list as $key => $tcolor) {
                $white_text = "";
                if ($key == "#000000" OR $key == "#000090" OR $key == "#666666" OR $key == "#0000FF")
                    $white_text = ';color:#FFFFFF ';
                ?>
                <option value="<?php echo $key; ?>" style="background-color:<?php echo $key . $white_text; ?>" <?php selected($text_color, $key, true); ?>><?php echo $tcolor; ?></option>
                <?php
            }
        }

        function print_thelength_list($size) {
            $size_list = array("short", "medium");

            foreach ($size_list as $isize) {
                ?>
                <option value="<?php echo $isize; ?>" <?php selected($size, $isize, true); ?>><?php echo UCWords($isize); ?></option>
                <?php
            }
        }

        function print_bordercolor_list($text_color) {

            $color_list = array(
                "#FF0000" => "Red",
                "#CC033C" => "Crimson",
                "#FF6F00" => "Orange",
                "#FFCC00" => "Gold",
                "#009000" => "Green",
                "#a0c030" => "Dark Green",
                "#00FF00" => "Lime",
                "#963939" => "Brown",
                "#C69633" => "Brass",
                "#0000FF" => "Blue",
                "#000090" => "Navy",
                "#FE00FF" => "Indigo",
                "#F99CF9" => "Pink",
                "#900090" => "Purple",
                "#000000" => "Black",
                "#FFFFFF" => "White",
                "#DDDDDD" => "Grey",
                "#BBBBBB" => "Dark Grey",
                "#666666" => "Gray",
                "#F6F9F9;" => "Silver"
            );


            foreach ($color_list as $key => $tcolor) {
                $white_text = "";
                if ($key == "#000000" OR $key == "#000090" OR $key == "#666666" OR $key == "#0000FF")
                    $white_text = ';color:#FFFFFF ';
                ?>
                <option value="<?php echo $key; ?>" style="background-color:<?php echo $key . $white_text; ?>" <?php selected($text_color, $key, true); ?>><?php echo $tcolor; ?></option>
                <?php
            }
        }

        function print_backgroundcolor_list($text_color) {

            $color_list = array(
                "#FF0000" => "Red",
                "#CC033C" => "Crimson",
                "#FF6F00" => "Orange",
                "#F9F99F" => "Golden",
                "#FFFCCC" => "Almond",
                "#F6F6CC" => "Beige",
                "#209020" => "Green",
                "#209020" => "Green",
                "#c3e44f" => "Light Green",
                "#963939" => "Brown",
                "#00FF00" => "Lime",
                "#99CCFF" => "Light Blue",
                "#000090" => "Navy",
                "#FE00FF" => "Indigo",
                "#F99CF9" => "Pink",
                "#993CF3" => "Violet",
                "#000000" => "Black",
                "#FFFFFF" => "White",
                "#DDDDDD" => "Grey",
                "#666666" => "Gray",
                "#F6F9F9;" => "Silver");

            foreach ($color_list as $key => $tcolor) {
                $white_text = "";
                if ($key == "#000000" OR $key == "#000090" OR $key == "#666666" OR $key == "#0000FF")
                    $white_text = ';color:#FFFFFF ';
                ?>
                <option value="<?php echo $key; ?>" style="background-color:<?php echo $key . $white_text; ?>" <?php selected($text_color, $key, true); ?>><?php echo $tcolor; ?></option>
                <?php
            }
        }

        function update($new_instance, $old_instance) {

            if (empty($currency_list)) {
                $file_location = dirname(__FILE__) . "/data/currencies.ser";
                if ($fd = fopen($file_location, 'r')) {
                    $currency_list_ser = fread($fd, filesize($file_location));
                    fclose($fd);
                    $currency_list = unserialize($currency_list_ser);
                } else {
                    $currency_list = array();
                }
            }

            $instance = $old_instance;

            $instance['currency_code'] = strip_tags(stripslashes($new_instance['currency_code']));
            $currency_code = $instance['currency_code'];
            $instance['currency_name'] = isset($currency_list[$currency_code]['currency_name']) ? strip_tags(stripslashes($currency_list[$currency_code]['currency_name'])): '';

            $instance['country_code'] = isset($currency_list[$currency_code]['currency_code']) ? strip_tags(stripslashes($currency_list[$currency_code]['country_code'])): '';
            /* $instance['title'] =  strip_tags(stripslashes($instance['currency_name'])) ; */
            $instance['title'] = isset($currency_list[$currency_code]['currency_title']) ?strip_tags(stripslashes($instance['title'])): '';
            $instance['currency_name'] = strip_tags(stripslashes($instance['currency_name']));
            $instance['length'] = strip_tags(stripslashes($new_instance['length']));
            $instance['label_type'] = isset($currency_list[$currency_code]['label_type']) ?strip_tags(stripslashes($new_instance['label_type'])): '';
            $instance['background_color'] = strip_tags(stripslashes($new_instance['background_color']));
            $instance['border_color'] = strip_tags(stripslashes($new_instance['border_color']));
            $instance['text_color'] = strip_tags(stripslashes($new_instance['text_color']));
            $instance['layout'] = strip_tags(stripslashes($new_instance['layout']));
            $instance['width'] = isset($currency_list[$currency_code]['width']) ?strip_tags(stripslashes($new_instance['width'])): '';
            $instance['default_amount'] = strip_tags(stripslashes($new_instance['default_amount']));
            $instance['default_from'] = strip_tags(stripslashes($new_instance['default_from']));
            $instance['default_to'] = strip_tags(stripslashes($new_instance['default_to']));
            $instance['transparentflag'] = isset($currency_list[$currency_code]['transparentflag']) ?strip_tags(stripslashes($new_instance['transparentflag'])): '';
            $instance['tflag'] =isset($currency_list[$currency_code]['tflag']) ? strip_tags(stripslashes($new_instance['tflag'])) : '';

            //return $instance;

            return $new_instance;
        }

        function form($instance) {

            if (empty($currency_list)) {
                $file_location = dirname(__FILE__) . "/data/currencies.ser";
                if ($fd = fopen($file_location, 'r')) {
                    $currency_list_ser = fread($fd, filesize($file_location));
                    fclose($fd);
                }

                $currency_list = array();
                $currency_list = unserialize($currency_list_ser);
            }


            $defaults = array(
                'currency_code' => '',
                'currency_name' => '',
                'title' => 'Euro',
                'country_code' => '',
                'layout' => 'vertical',
                'length' => 'medium',
                'width' => '150',
                'default_amount' => '100',
                'default_from' => 'USD',
                'default_to' => 'EUR',
                'text_color' => '#000000',
                'border_color' => '#BBBBBB',
                'background_color' => '#FFFFFF',
                'transparentflag' => '0',
                'tflag' => '0'
            );


            /* if(!isset($instance['layout']))
              $instance = $defaults; */

            $instance = wp_parse_args($instance, $defaults);


            // Extract value from vars
            $currency_code = htmlspecialchars($instance['currency_code'], ENT_QUOTES);
            $currency_name = htmlspecialchars($instance['currency_name'], ENT_QUOTES);
            /* $title = $currency_name; */
            $title = htmlspecialchars($instance['title'], ENT_QUOTES);
            $country_code = htmlspecialchars($instance['country_code'], ENT_QUOTES);
            $length = htmlspecialchars($instance['length'], ENT_QUOTES);
            $layout = htmlspecialchars($instance['layout'], ENT_QUOTES);
            $width = htmlspecialchars($instance['width'], ENT_QUOTES);
            $default_amount = htmlspecialchars($instance['default_amount'], ENT_QUOTES);
            $default_from = htmlspecialchars($instance['default_from'], ENT_QUOTES);
            $default_to = htmlspecialchars($instance['default_to'], ENT_QUOTES);
            $text_color = htmlspecialchars($instance['text_color'], ENT_QUOTES);
            $border_color = htmlspecialchars($instance['border_color'], ENT_QUOTES);
            $background_color = htmlspecialchars($instance['background_color'], ENT_QUOTES);
            $transparentflag = htmlspecialchars($instance['transparentflag'], ENT_QUOTES);
            $tflag = htmlspecialchars($instance['tflag'], ENT_QUOTES);
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', 'eggnews-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" type="text"/>
            </p>
            <p><label for="<?php echo $this->get_field_id('currency_code') ?>"><?php _e('Currency :', 'eggnews-pro'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('currency_code'); ?>" name="<?php echo $this->get_field_name('currency_code'); ?>">
                    <option value=""><?php _e('Set default currency', 'eggnews-pro'); ?></option>
                    <?php $this->print_currency_list($currency_code, $currency_list); ?>
                </select>
            </p>
            <p><label for="<?php echo $this->get_field_id('layout') ?>"><?php _e('Layout :', 'eggnews-pro'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
                    <?php $this->print_layout_list($layout); ?>
                </select>
            </p>

            <?php if (empty($currency_code) && $layout != "horizontal") { ?>
                <p><label for="<?php echo $this->get_field_id('length') ?>"><?php _e('Length :', 'eggnews-pro'); ?></label>
                    <select class="widefat" id="<?php echo $this->get_field_id('length'); ?>" name="<?php echo $this->get_field_name('length'); ?>">
                        <?php $this->print_thelength_list($length); ?>
                    </select>
                </p>
            <?php } ?>
            <?php /* ?>
              <p><label for="<?php echo $this->get_field_id( 'width' ) ?>"><?php _e('Width :', 'eggnews-pro'); ?></label>
              <select class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>">
              <?php $this->print_thewidth_list($width); ?>
              </select>
              </p>
              <?php */ ?>

            <p>
                <label for="<?php echo $this->get_field_id('default_amount'); ?>"><?php _e('Default Amount :', 'eggnews-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('default_amount'); ?>" name="<?php echo $this->get_field_name('default_amount'); ?>" value="<?php echo $default_amount; ?>" type="number"/>
            </p>

            <?php if (empty($currency_code)) { ?>
                <p><label for="<?php echo $this->get_field_id('default_to') ?>"><?php _e('To Currency :', 'eggnews-pro'); ?></label>
                    <select class="widefat" id="<?php echo $this->get_field_id('default_to'); ?>" name="<?php echo $this->get_field_name('default_to'); ?>">
                        <option value="">Choose currency</option>
                        <?php $this->print_currency_list($default_to, $currency_list); ?>
                    </select>
                </p>
            <?php } else { ?>
                <p>
                    <label for="<?php echo $this->get_field_id('default_to'); ?>"><?php _e('Default To', 'eggnews-pro'); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id('default_to'); ?>" name="<?php echo $this->get_field_name('default_to'); ?>" value="<?php echo $default_to; ?>" type="text">
                </p>
            <?php } ?>

            <p><label for="<?php echo $this->get_field_id('default_from') ?>"><?php _e('From Currency :', 'eggnews-pro'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('default_from'); ?>" name="<?php echo $this->get_field_name('default_from'); ?>">
                    <option value="">Choose currency</option>
                    <?php $this->print_currency_list($default_from, $currency_list); ?>
                </select>
            </p>

            <p><label for="<?php echo $this->get_field_id('text_color') ?>"><?php _e('Text Color :', 'eggnews-pro'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>">
                    <option value="">Choose currency</option>
                    <?php $this->print_textcolor_list($text_color); ?>
                </select>
            </p>


            <p><label for="<?php echo $this->get_field_id('border_color') ?>"><?php _e('Header Color :', 'eggnews-pro'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>">
                    <?php $this->print_bordercolor_list($border_color); ?>
                </select>
            </p>

            <p><label for="<?php echo $this->get_field_id('background_color') ?>"><?php _e('Background Color :', 'eggnews-pro'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>">
                    <?php $this->print_backgroundcolor_list($background_color); ?>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('transparentflag'); ?>"><?php _e('Transparent: ', 'eggnews-pro'); ?></label>
                <input id="<?php echo $this->get_field_id('transparentflag'); ?>" name="<?php echo $this->get_field_name('transparentflag'); ?>" value="1" <?php checked(1, $transparentflag, true); ?> type="checkbox"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('tflag'); ?>"><?php _e('Widget Title & fx-rate Link: ', 'eggnews-pro'); ?></label>
                <input id="<?php echo $this->get_field_id('tflag'); ?>" name="<?php echo $this->get_field_name('tflag'); ?>" value="1" <?php checked(1, $tflag, true); ?> type="checkbox"/>
            </p>
            <?php
        }

        function widget($args, $instance) {
            // Get values
            extract($args);

            // Extract value from vars
            $currency_code = isset($instance['currency_code']) ? htmlspecialchars($instance['currency_code'], ENT_QUOTES) : '';
            $currency_name = isset($instance['currency_name']) ? htmlspecialchars($instance['currency_name'], ENT_QUOTES) : '';
            ;
            $title = $currency_name;
            $country_code = isset($instance['currency_name']) ? (htmlspecialchars($instance['country_code'], ENT_QUOTES) ) : '';
            $layout = isset($instance['layout']) ? htmlspecialchars($instance['layout'], ENT_QUOTES) : '';
            $length = isset($instance['length']) ? htmlspecialchars($instance['length'], ENT_QUOTES) : '';
            $width = isset($instance['width']) ? htmlspecialchars($instance['width'], ENT_QUOTES) : '';
            $default_amount = isset($instance['default_amount']) ? htmlspecialchars($instance['default_amount'], ENT_QUOTES) : '';
            $default_from = isset($instance['default_from']) ? htmlspecialchars($instance['default_from'], ENT_QUOTES) : '';
            $default_to = isset($instance['default_to']) ? htmlspecialchars($instance['default_to'], ENT_QUOTES) : '';
            $text_color = isset($instance['text_color']) ? htmlspecialchars($instance['text_color'], ENT_QUOTES) : '';
            $border_color = isset($instance['border_color']) ? htmlspecialchars($instance['border_color'], ENT_QUOTES) : '';
            $background_color = isset($instance['background_color']) ? htmlspecialchars($instance['background_color'], ENT_QUOTES) : '';
            $transparentflag = isset($instance['transparentflag']) ? htmlspecialchars($instance['transparentflag'], ENT_QUOTES) : '';
            $tflag = isset($instance['tflag']) ? htmlspecialchars($instance['tflag'], ENT_QUOTES) : '';

            if ($transparentflag == "1") {
                $background_color = "";
                $border_color = "";
            }

            if ($currency_code)
                $length = "medium";

            $text_color = str_replace("#", "", $text_color);


            // Output calculator

            $widget_call_string = 'https://fx-rate.net/wp_converter.php?';
            if ($currency_code)
                $widget_call_string .= 'currency=' . $currency_code . "&";
            $widget_call_string .= "size=" . $length;
            $widget_call_string .= "&layout=" . $layout;
            $widget_call_string .= "&amount=" . $default_amount;
            $widget_call_string .= "&tcolor=" . $text_color;
            if (!empty($default_from))
                $widget_call_string .= "&default_pair=" . $default_from . "/" . $default_to;

            $country_code = strtolower($country_code);
            $plugin_url = trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
            $image_url = $plugin_url . '/countries/' . $country_code . '.png';

            $calc_label = strtoupper(substr($layout, 0, 1));
            if ($length == "short")
                $calc_label .= "S";

            $flag_string = '';
            $flag_string2 = '';
            if ($currency_code) {
                $target_url = "https://fx-rate.net/$currency_code/";
                $flag_string = '<img style="margin:0;padding:0;border:0;" alt="" src="' . $image_url . '" border=0 >&nbsp;<b>';
                $flag_string2 = '</b>';
                $title = UCWords($currency_name) . " Converter";
                $calc_label .= "1";
            } else {

                $target_url = "https://fx-rate.net/";
                $title = "Currency Converter";
            }

            $tsize = 12;
            if ($layout == "vertical" && $length == "short")
                $tsize = 10;

            if ($tflag != 1) {
                $noscript_start = "<noscript>";
                $noscript_end = "</noscript>";
            }

            #
            #		OUTPUT HTML
            #

        echo $before_widget;

            if ($title) {
                echo $before_title . $title . $after_title;
            }
            ?>
            <div class="eggnews_currenty_currency_wraper" style="/*width:<?php echo $width; ?>px;*/ background-color:<?php echo $background_color; ?>;">
                <?php echo $noscript_start; ?>
                <div class="title-wrap" style="background-color:<?php echo $border_color; ?>;">
                    <a class="<?php echo $calc_label; ?>label" style="font-size:<?php echo $tsize; ?>px!important;color:#<?php echo $text_color; ?>;" href="<?php echo $target_url; ?>">
                        <?php
                        echo $flag_string . $title . $flag_string2;
                        ?>
                    </a>
                </div>
                <?php echo $noscript_end; ?>
                <script type="text/javascript" src="<?php echo $widget_call_string; ?>"></script>
            </div>
            <?php echo $after_widget; ?>
            <?php
        }

    }

endif;