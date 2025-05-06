<?php

function register_good_life_post_type() {
    $labels = array(
        'name'               => 'The Good Life',
        'singular_name'      => 'The Good Life Item',
        'menu_name'          => 'The Good Life',
        'name_admin_bar'     => 'The Good Life Item',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Good Life Item',
        'new_item'           => 'New Good Life Item',
        'edit_item'          => 'Edit Good Life Item',
        'view_item'          => 'View Good Life Item',
        'all_items'          => 'All Good Life Items',
        'search_items'       => 'Search Good Life Items',
        'not_found'          => 'No Good Life items found.',
        'not_found_in_trash' => 'No Good Life items found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'the-good-life'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-smiley',
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
    );

    register_post_type('good_life', $args);
}
add_action('init', 'register_good_life_post_type');

// Register custom taxonomy for The Good Life categories
function register_good_life_categories() {
    $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Categories',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'good-life-category'),
    );

    register_taxonomy('good_life_category', array('good_life'), $args);

    // Add default categories
    $default_categories = array(
        'Events and Promotions',
        'Health and Wellness',
        'In The News',
        'Investment and Security',
        'Testimonials',
    );

    foreach ($default_categories as $category) {
        if (!term_exists($category, 'good_life_category')) {
            wp_insert_term($category, 'good_life_category');
        }
    }
}
add_action('init', 'register_good_life_categories');
?>