<title><?php single_term_title(); ?> - <?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
<?php
get_header(); ?>

<h1>Properties in HRB Segment</h1>

<?php if (have_posts()) : ?>
    <div class="property-list">
        <?php while (have_posts()) : the_post(); ?>
            <div class="property-item">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                <?php endif; ?>
                <p><?php the_excerpt(); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <p>No properties found in the HRB segment.</p>
<?php endif; ?>

<?php get_footer(); ?>
<?php wp_footer(); ?>