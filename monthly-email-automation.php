<?php
/**
 * @since             1.0.0
 * @package           Email Scheduler
 *
 * Plugin Name:       Email Scheduler
 * Plugin URI:        https://wordpress.org/plugins/email-scheduler/
 * Description:       Schedule and automate recurring email campaigns, newsletters, and recurring emails. Send automated emails to multiple recipients with WordPress cron. Track delivery logs and manage recipient lists.
 * Version:           1.0.0
 * Author:            eLearning evolve
 * Author URI:        https://elearningevolve.com/about/
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       email-scheduler
 * Requires PHP:      7.4
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Tested up to:      6.8.2
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

defined( 'MEA_MIN_WP' ) || define( 'MEA_MIN_WP', '6.0' );
defined( 'MEA_MIN_PHP' ) || define( 'MEA_MIN_PHP', '7.4' );
defined( 'MEA_VERSION' ) || define( 'MEA_VERSION', '1.0.0' );
defined( 'MEA_PLUGIN_FILE' ) || define( 'MEA_PLUGIN_FILE', __FILE__ );
defined( 'MEA_PLUGIN_DIR_PATH' ) || define( 'MEA_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
defined( 'MEA_PLUGIN_DIR_URL' ) || define( 'MEA_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

// Load PHP8 compat functions.
require __DIR__ . '/compat.php';

// Old versions of WordPress or PHP.
if (
	version_compare( $GLOBALS['wp_version'], MEA_MIN_WP, '<' )
	||
	version_compare( phpversion(), MEA_MIN_PHP, '<' )
) {
	require __DIR__ . '/old-versions.php';
} else {
	require __DIR__ . '/includes/class-mea-post-type.php';
	require __DIR__ . '/includes/class-mea-admin.php';
	require __DIR__ . '/includes/class-mea-scheduler.php';
	require __DIR__ . '/includes/class-mea-email-sender.php';
}

/**
 * Main plugin class
 */
class Monthly_Email_Automation {
    
    private static $instance = null;
    
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->init();
    }
    
    private function init() {
        // Register activation/deactivation hooks
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
        
        // Initialize components immediately
        $this->load_components();
    }
    
    public function activate() {
        // Register post type first
        $post_type = new MEA_Post_Type();
        $post_type->register_post_type();
        
        // Flush rewrite rules
        flush_rewrite_rules();
        
        // Schedule cron event
        $scheduler = new MEA_Scheduler();
        $scheduler->schedule_monthly_check();
        
        // Create log table
        $this->create_log_table();
    }
    
    public function deactivate() {
        // Clear scheduled events
        $scheduler = new MEA_Scheduler();
        $scheduler->unschedule_monthly_check();
        
        flush_rewrite_rules();
    }
    
    public function load_components() {
        // Initialize post type
        $post_type = new MEA_Post_Type();
        $post_type->init();
        
        // Initialize admin interface
        if ( is_admin() ) {
            $admin = new MEA_Admin();
            $admin->init();
        }
        
        // Initialize scheduler
        $scheduler = new MEA_Scheduler();
        $scheduler->init();
    }
    
    /**
     * Create log table for tracking sent emails
     */
    private function create_log_table() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'mea_email_logs';
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            email_id bigint(20) UNSIGNED NOT NULL,
            recipient_email varchar(255) NOT NULL,
            sent_at datetime NOT NULL,
            status varchar(20) NOT NULL,
            error_message text,
            PRIMARY KEY (id),
            KEY email_id (email_id),
            KEY sent_at (sent_at)
        ) $charset_collate;";
        
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );
    }
}

// Initialize the plugin if requirements are met.
if (
	version_compare( $GLOBALS['wp_version'], MEA_MIN_WP, '>=' ) &&
	version_compare( phpversion(), MEA_MIN_PHP, '>=' )
) {
	if ( class_exists( 'Monthly_Email_Automation' ) ) {
		Monthly_Email_Automation::get_instance();
	}
}

