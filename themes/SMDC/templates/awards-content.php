

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