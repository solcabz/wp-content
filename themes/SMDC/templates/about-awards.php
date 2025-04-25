<section class="awards-listing">
    <h2>Awards and Citations</h2>
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
            
            <div class="tab-contents">
                <?php while ( have_rows('award_groups') ): the_row(); ?>
                    <div class="tab-content">
                        <?php if ( have_rows('awards') ): ?>
                            <div class="awards">
                                <?php while ( have_rows('awards') ): the_row(); ?>
                                    <div class="award-item">
                                        <div class="award-content">
                                            <div>
                                                <p class="award-year"><?php echo esc_html(get_sub_field('award_year')); ?></p>
                                                <h4 class="award-title"><?php echo esc_html(get_sub_field('award_title')); ?></h4>
                                            </div>
                                            <div class="lower-content">
                                                <p class="award-description"><?php echo esc_html(get_sub_field('award_description')); ?></p>
                                                <p class="awarded-by">Awarded By: <?php echo esc_html(get_sub_field('awarded_by')); ?></p>
                                            </div>
                                        </div>
                                        <?php if ( $hover_image = get_sub_field('hover_image') ): ?>
                                            <div class="hover-image">
                                                <img src="<?php echo esc_url($hover_image['url']); ?>" alt="<?php echo esc_attr($hover_image['alt']); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else: ?>
                            <p>Debug: No awards found in this group</p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php else: ?>
        <p>Debug: No award groups found. Ensure data is entered in the WordPress admin.</p>
    <?php endif; ?>
</section>