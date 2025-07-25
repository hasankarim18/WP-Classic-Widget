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
        $title = esc_html($instance['title']);
        $title = apply_filters('widget_author_bio_title', $title);
        $bio = esc_html($instance['bio']);
        $bio = apply_filters('widget_author_bio', $bio);


        echo $args['before_widget'];
        echo $args['before_title'];
        echo $title;
        echo $args['after_title'];
        ?>
        <p>
            <?php echo nl2br($bio); ?>
        </p>
        <?php
        echo $args['after_widget'];
    }

    function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $bio = !empty($instance['bio']) ? $instance['bio'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input value="<?php echo $title; ?>" type="text" id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>">
        </p>
        <p>
            <label style="display: block;" for="<?php $this->get_field_id('bio'); ?>">
                Bio
            </label>
            <textarea style="width:100%; " id="<?php echo $this->get_field_id('bio'); ?>"
                name="<?php echo $this->get_field_name('bio') ?>">
                                                                <?php echo esc_attr($bio); ?>
                                                            </textarea>
        </p>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = [];
        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['bio'] = !empty($new_instance['bio']) ? sanitize_textarea_field($new_instance['bio']) : '';



        return $instance;
    }
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