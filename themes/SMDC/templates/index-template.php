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
                        <?php
                            // Define property segments and their taxonomy slugs
                            $property_segments = [
                                'High-Rise Buildings (HRB)' => 'hrb',
                                'Mid-Rise Buildings (MRB)' => 'mrb',
                                'Symphony Homes (ECO)' => 'eco',
                            ];

                            // Loop through each segment and fetch 2 featured properties
                            foreach ($property_segments as $segment_name => $segment_slug):
                                $args = [
                                    'post_type' => 'property',
                                    'posts_per_page' => 2, // Fetch 2 properties per segment
                                    'meta_query' => [
                                        [
                                            'key' => 'is_featured', // ACF field for "Featured"
                                            'value' => '1', // Value for "true" in ACF
                                            'compare' => '==',
                                        ],
                                    ],
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'property_segment', // Taxonomy name
                                            'field' => 'slug',
                                            'terms' => $segment_slug,
                                        ],
                                    ],
                                ];
                                $query = new WP_Query($args);

                            if ($query->have_posts()):
                        ?>
                        
                        <div class="feature-wrapper-item">
                            <div class="feature-title">
                                <p><?php echo esc_html($segment_name); ?></p>
                            </div>
                            <?php while ($query->have_posts()): $query->the_post(); ?>
                                <a href="<?php the_permalink(); ?>">
                                    <div class="feature-item">
                                        <?php 
                                            // Fetch the Hero Image from the ACF group field
                                            $hero_group = get_field('hero'); // Get the 'hero' group
                                            $hero_image = $hero_group['hero_image']; // Access the 'hero_image' subfield
                                        ?>
                                        <img src="<?php echo esc_url($hero_image['url']); ?>" alt="Feature Image" class="img-fluid feature-img zoom-in">
                                        <div class="feature-item-info">
                                            <h4><?php the_title(); ?></h4>
                                            <?php 
                                                // Fetch the About Property group field
                                                $about_property = get_field('about_property'); // Get the 'about_property' group
                                                $property_description = !empty($about_property['description']) ? $about_property['description'] : 'No description available.';
                                            ?>
                                            <p class="property-description"> <?php echo esc_html($property_description); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        </div>
                        <?php
                            endif;
                            wp_reset_postdata();
                        endforeach;
                        ?>                                       
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
                <section class="news-section py-5">
                    <!-- Header -->
                    <div class="">
                        <div class="row mb-4">
                            <div class="d-flex justify-content-around align-center text-center">
                                <h1 class="fw-bold fs-90">Latest News And Updates</h1>
                                <a href="<?php echo get_post_type_archive_link('good_life'); ?>" class="btn btn-outline-dark mt-3">View All</a>
                            </div>
                        </div>

                        <!-- News Content -->
                        <div class="row px-5">
                            <?php
                            // Query to fetch "The Good Life" posts
                            $args = [
                                'post_type' => 'good_life', // Custom post type
                                'posts_per_page' => 5, // Limit to 5 posts
                                'orderby' => 'date', // Order by date
                                'order' => 'DESC', // Descending order
                            ];
                            $good_life_query = new WP_Query($args);

                            if ($good_life_query->have_posts()):
                                $post_count = 0; // Counter to track featured vs grid posts
                                while ($good_life_query->have_posts()): $good_life_query->the_post();
                                    $post_count++;
                                    if ($post_count === 1): // First post as featured news
                            ?>
                            <!-- Featured News -->
                            <div class="col-lg-6 mb-4">
                                <div class="card border-0 shadow-lg h-100">
                                    <?php  
                                        $news_group = get_field('news_hero'); // Get the 'News' group
                                        $news_image = $news_group['news_image'];
                                        $news_sub_headline = $news_group['sub_headline']; 
                                    ?>
                                    <img src="<?php echo esc_url($news_image['url']); ?>" class="card-img-top" style="object-fit: cover; height: 100%;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php the_title(); ?></h5>
                                        <p class="card-text"><?php echo esc_html($news_sub_headline); ?></p>
                                        <p class="text-muted mb-2"><?php echo get_the_date(); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-dark">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <?php else: // Remaining posts as grid news ?>
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-lg">
                                    <?php  
                                        $news_group = get_field('news_hero'); // Get the 'News' group
                                        $news_image = $news_group['news_image']; 
                                        $news_sub_headline = $news_group['sub_headline']; 
                                    ?>
                                    <img src="<?php echo esc_url($news_image['url']); ?>" alt="<?php the_title(); ?>" class="card-img-top" style="object-fit: cover; height: 250px;">
                                    <div class="card-body">
                                        <h6 class="card-title"><?php the_title(); ?></h6>
                                        <p class="card-text"><?php echo esc_html($news_sub_headline); ?></p>
                                        <p class="text-muted mb-2"><?php echo get_the_date(); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-dark">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    endif;
                                endwhile;
                                wp_reset_postdata();
                            else:
                            ?>
                            <p class="text-center">No news available at the moment.</p>
                            <?php endif; ?>
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
