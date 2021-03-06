<?php
/**
 * Define customizer Custom classes
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

    class Eggnews_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'eggnews-pro' ),
                    'option_none_value' => '',
                    'selected'          => $this->value(),
                )
            );

            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
                $this->label,
                $this->description,
                $dropdown
            );
        }
    }

    /**
     * Image control by radio button
     */
    class Eggnews_Image_Radio_Control extends WP_Customize_Control {

        public function render_content() {

            if ( empty( $this->choices ) )
                return;

            $name = '_customize-radio-' . $this->id;

            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <ul class="controls" id ="eggnews-img-container">
            <?php
                foreach ( $this->choices as $value => $label ) :
                    $class = ($this->value() == $value)?'eggnews-radio-img-selected eggnews-radio-img-img':'travel-radio-img-img';
                    ?>
                    <li style="display: inline;">
                    <label>
                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                        <img src = '<?php echo esc_url( $label ); ?>' class = '<?php echo esc_attr( $class ); ?>'  alt=""/>
                    </label>
                    </li>
                    <?php
                endforeach;
            ?>
            </ul>
            <?php
        }
    }

    /**
     * Customize control for switch option
     */
    class Eggnews_Customize_Switch_Control extends WP_Customize_Control {
        public $type = 'switch';
        public function render_content() {
    ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
                <div class="switch_options">
                    <?php
                        $show_choices = $this->choices;
                        foreach ( $show_choices as $key => $value ) {
                            echo '<span class="switch_part '.$key.'" data-switch="'.$key.'">'. $value.'</span>';
                        }
                    ?>
                    <input type="hidden" id="enable_switch_option" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" />
                </div>
            </label>
    <?php
        }
    }

/**
        * Customize control for icon picker switch option
        * @package Theme Egg
        * @subpackage eggnews-pro
        * @since 1.3.0
    */

    class Eggnews_Icon_Picker_Control extends WP_Customize_Control {
        public $type = 'icon_picker';

        public function render_content() {

            $value = $this->value();
            if ( empty( $value ) ){
                $value = !empty($this->default) ? $this->default: '';
            }

         ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>

                    <div class="eggnews-selected-icon">
                        <i class="<?php echo esc_attr($value);?>"></i>
                        <span><i class="fa fa-angle-down"></i></span>
                    </div>
                    <?php

                    echo '<ul class="eggnews-icon-list eggnews-clearfix">';
                                        $eggnews_fontawesome_social_icons = eggnews_font_awesome_icons();
                                        foreach ($eggnews_fontawesome_social_icons as $eggnews_font_awesome_icon) {

                                            $icon_class = $value == $eggnews_font_awesome_icon ? 'icon-active' : '';
                                            echo '<li class=' . $icon_class . '><i class="' . $eggnews_font_awesome_icon . '"></i></li>';
                                        }
                                        echo '</ul>';
                                        ?>


                    <input id="_customize-input-<?php echo esc_attr( $this->id ); ?>" type="hidden" aria-describedby="_customize-description-<?php echo esc_attr( $this->id );?>" value="<?php echo esc_attr( $value ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id );?>">
            </label>
             <?php
        }
    }

/** A class to add a fontawesome icons selector */
// 
}