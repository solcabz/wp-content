<section class="awards-listing">
    <h1>Awards and Citations</h1>
    <p>Explore our achievements and recognitions.</p>

    <?php if (have_rows('award_groups')): ?>
        <ul class="tab-titles">
            <?php $group_index = 0; ?>
            <?php while (have_rows('award_groups')): the_row(); ?>
                <li class="tab-title<?php echo $group_index === 0 ? ' active' : ''; ?>" onclick="showTabContent(this, <?php echo $group_index; ?>)">
                    <?php echo esc_html(get_sub_field('award_group_title')); ?>
                </li>
                <?php $group_index++; ?>
            <?php endwhile; ?>
        </ul>

        <div class="tab-contents">
            <?php $group_index = 0; ?>
            <?php while (have_rows('award_groups')): the_row(); ?>
                <div class="tab-content<?php echo $group_index === 0 ? ' active' : ''; ?>">
                    <div class="awards-wrapper">
                        <?php if (have_rows('awards')): ?>
                            <?php 
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

                            // Split awards into chunks of 10
                            $chunks = array_chunk($awards, 10);
                            foreach ($chunks as $chunk_index => $chunk): ?>
                                <div class="award-container awards" data-page-index="<?php echo $chunk_index; ?>" style="<?php echo $chunk_index === 0 ? '' : 'display: none;'; ?>">
                                    <?php foreach ($chunk as $award): ?>
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
                                            <?php if (!empty($award['hover_image'])): ?>
                                                <div class="hover-image">
                                                    <img src="<?php echo esc_url($award['hover_image']['url']); ?>" alt="<?php echo esc_attr($award['hover_image']['alt']); ?>">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No awards found for this group.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination Controls -->
                    <?php if (count($chunks) > 1): ?>
                        <div class="pagination-controls">
                            <button class="prev-page" onclick="changePage(this, -1)" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="" viewBox="0 0 256 256"><path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path></svg>
                            </button>
                                
                            <button class="next-page" onclick="changePage(this, 1)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $group_index++; ?>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No award groups found. Please add them in the WordPress admin.</p>
    <?php endif; ?>
</section>