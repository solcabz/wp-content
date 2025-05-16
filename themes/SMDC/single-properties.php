<title><?php single_term_title(); ?> - <?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
<?php get_header(); ?>

<h1>Properties</h1>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <?php 
        if (have_rows('Properties_Module')): // Check if the flexible content field has rows
            while (have_rows('Properties_Module')): the_row();
                
                if (get_row_layout() == 'property_banner'): 
                    $property_banner = get_sub_field('property-image');
        ?>

        <!-- Hero Projects -->
        <section class="property-wrapper d-flex justify-content-end align-items-center flex-column" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 55%), url('<?php echo esc_url(is_array($property_banner) ? $property_banner['url'] : $property_banner); ?>');">

            <div class="property-search container-lg d-flex justify-content-center align-items-center p-5">
                <div class="custom-select-wrapper">
                    <div class="custom-select-container">
                        <select class="custom-select">
                            <option value="" disabled selected>Search Location</option>
                            <option value="option1-1">Option 1</option>
                            <option value="option1-2">Option 2</option>
                            <option value="option1-3">Option 3</option>
                            <option value="option1-4">Option 4</option>
                        </select>
                    </div>

                    <div class="custom-select-container">
                        <select class="custom-select">
                            <option value="" disabled selected>Select Type of Property</option>
                            <option value="option2-1">Option 1</option>
                            <option value="option2-2">Option 2</option>
                            <option value="option2-3">Option 3</option>
                            <option value="option2-4">Option 4</option>
                        </select>
                    </div>

                    <div class="custom-select-container">
                        <select class="custom-select">
                            <option value="" disabled selected>Select Price Range</option>
                            <option value="option3-1">Option 1</option>
                            <option value="option3-2">Option 2</option>
                            <option value="option3-3">Option 3</option>
                            <option value="option3-4">Option 4</option>
                        </select>
                    </div>

                    <button class="property-btn">Search</button>
                </div>
            </div>
        </section>

        <!-- Latest Projects -->
        <section class="property-projects">
            <div class="header-property">
                <h1>Latest Projects</h1>
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
            </div>

            <div class="d-flex justify-content-center align-items-center flex-wrap text-center gap-5 p-3 ">
                <!-- Add your property cards here -->
            </div>
        </section>

        <!-- HRB Projects -->
        <section class="hrb-property d-flex flex-column justify-content-center align-items-center flex-wrap text-center gap-5">
            <div class="header-property">
                <h1>HIGH-RISE BUILDINGS</h1>
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
            </div>

            <div class="d-flex justify-content-center align-items-center text-start flex-wrap gap-5 px-3 py-5">
                <!-- Add your HRB property cards here -->
            </div>
        </section>

        <!-- MRB Projects -->
        <section class="d-flex flex-column justify-content-center align-items-center flex-wrap gap-5" style="background: #D9D9D9;">
            <div class="header-property">
                <h1>MID-RISE BUILDINGS</h1>
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
            </div>

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-5 px-3 py-5 ">
                <!-- Add your MRB property cards here -->
            </div>
        </section>

        <!-- ECHO Projects -->
        <section class="d-flex flex-column justify-content-center align-items-center flex-wrap gap-5">
            <div class="header-property">
                <h1>HOUSE AND LOT</h1>
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
            </div>

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-5 px-3 py-5">
                <!-- Add your ECHO property cards here -->
            </div>
        </section>

        <?php get_template_part('templates/form', 'template'); ?>

        <?php 
                endif; // End layout check
            endwhile; // End flexible content loop
        else: 
        ?>
            <p>No content available.</p>
        <?php endif; ?>

    <?php endwhile; // End of the loop. ?>
<?php else : ?>
    <p>No properties found in the HRB segment.</p>
<?php endif; ?>

<?php get_footer(); ?>
<?php wp_footer(); ?>