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
 * @package vandco
 */

get_header();
?>

	<main id="main" class="main site-main" role="main">

		<?php
		while ( have_posts() ) :
			if (have_posts()) {
				the_post();
				the_content();
			}
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
