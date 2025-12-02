<?php
/**
 * Uninstall Script
 *
 * @package Email Scheduler
 * @since 1.0.0
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete all plugin options.
$options_to_delete = array(
	'mea_saved_recipients',
);

foreach ( $options_to_delete as $option ) {
	\delete_option( $option );
}

// Drop custom database table.
global $wpdb;
$table_name = $wpdb->prefix . 'mea_email_logs';
$wpdb->query( "DROP TABLE IF EXISTS {$table_name}" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching

// Clear scheduled cron events.
$timestamp = wp_next_scheduled( 'mea_monthly_email_check' );
if ( $timestamp ) {
	wp_unschedule_event( $timestamp, 'mea_monthly_email_check' );
}

