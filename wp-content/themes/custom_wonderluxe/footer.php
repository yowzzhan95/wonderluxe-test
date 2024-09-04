<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wonderluxe
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div class="main-container">
				<div class="footer-icon-row">
					<img  src="<?=home_url('/')?>wp-content/uploads/2024/09/logoiconblack-1.png">
				</div>
			</div>
			
			<div class="main-container footer-menu">
				<nav id="site-navigation" class="container main-navigation footer-item">
					<?php
					wp_nav_menu(
						array(
							'menu_id' => '4',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
			
			<div class="main-container desc">
				<p class="footer-credit text-center">Web design by Shaun Yow</p>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
