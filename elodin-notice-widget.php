<?php

/*
	Plugin Name: Elodin Notice Widget
	Plugin URI: https://elod.in
    Description: Just another notice widget plugin
	Version: 0.1.2
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/


/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Plugin directory
define( 'ELODIN_NOTICE_WIDGET', dirname( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_NOTICE_WIDGET_VERSION', '0.1.2' );

add_action( 'wp_enqueue_scripts', 'elodin_notice_enqueue_everything' );
function elodin_notice_enqueue_everything() {

	// Plugin styles
    wp_enqueue_style( 'elodin-notice-style', plugin_dir_url( __FILE__ ) . 'css/elodin-notice-style.css', array(), ELODIN_NOTICE_WIDGET_VERSION, 'screen' );
    
    // Script
    wp_enqueue_script( 'jquery-cookie', plugin_dir_url( __FILE__ ) . 'js/jquery.cookie.js', array( 'jquery' ), ELODIN_NOTICE_WIDGET_VERSION, true );
    wp_enqueue_script( 'elodin-notice-dismissable', plugin_dir_url( __FILE__ ) . 'js/elodin-notice-dismissable.js', array( 'jquery-cookie' ), ELODIN_NOTICE_WIDGET_VERSION, true );
	
}

add_action( 'widgets_init', 'elodin_notice_register_widget_area' );
function elodin_notice_register_widget_area() {
    register_sidebar( array(
        'name'          => __( 'Site Notice', 'elodin_notice_widget' ),
        'id'            => 'site-notice',
        'before_widget' => '<div id="site-notice" class="site-notice"><div class="notice-wrap"><a href="#" class="close-notice"><span></span><span></span></a>',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h2 class="notice-title">',
        'after_title'   => '</h2>',
    ) );
}

add_action( 'wp_footer', 'elodin_notice_display_widget_area' );
function elodin_notice_display_widget_area() {
    if ( !$_COOKIE["notice_hidden"] )
        dynamic_sidebar( 'site-notice' );
}