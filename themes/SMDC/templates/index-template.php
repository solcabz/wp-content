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
                <section class="hero-banner position-relative overflow-hidden" style="min-height: calc(100dvh - 80px); padding-top: 80px;">
                    <!-- Background Video -->
                     
                    <video autoplay muted loop playsinline id="myVideo" 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
                        <source src="<?php echo get_template_directory_uri(); ?>/assets/image/hero-vid.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>

                    <!-- Foreground Content -->
                    <div class="hero-header position-relative" style="z-index: 1;">
                        <p>The leading real estate developer in the Philippines.</p>
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
                                    <h4>Feature Title</h4>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/f2.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h4>Feature Title</h4>
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
                                    <h4>Feature Title</h4>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/f4.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h4>Feature Title</h4>
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
                                    <h4>Feature Title</h4>
                                    <p>Short description about the feature.</p>
                                    <p>Additional details here.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/f6.png" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                <div class="feature-item-info">
                                    <h4>Feature Title</h4>
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

                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="quote-form-home">
                        <input type="hidden" name="action" value="submit_quote_form_home">
                        <?php wp_nonce_field('submit_quote_form_home', 'quote_form_home_nonce'); ?>

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
                                <input type="text" name="first_name" required>
                            </div>
                            <div class="quote-item-col">
                                <label>LAST NAME</label>
                                <input type="text" name="last_name" required>
                            </div>
                        </div>

                        <div class="quote-item-row">
                            <div class="quote-item-col">
                                <label>CONTACT NUMBER</label>
                                <input type="text" name="contact_number" required>
                            </div>
                            <div class="quote-item-col">
                                <label>EMAIL ADDRESS</label>
                                <input type="email" name="email" required>
                            </div>
                        </div>

                        <div class="quote-item-col">
                            <label>COUNTRY OF RESIDENCE</label>
                            <input type="text" name="country" required>
                        </div>

                        <!-- Google reCAPTCHA -->
                        <div class="g-recaptcha" data-sitekey="6LfSuRcrAAAAAEJzNucLpRKth4SDW_hkqUWhgnvE"></div>
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                                $recaptchaResponse = $_POST['g-recaptcha-response'];
                                $secretKey = '6LfSuRcrAAAAAOUWbsb-OzTyjv8-cV2S0LqCXnPP';

                                // Verify the reCAPTCHA response
                                $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
                                $responseData = json_decode($verifyResponse);

                                if ($responseData->success) {
                                    echo "<p class='text-success'>Form submitted successfully!</p>";
                                } else {
                                    echo "<p class='text-danger'>reCAPTCHA verification failed. Please try again.</p>";
                                }
                            } else {
                                echo "<p class='text-danger'>Please complete the reCAPTCHA verification.</p>";
                            }
                        }
                        ?>

                        <button type="submit">SUBMIT</button>
                    </form>


                </section>
                

                <!-- Latest SMDC News Section -->
                <section class="news-section py-5" style="background: linear-gradient(to bottom, rgb(255, 255, 255), rgba(0, 15, 115, 0.88)); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    <!-- Header -->
                    <div class="news-header d-flex justify-content-between align-items-center mb-4">
                        <h1 class="">Latest News and Updates</h1>
                        <button class="">View All</button>
                    </div>

                    <!-- News Grid -->
                    <div class="news-item-wrapper">
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm ">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/l1.png" alt="SMDC groundbreaking" class="img-fluid" style=" object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h3 class="text-muted fs-6">SEPTEMBER 27, 2024</h3>
                                        <p class="fw-semibold mb-0">SMDC breaks ground on new residential projects in Cavite and Laguna</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm ">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/l2.png" alt="SMDC partners with Seafood City" class="img-fluid" style=" object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h3 class="text-muted fs-6">SEPTEMBER 20, 2024</h3>
                                        <p class="fw-semibold mb-0">SMDC and Seafood City revolutionize home buying for Global Filipinos</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm ">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/l2.png" alt="SMDC partners with Seafood City" class="img-fluid" style=" object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h3 class="text-muted fs-6">SEPTEMBER 20, 2024</h3>
                                        <p class="fw-semibold mb-0">SMDC and Seafood City revolutionize home buying for Global Filipinos</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm" >
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/news-image.png" alt="Sample news" class="img-fluid" style=" object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h3 class="text-muted fs-6">JANUARY 6, 2025</h3>
                                        <p class="fw-semibold mb-0">Lorem ipsum dolor sit amet, adipiscing consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-center p-0">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="news-item d-flex bg-light shadow-sm ">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/l4.png" alt="Sample news" class="img-fluid" style=" object-fit: cover;">
                                    <div class="news-content p-3 d-flex flex-column justify-content-center">
                                        <h3 class="text-muted fs-6">JANUARY 7, 2025</h3>
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
