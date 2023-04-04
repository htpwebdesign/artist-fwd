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


    <div class="page-wrap">

        <?php
				$args = array(
					'post_type' => 'artist-services',
					'posts_per_page' => -1,
					'order' => 'ASC',
					'orderby' => 'title',
				);

				$query = new WP_Query( $args );

				if ( $query -> have_posts() ) :
				echo '<div class="service-contain">';

					while ( $query -> have_posts() ) :
						$query -> the_post();
						?>
        <article class="service-wrapper">
            <button type="button" class="collapsible">
                <p class='collapsible-title'>
                    <?php esc_html_e(get_the_title()); ?>
                </p>
                <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24">
                    <path
                        d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                </svg>
            </button>

            <section class="service-content" style="display:none">
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
            </section>
        </article>
        <?php
					endwhile;
					wp_reset_postdata();
				endif;
			echo	"</div>";
				echo do_shortcode('[wpforms id="151"]');

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
    </div>

</main>

<?php
get_footer();