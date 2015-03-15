<?php
 /**
  * Functions include
  */

 // ---- System: Theme ----
 function process_nav_menu_item_class($classes, $item) {

 	$classes[] = "nav-link";
 	return $classes;
 }
 function register_menus() {
 	register_nav_menus(array(
 		'navigation-menu'    => 'Navigation',
 		'content-navigation' => 'Content',
 		'social-navigation'  => 'Social',
 		'legal-navigation'   => 'Legal'
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

 // ---- Admin: Config ----
 function zrecommerce_admin_install() {
 	// @todo STUB: Admin menu(s) setup
 }

 function zrecommerce_admin_uninstall() {
 	// @todo STUB: Admin menu(s) tear-down
 }

 // ---- Admin: Menus ----
 function zrecommerce_admin_menu() {
 	// add_options_page(
 	// 	'ZRECommerce Options',
 	// 	''
 	// );
 }

 function zrecommerce_admin_menu_options() {

 }

 // ---- System: Functions ----

 function zrecommerce_enabled() {
 	// @todo STUB: wire up to save/load setting via admin
 	return true;
 }
 function zrecommerce_config() {
 	// @todo STUB: save/load config via admin
 }

 add_action( 'init', 'register_menus' );
 add_action( 'wp_enqueue_scripts', 'register_js');
 add_theme_support( 'html5', array( 'search-form' ) );

 add_action( 'admin_menu', 'zrecommerce_admin_menu' );

?>