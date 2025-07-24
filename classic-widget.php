<?php
/*
Plugin Name: Classic Widget
Description: Restores the classic WordPress widgets interface.
Version: 1.0.0
Author: Your Name
License: GPL2
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('CLASSIC_WIDGET_DIR', plugin_dir_path(__FILE__));
define('CLASSIC_WIDGET_URL', plugin_dir_url(__FILE__));


class Author_Bio extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('author_bio', 'Author Bio Classic', [
            'description' => "Classic Author Bio Widget",
        ]);
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo "Author bio widget";
        echo $args['after_title'];
        ?>
        <p>Welcome to classic widget</p>
        <?php
        echo $args['after_widget'];
    }

    // function form($instance)
    // {
    // }

    // function update ($new_instance, $old_instance)
    // {
    // }
}


class CLASSIC_WIDGET
{
    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'load_dependencies']);
        add_action('init', [$this, 'init']);
        add_action('widgets_init', [$this, 'register_classic_widgets']);

    }

    function load_dependencies()
    {

    }

    function init()
    {

    }

    function register_classic_widgets()
    {
        register_widget('Author_Bio');

    }

}


new CLASSIC_WIDGET();