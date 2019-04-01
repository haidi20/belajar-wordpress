<?php
/**
 * Class Eggnews_Weather_Widget
 */
if (!class_exists('Eggnews_Weather_Widget')):

    class Eggnews_Weather_Widget extends WP_Widget {

        function __construct() {

            $widget_ops = array(
                'classname' => 'eggnews_weather',
                'description' => __('This widget is to display weather.', 'eggnews-pro'),
                'customize_selective_refresh' => true,
            );
            $control_ops = array(
                'width' => 400,
                'height' => 350,
            );
            parent::__construct('eggnews_weather', __('EggNews Weather', 'eggnews-pro'), $widget_ops, $control_ops);
        }

        /* -------------------------------------------------------
         *        Front-end display of widget
         * ------------------------------------------------------- */

        function widget($args, $instance) {

            extract($args);
            $title = isset($instance['title']) ? $instance['title'] : '';
            $title = apply_filters('widget_title', $title);
            $location_weather_id = isset($instance['location_weather_id']) ? $instance['location_weather_id'] : '';
            $location_weather_city = isset($instance['location_weather_city']) ? $instance['location_weather_city'] :'';
            $location_weather_country = isset($instance['location_weather_country']) ? $instance['location_weather_country'] :'';
            $location_weather_days = isset($instance['location_weather_days']) ? $instance['location_weather_days'] : '';

            echo $before_widget;


            $output = '';
            if ($title) {
                echo $before_title . $title . $after_title;
            }
            $output .= '<div class="eggnews-weather-widget">';
            $output .= '<div id="eggnews-weather-' . $location_weather_id . '"></div>';
            $output .= '</div><!--/#widget-->';
            $output .= "<script>

        /*
         * Location weather
         */
         jQuery(document).ready(function() {
                loadWeatherWidget$location_weather_id('$location_weather_city','$location_weather_country'); //@params location, woeid
            });

            function loadWeatherWidget$location_weather_id(location, woeid) {
                jQuery.simpleWeather({
                    location: location,
                    woeid: woeid,
                    unit: 'c',
                    success: function(weather) {
                      var forcast_days = parseInt($location_weather_days);
                      html = '<ul class=\"current-weather\" style=\"background-image:url(\''+weather.image+'\');\">';
                      html += '<li><h6>'+weather.city+' Today</h5></li>';
                      html += '<li>'+weather.temp+' '+weather.units.temp+'</li>';
                      html += '<li>'+weather.currently+'</li>';
                      html += '<li>High: '+weather.high+'| Low: '+weather.low+'</li>';
                      html += '<li>Humidity: '+weather.humidity+'</li>';
                      html += '<li>Visbility: '+weather.visibility+'</li>';
                      html += '<li>Sunrise: '+weather.sunrise+'</li>';
                      html += '<li>Sunset: '+weather.sunset+'</li>';
                      html += '</ul>';
                      if(forcast_days){
                          for(var i=0;i<weather.forecast.length;i++) {
                            if( forcast_days <= i ){
                                break;
                            }
                            html += '<div class=\"eggnews-weather-days\">';
                                html += '<figure>';
                                html += '<img src=\"'+weather.forecast[i].thumbnail+'\" alt=\"\"/>';
                                html += '</figure>';
                                html += '<ul class=\"forcast-day day-'+i+'\">';
                                html += '<li>'+weather.forecast[i].day+'</li>';
                                html += '<li>'+weather.forecast[i].date+'</li>';
                                html += '<li>'+weather.forecast[i].text+'</li>';
                                html += '<li>High: '+weather.forecast[i].high +' Low: '+ weather.forecast[i].low +'</li>';
                                html += '</ul>';
                            html += '</div>';
                          }
                      }

                      jQuery('#eggnews-weather-$location_weather_id').html(html);

                    },
                    error: function(error) {
                      jQuery('#eggnews-weather-$location_weather_id').html('<p>'+error.message+'</p>');
                    }
                  });
                }
            </script>";


            echo $output;

            echo $after_widget;
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['location_weather_id'] = strip_tags($new_instance['location_weather_id']);
            $instance['location_weather_city'] = strip_tags($new_instance['location_weather_city']);
            $instance['location_weather_country'] = strip_tags($new_instance['location_weather_country']);
            $instance['location_weather_days'] = absint($new_instance['location_weather_days']);

            return $instance;
        }

        function form($instance) {
            $defaults = array(
                'title' => '',
                'location_weather_id' => 1,
                'location_weather_city' => 'london',
                'location_weather_country' => 'uk',
                'location_weather_days' => 0
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
                    for="<?php echo esc_attr($this->get_field_id('location_weather_id')); ?>"><?php _e('ID', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('location_weather_id')); ?>"
                           class="widefat"
                           type="text"
                           name="<?php echo esc_attr($this->get_field_name('location_weather_id')); ?>"
                           value="<?php echo $instance['location_weather_id']; ?>"/>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('location_weather_city')); ?>"><?php _e('City', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('location_weather_city')); ?>"
                           class="widefat"
                           type="text"
                           name="<?php echo esc_attr($this->get_field_name('location_weather_city')); ?>"
                           value="<?php echo esc_attr($instance['location_weather_city']); ?>"/>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('location_weather_country')); ?>"><?php _e('Country', 'eggnews-pro'); ?>
                    <input id="<?php echo esc_attr($this->get_field_id('location_weather_country')); ?>"
                           class="widefat"
                           type="text"
                           name="<?php echo esc_attr($this->get_field_name('location_weather_country')); ?>"
                           value="<?php echo esc_attr($instance['location_weather_country']); ?>"/>
                </label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('location_weather_days')); ?>"><?php _e('Forecast Days:', 'eggnews-pro'); ?>
                    <Select id="<?php echo esc_attr($this->get_field_id('location_weather_days')); ?>"
                            class="widefat"
                            name="<?php echo esc_attr($this->get_field_name('location_weather_days')); ?>">
                                <?php
                                $forecast_days = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
                                foreach ($forecast_days as $no_of_days) {
                                    ?>
                            <option value="<?php echo $no_of_days; ?>" <?php selected($no_of_days, $instance['location_weather_days'], true); ?>><?php echo $no_of_days; ?></option>
                            <?php
                        }
                        ?>
                    </Select>
                </label>
            </p>
            <?php
        }
    }
endif;