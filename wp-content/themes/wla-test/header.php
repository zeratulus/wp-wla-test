<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<?php wp_head(); ?>
</head>
<body>
<div class="menu-fix fw"></div>
<header class="fw">
    <div class="container">
        <img src="<?php echo get_theme_mod('theme_logo'); ?>" class="logo" />
        <?php wp_nav_menu([
		    'menu' => 'top',
		    'container' => 'nav',
		    'container_class' => 'top-nav'
        ]); ?>
    </div>
</header>
<div class="btn-mobile-menu"><i class="fas fa-bars"></i></div>
<script>
    window.isMobile = screen.width <= 768;
    jQuery(document).ready(function () {
        jQuery('.btn-mobile-menu').on('click', function () {
            jQuery('header').toggleClass('active');
        });
    });
</script>