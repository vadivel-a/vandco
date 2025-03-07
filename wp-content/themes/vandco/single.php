<?php
global $post;
get_header();

if (post_password_required()) {
	get_template_part('parts/content-protected');
} else {
	if (have_posts()) {
		the_post();
		?>
			<main id="main" class="main site-main" role="main">
				<div class="wp-block-group alignwide">
					<div class="single-block-content mob-padding-inline">
						<?php
							do_action('before_post_content', $post);
								the_content();
							do_action('after_post_content', $post);
						?>
					</div>
				</div>
			</main>
		<?php
	}
}

get_footer();
