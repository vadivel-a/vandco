<?php
$class_name = 'text-image-block';

$heading = get_field( "text_image_title" );
$content = get_field( "text_image_content" );
$link = get_field( "link" );
$type = get_field('type');
$size = 'large';
?>
<div class="<?php echo esc_attr($class_name); ?>">
	<div class="textimage-container content-columns">
		<div class="textimage-content content-column">
			<?php if( $heading ) { ?>
				<h2 class="wp-block-heading"><?php echo wp_kses_post( $heading ); ?></h2>
			<?php } ?>
			<?php if( $content ) { ?>
				<p><?php echo wp_kses_post( $content ); ?></p>
			<?php } ?>
			<?php
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
			?>
				<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
					<div class="wp-block-button is-style-fill">
						<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="wp-block-button__link wp-element-button">
							<?php echo esc_html( $link_title ); ?>
						</a>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="textimage-banner content-column <?php echo (get_field('type') != 'image') ? 'video-section' : ''; ?>">
			
		<?php
			if( get_field('type') == 'image' ) {
				$image = get_field('image');
			?>
			<figure class="wp-block-image size-large">
				<img fetchpriority="high" decoding="async" width="1024" height="846" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="text-wp-image">
			</figure>
			<?php
			}
		?>

		<?php
			$video_url = get_field('video');
			if ($video_url) {
				preg_match('/(?:https:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([^"&?\s]{11})/', $video_url, $matches);
				$video_id = isset($matches[1]) ? $matches[1] : '';
				if ($video_id) {
					$embed_url = 'https://www.youtube.com/embed/' . $video_id . '?feature=oembed&controls=0&hd=1&autohide=1&autoplay=1&loop=1&playlist=' . $video_id . '&modestbranding=1&rel=0&showinfo=0&mute=1';
			?>
				<div class="video-wrapper">
					<iframe
						title="Embedded Video"
						width="100%"
						height="450px"
						src="<?php echo esc_url($embed_url); ?>"
						frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						referrerpolicy="strict-origin-when-cross-origin"
						allowfullscreen>
					</iframe>
				</div>
			<?php
				}
			}
		?>
</div>
	</div>
</div>