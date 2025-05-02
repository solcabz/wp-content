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

// Handle quote form submission
add_action('admin_post_nopriv_submit_quote_form_home', 'handle_quote_form_home');
add_action('admin_post_submit_quote_form_home', 'handle_quote_form_home');

function handle_quote_form_home() {
    // Check nonce for security
    if (!isset($_POST['quote_form_home_nonce']) || !wp_verify_nonce($_POST['quote_form_home_nonce'], 'submit_quote_form_home')) {
        wp_die('Security check failed.');
    }

    // Sanitize form inputs
    $property = sanitize_text_field($_POST['property']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $contact_number = sanitize_text_field($_POST['contact_number']);
    $email = sanitize_email($_POST['email']);
    $country = sanitize_text_field($_POST['country']);
    $submitted_at = current_time('mysql'); // To store the submission time

    // Validate the email address
    if (!is_email($email)) {
        wp_die('Invalid email address.');
    }

    // Prepare data for database
    global $wpdb;
    $table_name = $wpdb->prefix . 'quote_form_home';
    
    // Get current timestamp (optional, can be omitted if the database handles it)
    $created_at = current_time('mysql');  // This gets the current WordPress timestamp
    
    // Insert form data into the database
    $inserted = $wpdb->insert(
        $table_name,
        [
            'property'      => $property,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'contact_number'=> $contact_number,
            'email'         => $email,
            'country'       => $country,
            'created_at'    => $created_at
        ]
    );
    
    if ($inserted === false) {
        // Log the error message for debugging
        error_log('Database Insert Error: ' . $wpdb->last_error);
        wp_die('There was an error saving your data. Please try again.');
    }

    // Send email notification to admin
    $to = get_option('quote_form_home_recipient_email', get_option('admin_email'));
    $subject = 'New Quote Request from ' . $first_name . ' ' . $last_name;
    $body = "A new quote request has been submitted:\n\n";
    $body .= "Property: $property\n";
    $body .= "First Name: $first_name\n";
    $body .= "Last Name: $last_name\n";
    $body .= "Contact Number: $contact_number\n";
    $body .= "Email: $email\n";
    $body .= "Country: $country\n";
    $body .= "Submitted At: $submitted_at\n";

    wp_mail($to, $subject, $body);

    // Redirect to a thank you page after submission
    wp_redirect(home_url('/thank-you'));
    exit;
}

// Admin Menu Page for quote forms
add_action('admin_menu', 'add_quote_forms_menu');

function add_quote_forms_menu() {
    add_menu_page('Forms', 'Forms', 'manage_options', 'quote-forms', 'render_quote_forms_admin', 'dashicons-feedback', 20);
}

function render_quote_forms_admin() {
    global $wpdb;

    // Get active tab (home, quote, or inquiry)
    $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'home';
    $table_map = [
        'home' => $wpdb->prefix . 'quote_form_home',
        'quote' => $wpdb->prefix . 'get_a_quote_page',
        'inquiry' => $wpdb->prefix . 'inquiry_form',
    ];

    // Determine table name based on the active tab
    $table_name = $table_map[$tab] ?? $wpdb->prefix . 'quote_form_home';

    // Handle filters
    $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
    $start_date = isset($_GET['start_date']) ? sanitize_text_field($_GET['start_date']) : '';
    $end_date = isset($_GET['end_date']) ? sanitize_text_field($_GET['end_date']) : '';

    // Prepare query
    $query = "SELECT * FROM $table_name WHERE 1=1";
    $params = [];

    // Apply search filter
    if ($search) {
        $query .= " AND (first_name LIKE %s OR last_name LIKE %s OR email LIKE %s)";
        $wild_search = '%' . $wpdb->esc_like($search) . '%';
        $params[] = $wild_search;
        $params[] = $wild_search;
        $params[] = $wild_search;
    }

    // Apply date filters
    if ($start_date) {
        $query .= " AND submitted_at >= %s";
        $params[] = $start_date . ' 00:00:00';
    }
    if ($end_date) {
        $query .= " AND submitted_at <= %s";
        $params[] = $end_date . ' 23:59:59';
    }

    // Prepare the final query
    if (!empty($params)) {
        $query = $wpdb->prepare($query, ...$params);
    }

    // Fetch results
    $results = $wpdb->get_results($query, ARRAY_A);

    // Display tabs for switching between different form submissions
    echo '<h2 class="nav-tab-wrapper">';
    foreach ($table_map as $key => $label) {
        $active = $tab === $key ? 'nav-tab-active' : '';
        $name = ucwords(str_replace('_', ' ', $key));
        echo "<a href='?page=quote-forms&tab=$key' class='nav-tab $active'>$name</a>";
    }
    echo '</h2>';

    // Filter form for search and date range
    ?>
    <form method="get">
        <input type="hidden" name="page" value="quote-forms" />
        <input type="hidden" name="tab" value="<?php echo esc_attr($tab); ?>" />
        <input type="text" name="search" placeholder="Search..." value="<?php echo esc_attr($search); ?>" />
        <input type="submit" value="Filter" class="button" />
        <input type="date" name="start_date" value="<?php echo esc_attr($start_date); ?>" />
        <input type="date" name="end_date" value="<?php echo esc_attr($end_date); ?>" />
        <a href="<?php echo admin_url("admin-post.php?action=export_quote_form_data&tab=$tab&search=$search&start_date=$start_date&end_date=$end_date"); ?>" class="button button-primary">Export CSV</a>
    </form>

    <table class="widefat fixed striped">
        <thead>
            <tr>
                <?php if (!empty($results)) {
                    foreach (array_keys($results[0]) as $col) {
                        echo '<th>' . esc_html(ucwords(str_replace('_', ' ', $col))) . '</th>';
                    }
                    echo '<th>Actions</th>';
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <?php foreach ($row as $value): ?>
                        <td><?php echo esc_html($value); ?></td>
                    <?php endforeach; ?>
                    <td>
                        <a href="<?php echo admin_url('admin-post.php?action=delete_quote_submission&id=' . intval($row['id']) . '&tab=' . esc_attr($tab)); ?>" class="button button-small" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($results)): ?>
                <tr><td colspan="100%">No submissions found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
}

// Export form data as CSV
add_action('admin_post_export_quote_form_data', 'export_quote_form_data');

function export_quote_form_data() {
    global $wpdb;

    $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'home';
    $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
    $start_date = isset($_GET['start_date']) ? sanitize_text_field($_GET['start_date']) : '';
    $end_date = isset($_GET['end_date']) ? sanitize_text_field($_GET['end_date']) : '';

    $table_map = [
        'home' => $wpdb->prefix . 'quote_form_home',
        'quote' => $wpdb->prefix . 'get_a_quote_page',
        'inquiry' => $wpdb->prefix . 'inquiry_form',
    ];

    $table_name = $table_map[$tab] ?? $wpdb->prefix . 'quote_form_home';

    $query = "SELECT * FROM $table_name WHERE 1=1";
    $params = [];

    // Apply search filter
    if ($search) {
        $query .= " AND (first_name LIKE %s OR last_name LIKE %s OR email LIKE %s)";
        $wild_search = '%' . $wpdb->esc_like($search) . '%';
        $params[] = $wild_search;
        $params[] = $wild_search;
        $params[] = $wild_search;
    }

    // Apply date filters
    if ($start_date) {
        $query .= " AND submitted_at >= %s";
        $params[] = $start_date . ' 00:00:00';
    }
    if ($end_date) {
        $query .= " AND submitted_at <= %s";
        $params[] = $end_date . ' 23:59:59';
    }

    // Prepare the query
    if (!empty($params)) {
        $query = $wpdb->prepare($query, ...$params);
    }

    // Get results
    $results = $wpdb->get_results($query, ARRAY_A);

    // If no data, show an error
    if (empty($results)) {
        wp_die('No data to export.');
    }

    // Export CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="form_data_' . $tab . '_' . date('Y-m-d') . '.csv"');

    $output = fopen('php://output', 'w');

    // Write header
    fputcsv($output, array_keys($results[0]));

    // Write rows
    foreach ($results as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}

// Handle deletion of quote submission
add_action('admin_post_delete_quote_submission', 'delete_quote_submission');

function delete_quote_submission() {
    global $wpdb;

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'home';

    $table_map = [
        'home' => $wpdb->prefix . 'quote_form_home',
        'quote' => $wpdb->prefix . 'get_a_quote_page',
        'inquiry' => $wpdb->prefix . 'inquiry_form',
    ];

    $table_name = $table_map[$tab] ?? $wpdb->prefix . 'quote_form_home';

    if ($id > 0) {
        $wpdb->delete($table_name, ['id' => $id]);
    }

    wp_redirect(admin_url("admin.php?page=quote-forms&tab=$tab"));
    exit;
}

// Settings page for email
add_action('admin_menu', function () {
    add_submenu_page(
        'quote-forms',
        'Form Email Settings',
        'Email Settings',
        'manage_options',
        'quote-form-email-settings',
        'render_quote_form_email_settings_page'
    );
});

add_action('admin_init', function () {
    register_setting('quote_form_email_settings_group', 'quote_form_home_recipient_email');

    add_settings_section(
        'quote_form_email_settings_section',
        'Recipient Email Settings',
        null,
        'quote-form-email-settings'
    );

    add_settings_field(
        'quote_form_home_recipient_email',
        'Recipient Email for Home Quote Form',
        function () {
            $value = get_option('quote_form_home_recipient_email', get_option('admin_email'));
            echo '<input type="email" name="quote_form_home_recipient_email" value="' . esc_attr($value) . '" class="regular-text" />';
        },
        'quote-form-email-settings',
        'quote_form_email_settings_section'
    );
});

function render_quote_form_email_settings_page() {
    ?>
    <div class="wrap">
        <h2>Quote Form Email Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('quote_form_email_settings_group'); ?>
            <?php do_settings_sections('quote-form-email-settings'); ?>
            <p class="submit">
                <input type="submit" name="submit" class="button-primary" value="Save Settings" />
            </p>
        </form>
    </div>
    <?php
}


?>

