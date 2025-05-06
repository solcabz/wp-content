
<?php wp_head(); ?>
<?php get_header(); ?>
<div class="property-page">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="property-thumbnail">
            <?php the_post_thumbnail('large'); ?>
        </div>
        <div class="property-content">
            <?php the_content(); ?>
        </div>

        <!-- Custom Fields Example -->
        <div class="property-meta">
            <p><strong>Type:</strong> <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
            <p><strong>Location:</strong> <?php echo get_post_meta(get_the_ID(), 'location', true); ?></p>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
<?php wp_footer(); ?>
