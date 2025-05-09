<?php
get_header(); ?>

<div class="property-category">
    <h1><?php single_cat_title(); ?></h1>
    <div class="property-list">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', 'property-category');
            endwhile;
        else :
            echo '<p>No properties found in this category.</p>';
        endif;
        ?>
    </div>
</div>

<?php
get_footer();
?>