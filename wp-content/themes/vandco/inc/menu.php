<?php

function vandco_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	
	$field_group = array(
		'key' => 'group_header_menu_customize_option',
		'title' => 'Menu Item Settings',
		'fields' => array(
			array(
				'key' => 'field_header_menu_customize_option_icon',
				'label' => 'Icon',
				'name' => 'menu_item_icon',
				'type' => 'image',
				'return_format' => 'url',
			),
			array(
				'key' => 'field_6681184941f3d',
				'label' => 'Select CTA',
				'name' => 'select_cta',
				'type' => 'select',
				'choices' => array(),
				'instructions' => 'It will work only for megamenu',
				'multiple' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'nav_menu_item',
					'operator' => '==',
					'value' => '2', // Replace with your menu location slug
				),
			),
			array(
				array(
					'param' => 'nav_menu_item',
					'operator' => '==',
					'value' => '3', // Replace with your menu location slug
				),
			),
		),
	);

	$dynamic_options = array();
	$posts = get_posts(array(
		'post_type' => 'wp_block',
		'post_status' => 'publish',
		'numberposts' => -1,
	));

	if ($posts) {
		foreach ($posts as $post) {
			$dynamic_options[$post->ID] = $post->post_title;
		}
	}

	$static_option = array(
		'' => 'Select the option', // Static value and label
	);

	$field_group['fields'][1]['choices'] = $static_option + $dynamic_options;

	acf_add_local_field_group($field_group);
}

add_action('acf/include_fields', 'vandco_register_acf_fields');

class Custom_Menu_Walker extends Walker_Nav_Menu {
	
	// Override start_el method to add ACF field data
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		// Get ACF field value for the menu item (adjust 'acf_field_name' to your ACF field name)
		$acf_value = get_field( 'menu_item_icon', $item );

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $class_names . '>';

		$output .= $args->before;

		$cta_class = 'menu-link';
		if ($selected_product = get_field('select_cta',$item)) {
			$cta_class .= ' product-item-link';
		}
		$output .= '<a href="' . $item->url . '" class="'.$cta_class.'">';
		if ( ! empty( $acf_value ) ) {
			$output .= '<span class="menu-icon"><img src="'.$acf_value.'" alt="'.esc_attr($item->title).'"></span>';
		}

		if ( in_array( 'currency', $item->classes ) ) {
			$output .= do_shortcode('[woocs]');
		}

		$output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

		if ( in_array( 'cart-count', $item->classes ) ) {
			$cart_count = WC()->cart->get_cart_contents_count();
			if ($cart_count) {
				$output .= '<div class="mini-cart-count"> ' . $cart_count . '</div>';
			}
		}

		if ( in_array( 'wishlist-count', $item->classes ) ) {
			$wishlist_count = '';
			if ( class_exists( 'YITH_WCWL' ) ) {
				$wishlist_count = YITH_WCWL()->count_products();
				$output .= '<div class="mini-wishlist-count"> ' . $wishlist_count . '</div>';
			}
		}

		$output .= '</a>';

		if ($selected_product = get_field('select_cta',$item)) {
			$post = get_post($selected_product);
			$block_content = $post->post_content;
			if (!empty($block_content)) {
				$output .= '<div class="product-item">'.apply_filters('the_content', $block_content).'</div>';
			}
		}

		$output .= $args->after;
	}
}


