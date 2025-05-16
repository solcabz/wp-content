<?php wp_head(); ?>
<?php get_header(); ?>

<?php  
  $news_group = get_field('news_hero'); // Get the 'News' group
  $news_image = $news_group['news_image'];
  $news_sub_headline = $news_group['sub_headline']; 
?>
<section class="news-banner" style="background-image: linear-gradient(rgba(25, 12, 54, 0.69), rgba(30, 16, 83, 0.69)), url('<?php echo esc_url($news_image['url']); ?>');">
  
  <div class="news-heading">
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
    <h1><?php the_title(); ?></h1>
    <h5><?php echo esc_html($news_sub_headline); ?></h5>
  </div>
</section>

<?php get_footer(); ?>
<?php wp_footer(); ?>