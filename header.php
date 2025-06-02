<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header class="header">
			<div class="container header__container">
				<a href="/" class="logo header__logo">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/app/img/logos/logo.png" alt="Логотип" width="124" height="40">
				</a>
				<nav class="nav" title="">
					<ul class="list-reset nav__list">
						<li class="nav__item"><span class="nav__link nav-current">Main page</span></li>
						<li class="nav__item"><a href="#" class="nav__link">Contact</a></li>
					</ul>
				</nav>
			</div>
		</header>