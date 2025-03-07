<?php
$class_name = 'block-brand-slider';
?>
<div class="wp-block-group alignfull is-layout-constrained wp-block-group-is-layout-constrained <?php echo esc_attr($class_name); ?>" style="margin-top:var(--wp--preset--spacing--60);padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<div class="wp-block-group alignwide featured-brand-slider is-layout-constrained wp-block-group-is-layout-constrained">
		<h2 class="wp-block-heading has-text-align-center"><strong><?php echo get_field('vandco_brand_heading'); ?></strong></h2>
		<div class="swiper brand-slider">
        <?php if( have_rows('brand_images') ): ?>
			<div class="swiper-wrapper">
                <?php 
                while( have_rows('brand_images') ): the_row(); 
                    $brand_image = get_sub_field('brand_image');
                ?>
				<!-- Slides -->
				<div class="swiper-slide has-text-align-center">
					<figure class="wp-block-image size-full">
                        <img loading="lazy" decoding="async" width="250" height="60" src="<?php echo esc_url($brand_image['url']); ?>" alt="<?php echo esc_attr($brand_image['alt']); ?>">
                    </figure>
				</div>
                <?php endwhile; ?>
			</div>
        <?php endif; ?>
		</div>
	</div>
</div>
