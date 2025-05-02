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
            $tab_index = 0;
            ?>

            <div class="tab-contents">
                <?php while (have_rows('award_groups')): the_row(); ?>
                    <div class="tab-content <?php echo $tab_index === $current_tab ? 'active' : ''; ?>">
                        <?php if (have_rows('awards')): ?>
                            <?php
                            // Collect all awards into an array
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

                            // Sort awards by award_year in descending order
                            usort($awards, function ($a, $b) {
                                return intval($b['award_year']) - intval($a['award_year']);
                            });

                            // Pagination logic
                            $awards_per_page = 10;
                            $total_awards = count($awards);
                            $total_pages = ceil($total_awards / $awards_per_page);
                            $start_index = ($current_page - 1) * $awards_per_page;
                            $awards_to_display = array_slice($awards, $start_index, $awards_per_page);
                            ?>

                            <div class="awards">
                                <?php foreach ($awards_to_display as $award): ?>
                                    <div class="award-item">
                                        <div class="award-content">
                                            <div>
                                                <p class="award-year"><?php echo esc_html($award['award_year']); ?></p>
                                                <h4 class="award-title"><?php echo esc_html($award['award_title']); ?></h4>
                                                <p class="award-description"><?php echo esc_html($award['award_description']); ?></p>
                                            </div>
                                            <div class="lower-content">
                                                <p class="awarded-by">AWARDED BY</p>
                                                <p class="awarded-by1"><?php echo esc_html($award['awarded_by']); ?></p>
                                            </div>
                                        </div>
                                        <?php if ($hover_image = $award['hover_image']): ?>
                                            <div class="hover-image">
                                                <img src="<?php echo esc_url($hover_image['url']); ?>" alt="<?php echo esc_attr($hover_image['alt']); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <?php if ($total_pages > 1): // Only show pagination if there are multiple pages ?>
                                <div class="pagination">
                                    <?php if ($current_page > 1): ?>
                                        <a href="?tab=<?php echo $current_tab; ?>&page=<?php echo $current_page - 1; ?>" class="prev-page">Previous</a>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <a href="?tab=<?php echo $current_tab; ?>&page=<?php echo $i; ?>" class="page-number <?php echo $i === $current_page ? 'current' : ''; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    <?php endfor; ?>

                                    <?php if ($current_page < $total_pages): ?>
                                        <a href="?tab=<?php echo $current_tab; ?>&page=<?php echo $current_page + 1; ?>" class="next-page">Next</a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <p>No awards found</p>
                        <?php endif; ?>
                    </div>
                    <?php $tab_index++; ?>
                <?php endwhile; ?>
            </div>

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