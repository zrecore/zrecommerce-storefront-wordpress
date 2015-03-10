<?php
 /**
  * Functions include
  */

 function process_nav_menu_item_class($classes, $item) {
 	$classes[] = "nav-link";
 	return $classes;
 }
 function register_menus() {
 	register_nav_menus(array(
 		'navigation-menu' => 'Navigation'
 	));

 	add_filter( 'nav_menu_css_class', 'process_nav_menu_item_class', 10, 2 );
 }

 function register_js() {
 	wp_register_script(
 		'header-script', 
 		get_template_directory_uri() + '/js/header.js', 
 		array('jquery')
 	);
 	wp_enqueue_script('header-script');
 }

 add_action( 'init', 'register_menus' );
 add_action( 'wp_enqueue_scripts', 'register_js');

?>