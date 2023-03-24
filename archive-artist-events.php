<?php
/**
 * The template for displaying archive-artist-events page
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
			</header>

			<?php
			$args = array(
				'post_type' => 'artist-events',
				'posts_per_page' => -1,
			);

			$query = new WP_Query( $args );

			if ( $query -> have_posts() ) :

				while ( $query -> have_posts() ) :
					$query -> the_post();
					?>
					<div class="event-wrapper">
						<h2 class="event-name"><?php the_title(); ?></h2>

						<?php
						if (function_exists( 'get_field' ) ) :
							?>
							
								<?php
								if ( get_field( 'event_photo') ) :
									$photo = get_field('event_photo');
									echo wp_get_attachment_image( $photo, 'large' );
								endif;
								
								if ( get_field( 'events_calendar') ) :
									?>
									<p class="event-date"><?php the_field('events_calendar'); ?></p>
									<?php 
								endif;

								if ( get_field( 'event_desc') ) :
									?>
									<p class="event-description"><?php the_field('event_description'); ?></p>
									<?php 
								endif;

								if ( get_field( 'event_collabs') ) :
									$collab = get_field('event_collabs');
									?>
									<h3 class="collab-name"><?php esc_html_e($collab[0]['event_collab_names']); ?></h3>
									<p class="collab-desc"><?php esc_html_e($collab[0]['event_collab_description']); ?></p>
									<?php 
								endif;

								if ( get_field( 'event_map') ) :
								acf_make_map( get_field( 'event_map' ) );
								endif;	
						endif;
					?>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>


	</main>

<?php
get_footer();
