<?php
/**
 * The template for displaying all single posts.
 *
 * @package Poseidon
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single-video' );

			do_action( 'poseidon_after_posts' );

			poseidon_related_posts();

			comments_template();

		endwhile; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
