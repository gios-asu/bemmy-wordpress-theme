<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bemmy
 */

require_once dirname( __FILE__ ) . '/components/Navigation/NextAndPreviousPageLinks.php';

get_header(); ?>

	<div id="primary" class="page">
		<?php
		if ( is_home() && get_header_image() ) :
		?>
			<div class="page__feature" style="background-image: url(<?php header_image(); ?>)">
				<div class="page__feature-container">
					<h1 class="page__title page__title--feature">
						<?php echo get_bloginfo( 'name' ); ?>
					</h1>
					<h2 class="page__description page__description--feature">
						<?php echo get_bloginfo( 'description' ); ?>
					</h2>
				</div>
			</div>
		<?php
		endif;
		?>
		<main id="main" class="page__main" role="main">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			$first = true;
			/* Start the Loop */
			while ( have_posts() ) :
				if ( $first ) {
					$first = false;
				} else {
					echo '<hr />';
				}

				the_post();
				

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			//the_posts_navigation();
			NextAndPreviousPageLinks();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
