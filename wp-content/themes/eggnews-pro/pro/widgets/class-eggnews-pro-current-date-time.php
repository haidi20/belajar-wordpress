<?php
/**
 * Class Eggnews_Date_Time
 */
if (!class_exists('Eggnews_Current_Date_Time')):

    class Eggnews_Current_Date_Time extends WP_Widget {

        function __construct() {

            $widget_ops = array(
                'classname' => 'eggnews_date_time',
                'description' => __('This widget is to display date and time.', 'eggnews-pro'),
                'customize_selective_refresh' => true,
            );
            $control_ops = array(
                'width' => 400,
                'height' => 350,
            );

            parent::__construct('eggnews_date_time', __('Date and Time', 'eggnews-pro'), $widget_ops, $control_ops);
        }

        function widget($args, $instance) {

            extract($args);
            $title = isset($instance['title']) ? $instance['title'] : '';
            $title = apply_filters('widget_title', $title);
            $timezone = isset($instance['timezone']) ? $instance['timezone'] : 'Asia/Kathmandu';
            $format = isset($instance['format']) ? $instance['format'] : 'l, F j, g:i a';
            date_default_timezone_set($timezone);
            $currentDate = date($format);
            echo $before_widget;
            if (!empty($title)) {
                echo $before_title . $title . $after_title;
            }
            echo '<p id="current-date-time">' . $currentDate . '</p>';
            echo $after_widget;
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['timezone'] = strip_tags($new_instance['timezone']);
            $instance['format'] = strip_tags($new_instance['format']);
            return $instance;
        }

        function form($instance) {

            $title = (isset($instance['title'])) ? esc_attr($instance['title']) : '';
            $timezone = (isset($instance['timezone'])) ? esc_attr($instance['timezone']) : 'Asia/Kathmandu';
            $format = (isset($instance['format'])) ? esc_attr($instance['format']) : 'l, F j, g:i a';
            ?>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                           class="widefat"
                           type="text"
                           name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                           value="<?php echo esc_attr($title); ?>"/>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('timezone')); ?>"><?php _e('Time Zone', 'eggnews-pro'); ?>
                    <select id="<?php echo esc_attr($this->get_field_id('timezone')); ?>"
                            class="widefat"
                            name="<?php echo esc_attr($this->get_field_name('timezone')); ?>">
                                <?php
                                $php_time_zones = timezone_identifiers_list();
                                foreach ($php_time_zones as $time_zone_single) {
                                    ?>
                            <option value="<?php echo $time_zone_single; ?>" <?php selected($timezone, $time_zone_single, true); ?>><?php echo $time_zone_single; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('format')); ?>"><?php _e('Date Format', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('format')); ?>"
                           class="widefat"
                           type="text"
                           name="<?php echo esc_attr($this->get_field_name('format')); ?>"
                           value="<?php echo esc_attr($format); ?>"/>
                </label>
            </p>
            <?php
        }

    }

endif;