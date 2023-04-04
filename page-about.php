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
        <section class="about-section">
            <?php
					if ( function_exists( 'get_field' ) ) :
						if ( get_field( 'portrait') ) :
							$portrait = get_field( 'portrait' );
							echo wp_get_attachment_image( $portrait, 'large' );
						endif;
					endif;

					if (function_exists( 'get_field_object' ) ) :
						if ( get_field_object( 'about') ) :
							$field = get_field_object('about');
							?>

            <h1 class="page-title"><?php echo $field['label']; ?></h1>
            <p><?php echo esc_html($field['value']); ?></p>
            <?php 
						endif;
					endif;
				?>
        </section>
        <?php
				if ( function_exists( 'get_field' ) ) :

					if ( get_field( 'collab_links') ) :
						$collabObj = get_field_object('collab_links');
						$collabs = get_field( 'collab_links' );
						?>
        <section class="about-collabs">
            <h2><?php echo esc_html($collabObj['label']); ?></h2>
            <div class="collab-wrap">
                <?php

							$len = count($collabs);
							foreach( $collabs as $collab ) :
								?>
                <a class="collaborator" href="<?php echo esc_url($collab['collab_name']['url']); ?>" target="_blank"
                    rel="noopener noreferrer"><?php echo esc_html($collab['collab_name']['title']); ?></a>
                <?php
								if( $len > 1) :
									echo '<br>'; 
									$len--;
								endif;
							endforeach;
							?>
            </div>
        </section>
        <?php
					endif;

				endif;

				if ( function_exists( 'get_field' ) ) :
					?>
        <section class="about-accessories">
            <?php
						if ( get_field( 'cv_link') ) :
							?>
            <a class="faux-btn" href="<?php the_field('cv_link'); ?>" target="_blank" rel="noopener noreferrer">CV
            </a>
            <?php
						endif;

						if ( get_field( 'portfolio_cta') ) :
							?>
            <a class="faux-btn" href="<?php the_field('portfolio_cta'); ?>" target="_blank"
                rel="noopener noreferrer">Portolio</a>
            <?php
						endif;
					?>
        </section>
        <?php
				endif;

		
				?>
    </div>
    <?php
		endwhile;
		?>

</main>

<?php
get_footer();