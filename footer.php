<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Artist_FWD
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<p>&copy; Elisa He, Henry Vu, Len Tong, Peter Nguyen 2023.</p>
			<nav class="footer-info">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu'
						)
					);
				?>
			</nav>
		</div>

	</footer>

<?php wp_footer(); ?>

</body>
</html>
