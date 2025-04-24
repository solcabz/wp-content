<?php
/*
     Template Name: About Us
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

    <?php wp_head(); ?>
</head>
<body>
<?php get_header(); ?>

<?php if ( have_rows('About_Page_Modules') ): ?>
    <?php while ( have_rows('About_Page_Modules') ): the_row(); ?>
        <?php 
                if ( get_row_layout() == 'about_hero' ): 
                    $about_banner = get_sub_field('about_banner');
        ?>
            <!-- Hero Projects -->
            <section class="property-wrapper d-flex justify-content-end align-items-center flex-column" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 55%), url('<?php echo esc_url(is_array($about_banner) ? $about_banner['url'] : $about_banner); ?>');">

            </section>
        <?php endif ?>

        <!-- End Hero Projects -->    
        <?php if ( get_row_layout() == 'awards_listing' ): ?>
            <?php get_template_part('templates/about', 'awards'); ?>
        <?php endif; ?>
        
    <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('templates/form', 'template'); ?>
<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>