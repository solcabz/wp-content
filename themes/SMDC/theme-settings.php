<?php
function custom_theme_add_admin_menu() {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'custom-theme-settings',
        'custom_theme_settings_page',
        'dashicons-admin-settings',
        30
    );
}
add_action('admin_menu', 'custom_theme_add_admin_menu');

function custom_theme_register_settings() {
    register_setting('custom_theme_settings_group', 'wp_header_logo');
    register_setting('custom_theme_settings_group', 'wp_footer_logo');
}
add_action('admin_init', 'custom_theme_register_settings');

function handle_custom_upload($option_name, $file) {
    if (isset($file) && !empty($file['name'])) {
        $upload_dir = get_template_directory() . '/images/';

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name = basename($file['name']);
        $target_file = $upload_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        if (!in_array($file_type, $allowed_types)) {
            return false;
        }

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $file_url = get_template_directory_uri() . '/images/' . $file_name;
            update_option($option_name, $file_url);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['wp_header_logo_upload']['name'])) {
        handle_custom_upload('wp_header_logo', $_FILES['wp_header_logo_upload']);
    }
    if (!empty($_FILES['wp_footer_logo_upload']['name'])) {
        handle_custom_upload('wp_footer_logo', $_FILES['wp_footer_logo_upload']);
    }

    if (isset($_POST['delete_header_logo'])) {
        delete_option('wp_header_logo');
    }
    if (isset($_POST['delete_footer_logo'])) {
        delete_option('wp_footer_logo');
    }
}

function custom_theme_settings_page() {
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'logos';
    ?>
    <div class="wrap">
        <h1>Theme Settings</h1>

        <h2 class="nav-tab-wrapper">
            <a href="?page=custom-theme-settings&tab=logos" class="nav-tab <?php echo ($active_tab == 'logos') ? 'nav-tab-active' : ''; ?>">Logos</a>
        </h2>

        <form method="post" action="" enctype="multipart/form-data">
            <?php settings_fields('custom_theme_settings_group'); ?>
            <?php do_settings_sections('custom-theme-settings'); ?>

            <?php if ($active_tab == 'logos') : ?>
                <h2>Header Logo</h2>
                <input type="file" name="wp_header_logo_upload">
                <?php if (get_option('wp_header_logo')) : ?>
                    <br><img src="<?php echo esc_url(get_option('wp_header_logo')); ?>" style="max-width: 200px; height: auto;">
                    <br>
                    <button type="submit" name="delete_header_logo" class="button button-secondary">Delete</button>
                <?php endif; ?>

                <h2>Footer Logo</h2>
                <input type="file" name="wp_footer_logo_upload">
                <?php if (get_option('wp_footer_logo')) : ?>
                    <br><img src="<?php echo esc_url(get_option('wp_footer_logo')); ?>" style="max-width: 200px; height: auto;">
                    <br>
                    <button type="submit" name="delete_footer_logo" class="button button-secondary">Delete</button>
                <?php endif; ?>

                <br><br>
                <input type="submit" name="save_settings" value="Save Settings" class="button button-primary">
            <?php endif; ?>
        </form>
    </div>
    <?php
}

// For Social Links
// Add the settings menu for Social Links
function custom_theme_add_social_menu() {
    add_menu_page(
        'Social Media Links', 
        'Social Links', 
        'manage_options', 
        'custom-social-links', 
        'custom_theme_social_links_page', 
        get_template_directory_uri() . '/assets/image/social-media.png', // Custom icon URL // Custom icon will be added later
        30
    );
}
add_action('admin_menu', 'custom_theme_add_social_menu');

// Register Settings for Links and Icons
function custom_theme_register_social_settings() {
    // Register social media links
    register_setting('custom_social_links_group', 'facebook_link');
    register_setting('custom_social_links_group', 'instagram_link');
    register_setting('custom_social_links_group', 'twitter_link');
    register_setting('custom_social_links_group', 'youtube_link');
    register_setting('custom_social_links_group', 'linkedin_link');
    
    // Register social media icons
    register_setting('custom_social_links_group', 'facebook_icon');
    register_setting('custom_social_links_group', 'instagram_icon');
    register_setting('custom_social_links_group', 'twitter_icon');
    register_setting('custom_social_links_group', 'youtube_icon');
    register_setting('custom_social_links_group', 'linkedin_icon');
}
add_action('admin_init', 'custom_theme_register_social_settings');

// Handle the file uploads for social media icons
function handle_social_icon_upload($option_name, $file) {
    if (!empty($file['name'])) {
        // Use WordPress's upload directory
        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['path']; // Absolute path to the uploads directory
        $upload_url = $upload_dir['url'];   // URL to access uploaded files

        if (!file_exists($upload_path)) {
            wp_mkdir_p($upload_path); // Make sure the directory exists
        }

        $file_name = basename($file['name']);
        $target_file = $upload_path . '/' . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types for icons
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        if (!in_array($file_type, $allowed_types)) {
            return false;
        }

        // Move the uploaded file
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $file_url = $upload_url . '/' . $file_name;
            update_option($option_name, $file_url); // Update the URL option in the database
            return true;
        }
    }

    return false;
}

