<?php
// filepath: c:\Users\solomon.cabreza\Local Sites\smdc\app\public\wp-content\themes\SMDC\template-parts\content-property-category.php

// Get the current category
$current_category = get_queried_object();

// Query properties in the current category
$args = array(
    'post_type' => 'property',
    'tax_query' => array(
        array(
            'taxonomy' => 'property_segment',
            'field'    => 'slug',
            'terms'    => $current_category->slug,
        ),
    ),
);

$properties = new WP_Query($args);

if ($properties->have_posts()) : ?>
    <div class="property-category">
        <h1><?php echo esc_html($current_category->name); ?> Properties</h1>
        <div class="property-list">
            <?php while ($properties->have_posts()) : $properties->the_post(); ?>
                <div class="property-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="property-thumbnail">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="property-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php else : ?>
    <p>No properties found in this category.</p>
<?php endif;

wp_reset_postdata();
?>