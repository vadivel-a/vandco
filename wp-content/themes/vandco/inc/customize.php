<?php

/**
 * custom cpt
 */

function create_projects_post_type() {
	// Register the custom taxonomy for project categories
	register_taxonomy('project-category', 'project', array(
		'hierarchical' => true, // No parent-child relationships
		'label' => 'Project Categories',
		'rewrite' => array('slug' => 'project-category'),
		'show_in_rest' => true, // Enable REST API support
	));

	// Register the custom post type 'project'
	$args = array(
		'labels' => array(
			'name' => 'Projects',
			'singular_name' => 'Project',
			'add_new' => 'Add New Project',
			'add_new_item' => 'Add New Project',
			'edit_item' => 'Edit Project',
			'new_item' => 'New Project',
			'view_item' => 'View Project',
			'search_items' => 'Search Projects',
			'not_found' => 'No projects found',
			'not_found_in_trash' => 'No projects found in Trash',
			'all_items' => 'All Projects',
			'archives' => 'Project Archives',
			'insert_into_item' => 'Insert into project',
			'uploaded_to_this_item' => 'Uploaded to this project',
			'menu_name' => 'Projects',
		),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'project'),
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'taxonomies' => array('project-category'),
	);

	register_post_type('project', $args);
}
add_action('init', 'create_projects_post_type');

function create_teams_post_type() {
	// Register the custom taxonomy for team categories
	register_taxonomy('team-category', 'team', array(
		'hierarchical' => true, // No parent-child relationships
		'label' => 'Team Categories',
		'rewrite' => array('slug' => 'team-category'),
		'show_in_rest' => true, // Enable REST API support
	));

	// Register the custom post type 'team'
	$args = array(
		'labels' => array(
			'name' => 'Teams',
			'singular_name' => 'Team',
			'add_new' => 'Add New Team',
			'add_new_item' => 'Add New Team',
			'edit_item' => 'Edit Team',
			'new_item' => 'New Team',
			'view_item' => 'View Team',
			'search_items' => 'Search Teams',
			'not_found' => 'No teams found',
			'not_found_in_trash' => 'No teams found in Trash',
			'all_items' => 'All Teams',
			'archives' => 'Team Archives',
			'insert_into_item' => 'Insert into team',
			'uploaded_to_this_item' => 'Uploaded to this team',
			'menu_name' => 'Teams',
		),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'team'),
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'taxonomies' => array('team-category'),
	);

	register_post_type('team', $args);
}
add_action('init', 'create_teams_post_type');

/**
 * team acf
 */
function create_team_custom_fields() {
	// Register ACF field group for the 'team' custom post type
	if (function_exists('acf_add_local_field_group')) {
		acf_add_local_field_group([
			'key' => 'group_team_info',
			'title' => 'Team Information',
			'fields' => [
				[
					'key' => 'field_team_location',
					'label' => 'Location',
					'name' => 'member_location',
					'type' => 'text',
				],
				[
					'key' => 'field_team_phone',
					'label' => 'Phone',
					'name' => 'member_phone',
					'type' => 'text',
				],
			],
			'location' => [
				[
					[
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'team',
					],
				],
			],
			'position' => 'normal',
			'style' => 'seamless',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
		]);
	}
}
add_action('init', 'create_team_custom_fields');

function register_acf_team_block() {
	if (function_exists('acf_register_block_type')) {
		acf_register_block_type(array(
			'name'              => 'team-info',
			'title'             => __('Team Info'),
			'description'       => __('A custom block to display team info.'),
			'render_callback'   => 'render_team_info_block',
			'category'          => 'common',
			'icon'              => 'location',
			'keywords'          => array('team', 'phone', 'location'),
		));
	}
}
add_action('acf/init', 'register_acf_team_block');

