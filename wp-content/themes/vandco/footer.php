<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vandco
 */

?>

	<footer id="default-footer" class="default-footer footer">
		<?php
			$footer_default = get_field('default_theme_footer', 'option');
			if ($footer_default && !is_wp_error($footer_default)) {
				echo apply_filters('the_content', $footer_default->post_content);
			} else {
				echo '<p>No default footer content found.</p>';
			}
		?>
	</footer><!-- #colophon -->
</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>
