<?php
$class_name = 'block-featured-slider';
?>
<div class="wp-block-group alignfull vandco-featured-slider has-background is-layout-constrained wp-block-group-is-layout-constrained <?php echo esc_attr($class_name); ?>" style="background-color:#f3f7f7;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--80)">
	<div class="wp-block-group alignwide featured-featured-slider is-layout-constrained wp-block-group-is-layout-constrained">
		<h2 class="wp-block-heading has-text-align-center"><strong><?php echo get_field('vandco_featured_heading'); ?></strong></h2>
		<div class="swiper product-featured-slider">
       	 <?php if( have_rows('featured_images') ): ?>
			<div class="swiper-wrapper">
                <?php 
                while( have_rows('featured_images') ): the_row(); 
                    $featured_image = get_sub_field('featured_image');
                ?>
				<!-- Slides -->
				<div class="swiper-slide has-text-align-center">
					<figure class="wp-block-image size-full">
                        <img src="<?php echo esc_url($featured_image['url']); ?>" alt="<?php echo esc_attr($featured_image['alt']); ?>">
                    </figure>
				</div>
                <?php endwhile; ?>
			</div>
        	<?php endif; ?>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</div>