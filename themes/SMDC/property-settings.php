<?php

function register_property_post_type() {
    $labels = array(
        'name'               => 'Properties',
        'singular_name'      => 'Property',
        'menu_name'          => 'Properties',
        'name_admin_bar'     => 'Property',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Property',
        'new_item'           => 'New Property',
        'edit_item'          => 'Edit Property',
        'view_item'          => 'View Property',
        'all_items'          => 'All Properties',
        'search_items'       => 'Search Properties',
        'not_found'          => 'No properties found.',
        'not_found_in_trash' => 'No properties found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'properties'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-admin-home',
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
    );

    register_post_type('property', $args);
}
add_action('init', 'register_property_post_type'); 

// Modify the permalink structure for the 'property' post type
function custom_property_permalink($post_link, $post) {
    if ($post->post_type === 'property') {
        // Get the property segment from the ACF field
        $property_segment = get_field('property_segment', $post->ID);

        // If the segment exists, include it in the permalink
        if ($property_segment) {
            return home_url('properties/' . $property_segment . '/' . $post->post_name);
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'custom_property_permalink', 10, 2);

// Add rewrite rules to handle the custom permalink structure
function custom_property_rewrite_rules() {
    add_rewrite_rule(
        '^properties/([^/]+)/([^/]+)/?$',
        'index.php?property=$matches[2]',
        'top'
    );
}
add_action('init', 'custom_property_rewrite_rules');

// Flush permalinks when the theme is activated to apply the new rules
function flush_rewrite_rules_on_activation() {
    register_property_post_type(); // Ensure the post type is registered
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'flush_rewrite_rules_on_activation');

?>