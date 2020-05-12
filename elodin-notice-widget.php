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
        'name'          => __( 'Site notice (popup overlay)', 'elodin_notice_widget' ),
        'id'            => 'site-notice',
        'description'   => 'A popup overlay that appears once every few hours for users',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="notice-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Site notice (bottom bar)', 'elodin_notice_widget' ),
        'id'            => 'site-bar',
        'description'   => 'A bar at the bottom of the screen that allows access to the main notice and shows a shortened version of the message',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<strong class="site-bar-title">',
        'after_title'   => '</strong> ',
    ) );
}

add_action( 'wp_footer', 'elodin_notice_display_site_notice' );
function elodin_notice_display_site_notice() {

    if ( !is_active_sidebar( 'site-bar' ) ) 
        return;

        ?>
        <style>.site-notice { display: none; }</style>
        <?php

    echo '<div id="site-notice" class="site-notice"><div class="notice-wrap"><a href="#" class="close-notice"><span></span><span></span></a>';
        dynamic_sidebar( 'site-notice' );
    echo '</div></div>';
}

add_action( 'wp_footer', 'elodin_notice_display_widget_area' );
function elodin_notice_display_widget_area() {

    //* bail if this sidebar isn't active
    if ( !is_active_sidebar( 'site-bar' ) ) 
        return;

    echo '<div id="site-notice-bar" class="site-bar"><div class="site-bar-wrap"><a href="#" class="close-bar"><span></span><span></span></a>';
        dynamic_sidebar( 'site-bar' );
    echo '</div></div>';
    echo '<a href="#" class="show-bar">Show site notice</div>';

    //* bail on showing the link to the notice if there isn't a notice
    if ( !is_active_sidebar( 'site-notice' ) ) 
        return;

    ?>
    <script>
        jQuery(document).ready(function( $ ) {
            $('.site-bar-wrap p').append(' <a href="#" class="show-notice">More information</a>');	
        });
    </script>
    <?php
}