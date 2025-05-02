<?php

 /* 
 Template Name: News
  */
?>
  

<?php wp_head(); ?>
<?php get_header(); ?>

<section class="news-banner" style="background-image: linear-gradient(to bottom, rgba(46, 24, 95, 0.29) 30%, rgba(25, 24, 109, 0) 55%), url('<?php echo get_template_directory_uri(); ?>/assets/image/Twin Residences Central Gazebo.jpg');">
  <div class="news-heading">
    <h1>heading</h1>
    <h5>sub heading</h5>
  </div>
</section>

<?php get_footer(); ?>
<?php wp_footer(); ?>