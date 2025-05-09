<?php
// Enqueue styles and scripts
function smdc_enqueue_scripts() {
    wp_enqueue_style('smdc-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'smdc_enqueue_scripts');

// Register custom post type and taxonomy
require get_template_directory() . '/property-settings.php';

// Add theme support for post thumbnails
add_theme_support('post-thumbnails');

// Register additional image sizes if needed
add_image_size('property-thumbnail', 300, 200, true);

// Custom function to display properties by category
function smdc_display_properties_by_category($category_slug) {
    $args = array(
        'post_type' => 'property',
        'tax_query' => array(
            array(
                'taxonomy' => 'property_segment',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ),
        ),
    );

    $properties = new WP_Query($args);

    if ($properties->have_posts()) {
        while ($properties->have_posts()) {
            $properties->the_post();
            get_template_part('template-parts/content', 'property-category');
        }
        wp_reset_postdata();
    } else {
        echo '<p>No properties found in this category.</p>';
    }
}
?>