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