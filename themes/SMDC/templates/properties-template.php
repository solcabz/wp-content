<?php

 /* 
 Template Name: Properties

  */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>
<body>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php 
    if ( have_rows('Properties_Module') ): // Check if the flexible content field has rows
        while ( have_rows('Properties_Module') ): the_row();
            
            if ( get_row_layout() == 'property_banner' ): 
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
            <div class="property-card">
                <h3>HIGH RISE BUILDINGS (CONDOMINIUM)</h3>
                <div class="image-container">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/lh1.png" alt="" class="zoom-in">
                </div>
                <div>
                    <h5>GOLD RESIDENCES</h5>
                    <p>Parañaque City</p>
                    <p>₱6.8M - 15.7M</p>
                </div>
                <p>As SMDC’s first township, Gold Residences was built to exemplify the gold standard in modern living. This condominium across NAIA Terminal 1 stands in a 11.6 hectare master-planned community in which modernization, innovation, and prestige converge.</p>
                <button>VIEW PROPERTY</button>
            </div>
            <div class="property-card">
                <h3>MID-RISE BUILDINGS (CONDOMINIUM)</h3>
                <div class="image-container">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/lm2.png" alt="" class="zoom-in">
                </div>
                <div>
                    <h5>GOLD RESIDENCES</h5>
                    <p>Parañaque City</p>
                    <p>₱6.8M - 15.7M</p>
                </div>
                <p>As SMDC’s first township, Gold Residences was built to exemplify the gold standard in modern living. This condominium across NAIA Terminal 1 stands in a 11.6 hectare master-planned community in which modernization, innovation, and prestige converge.</p>
                <button>VIEW PROPERTY</button>
            </div>
            <div class="property-card">
                <h3>SYMPHONY HOMES (HOUSE AND LOT)</h3>
                <div class="image-container">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/le3.png" alt="" class="zoom-in">
                </div>
                <div>
                    <h5>GOLD RESIDENCES</h5>
                    <p>Parañaque City</p>
                    <p>₱6.8M - 15.7M</p>
                </div>
                <p>As SMDC’s first township, Gold Residences was built to exemplify the gold standard in modern living. This condominium across NAIA Terminal 1 stands in a 11.6 hectare master-planned community in which modernization, innovation, and prestige converge.</p>
                <button>VIEW PROPERTY</button>
            </div>
        </div>
    </section>

     <!-- HRB Projects -->
      <Section class="hrb-property d-flex flex-column justify-content-center align-items-center flex-wrap text-center gap-5">
            <div class="header-property">
                <h1>HIGH-RISE BUILDINGS</h1>
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
            </div>

            <div class="d-flex justify-content-center align-items-center text-start flex-wrap gap-5 px-3 py-5">
                <div class="prop-wrapper dark" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/h1.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
                <div class="prop-wrapper dark" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/h2.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
                <div class="prop-wrapper dark" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/h3.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
            </div>
      </Section>

      <!-- MRB Projects -->
      <Section class="d-flex flex-column justify-content-center align-items-center flex-wrap gap-5" style="background: #D9D9D9;">
            <div class="header-property">
                <h1>MID-RISE BUILDINGS</h1>
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
            </div>

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-5 px-3 py-5 ">
                <div class="prop-wrapper white" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/m3.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
                <div class="prop-wrapper white" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/m2.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
                <div class="prop-wrapper white" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/m1.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
            </div>
      </Section>

      <!-- ECHO Projects -->
      <Section class="d-flex flex-column justify-content-center align-items-center flex-wrap gap-5">
            <div class="header-property">
                <h1>HOUSE AND LOT</h1>
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
            </div>

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-5 px-3 py-5">
                <div class="prop-wrapper white" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/e1.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
                <div class="prop-wrapper white" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/e2.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
                <div class="prop-wrapper white" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/image/e3.png');">
                    <div class="slide-info p-3">
                        <h5>SAIL RESIDENCES</h5>
                        <p>Parañaque City</p>
                        <p>₱6.8M - 15.7M</p>
                        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Condimentum varius felis maecenas; magnis mollis leo metus lobortis</p>
                        <button>VIEW PROPERTY</button>
                    </div>
                </div>
            </div>
      </Section>


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