<?php
//error_reporting(E_ERROR);
if (!class_exists('Eggnews_Youtube_Playlist')):

    class Eggnews_Youtube_Playlist extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'eggnews_youtube_playlist', 'description' => 'Displays a list of videos from youtube playlist using Google API.');
            parent::__construct('eggnews_youtube_playlist', __('Youtube Playlist', 'eggnews-pro'), $widget_ops);
        }

        function form($instance) {
            $instance = wp_parse_args((array) $instance, array('title' => __('Youtube Playlist', 'eggnews-pro')));
            $title = isset($instance['title']) ? $instance['title'] : __('Youtube Playlist', 'eggnews-pro');
            $api_key = isset($instance['api_key']) ? $instance['api_key'] : '';
            $playlist_id = isset($instance['playlist_id']) ? $instance['playlist_id'] : '';
            $show_max = isset($instance['show_max']) ? $instance['show_max'] : '';
            $layout = isset($instance['layout']) ? $instance['layout'] : '';
            ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('api_key'); ?>">Google API Key: <input class="widefat" id="<?php echo $this->get_field_id('api_key'); ?>" name="<?php echo $this->get_field_name('api_key'); ?>" type="text" value="<?php echo esc_attr($api_key); ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('playlist_id'); ?>">Youtube Playlist ID: <input class="widefat" id="<?php echo $this->get_field_id('playlist_id'); ?>" name="<?php echo $this->get_field_name('playlist_id'); ?>" type="text" value="<?php echo esc_attr($playlist_id); ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('show_max'); ?>">Show Max Videos: <input class="widefat" id="<?php echo $this->get_field_id('show_max'); ?>" name="<?php echo $this->get_field_name('show_max'); ?>" type="text" value="<?php echo esc_attr($show_max); ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('text'); ?>">Layout: <select class='widefat' id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>" type="text"><option value=''<?php echo ($layout == null) ? 'selected' : ''; ?>>-- Select --</option><option value='v'<?php echo ($layout == 'v') ? 'selected' : ''; ?>>Vertical</option><option value='h'<?php echo ($layout == 'h') ? 'selected' : ''; ?>>Horizontal</option></select></label></p>
            <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['api_key'] = $new_instance['api_key'];
            $instance['playlist_id'] = $new_instance['playlist_id'];
            $instance['show_max'] = $new_instance['show_max'];
            $instance['layout'] = $new_instance['layout'];
            return $instance;
        }

        function widget($args, $instance) {

            extract($args, EXTR_SKIP);

            echo $before_widget;
            $title = isset($instance['title']) ? esc_html($instance['title']) : '';
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $title);

            if (!empty($title))
                echo $before_title . $title . $after_title;

            $apiKey = isset($instance['api_key']) ? esc_html($instance['api_key']) : '';

            $playListId = isset($instance['playlist_id']) ? esc_html($instance['playlist_id']) : '';

            $videoCount = isset($instance['show_max']) ? absint($instance['show_max']) : '';

            $format = isset($instance['layout']) ? esc_attr($instance['layout']) : '';

            /**
             * Call the function to process the playlist code for widget
             */
            $this->processPlaylist($apiKey, $playListId, $videoCount, 50, $format);

            echo $after_widget;
        }

        /**
         * Function to process the playlist
         *
         * @param string $key        Google API Key
         * @param string $listId     Youtube Playlist ID
         * @param int    $userVidCnt User defined video count
         * @param int    $maxCnt     Maximum count allowed by youtube
         * @param string $pageLayout Playlist layout to show
         */
        function processPlaylist($key, $listId, $userVidCnt, $maxCnt, $pageLayout) {

            $videosList = $this->getVideos($userVidCnt, $listId, $key, false, '');
            if ($userVidCnt <= $maxCnt) {
                $videosList = $this->getVideos($userVidCnt, $listId, $key, false, '');
                $this->displayVideoList($videosList, $pageLayout);
            } else {
                $counter = 0;
                while ($userVidCnt > 0) {
                    if ($counter == 0) {
                        $videosList = $this->getVideos($userVidCnt, $listId, $key, false, '');
                        $this->displayVideoList($videosList, $pageLayout);
                    } else {
                        if ($userVidCnt > $maxCnt) {
                            $videosList = $this->getVideos($maxCnt, $listId, $key, true, $nextToken);
                        } else {
                            $videosList = $this->getVideos($userVidCnt, $listId, $key, true, $nextToken);
                        }
                        $this->displayVideoList($videosList, $pageLayout);
                    }
                    $counter++;
                    $videoCount = $videoCount - $maxCnt;
                    $nextToken = $videosList['nextPageToken'];
                }
            }
        }

        /**
         * function to get videos for the said playlist ID
         *
         * @param int    $maxVideos  Maximum number of videos to fetch
         * @param string $playListId Public youtube playlist ID
         * @param string $apiKey     Google API Key
         *
         * @return array List of youtube videos data
         */
        function getVideos($maxVideos, $playListId, $apiKey, $isNext, $nextToken) {
            // Open CURL connection.
            $ch = curl_init();

            if ($isNext) {
                $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=' . $maxVideos . '&playlistId=' . $playListId . '&key=' . $apiKey . '&pageToken=' . $nextToken;
            } else {
                $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=' . $maxVideos . '&playlistId=' . $playListId . '&key=' . $apiKey;
            }

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, false);
            //curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-Type: application/json');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Execute request
            $result = curl_exec($ch);

            // Close connection
            curl_close($ch);

            // get the result and parse to JSON
            $result_arr = json_decode($result, true);
            return $result_arr;
        }

        /**
         * Function to display list of youtube videos
         *
         * @param array $collection Parsed data from youtube
         *
         * @return null
         */
        function displayVideoList($collection, $pageFormat) {
            $layoutClass = '';
            if ($pageFormat == 'h') {
                $layoutClass = 'horizontal';
            }

            if (isset($collection['error'])) {
                echo '<p style="color:red;font-weight:bold;">An error occurred:</p>';
                echo '<p style="color:red; font-size:12px;">' . $collection['error']['message'] . '</p>';
            } else {
                echo '<ul class="youtube-playlist ' . $layoutClass . '">';
                foreach ($collection['items'] as $i => $listItems) {
                    $vIds = $listItems['snippet']['resourceId']['videoId'];
                    $vTitle = $listItems['snippet']['title'];
                    $videoThumb = $listItems['snippet']['thumbnails']['medium']['url'];
                    $videoURL = 'https://www.youtube.com/watch?v=' . $vIds;
                    echo '<li><div class="thumbnail-wrap"><img src="' . $videoThumb . '" alt=""/><a class="play" data-video_id="' . $vIds . '" target="_blank" href="' . $videoURL . '" title="' . $vTitle . '">Watch</a></div><p>' . $vTitle . '</p></li>';
                }
                echo '</ul>';
            }
        }

    }
endif;