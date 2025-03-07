<?php
$class_name = 'customer-testimonial-block';
?>
<div class="wp-block-group alignfull has-primary-light-background-color has-background is-layout-constrained wp-block-group-is-layout-constrained <?php echo esc_attr($class_name); ?>" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
    <div class="wp-block-columns alignwide is-layout-flex wp-container-core-columns-is-layout-12 wp-block-columns-is-layout-flex">
        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow has-wp-block-custom-swiper" style="padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
            <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color has-link-color" style="padding-bottom:var(--wp--preset--spacing--50)"><?php echo get_field('testimonial_heading'); ?></h2>
            <div class="swiper customer-testimonial-swiper">
                <?php if( have_rows('customer_testimonial_loop') ): ?>
                    <div class="swiper-wrapper">
                    <?php while( have_rows('customer_testimonial_loop') ): the_row(); 
                    $author_image = get_sub_field('testimonial_author_image');
                    $author_review = get_sub_field('author_review');
                    $author_name = get_sub_field('author_name');
                    $author_comment = get_sub_field('author_comment');
                    ?>
                    <div class="swiper-slide">
                        <div class="wp-block-group is-layout-constrained wp-container-core-group-is-layout-2 wp-block-group-is-layout-constrained">
                            <figure class="wp-block-image aligncenter size-large"><img decoding="async" src="<?php echo esc_url($author_image['url']); ?>" alt="<?php echo esc_attr($author_image['alt']); ?>" class="wp-image-113"></figure>
                            <figure class="wp-block-image aligncenter size-large"><img decoding="async" src="<?php echo esc_url($author_review['url']); ?>" alt="<?php echo esc_attr($author_review['alt']); ?>" class="wp-image-114"></figure>
                            <?php if( $author_comment ): ?>
                                <p class="has-text-align-center has-white-color has-text-color has-link-color has-regular-font-size"><?php echo esc_html($author_comment); ?></p>
                            <?php endif; ?>
                            <?php if( $author_name ): ?>
                                <p class="has-text-align-center has-white-color has-text-color has-link-color has-medium-font-size"><?php echo esc_html($author_name); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>
