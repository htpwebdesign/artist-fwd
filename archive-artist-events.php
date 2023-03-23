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
							<h2><?php the_title("<h2>", "</h2>"); ?></h2>

							<?php
							if (function_exists( 'get_field' ) ) :

								if ( get_field( 'event_photo') ) :
									$photo = get_field('event_photo');
									?>
									<img class='event-photo' src="<?php echo esc_url($photo['sizes']['medium']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>"/>
									<?php 
								endif;
								
								if ( get_field( 'events_calendar') ) :
									?>
									<p><?php the_field('events_calendar'); ?></p>
									<?php 
								endif;

								if ( get_field( 'event_description') ) :
									?>
									<p><?php the_field('event_description'); ?></p>
									<?php 
								endif;

								if ( get_field( 'event_collabs') ) :
									$collab = get_field('event_collabs');
									?>
									<h3><?php esc_html_e($collab[0]['event_collab_names']); ?></h3>
									<p><?php esc_html_e($collab[0]['event_collab_description']); ?></p>
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


		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>


	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