function render_team_info_block($block) {
	global $post;
	$member_location = get_field('member_location', $post);
	$member_phone = get_field('member_phone', $post);
	if ($member_location): ?>
		<div class="team-location">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="16px" width="16px" version="1.1" id="Layer_1" viewBox="0 0 511.953 511.953" xml:space="preserve">
			<g transform="translate(-1)">
				<g>
					<g>
						<path d="M256.995,149.287c-11.776,0-21.333,9.579-21.333,21.333c0,11.755,9.557,21.333,21.333,21.333s21.333-9.579,21.333-21.333     C278.328,158.865,268.771,149.287,256.995,149.287z"/>
						<path d="M365.518,38.887C325.987,6.311,274.04-6.639,223.011,3.239C154.147,16.615,100.152,72.273,88.718,141.735     c-6.784,41.003,0.725,81.216,21.696,116.267l8.704,14.528c27.861,46.443,56.64,94.485,79.701,143.893l38.848,83.221     c3.499,7.509,11.029,12.309,19.328,12.309s15.829-4.8,19.328-12.309l34.965-74.923c23.317-49.984,52.096-98.688,79.957-145.792     l12.971-22.016c15.339-26.091,23.445-55.936,23.445-86.293C427.662,119.484,405.006,71.463,365.518,38.887z M256.995,234.62     c-35.285,0-64-28.715-64-64s28.715-64,64-64s64,28.715,64,64S292.28,234.62,256.995,234.62z"/>
					</g>
				</g>
			</g>
			</svg>
			<?php echo esc_html($member_location); ?>
		</div>
	<?php endif;

	if ($member_phone): ?>
		<div class="team-phone">
		<svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g clip-path="url(#clip0_15_535)">
			<rect width="24" height="24" fill="white"/>
			<path d="M2.01394 6.87134C1.34749 10.0618 3.85967 13.8597 7.01471 17.0147C10.1698 20.1698 13.9676 22.682 17.1581 22.0155C19.782 21.4674 21.1215 20.0697 21.8754 18.8788C22.1355 18.4678 22.0042 17.9344 21.6143 17.6436L17.9224 14.8897C17.5243 14.5928 16.9685 14.633 16.6174 14.9842L14.6577 16.9438C14.6577 16.9438 12.7529 16.3246 10.2288 13.8006C7.70482 11.2766 7.08564 9.37175 7.08564 9.37175L9.04529 7.4121C9.39648 7.06091 9.43671 6.5052 9.13975 6.10709L6.38585 2.4151C6.09505 2.02525 5.56163 1.89395 5.15068 2.15407C3.9597 2.90794 2.56203 4.24747 2.01394 6.87134Z" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M19 1L19 10M19 10L23 6M19 10L15 6" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
			</g>
			<defs>
			<clipPath id="clip0_15_535">
			<rect width="24" height="24" fill="white"/>
			</clipPath>
			</defs>
		</svg>
			<?php echo esc_html($member_phone); ?>
		</div>
	<?php endif;
}


function enqueue_swiper_assets() {
	// Enqueue Swiper CSS
	wp_enqueue_style('swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css');
	
	// Enqueue Swiper JS (loaded in the footer)
	wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);
	
	// Add inline Swiper initialization script
	$swiper_init_script = "
		document.addEventListener('DOMContentLoaded', function () {
			var Swipes = new Swiper('.swiper-container', {
				loop: true,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				pagination: {
					el: '.swiper-pagination',
				},
			});
		}); 
	";
	
	wp_add_inline_script('swiper-js', $swiper_init_script);
}
//add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');

/*add_filter( 'render_block', function( $block_content, $block ) {

	if ( 'core/query' === $block['blockName'] ) {

		if ( has_block( 'core/query' ) ) {
			$block_content = preg_replace_callback( '/<li(.*?)>/', function ( $matches ) {
				static $index = 0;
				$index++;
				$dynamic_class = 'swiper-slide loop-item-' . $index;
				return str_replace( 'class="', 'class="' . $dynamic_class . ' ', $matches[0] );
			}, $block_content );
		}
	}
	return $block_content;
}, 10, 2 );*/
