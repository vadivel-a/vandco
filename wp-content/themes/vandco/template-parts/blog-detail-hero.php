<?php
/**
 * Blog Detail page Banner
 */
global $post;
?>
<!-- Banner Detail -->
<div class="wp-block-group single-detail-banner">
    <div class="detail-banner-columns">
        <div class="detail-banner-column">
            <div class="detail-banner-content">
                <p class="blog-date"><?php echo esc_html(get_the_date('D, M d')); ?></p>
                <h2 class="wp-block-heading"><?php echo esc_html(get_the_title()); ?></h2>
            </div>
        </div>
        <div class="detail-banner-column">
            <figure class="wp-block-image size-large">
                <img src="<?php echo esc_url( get_the_post_thumbnail_url($post->ID, 'large') ); ?>" alt="<?php echo get_the_title() ?>" class="text-wp-image">
            </figure>
        </div>
    </div>
</div>
<!-- Breadcrumbs -->
<div id="breadcrumbs" class="vandco-breadcrumbs blog-breadcrumbs">
    <span class="wp-block-group is-layout-constrained wp-block-group-is-layout-constrained">
        <span class="breadcrumb_home">
            <a href="<?php echo site_url('/blog/'); ?>">
                <i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Blogs
            </a>
        </span> /
        <span class="breadcrumb_last" aria-current="page"><?php echo esc_html(get_the_title()); ?></span>
    </span>
</div>
