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

<?php while ( have_posts() ) : the_post(); ?>

    <?php 
    if ( have_rows('About_Module') ): // Check if the flexible content field has rows
        while ( have_rows('About_Module') ): the_row();
            
            if ( get_row_layout() == 'about_hero' ): 
                $about_banner = get_sub_field('about_banner');
    ?>

<!-- hero about -->
<section class="property-wrapper d-flex justify-content-end align-items-center flex-column" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 55%), url('<?php echo esc_url(is_array($about_banner) ? $about_banner['url'] : $about_banner); ?>');>

</section>

<!-- Vision & Mission -->
<section class="">

</section>

<!-- Values -->
<section class="">

</section>

<!-- story -->
<section class="">

</section>

<!-- Executive -->
<section class="">

</section>

<!-- Awards Citation -->
<section class="">

</section>

<?php get_template_part('templates/form', 'template'); ?>

<?php 
            endif; // End layout check
        endwhile; // End flexible content loop
    else: 
    ?>
        <p>No content available.</p>
  <?php endif; ?>



<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
<?php wp_footer(); ?>