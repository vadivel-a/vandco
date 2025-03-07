<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package vandco
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title">
					<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'vandco' ); ?>
				</h1>
				<div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-is-layout-1 wp-block-buttons-is-layout-flex">
					<div class="wp-block-button is-style-outline has-custom-font-size is-style-outline has-small-font-size">
						<a href="<?php echo get_site_url(); ?>" class="wp-block-button__link has-text-align-center wp-element-button" >Back to Home</a>
					</div>
				</div>
			</header><!-- .page-header -->
			<img class="no-rsult-image" src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/404.jpg" alt="No Result">
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
