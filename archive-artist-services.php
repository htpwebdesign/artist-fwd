<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Artist_FWD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				post_type_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
				$args = array(
					'post_type' => 'artist-services',
					'posts_per_page' => -1,
					'order' => 'ASC',
					'orderby' => 'title',
				);

				$query = new WP_Query( $args );

				if ( $query -> have_posts() ) :

					while ( $query -> have_posts() ) :
						$query -> the_post();
						?>
						<div class="service-wrapper">
							<button type="button" class="collapsible">
								<h2><?php esc_html_e(get_the_title()); ?></h2>
							</button>

							<div class="service-content" style="display:none">
								<?php
								if (function_exists( 'get_field' ) ) :
									
									if ( get_field( 'service_description') ) :
										?>
										<p><?php the_field('service_description'); ?></p>
										<?php 
									endif;

									if ( get_field( 'service_price') ) :
										?>
										<p><?php the_field('service_price'); ?></p>
										<?php 
									endif;

								endif;
								?>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;

				$args = array ( 'page_id' => 154 );

				$query = new WP_Query( $args );
				if ( $query -> have_posts() ) :
					while ( $query -> have_posts() ) :
						$query -> the_post();
						the_content();
					endwhile;
					wp_reset_postdata();
				endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
