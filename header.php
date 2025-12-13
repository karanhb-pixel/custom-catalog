<?php
/**
 * The header for our theme
 *
 * @package Custom-Catalog
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary">
			<?php esc_html_e('Skip to content', 'custom-catalog'); ?>
		</a>

		<header id="masthead" class="site-header">
			<div class="container header-inner">
				<a href="<?php echo home_url('/'); ?>" class="logo">
					<span class="logo-mark">MR</span>
					<span class="logo-text">Furniture</span>
				</a>


				<nav class="main-nav" aria-label="<?php esc_attr_e('Main navigation', 'custom-catalog'); ?>">
					<button class="nav-toggle" aria-expanded="false"
						aria-label="<?php esc_attr_e('Toggle navigation', 'custom-catalog'); ?>">
						☰
					</button>
					<ul class="nav-links">
						<li><a href="<?php echo home_url('/'); ?>"><?php esc_html_e('Home', 'custom-catalog'); ?></a>
						</li>
						<li><a
								href="<?php echo home_url('/'); ?>#services"><?php esc_html_e('Services', 'custom-catalog'); ?></a>
						</li>
						<li><a
								href="<?php echo home_url('/'); ?>#projects"><?php esc_html_e('Projects', 'custom-catalog'); ?></a>
						</li>
						<li><a
								href="<?php echo home_url('/'); ?>#about"><?php esc_html_e('About', 'custom-catalog'); ?></a>
						</li>
						<li><a
								href="<?php echo home_url('/'); ?>#contact"><?php esc_html_e('Contact', 'custom-catalog'); ?></a>
						</li>
					</ul>
				</nav>
			</div>
		</header><!-- #masthead -->

		<div id="content" class="site-content">