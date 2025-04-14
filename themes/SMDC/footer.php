<footer className="footer-wrapper">
       <div class="footer-up">
        <div class="footer-info-container">
            <div class="footer-company-info">
                <?php 
                    $footer_logo = get_option('wp_footer_logo'); 
                    if ($footer_logo) {
                        echo '<img src="' . esc_url($footer_logo) . '" alt="Footer Logo">';
                    }else{
                        
                    }
                ?>
                <p>
                    15th Floor, Two E-com Center,
                    Harbor Drive, Mall of Asia Complex,
                    Pasay City, 1300 Philippines
                </p>
                <button>Get A Quote / Reserve Now</button>
            </div>
            <div class="footer-link-wrapper">
                <div class="form-news">
                    <div class="title-wrapper">
                        <h2>SMDC NEWSLETTER</h2>
                        <p>Join our newsletter mailing list to receive the latest updates and information about our promos and properties.</p>
                    </div>
                    <form action="" method="post">
                        <input type="text" placeholder="Type your email here">
                        <button>SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <p>Copyright 2025 SMDC. All Rights Reserved.</p>
        </div>
       </div>
       <div class="footer-down">
        <div>
            <?php
                $menu = wp_nav_menu([
                    'theme_location' => 'tertiary',
                    'container'      => false,  // Remove the <nav> container
                    'menu_class'     => 'nav-links-footer', // Set class for <ul>
                    'fallback_cb'    => false, // Avoids showing a default menu if none is assigned
                    'echo'           => false  // Get the menu as a string
                ]);

                // Force class on <ul> if not applied
                if ($menu) {
                    $menu = preg_replace('/<ul(.*?)>/', '<ul class="nav-links-footer"$1>', $menu, 1);
                } else {
                    $menu = '<ul class="nav-links"><li><a href="' . esc_url(home_url('/')) . '">Home</a></li></ul>'; // Added fallback menu
                }

                echo $menu;
            ?>
       </div>
       <div id="cookie-notice" style="display:none;">
            <div id="cookie-popup">
                    <div class="cookie-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/npc.png" alt="npc">
                    </div>
                    <div class="cookie-text">
                        <h6>Good day, Good Guy!</h6>
                        <p>We use cookies to improve your browsing experience. Continuing to use this site means you agree to our use of cookies. Tell me more!</p>
                        <button onclick="acceptCookies()">I Agree</button>
                    </div>
               
            </div>
        </div>
       <div class="social-menu">
            <ul>
                <?php 
                // Define social media platforms and their respective options
                $social_media = [
                    'facebook' => [
                        'link' => get_option('facebook_link'),
                        'icon' => get_option('facebook_icon')
                    ],
                    'instagram' => [
                        'link' => get_option('instagram_link'),
                        'icon' => get_option('instagram_icon')
                    ],
                    'twitter' => [
                        'link' => get_option('twitter_link'),
                        'icon' => get_option('twitter_icon')
                    ],
                    'youtube' => [
                        'link' => get_option('youtube_link'),
                        'icon' => get_option('youtube_icon')
                    ],
                    'linkedin' => [
                        'link' => get_option('linkedin_link'),
                        'icon' => get_option('linkedin_icon')
                    ]
                ];

                // Loop through each social media platform and display the link and icon if available
                foreach ($social_media as $platform => $data) {
                    if (!empty($data['link']) && !empty($data['icon'])) {
                        echo '<li>';
                        echo '<a href="' . esc_url($data['link']) . '" target="_blank">';
                        echo '<img src="' . esc_url($data['icon']) . '" alt="' . esc_attr(ucwords($platform)) . ' Icon" class="social-icon">';
                        echo '</a>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>
      
</footer>