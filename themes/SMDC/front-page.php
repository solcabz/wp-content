

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <script>
        function loadMetaPixel() {
            !(function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)})(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');

            fbq('init', 'YOUR_PIXEL_ID'); // 🔁 Replace with your actual Meta Pixel ID
            fbq('track', 'PageView');
        }
    </script>
    <?php wp_head(); ?>
</head>
<body>
<?php include 'header.php';?>

<?php get_template_part('templates/index', 'template'); ?>

<?php include 'footer.php';?>
</body>
<?php wp_footer(); ?>
</html>