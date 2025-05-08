<?php

 /* 
 Template Name: Home
  */
?>

<?php
// Define the query for the "good_life" post type
$args = [
    'post_type' => 'good_life', // Replace with your custom post type slug
    'posts_per_page' => 4, // Number of posts to fetch
    'post_status' => 'publish', // Only fetch published posts
];
$good_life_query = new WP_Query($args);
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
                 
                <!-- Map Section -->
                <section class="map-section py-5">
                    <div class="container-xl">
                        <div class="row align-items-center">
                            <!-- Left Column: Content -->
                            <div class="col-lg-6">
                                <h2 style="font-size: 90px; ">Our Locations</h2>
                                <p>Explore our properties across the Philippines. Find the perfect location for your dream home.</p>
                            </div>

                            <!-- Right Column: Map Image -->
                            <div class="col-lg-6 text-center">
                                <!-- Map Image -->
                                <div class="map-container position-relative">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/map.png" alt="Philippines Map" class="img-fluid">
                                    
                                   
                                    <a href="" class="map-link" style="top: 14%; left: 73%; width: 10%; height: 5%; width: 20%;">Makati City</a>
                                    <a href="" class="map-link" style="top: 23%; left: 3%; width: 10%; height: 5%; width: 20%">Mall of Asia</a>
                                    <a href="" class="map-link" style="top: 27%; left: 65%; width: 10%; height: 5%; width: 20%">Mandaluyong</a>
                                    <a href="" class="map-link" style="top: 33%; left: 2%; width: 10%; height: 5%; width: 20%">Pasig</a>
                                </div>
                            </div>
                        </div>
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
                    <div class="container">
                        <div class="row">
                            <!-- Left Column: Title and Button -->
                            <div class="col-lg-4 d-flex flex-column justify-content-Start align-items-start">
                                <h1 class="news-title">Latest News & Updates</h1>
                                <a href="<?php echo get_post_type_archive_link('good_life'); ?>" class="news-btn">View All</a>
                            </div>

                            <!-- Right Column: Featured News and Grid -->
                            <div class="col-lg-8">
                                <div class="row">
                                    <!-- Featured News -->
                                    <div class="col-12 mb-4">
                                        <?php
                                        $post_count = 0;
                                        while ($good_life_query->have_posts()): $good_life_query->the_post();
                                            $post_count++;
                                            if ($post_count === 1): // First post as featured news
                                                $news_group = get_field('news_hero'); // Get the 'News' group
                                                $news_image = isset($news_group['news_image']) ? $news_group['news_image'] : null;
                                                $news_sub_headline = isset($news_group['sub_headline']) ? $news_group['sub_headline'] : '';
                                        ?>
                                                <div class="card border-0 shadow-lg h-100 position-relative">
                                                    <!-- News Image -->
                                                    <?php if ($news_image): ?>
                                                        <img src="<?php echo esc_url($news_image['url']); ?>" alt="<?php the_title(); ?>" class="card-img" style="object-fit: cover; height: 100%; width: 100%;">
                                                    <?php else: ?>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/image/default-image.jpg'); ?>" alt="<?php the_title(); ?>" class="card-img" style="object-fit: cover; height: 100%; width: 100%;">
                                                    <?php endif; ?>

                                                    <!-- Overlay Content -->
                                                    <div class="card-overlay position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 100%); color: #fff;">
                                                        <h5 class="card-title mb-2"><?php the_title(); ?></h5>
                                                        <p class="card-text mb-3"><?php echo esc_html($news_sub_headline); ?></p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0" style="color: rgba(255, 255, 255, 0.7);"><?php echo get_the_date(); ?></p>
                                                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-light">Read More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            endif;
                                        endwhile;
                                        ?>
                                    </div>

                                    <!-- Grid of 3 Cards -->
                                    <div class="row w-100 m-0 p-0">
                                        <?php
                                        $post_count = 0; // Reset counter for grid posts
                                        while ($good_life_query->have_posts()): $good_life_query->the_post();
                                            $post_count++;
                                            if ($post_count > 1 && $post_count <= 4): // Remaining posts as grid news
                                                $news_group = get_field('news_hero'); // Get the 'News' group
                                                $news_image = isset($news_group['news_image']) ? $news_group['news_image'] : null;
                                                $news_sub_headline = isset($news_group['sub_headline']) ? $news_group['sub_headline'] : '';
                                        ?>
                                                <div class="col-md-4 mb-4">
                                                    <div class="card border-0 shadow-lg h-100 position-relative card-fixed-height">
                                                        <!-- News Image -->
                                                        <?php if ($news_image): ?>
                                                            <img src="<?php echo esc_url($news_image['url']); ?>" alt="<?php the_title(); ?>" class="card-img-top" style="object-fit: cover; height: 200px; width: 100%;">
                                                        <?php else: ?>
                                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/image/default-image.jpg'); ?>" alt="<?php the_title(); ?>" class="card-img-top" style="object-fit: cover; height: 200px; width: 100%;">
                                                        <?php endif; ?>

                                                        <!-- Content -->
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-2"><?php the_title(); ?></h5>
                                                            <p class="card-text mb-3"><?php echo esc_html($news_sub_headline); ?></p>
                                                            <p class="mb-0" style="color: rgba(0, 0, 0, 0.7);"><?php echo get_the_date(); ?></p>
                                                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary mt-2">Read More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            endif;
                                        endwhile;
                                        ?>
                                    </div>
                                </div>
                            </div>
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
