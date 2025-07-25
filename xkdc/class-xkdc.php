<?php

class CWXKDC extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('xkdc', 'XKDC Daily Comic', [
            'description' => "Classic XKDC Widget",

        ]);
    }


    function widget($args, $instance)
    {
        // Fetch comic data
        $url = 'https://xkcd.com/info.0.json';
        $response = wp_remote_get($url);

        // Check for error
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();

            // Optionally: log or display user-friendly message
            echo $args['before_widget'];
            echo $args['before_title'] . 'Error' . $args['after_title'];
            echo '<p>Could not load comic: ' . esc_html($error_message) . '</p>';
            echo $args['after_widget'];
            return;
        }

        // Get and decode the response body
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        echo $args['before_widget'];
        echo $args['before_title'] . 'Daily XKCD Comic' . $args['after_title'];

        if (!empty($data->img)) {
            ?>
            <div style="text-align:center;">
                <img src="<?php echo esc_url($data->img); ?>" alt="<?php echo esc_attr($data->title); ?>" style="max-width:100%;">
                <p><?php echo esc_html($data->title); ?></p>
            </div>
            <?php
        } else {
            echo '<p>Comic data unavailable.</p>';
        }

        echo $args['after_widget'];
    }

}




