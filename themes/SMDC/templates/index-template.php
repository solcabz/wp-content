<?php

 /* 
 Template Name: Home
  */
?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php 
    if ( have_rows('Home_Module') ): // Check if the flexible content field has rows
        while ( have_rows('Home_Module') ): the_row();
            
            if ( get_row_layout() == 'hero_banner' ): 
                $hero_banner = get_sub_field('banner-image');
                $hero_title = get_sub_field('title-banner');
    ?>
                <!-- Hero Banner Section -->
                <section class="hero-banner position-relative overflow-hidden" style="min-height: 100vh;">
                    <!-- Background Video -->
                    <video autoplay muted loop playsinline id="myVideo" 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; ">
                        <source src="<?php echo get_template_directory_uri(); ?>/assets/image/hero-vid.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>

                   
                    <!-- Foreground Content -->
                    <div class="hero-header position-relative" style="z-index: 1;">
                        <p>The leading real estate developer in the Philippines.</p>
                        <button>CHOOSE LOCATION</button>
                    </div>
                    <div class="title-wrapper-heading position-relative" style="z-index: 1;">
                        <h1><?php echo esc_html($hero_title); ?></h1>
                    </div>
                </section>


                <!-- Featured Properties Section -->
                <section class="feature-section">
                    <div class="feature-wrapper">
                        <h1>Featured Properties</h1>
                        <p>Find the best home for your lifestyle among our selection of premium residential condominiums.</p>
                    </div>

                    <div class="feature-container">
                        <div class="feature-wrapper-item">
                            <div class="feature-title">
                                <p>HIGH-RISE BUILDINGS (CONDOMINIUM)</p>
                            </div>
                            <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/placeholder.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h6>Feature Title</h6>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/f2.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h6>Feature Title</h6>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-wrapper-item">
                            <div class="feature-title">
                                <p>MID-RISE BUILDINGS (CONDOMINIUM)</p>
                            </div>
                            <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/f3.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h6>Feature Title</h6>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/f4.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h6>Feature Title</h6>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-wrapper-item">
                            <div class="feature-title">
                                <p>SYMPHONY HOMES (HOUSE AND LOT)</p>
                            </div>
                        <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/f5.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h6>Feature Title</h6>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/f6.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h6>Feature Title</h6>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

    <?php 
            elseif ( get_row_layout() == 'get_a_quote' ): 
                $quote_image = get_sub_field('quote-image');
    ?>

    <!-- Get a Quote Section -->
               
                <section class="quote-section " style="background-image:  url('<?php echo esc_url(is_array($quote_image ) ? $quote_image ['url'] : $quote_image ); ?>');">
                    <div class="quote-header">
                        <h1>Get a Quote</h1>
                        <p>Seeking the Good Life? We’ve got you! Get a custom quote for any of our properties at no cost!</p>
                    </div>

                    <form action="" class="quote-form">
                        <div class="quote-item-col">
                            <label>PROPERTY OF INTEREST</label>
                            <select name="property" id="property">
                                <option value="Homes">Homes</option>
                                <option value="HRB">HRB</option>
                                <option value="MRB">MRB</option>
                            </select>
                        </div>

                        <div class="quote-item-row">
                            <div class="quote-item-col">
                                <label>FIRST NAME</label>
                                <input type="text">
                            </div>
                            <div class="quote-item-col">
                                <label>LAST NAME</label>
                                <input type="text">
                            </div>
                        </div>

                        <div class="quote-item-row">
                            <div class="quote-item-col">
                                <label>CONTACT NUMBER</label>
                                <input type="text">
                            </div>
                            <div class="quote-item-col">
                                <label>EMAIL ADDRESS</label>
                                <input type="text">
                            </div>
                        </div>

                        <div class="quote-item-col">
                            <label>COUNTRY OF RESIDENCE</label>
                            <select name="country" id="country">
                                <option value="PH">PH</option>
                                <option value="CHI">CHI</option>
                                <option value="USA">USA</option>
                            </select>
                        </div>
                        <button>SUBMIT</button>
                    </form>
                  
                </section>
                

                <!-- Latest SMDC News Section -->
                <section class="news-section py-5">
                    <!-- Header -->
                    <div class="news-header d-flex justify-content-between align-items-center mb-4">
                        <h1 class="fs-3 fw-bold">Latest SMDC News</h1>
                        <button class="">View All</button>
                    </div>

                    <!-- News Grid -->
                    <div class="container-lg row row-cols-1 row-cols-md-2 g-4 justify-content-center p-0">
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm overflow-hidden" style="height: 291px;">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/l1.png" alt="SMDC groundbreaking" class="img-fluid" style="width: 50%; object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h5 class="text-muted small">SEPTEMBER 27, 2024</h5>
                                        <p class="fw-semibold mb-0">SMDC breaks ground on new residential projects in Cavite and Laguna</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm overflow-hidden" style="height: 291px;">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/l2.png" alt="SMDC partners with Seafood City" class="img-fluid" style="width: 50%; object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h5 class="text-muted small">SEPTEMBER 20, 2024</h5>
                                        <p class="fw-semibold mb-0">SMDC and Seafood City revolutionize home buying for Global Filipinos</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm overflow-hidden" style="height: 291px;">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/news-image.png" alt="Sample news" class="img-fluid" style="width: 50%; object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h5 class="text-muted small">JANUARY 6, 2025</h5>
                                        <p class="fw-semibold mb-0">Lorem ipsum dolor sit amet, adipiscing consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm overflow-hidden" style="height: 291px;">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/l4.png" alt="Sample news" class="img-fluid" style="width: 50%; object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h5 class="text-muted small">JANUARY 7, 2025</h5>
                                        <p class="fw-semibold mb-0">Lorem ipsum dolor sit amet, adipiscing consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </section>

    <?php 
            endif; // End layout check
        endwhile; // End flexible content loop
    else: 
    ?>
        <p>No content available.</p>
    <?php endif; ?>



<?php endwhile; // end of the loop. ?>
