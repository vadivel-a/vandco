<?php
$class_name = 'popup-image-block';
$image = get_field("popup_image");
?>
<div class="<?php echo esc_attr($class_name); ?>">
    <div class="popup-video-container">
        <figure class="wp-block-image size-full is-style-default">
            <img fetchpriority="high" decoding="async" width="1024" height="846" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="popup-wp-image">
        </figure>
        <?php 
            if ( get_field('enable_video_popup') === 'enable' ) {
            $video_url = get_field("video_popup_url");
        ?>
            <div class="video-popup-modal">
                <a class="wp-video-button__link" href="<?php echo $video_url; ?>" data-modaal-scope="modaal_1721812331544ad1279f20a50a">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/images/video-play.svg" alt="Video Play Icon" />
                </a>
            </div>
        <?php } ?>
    </div>
</div>