// Handle the form submission for uploading social media icons and saving links
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['facebook_icon_upload']['name'])) {
        handle_social_icon_upload('facebook_icon', $_FILES['facebook_icon_upload']);
    }
    if (!empty($_FILES['instagram_icon_upload']['name'])) {
        handle_social_icon_upload('instagram_icon', $_FILES['instagram_icon_upload']);
    }
    if (!empty($_FILES['twitter_icon_upload']['name'])) {
        handle_social_icon_upload('twitter_icon', $_FILES['twitter_icon_upload']);
    }
    if (!empty($_FILES['youtube_icon_upload']['name'])) {
        handle_social_icon_upload('youtube_icon', $_FILES['youtube_icon_upload']);
    }
    if (!empty($_FILES['linkedin_icon_upload']['name'])) {
        handle_social_icon_upload('linkedin_icon', $_FILES['linkedin_icon_upload']);
    }

    // Save the social media links
    if (isset($_POST['facebook_link'])) {
        update_option('facebook_link', $_POST['facebook_link']);
    }
    if (isset($_POST['instagram_link'])) {
        update_option('instagram_link', $_POST['instagram_link']);
    }
    if (isset($_POST['twitter_link'])) {
        update_option('twitter_link', $_POST['twitter_link']);
    }
    if (isset($_POST['youtube_link'])) {
        update_option('youtube_link', $_POST['youtube_link']);
    }
    if (isset($_POST['linkedin_link'])) {
        update_option('linkedin_link', $_POST['linkedin_link']);
    }

}

// Display the settings page for Social Links
function custom_theme_social_links_page() {
    ?>
    <div class="wrap">
        <h1>Social Media Links</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <?php settings_fields('custom_social_links_group'); ?>
            <?php do_settings_sections('custom-social-links'); ?>

            <h2>Facebook</h2>
            <input type="text" name="facebook_link" value="<?php echo esc_url(get_option('facebook_link')); ?>" placeholder="Facebook URL">
            <input type="file" name="facebook_icon_upload">
            <?php if (get_option('facebook_icon')) : ?>
                <br><img src="<?php echo esc_url(get_option('facebook_icon')); ?>" style="max-width: 50px; height: auto;">
            <?php endif; ?>

            <h2>Instagram</h2>
            <input type="text" name="instagram_link" value="<?php echo esc_url(get_option('instagram_link')); ?>" placeholder="Instagram URL">
            <input type="file" name="instagram_icon_upload">
            <?php if (get_option('instagram_icon')) : ?>
                <br><img src="<?php echo esc_url(get_option('instagram_icon')); ?>" style="max-width: 50px; height: auto;">
            <?php endif; ?>

            <h2>Twitter</h2>
            <input type="text" name="twitter_link" value="<?php echo esc_url(get_option('twitter_link')); ?>" placeholder="Twitter URL">
            <input type="file" name="twitter_icon_upload">
            <?php if (get_option('twitter_icon')) : ?>
                <br><img src="<?php echo esc_url(get_option('twitter_icon')); ?>" style="max-width: 50px; height: auto;">
            <?php endif; ?>

            <h2>YouTube</h2>
            <input type="text" name="youtube_link" value="<?php echo esc_url(get_option('youtube_link')); ?>" placeholder="YouTube URL">
            <input type="file" name="youtube_icon_upload">
            <?php if (get_option('youtube_icon')) : ?>
                <br><img src="<?php echo esc_url(get_option('youtube_icon')); ?>" style="max-width: 50px; height: auto;">
            <?php endif; ?>

            <h2>LinkedIn</h2>
            <input type="text" name="linkedin_link" value="<?php echo esc_url(get_option('linkedin_link')); ?>" placeholder="LinkedIn URL">
            <input type="file" name="linkedin_icon_upload">
            <?php if (get_option('linkedin_icon')) : ?>
                <br><img src="<?php echo esc_url(get_option('linkedin_icon')); ?>" style="max-width: 50px; height: auto;">
            <?php endif; ?>

            <br><br>
            <input type="submit" name="save_settings" value="Save Settings" class="button button-primary">
        </form>
    </div>
    <?php
}

function custom_admin_menu_styles() {
    echo '
    <style>
    #adminmenu .wp-menu-image img {
        width: 20px !important;
        height: 20px !important;
        object-fit: contain;
    }
    </style>
    ';
}
add_action('admin_head', 'custom_admin_menu_styles');
?>

