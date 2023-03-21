<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Artist_FWD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			?>
			<div class="entry-content">
			<?php
			if (function_exists( 'get_field' ) ) :
				if ( get_field( 'hero_image') ) :
					$images = get_field( 'hero_image' );
					shuffle($images);

					foreach( $images as $image ): ?>
						<div class="img-wrapper">
							<img class='hero-img' src="<?php echo esc_url($image ['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>	
						</div>
					<?php break;
					endforeach; 
					
				endif;
			endif;
			?>
			</div>
		<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
