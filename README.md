Here's a `README.md` file that clearly explains the process of registering a classic WordPress widget, using your code as a practical example:

---

# Classic Widget Plugin

This plugin demonstrates how to create and register a **classic WordPress widget**, which restores the traditional widget interface in WordPress (before the block-based widget editor was introduced).

---

## 🧩 What is a Classic Widget?

Classic widgets in WordPress are defined by extending the `WP_Widget` class and registering them via `register_widget()`. This is useful for themes or sites that prefer the old widget experience or want to build custom sidebar components.

---

## ✅ Features

- Registers a custom widget called **Author Bio Classic**
- Adds content to the sidebar using traditional `widget()` output
- Clean and minimal structure for learning or extending

---

## 🛠️ How Widget Registration Works in WordPress

1. **Extend the WP_Widget class**
2. **Define widget output using `widget()`**
3. _(Optionally)_ Add `form()` for admin interface and `update()` for saving options
4. **Register the widget using `register_widget()` inside `widgets_init` hook**

---

## 📂 Plugin Structure

```
classic-widget/
│
├── classic-widget.php   ← Main plugin file
└── readme.md             ← You are here!
```

---

## 📌 Code Explanation

Below is an annotated explanation of how the code works:

---

### 1. Plugin Header

```php
/*
Plugin Name: Classic Widget
Description: Restores the classic WordPress widgets interface.
Version: 1.0.0
Author: Your Name
License: GPL2
*/
```

This block provides essential metadata that WordPress reads when displaying the plugin in the admin dashboard.

---

### 2. Security Check

```php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
```

This prevents direct access to the file via browser by ensuring it runs only within WordPress.

---

### 3. Constants

```php
define('CLASSIC_WIDGET_DIR', plugin_dir_path(__FILE__));
define('CLASSIC_WIDGET_URL', plugin_dir_url(__FILE__));
```

Defines useful constants for referencing plugin directory and URL in future development.

---

### 4. Creating a Custom Widget Class

```php
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
        echo "Author bio Classic";
        echo $args['after_title'];
        ?>
        <p>Welcome to classic widget</p>
        <?php
        echo $args['after_widget'];
    }

    // Optional: Admin form and update handler
    // function form($instance) {}
    // function update ($new_instance, $old_instance) {}
}
```

This is where you define your widget:

- `__construct()` sets widget ID, name, and description.
- `widget()` outputs frontend HTML for the widget.
- `form()` and `update()` (commented out) can be added to manage widget settings in admin.

---

### 5. Plugin Bootstrapping Class

```php
class CLASSIC_WIDGET
{
    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'load_dependencies']);
        add_action('init', [$this, 'init']);
        add_action('widgets_init', [$this, 'register_classic_widgets']);
    }

    function load_dependencies() {
        // Placeholder for future file includes
    }

    function init() {
        // Placeholder for future hooks
    }

    function register_classic_widgets()
    {
        register_widget('Author_Bio');
    }
}
```

This class sets up the plugin:

- Hooks into WordPress lifecycle (`plugins_loaded`, `init`, and `widgets_init`)
- Registers the widget using `register_widget('Author_Bio')`

---

### 6. Initialize the Plugin

## Summary

```php
new CLASSIC_WIDGET();
```

Instantiates the main plugin class, so all the hooks are active.

---

## ✅ Usage

1. Place this plugin in your `wp-content/plugins` directory inside a folder called `classic-widget/`.
2. Activate it from **WordPress Admin > Plugins**.
3. Go to **Appearance > Widgets** and look for **Author Bio Classic**.
4. Drag and drop into a sidebar.

---

## 📝 Notes

- This example is intentionally simple.
- You can expand the widget by adding form fields and saving settings via `form()` and `update()`.
- Compatible with WordPress classic widget interface.

---

## 📜 License

GPL-2.0-or-later

---

```
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
```
