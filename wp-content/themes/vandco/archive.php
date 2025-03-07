<?php
global $post;
get_header();

$qo = get_queried_object();
echo '<main id="main" class="main site-main" role="main">';
do_action('before_archive_loop', $qo);

$archive_post_classes = ['archive-posts category-lists wp-block-post-template is-layout-flow wp-block-post-template-is-layout-flow'];
if (is_a($qo, 'WP_Post_Type')) {
	$archive_post_classes[] = sprintf('post-type-%s', $qo->name);
}
$archive_post_classes = apply_filters('archive_loop_classes', $archive_post_classes, $qo);
?>
<div class="archive-posts category-lists">
	<ul class="<?php echo implode(' ', $archive_post_classes); ?>">
		<?php
		$post_index = 1;
		while (have_posts()) {
			the_post();
			do_action('before_archive_post', $post, $post_index);
			do_action('the_archive_post', $post);
			do_action('after_archive_post', $post, $post_index);
			$post_index++;
		}
		?>
	</ul>
</div>
<?php
do_action('after_archive_loop', $qo);
echo '</main>';
get_footer();
