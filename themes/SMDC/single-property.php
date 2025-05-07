<?php wp_head(); ?>
<?php get_header(); ?>

<!-- Breadcrumbs Section -->
<div class="breadcrumbs">
    <a href="<?php echo home_url(); ?>">Home</a> &raquo;
    <a href="<?php echo home_url('/properties'); ?>">Properties</a> &raquo;
    <span><?php the_title(); ?></span>
</div>

<section class="property-section">
    <div class="property-detail-wrapper">
        <div class="property-info">
        <?php 
            // Fetch the Hero Image from the ACF group field
            $hero_group = get_field('hero'); // Get the 'hero' group
            $property_icon_url = !empty($hero_group['property_icon']) ? esc_url($hero_group['property_icon']['url']) : 'path/to/default-image.jpg';
        ?>
            <img src="<?php echo $property_icon_url; ?>" alt="" class="property-icon">
            <h1 class="property-title"><?php the_title(); ?></h1>
            <?php 
                // Fetch the About Property group field
                $about_property = get_field('about_property'); // Get the 'about_property' group
                $property_description = !empty($about_property['description']) ? $about_property['description'] : 'No description available.';
            ?>
            <p class="property-description">
                    
            </p>
            <a class="virtual-tour-btn">
                360 Virtual Tour
            </a>
        </div>
        <div class="property-meta">
            <div class="meta-item">
                <span class="meta-icon">📍</span>
                <span class="meta-text"><?php the_field('location'); // ACF field for location ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-icon">💰</span>
                <span class="meta-text"><?php the_field('price_range'); // ACF field for price range ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-icon">🏠</span>
                <span class="meta-text"><?php the_field('units'); // ACF field for units ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-icon">✨</span>
                <span class="meta-text"><?php the_field('amenities'); // ACF field for amenities ?></span>
            </div>
        </div>
    </div>

    <?php 
        // Fetch the Hero Image from the ACF group field
        $hero_group = get_field('hero'); // Get the 'hero' group
        $hero_image = $hero_group['hero_image']; // Access the 'hero_image' subfield
    ?>
    <div class="property-hero-image" style="background-image: url('<?php echo esc_url($hero_image['url']); ?>');">
    </div>
</section>

<?php get_footer(); ?>
<?php wp_footer(); ?>
