<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vandco
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'vandco' ); ?></a>
	<div class="menu-overlay"></div>
	<header id="header" class="site-header">
		<nav id="site-navigation" class="main-navigation wp-block-group">
			<div class="menu-container wp-block-group alignwide desktop">
				<div class="site-branding">
					<?php
					the_custom_logo();
					?>

				</div><!-- .site-branding -->
				<div class="menu menu-nav navigation_container">
					<ul id="primary-menu" class="menu">
						<?php 
								wp_nav_menu(
									array(
										'theme_location' => 'main-nav',
										'menu_id'        => 'primary-menu',
										'items_wrap' => '%3$s',
										'walker'         => new Custom_Menu_Walker(),
									)
								);	  
						?>
						<div class="search-container active">
							<?php get_search_form(); ?>
						</div>
					</ul>
				</div>

			</div>
			<div class="menu-container mobile">
				<div class="menu-nav mobile-menu navigation_container">
					<ul id="primary-menu-mobile" class="menu">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main-nav',
								'menu_id'        => 'primary-menu',
								'items_wrap' => '%3$s',
								'walker'         => new Custom_Menu_Walker(),
							)
						);
					?>
					<div class="search-container active">
						<?php get_search_form(); ?>
					</div>
					</ul>
				</div>

			</div>


		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

