# SMDC Theme Documentation

## Overview
The SMDC theme is designed for showcasing properties categorized into different segments, specifically ECO, HRB, and MRB. This theme utilizes custom post types and taxonomies to manage and display property listings effectively.

## File Structure
The theme consists of the following key files:

- **template-parts/content-property-category.php**: Template part for displaying properties under specified categories.
- **category-eco.php**: Template for displaying properties categorized under ECO.
- **category-hrb.php**: Template for displaying properties categorized under HRB.
- **category-mrb.php**: Template for displaying properties categorized under MRB.
- **functions.php**: Contains theme functions, hooks, and feature registrations.
- **property-settings.php**: Responsible for registering the custom post type and taxonomy for properties.
- **style.css**: Contains the CSS styles for the theme.
- **README.md**: Documentation for the project.

## Setup Instructions
1. **Install WordPress**: Ensure you have a working installation of WordPress.
2. **Theme Installation**:
   - Upload the SMDC theme folder to the `/wp-content/themes/` directory.
   - Activate the theme from the WordPress admin dashboard under Appearance > Themes.
3. **Flush Permalinks**: After activating the theme, go to Settings > Permalinks and click "Save Changes" to flush the rewrite rules.
4. **Add Properties**: Use the "Properties" menu in the admin dashboard to add new property listings.

## Usage
- Navigate to the respective category pages (ECO, HRB, MRB) to view properties listed under each category.
- Each category page utilizes the `content-property-category.php` template part to render the properties.

## Customization
- Modify styles in `style.css` to change the appearance of the theme.
- Extend functionality by adding custom functions in `functions.php`.

## Support
For any issues or questions, please refer to the WordPress documentation or seek help from the WordPress community.