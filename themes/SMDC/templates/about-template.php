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
        <?php if ( get_row_layout() == 'about_hero' ): ?>
            <?php 
                $about_banner = get_sub_field('about_banner');
            ?>
            <!-- Hero Projects -->
            <section class="property-wrapper d-flex justify-content-end align-items-center flex-column" style="background-image: url('<?php echo esc_url(is_array($about_banner) ? $about_banner['url'] : $about_banner); ?>');">
            </section>
        <?php endif; ?>
    <?php endwhile; ?>

    <!-- Include Goodlife and Goodguy templates here -->
    <?php get_template_part('templates/about/goodlife', 'section'); ?>
    <?php get_template_part('templates/about/goodguy', 'values'); ?>
     <?php get_template_part('templates/about/story', 'section'); ?>

    <?php while ( have_rows('About_Page_Modules') ): the_row(); ?>
        <!-- Awards Listing -->
        <?php if ( get_row_layout() == 'awards_listing' ): ?>
            <?php get_template_part('templates/about/about', 'awards'); ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
            
<?php get_template_part('templates/about/form', 'template'); ?>
<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>