<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://xylusthemes.com
 * @since      1.0.0
 *
 * @package    Import_Facebook_Events
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove options
delete_option( IFE_OPTIONS );

// Remove schduled Imports
$scheduled_import_args = array(
		'post_type'     => 'fb_scheduled_imports',
		'posts_per_page' => -1,
	);
$scheduled_imports = get_posts( $scheduled_import_args );
if( !empty( $scheduled_imports ) ){
	foreach ( $scheduled_imports as $import ) {
		if( $import->ID != '' ){
			wp_delete_post( $import->ID, true );
		}		
	}
}
