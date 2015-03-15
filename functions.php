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

 	add_menu_page(
 		'ZRECommerce Storefront Dashboard', // Page title
 		'Storefront', // Menu title
 		'read', // Capability
 		'zrecommerce', // Menu slug
 		'zrecommerce_admin_plugin', // Function
 		get_template_directory_uri() . '/assets/icons/logo-16x16.png', // Icon
 		0.99 // Load it near the top.
 	);

 	add_submenu_page(
 		'zrecommerce', // Parent slug
 		'ZRECommerce Storefront Dashboard - Reports', // Page title
 		'Reports', // Menu title
 		'read', // Capability
 		'zrecommerce-reports', // Menu slug
 		'zrecommerce_admin_plugin_reports' // Function
 	);

 	add_submenu_page(
 		'zrecommerce', // Parent slug
 		'ZRECommerce Storefront Dashboard - Orders', // Page title
 		'Orders', // Menu title
 		'read', // Capability
 		'zrecommerce-orders', // Menu slug
 		'zrecommerce_admin_plugin_orders' // Function
 	);

 	add_submenu_page(
 		'zrecommerce', // Parent slug
 		'ZRECommerce Storefront Dashboard - Services', // Page title
 		'Services', // Menu title
 		'read', // Capability
 		'zrecommerce-services', // Menu slug
 		'zrecommerce_admin_plugin_services' // Function
 	);
 }

 // ---- System: Plugins ----
 function zrecommerce_admin_plugin() {
 	// @todo STUB: Output the admin page for the ZRECommerce Storefront.
 	get_template_part('admin-plugin');
 }

 function zrecommerce_admin_plugin_reports() {
 	// @todo STUB: Output the ZRECommerce reports page.
 	get_template_part('admin-plugin-reports');
 }

 function zrecommerce_admin_plugin_orders() {
 	// @todo STUB: Output the ZRECommerce reports page.
 	get_template_part('admin-plugin-orders');
 }

 function zrecommerce_admin_plugin_services() {
 	// @todo STUB: Output the ZRECommerce reports page.
 	get_template_part('admin-plugin-services');
 }

 // ---- System: Functions ----

 function zrecommerce_enabled() {
 	// @todo STUB: wire up to save/load setting via admin
 	return false;
 }
 function zrecommerce_config() {
 	// @todo STUB: save/load config via admin
 }

 add_action( 'init', 'register_menus' );
 add_action( 'wp_enqueue_scripts', 'register_js');
 add_theme_support( 'html5', array( 'search-form' ) );

 add_action( 'admin_menu', 'zrecommerce_admin_menu' );

?>