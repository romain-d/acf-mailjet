<?php
/*
 Plugin Name: Advanced Custom Fields: Mailjet
 Plugin URI:  https://github.com/romain-d/acf-mailjet
 Description: Add Mailjet selectors to ACF
 Version:     1.0.0
 Author:      Romain DORR
 Author URI:  https://github.com/romain-d
 License:     GPL3
 Text Domain: acf-mailjet
 ----

 Copyright 2019 Romain DORR (contact@romaindorr.fr)

 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

define( 'ACF_MAILJET_VERSION', '1.0.0' );
define( 'ACF_MAILJET_DIR', plugin_dir_path( __FILE__ ) );

class acf_field_mailjet_plugin {

	/**
	 * Constructor.
	 *
	 * Load plugin's translation and register acf Mailjet fields.
	 * @author Romain DORR
	 * @since 1.0.0
	 */
	function __construct() {

		add_action( 'init', array( __CLASS__, 'load_translation' ), 1 );

		// Register ACF fields
		add_action( 'acf/include_field_types', array( __CLASS__, 'register_field_v5' ) );
	}

	/**
	 * Load plugin translation.
	 * @author Romain DORR
	 * @since 1.0.0
	 */
	public static function load_translation() {
		load_plugin_textdomain( 'acf-mailjet', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Register Mailjet list selector field for ACF v5.
	 * @author Romain DORR
	 * @since 1.0.0
	 */
	public static function register_field_v5() {
		if ( ! class_exists( 'WP_Mailjet' ) ) {
			return false;
		}

		include_once( ACF_MAILJET_DIR . 'fields/field-mailjet-list.php' );
		new acf_field_mailjet_list_select();
	}
}

/**
 * Init plugin.
 * @author Romain DORR
 * @since 1.0.0
 */
function acf_field_mailjet() {
	new acf_field_mailjet_plugin();
}
add_action( 'plugins_loaded', 'acf_field_mailjet' );
