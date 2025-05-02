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