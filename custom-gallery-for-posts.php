<?php
/*
Plugin Name: Custom Gallery for Posts
Description: Adds a custom gallery to each post or page and integrates with Elementor's dynamic tags.
Version: 1.0
Author: fondly.cz
Author URI: https://www.fondly.cz
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Include required files
require_once plugin_dir_path( __FILE__ ) . 'includes/meta-box.php';


// Enqueue scripts and styles
function cgp_enqueue_scripts() {
    wp_enqueue_style( 'cgp-styles', plugin_dir_url( __FILE__ ) . 'assets/styles.css' );
    wp_enqueue_script( 'cgp-scripts', plugin_dir_url( __FILE__ ) . 'assets/scripts.js', array('jquery'));
}
add_action( 'admin_enqueue_scripts', 'cgp_enqueue_scripts' );

function cgp_register_dynamic_tags($dynamic_tags)
{
    require_once plugin_dir_path( __FILE__ ) . 'includes/elementor-dynamic-tags.php';
    $dynamic_tags->register(new CGP_Elementor_Gallery_Tag());
}
add_action('elementor/dynamic_tags/register', 'cgp_register_dynamic_tags');