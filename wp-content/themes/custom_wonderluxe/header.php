<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wonderluxe
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wonderluxe' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="main-container">
			<nav id="site-navigation" class="main-navigation header-item">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<?php esc_html_e( 'Primary Menu', 'wonderluxe' ); ?>
				</button>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->

			<div class="site-branding">
				<div class="logo">
					<a href="<?=home_url('/'); ?>">
						<img src="<?=home_url('/')?>wp-content/uploads/2024/09/logoblack-1.png" />
					</a>
				</div>
			</div><!-- .site-branding -->

			<div class="header-item header-btn">
				<div class="btn-container">
					<p>
						<input class="btn" type="submit" value="ENTER NOW">
					</p>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
