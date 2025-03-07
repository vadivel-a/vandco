<?php
class Blog_Template {

	public static function setup() {
		add_action('pre_get_posts', [__CLASS__, 'register_singular_actions']);
		add_action('pre_get_posts', [__CLASS__, 'register_archive_actions']);
	}

	public static function register_archive_actions(WP_Query $query) {
		if (!is_admin() && $query->is_main_query()) {

			if ($query->is_search()) {
				$query->set('post_type', 'post');
			}

			if ($query->is_home() || $query->is_category() || $query->is_search()) {
				add_action('before_archive_loop', [__CLASS__, 'inject_archive_header']);
				add_action('before_archive_loop', [__CLASS__, 'inject_archive_filter']);
				add_action('the_archive_post', [__CLASS__, 'archive_item']);
				add_action('after_archive_loop', [__CLASS__, 'archive_pagination']);
			}
		}
	}

	public static function inject_archive_header(): void {
		get_template_part( 'template-parts/blog', 'hero-banner');
	}

	public static function inject_archive_filter(): void {
		get_template_part('template-parts/blog', 'archive-filter');
	}

	public static function archive_item(): void {
		global $post;
		$expert_content = get_post_meta($post->ID, 'expert_content', true);
		$default_message = get_the_excerpt();
		?>
			<li class="post-card wp-block-post">
				<div class="post-image">
					<figure class="wp-block-post-featured-image">
						<img src="<?php echo esc_url( get_the_post_thumbnail_url($post->ID, 'large') ); ?>" alt="<?php echo get_the_title() ?>" class="text-wp-image">
					</figure>
				</div>
				<div class="wp-block-post-date"><?php echo get_the_date('D, M d'); ?></div>
				<h2 class="wp-block-post-title">
					<a href="<?php echo get_the_permalink(); ?>" target="_self" >
						<?php echo get_the_title() ?>
					</a>
				</h2>
				<div class="wp-block-post-excerpt">
					<p class="wp-block-post-excerpt__excerpt"><?php echo !empty($expert_content) ? esc_html($expert_content) : esc_html($default_message); ?></p>
					<p class="wp-block-post-excerpt__more-text">
						<a href="<?php echo get_the_permalink(); ?>" target="_self" class="wp-block-post-excerpt__more-link">Learn More</a>
					</p>
				</div>
			</li>
		<?php
		return;
	}

	public static function archive_pagination(): void {
		global $wp_query;

		$big = 999999999;
		$current_page = max(1, get_query_var('paged'));
		$total_pages = $wp_query->max_num_pages;

		$pagination_links = paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => $current_page,
			'total' => $total_pages,
			'prev_text' => __('Prev'),
			'next_text' => __('Next'),
			'before_page_number' => '<span class="screen-reader-text">' . __('Page ') . '</span>',
			'type' => 'array',
		));

		if ($pagination_links) {
			echo '<nav class="archive-pagination">';
			// First Page link
			if ($current_page > 1) {
				echo '<a class="first-page" href="' . esc_url(get_pagenum_link(1)) . '">' . __('First') . '</a>';
			}
			// Pagination links
			foreach ($pagination_links as $link) {
				echo $link;
			}
			// Last Page link
			if ($current_page < $total_pages) {
				echo '<a class="last-page" href="' . esc_url(get_pagenum_link($total_pages)) . '">' . __('Last') . '</a>';
			}
			echo '</nav>';
		}
	}

	public static function register_singular_actions(WP_Query $query): void {
		
		if (is_admin() || !$query->is_main_query() || !$query->is_singular) {
			return;
		}

		/* standard posts don't show a post type?!? */
		$post_type = $query->get('post_type');
		if (is_page() || $post_type && $post_type !== 'post') {
			return;
		}
				
		add_action('before_post_content', [__CLASS__, 'inject_post_hero']);
		add_action('after_post_content', [__CLASS__, 'inject_post_footer']);
	}

	public static function inject_post_hero(): void {
		get_template_part('template-parts/blog', 'detail-hero');
	}

	public static function inject_post_footer(): void {
		//get_template_part('template-parts/content', 'quality-quarantee');
	}

}

add_action('after_setup_theme', function() {
	Blog_Template::setup();
});
