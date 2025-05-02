

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body>
<?php include 'header.php';?>

<?php get_template_part('templates/index', 'template'); ?>

<?php include 'footer.php';?>
</body>
<?php wp_footer(); ?>
</html>