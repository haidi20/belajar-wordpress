<?php
/**
 * Call To Action Widget
 */
if (!class_exists('Eggnews_Call_To_Action')):

    class Eggnews_Call_To_Action extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'eggnews_call_to_action', 'description' => __('Display Call To Action Widget.', 'eggnews-pro'));
            $control_ops = array('width' => 200, 'height' => 250);
            parent::__construct('eggnews_call_to_action', $name = __('Call To Action', 'eggnews-pro'), $widget_ops);
        }

        function form($instance) {

            $eggnews_defaults = array(
                'title' => '',
                'background_image' => '',
                'minimum_height' => 0,
                'enable_parallex' => 1,
                'text' => '',
                'btn_text' => '',
                'btn_link' => '',
                'align' => 'left',
            );

            $instance = wp_parse_args((array) $instance, $eggnews_defaults);
            $title = $instance['title'];
            $background_image = $instance['background_image'];
            $minimum_height = $instance['minimum_height'];
            $enable_parallex = $instance['enable_parallex'];
            $text = $instance['text'];
            $btn_text = $instance['btn_text'];
            $btn_link = $instance['btn_link'];
            $button_align = $instance['align'];
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'eggnews-pro'); ?></label>
                <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" type="text" value="<?php echo esc_attr($title); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('background_image'); ?>"> <?php esc_html_e('Background Image ', 'eggnews-pro'); ?></label>
            <div class="media-uploader" id="<?php echo $this->get_field_id('background_image'); ?>">
                <div class="custom_media_preview">
                    <?php if ($background_image != '') : ?>
                        <img style="max-width:100%;" class="custom_media_preview_default" src="<?php echo esc_url($background_image); ?>"  alt=""/>
                    <?php endif; ?>
                </div>
                <input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id('background_image'); ?>" name="<?php echo $this->get_field_name('background_image'); ?>" value="<?php echo esc_url($background_image); ?>" style="margin-top:5px;" />
                <button class="eggnews_media_upload button" id="<?php echo $this->get_field_id('background_image'); ?>" data-choose="<?php esc_attr_e('Choose an image', 'eggnews-pro'); ?>" data-update="<?php esc_attr_e('Use image', 'eggnews-pro'); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e('Select an Image', 'eggnews-pro'); ?></button>
            </div>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('minimum_height'); ?>"><?php esc_html_e('height in px:', 'eggnews-pro'); ?></label>
                <input id="<?php echo $this->get_field_id('minimum_height'); ?>" min="0" max="2000" name="<?php echo $this->get_field_name('minimum_height'); ?>" class="widefat" type="number" value="<?php echo absint($minimum_height); ?>" />
            <p>
                <label for="<?php echo $this->get_field_id('enable_parallex'); ?>"><?php esc_html_e('Enable Parallex?', 'eggnews-pro'); ?></label>
                <input id="<?php echo $this->get_field_id('enable_parallex'); ?>" name="<?php echo $this->get_field_name('enable_parallex'); ?>"  type="checkbox" <?php checked(1, $enable_parallex, true); ?> value="1" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e('Description', 'eggnews-pro'); ?></label>
                <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea($text); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('btn_text'); ?>"><?php esc_html_e('Button Text:', 'eggnews-pro'); ?></label>
                <input id="<?php echo $this->get_field_id('btn_text'); ?>" name="<?php echo $this->get_field_name('btn_text'); ?>" class="widefat" type="text" value="<?php echo esc_attr($btn_text); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('btn_link'); ?>"><?php esc_html_e('Button URL:', 'eggnews-pro'); ?></label>
                <input id="<?php echo $this->get_field_id('btn_link'); ?>" name="<?php echo $this->get_field_name('btn_link'); ?>" class="widefat" type="text" value="<?php echo esc_url($btn_link); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('align'); ?>"><?php esc_html_e('Text Align:', 'eggnews-pro'); ?></label>
                <select id="<?php echo $this->get_field_id('align'); ?>" name="<?php echo $this->get_field_name('align'); ?>">
                    <option value="left" <?php selected($button_align, 'left'); ?>><?php esc_html_e('Left', 'eggnews-pro'); ?></option>
                    <option value="center" <?php selected($button_align, 'center'); ?>><?php esc_html_e('Center', 'eggnews-pro'); ?></option>
                    <option value="right" <?php selected($button_align, 'right'); ?>><?php esc_html_e('Right', 'eggnews-pro'); ?></option>
                </select>
            </p>
            <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['background_image'] = esc_url_raw($new_instance['background_image']);
            $instance['minimum_height'] = absint($new_instance['minimum_height']);
            $instance['enable_parallex'] = absint($new_instance['enable_parallex']);
            if (current_user_can('unfiltered_html'))
                $instance['text'] = $new_instance['text'];
            else
                $instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text'])));
            $instance['btn_link'] = esc_url_raw($new_instance['btn_link']);
            $instance['btn_text'] = sanitize_text_field($new_instance['btn_text']);
            $instance['align'] = sanitize_text_field($new_instance['align']);
            return $instance;
        }

        function widget($args, $instance) {
            extract($args);
            extract($instance);
            global $post;
            $title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
            $background_image = isset($instance['background_image']) ? $instance['background_image'] : '';
            $minimum_height = isset($instance['minimum_height']) ? $instance['minimum_height'] : 0;
            $enable_parallex = isset($instance['enable_parallex']) ? $instance['enable_parallex'] : 0;
            $text = isset($instance['text']) ? $instance['text'] : '';
            $btn_link = isset($instance['btn_link']) ? $instance['btn_link'] : '';
            $btn_text = isset($instance['btn_text']) ? $instance['btn_text'] : '';
            $align = isset($instance['align']) ? $instance['align'] : 'call-to-action--left';
            $style = '';
            $background_image_style = '';
            $minimum_height_style = '';
            if (!empty($background_image)) {
                $background_image_style = "background-image:url({$background_image});";
            }
            if (!empty($minimum_height)) {
                $minimum_height_style = "height:" . absint($minimum_height) . "px;";
            }
            $background_color = "background-color:" . get_theme_mod('eggnews_theme_color', '#000');
            echo $before_widget;
            ?>
            <div class="callto_action_bg <?php echo ($enable_parallex) ? 'parallex' : ''; ?>" style="<?php echo esc_attr($background_image_style) . esc_attr($minimum_height_style) . $background_color; ?>" >
                <div class="callto_action_wrap  <?php echo esc_attr($align); ?>">
                    <?php if (!empty($title)) : ?>
                        <h3 class="call_to_action_title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($text)) : ?>
                        <div class="eggnews_action_content">
                            <p><?php echo esc_html($text); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($btn_link)) : ?>
                        <a href="<?php echo esc_url($btn_link); ?>" class="bttn"><?php echo esc_html($btn_text); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- </div> -->
            <?php
            echo $after_widget;
        }

    }

endif;
