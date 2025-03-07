<?php

class CustomBlockStyles {
    public static function register_heading_block_styles() {
        register_block_style(
            'core/heading',
            array(
                'name'  => 'display',
                'label' => __('Display', 'text-domain')
            )
        );
        register_block_style(
            'core/heading',
            array(
                'name'  => 'eyebrow',
                'label' => __('Eyebrow', 'text-domain')
            )
        );
        register_block_style(
            'core/heading',
            array(
                'name'  => 'heading-h1',
                'label' => __('Heading H1', 'text-domain')
            )
        );
    }

    /** Load Blocks **/
    public static function register_acf_blocks() {
        register_block_type(__DIR__ . '/blocks/brand-slider');
        register_block_type(__DIR__ . '/blocks/featured-slider');
        register_block_type(__DIR__ . '/blocks/text-image');
        register_block_type(__DIR__ . '/blocks/video-popup');
        register_block_type(__DIR__ . '/blocks/gift-card');
        register_block_type(__DIR__ . '/blocks/gift-card-banner');
        register_block_type(__DIR__ . '/blocks/testimonial');
    }

    public function init() {
        add_action('init', [$this, 'register_heading_block_styles']);
        add_action('init', [$this, 'register_acf_blocks']);
    }
}

$custom_block_styles = new CustomBlockStyles();
$custom_block_styles->init();

