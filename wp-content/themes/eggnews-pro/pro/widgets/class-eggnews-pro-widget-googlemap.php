<?php
/**
 * Class Eggnews_Weather_Widget
 */
if (!class_exists('Eggnews_Googlemap_Widget')):

    class Eggnews_Googlemap_Widget extends WP_Widget {

        function __construct() {

            $widget_ops = array(
                'classname' => 'eggnews_google_map',
                'description' => __('This widget is to display google map.', 'eggnews-pro'),
                'customize_selective_refresh' => true,
            );
            $control_ops = array(
                'width' => 400,
                'height' => 350,
            );
            parent::__construct('eggnews_google_map', __('EggNews Google Map', 'eggnews-pro'), $widget_ops, $control_ops);
        }

        /* -------------------------------------------------------
         *              Front-end display of widget
         * ------------------------------------------------------- */

        function widget($args, $instance) {
            extract($args);
            $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
            $title = apply_filters('widget_title', $title);
            $address = isset($instance['address']) ? esc_attr($instance['address']) : '';
            $enable_scroll_wheel = isset($instance['enable_scroll_wheel']) ? $instance['enable_scroll_wheel'] : '';
            $zoom = isset($instance['zoom']) ? $instance['zoom'] : '';
            $disable_controls = isset($instance['disable_controls']) ? $instance['disable_controls'] : '';
            $google_api_key = isset($instance['google_api_key']) ? $instance['google_api_key'] : '';

            echo $before_widget;

            if ($title) {
                echo $before_title . $title . $after_title;
            }

            echo do_shortcode("[eggnews_map address=\"$address\" key=\"$google_api_key\" disablecontrols=\"$disable_controls\" zoom=\"$zoom\" enablescrollwheel=\"$enable_scroll_wheel\" ]");

            echo $after_widget;
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = (isset($new_instance['title'])) ? esc_attr($new_instance['title']) : '';
            $instance['address'] = (isset($new_instance['address'])) ? esc_attr($new_instance['address']) : '';
            $instance['enable_scroll_wheel'] = (isset($new_instance['enable_scroll_wheel'])) ? esc_attr($new_instance['enable_scroll_wheel']) : '';
            $instance['zoom'] = (isset($new_instance['zoom'])) ? esc_attr($new_instance['zoom']) : '';
            $instance['disable_controls'] = (isset($new_instance['disable_controls'])) ? esc_attr($new_instance['disable_controls']) : '';
            $instance['google_api_key'] = (isset($new_instance['google_api_key'])) ? esc_attr($new_instance['google_api_key']) : '';

            return $instance;
        }

        function form($instance) {
            $defaults = array(
                'title' => '',
                'width' => '100%',
                'height' => '400px',
                'address' => 'Kathmandu',
                'enable_scroll_wheel' => 1,
                'zoom' => 15,
                'disable_controls' => 0,
                'google_api_key' => '',
            );
            $instance = wp_parse_args((array) $instance, $defaults);
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                           class="widefat"
                           type="text"
                           name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                           value="<?php echo $instance['title']; ?>"/>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php _e('Address', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('address')); ?>"
                           class="widefat"
                           type="text"
                           name="<?php echo esc_attr($this->get_field_name('address')); ?>"
                           value="<?php echo $instance['address']; ?>"/>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('enable_scroll_wheel')); ?>"><?php _e('Enable Scroll Wheel', 'eggnews-pro'); ?>
                    <select name="<?php echo esc_attr($this->get_field_name('enable_scroll_wheel')); ?>"
                            class="widefat"
                            id="<?php echo esc_attr($this->get_field_id('enable_scroll_wheel')); ?>">
                        <option value="1" <?php selected(1, $instance['enable_scroll_wheel']); ?>><?php _e('True', 'eggnews-pro'); ?></option>
                        <option value="0" <?php selected(0, $instance['enable_scroll_wheel']); ?>><?php _e('False', 'eggnews-pro'); ?></option>
                    </select>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('zoom')); ?>"><?php _e('Zoom', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('zoom')); ?>"
                           class="widefat"
                           type="number"
                           name="<?php echo esc_attr($this->get_field_name('zoom')); ?>"
                           value="<?php echo esc_attr($instance['zoom']); ?>"/>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('disable_controls')); ?>"><?php _e('Disable Controls', 'eggnews-pro'); ?>
                    <select name="<?php echo esc_attr($this->get_field_name('disable_controls')); ?>"
                            class="widefat"
                            id="<?php echo esc_attr($this->get_field_id('disable_controls')); ?>">
                        <option value="1" <?php selected(1, $instance['disable_controls']); ?>><?php _e('True', 'eggnews-pro'); ?></option>
                        <option value="0" <?php selected(0, $instance['disable_controls']); ?>><?php _e('False', 'eggnews-pro'); ?></option>
                    </select>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('google_api_key')); ?>"><?php _e('Google API Key', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('google_api_key')); ?>"
                           class="widefat"
                           type="text"
                           name="<?php echo esc_attr($this->get_field_name('google_api_key')); ?>"
                           value="<?php echo esc_attr($instance['google_api_key']); ?>"/>
                </label>
            </p>
            <?php
        }
    }
endif;