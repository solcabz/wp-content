<section class="awards-listing">
    <h1>Awards and Citations</h1>
    <p>Explore our achievements and recognitions.</p>
    
    <?php if ( have_rows('award_groups') ): ?>
        <div class="tabs">
            <ul class="tab-titles">
                <?php while ( have_rows('award_groups') ): the_row(); ?>
                    <li class="tab-title" onclick="showTabContent(this)">
                        <?php echo esc_html(get_sub_field('award_group_title')); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
            
            <?php
            $current_tab = isset($_GET['tab']) ? intval($_GET['tab']) : 0;
            $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

            // Ensure the correct tab and page are processed
            $tab_index = 0;
            while (have_rows('award_groups')): the_row();
                if ($tab_index === $current_tab) {
                    // Process awards for the current tab
                    $awards = [];
                    while (have_rows('awards')): the_row();
                        $awards[] = [
                            'award_year' => get_sub_field('award_year'),
                            'award_title' => get_sub_field('award_title'),
                            'award_description' => get_sub_field('award_description'),
                            'awarded_by' => get_sub_field('awarded_by'),
                            'hover_image' => get_sub_field('hover_image'),
                        ];
                    endwhile;

                    // Sort and paginate awards
                    usort($awards, function ($a, $b) {
                        return intval($b['award_year']) - intval($a['award_year']);
                    });

                    $awards_per_page = 10;
                    $total_awards = count($awards);
                    $total_pages = ceil($total_awards / $awards_per_page);
                    $start_index = ($current_page - 1) * $awards_per_page;
                    $awards_to_display = array_slice($awards, $start_index, $awards_per_page);

                    // Output the awards for the current tab and page
                    include locate_template('templates/awards-content.php');
                    break;
                }
                $tab_index++;
            endwhile;
            ?>

        </div>
    <?php else: ?>
        <p>Debug: No award groups found. Ensure data is entered in the WordPress admin.</p>
    <?php endif; ?>
</section>

<pre>
    <?php
   // echo 'Current Tab: ' . $current_tab . '<br>';
  //  echo 'Current Page: ' . $current_page . '<br>';
  //  echo 'Awards to Display: ' . print_r($awards_to_display, true);
    ?>
</pre>