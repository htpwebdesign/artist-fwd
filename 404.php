<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Artist_FWD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'You&rsquo;re probably wondering why I&rsquo;ve gathered you all here... Just kidding! This page just doesn&rsquo;t exist, teehee.', 'artist-fwd' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'Nothing was found at this location. Maybe try a search?', 'artist-fwd' ); ?></p>

					<?php
					get_search_form();
					?>

			</div>
		</section>

	</main>

<?php
get_footer();
