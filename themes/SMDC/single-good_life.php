<?php wp_head(); ?>
<?php get_header(); ?>

<?php  
  $news_group = get_field('news_hero'); // Get the 'News' group
  $news_image = $news_group['news_image'];
  $news_sub_headline = $news_group['sub_headline']; 
?>
<section class="news-banner" style="background-image: linear-gradient(to bottom, rgba(46, 24, 95, 0.29) 30%, rgba(25, 24, 109, 0) 55%), url('<?php echo esc_url($news_image['url']); ?>');">
  <div class="news-heading">
    <h1><?php the_title(); ?></h1>
    <h5><?php echo esc_html($news_sub_headline); ?></h5>
  </div>
</section>

<?php get_footer(); ?>
<?php wp_footer(); ?>