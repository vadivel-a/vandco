<?php
class Theme_Settings {

    public function __construct() {
        add_action('init', array($this, 'add_acf_options_pages'));
        add_action('acf/include_fields', array($this, 'register_acf_field_groups'));
        add_action('acf/include_fields', array($this, 'popup_banner_register_acf_field_groups'));
    }

    public function add_acf_options_pages() {
        if (function_exists('acf_add_options_page')) {

            acf_add_options_page(array(
                'page_title'    => 'Other Content',
                'menu_title'    => 'Other Content',
                'menu_slug'     => 'theme-other-contents',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ));

            acf_add_options_sub_page(array(
                'page_title'    => 'Popup Banner',
                'menu_title'    => 'Popup Banner',
                'parent_slug'   => 'theme-other-contents',
            ));

            acf_add_options_sub_page(array(
                'page_title'    => 'Footer',
                'menu_title'    => 'Footer',
                'parent_slug'   => 'theme-other-contents',
            ));
        }
    }

    public function popup_banner_register_acf_field_groups() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }
    
        acf_add_local_field_group( array(
        'key' => 'group_66b8c4e00b014',
        'title' => 'Dena Offer Banner',
        'fields' => array(
            array(
                'key' => 'field_66b8c53e3de43',
                'label' => 'Popup Banner - ON/OFF',
                'name' => 'popup_banner_onoff',
                'type' => 'true_false',
                'instructions' => 'Here ON/OFF the popup banner on the current website with load only once in a day',
            ),
            array(
                'key' => 'field_66b8c4e23de42',
                'label' => 'Popup Banner',
                'name' => 'offer_banner',
                'type' => 'post_object',
                'instructions' => 'Select your offer banner here',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66b8c53e3de43',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'post_type' => array(
                        0 => 'wp_block',
                ),
                'return_format' => 'object',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-popup-banner',
                ),
            ),
        ),
        'position' => 'normal',
        'instruction_placement' => 'label',
        'active' => true,
    ));
    }

    public function register_acf_field_groups() {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group( array(
            'key' => 'group_669360d6a8dd6',
            'title' => 'Product Featured Slider',
            'fields' => array(
                array(
                    'key' => 'field_669360db34d82',
                    'label' => 'Slider',
                    'name' => 'product_featured_slider',
                    'type' => 'post_object',
                    'instructions' => 'Single Product - Featured Slider Section',
                    'post_type' => array(
                        0 => 'wp_block',
                    ),
                    'return_format' => 'object',
                    'ui' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-other-contents',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));

        acf_add_local_field_group(array(
            'key' => 'group_667956267aa92',
            'title' => 'Footer',
            'fields' => array(
                array(
                    'key' => 'field_66795629d987f',
                    'label' => 'Default Footer',
                    'name' => 'default_theme_footer',
                    'type' => 'post_object',
                    'instructions' => 'Here you can select the post to display as the default footer on all pages.',
                    'post_type' => array(
                        0 => 'wp_block',
                    ),
                    'return_format' => 'object',
                    'ui' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-footer',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));
    }
}

// Instantiate the class
new Theme_Settings();
