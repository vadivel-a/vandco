<?php
/**
 * Blog Banner
 */
$hero = get_field('blog_banner_group', 'options');
if( $hero ): 
?>
<div class="wp-block-group is-layout-constrained alignwide blog-archive-hero" style="margin:0 auto;">
	<div class="banner-columns">
		<div class="banner-column">
			<div class="blog-banner-content">
				<p class="blog-date"><?php echo esc_html( $hero['blog_date'] ); ?></p>
				<h2 class="wp-block-heading"><?php echo esc_html( $hero['blog_title'] ); ?></h2>
				<p class="blog-content"><?php echo esc_html( $hero['blog_description'] ); ?></p>
				<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
					<div class="wp-block-button is-style-fill">
						<a href="<?php echo esc_url( $hero['blog_link']['url'] ); ?>" target="_self" class="wp-block-button__link wp-element-button">
							Learn More
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-column">
			<figure class="wp-block-image size-large">
				<img src="<?php echo esc_url( $hero['blog_banner_image']['url'] ); ?>" alt="<?php echo esc_attr( $hero['blog_banner_image']['alt'] ); ?>" class="text-wp-image">
			</figure>
		</div>
	</div>
</div>
<?php endif; ?>