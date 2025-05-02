<?php

function my_theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . "/style.css", array(), '2.1', 'all');
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function script_register() {
    wp_enqueue_script('script', get_template_directory_uri() . '/script.js', array(), '2.1', true);
}

add_action('wp_enqueue_scripts', 'script_register');

function menu_option() {
    register_nav_menu('primary', 'Primary Menu');
    register_nav_menu('secondary', 'Secondary Menu');
    register_nav_menu('tertiary', 'Tertiary Menu');
    
}

add_action('after_setup_theme', 'menu_option');

function enqueue_bootstrap() {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

    // Enqueue Bootstrap JS (with dependency on jQuery, though Bootstrap 5 does not require it)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

function enqueue_all_styles() {
    $theme_dir = get_template_directory_uri();
    $style_dir = get_template_directory() . '/assets/style/';

    // Check if directory exists
    if (is_dir($style_dir)) {
        foreach (glob($style_dir . '*.css') as $file) {
            $filename = basename($file);
            wp_enqueue_style("custom-$filename", $theme_dir . "/assets/style/$filename", array(), filemtime($file));
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_all_styles');

function enqueue_cookie_script() {
    wp_enqueue_script('custom-cookie', get_template_directory_uri() . '/assets/script/cookie.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_cookie_script');

function enqueue_recaptcha_script() {
    wp_enqueue_script(
        'google-recaptcha',
        'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit',
        [],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_recaptcha_script');

add_filter('document_title_separator', function() {
    return '-';
});

add_theme_support('title-tag');

add_action('wp_ajax_load_award_page', 'load_award_page');
add_action('wp_ajax_nopriv_load_award_page', 'load_award_page');

function load_award_page() {
    if (isset($_GET['tab']) && isset($_GET['page'])) {
        $tab = intval($_GET['tab']);
        $page = intval($_GET['page']);
        
        // Fetch and display the awards for the given tab and page
        // Use similar logic to what you already have, but only for the requested tab/page
        // Send back the generated content
        echo get_award_content_for_tab_page($tab, $page);
    }
    wp_die(); // Important to terminate the request properly
}

require_once get_template_directory() . '/theme-settings.php';require_once get_template_directory() . '/theme-settings.php';


