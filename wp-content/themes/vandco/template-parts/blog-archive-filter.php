<?php
	global $post;
	$current_category = get_queried_object();
	$current_category_slug = is_category() ? $current_category->slug : '';
?>
<div class="blog-archive-filter">
	<div class="filter-category">
		<?php
		$categories = get_categories();
		if (!empty($categories)) {
			echo '<ul class="filter-category-lists">';
			$all_class = ($current_category_slug === '') ? 'active' : '';
			echo '<li class="blog-all ' . esc_attr($all_class) . '"><a href="' . esc_url(site_url('blog')) . '" class="category-name">All</a></li>';
			foreach ($categories as $category) {
				$active_class = ($category->slug === $current_category_slug) ? 'active' : '';
				echo '<li class="' . esc_html($category->slug) . ' ' . esc_attr($active_class) . '"><a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-name">' . esc_html($category->name) . '</a></li>';
			}
			echo '</ul>';
		}
		?>
	</div>
</div>
