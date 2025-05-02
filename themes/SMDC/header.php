<header class="header-container">
        <div class="menu-container">
            <div class="logo-menu">
                <a href="<?php echo esc_url(home_url('/')); ?>"> <!-- Added link to home -->
                    <?php 
                        $header_logo = get_option('wp_header_logo'); 
                        if ($header_logo) {
                            echo '<img src="' . esc_url($header_logo) . '" alt="SMDC Homes" class="logo">';
                            } else {
                                echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/default-logo.png') . '" alt="Default Logo" class="logo">'; // Added fallback logo
                            }
                    ?>
                </a>
            </div>
    
            <!-- Hamburger Button -->
            <button class="menu-toggle" id="menu-toggle">&#9776;</button>
    
            <!-- Navigation Menu -->
            <nav class="menu-list" id="menu">
               
            <?php
                $menu = wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,  // Remove the <nav> container
                    'menu_class'     => 'nav-links', // Set class for <ul>
                    'fallback_cb'    => false, // Avoids showing a default menu if none is assigned
                    'echo'           => false  // Get the menu as a string
                ]);

                // Force class on <ul> if not applied
                if ($menu) {
                    $menu = preg_replace('/<ul(.*?)>/', '<ul class="nav-links"$1>', $menu, 1);
                } else {
                    $menu = '<ul class="nav-links"><li><a href="' . esc_url(home_url('/')) . '">Home</a></li></ul>'; // Added fallback menu
                }

                echo $menu;
            ?>

    
                <div class="inner-div">
                <form id="customSearchForm" class="search-form">
                    <div class="search-container">
                        <input type="search" id="customSearchInput" placeholder="What are you looking for?" />
                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0030ff" viewBox="0 0 256 256">
                                <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
                    
                    <button class="btn-quote">GET A QUOTE</button>
                </div>
                
            </nav>
        </div>
    </header>