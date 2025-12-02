<?php
/**
 * Custom Post Type for Automated Emails
 */

if (!defined('ABSPATH')) {
    exit;
}

class MEA_Post_Type {
    
    public function init() {
        // Register post type and meta fields on init hook
        add_action('init', array($this, 'register_post_type'), 10);
        add_action('init', array($this, 'register_meta_fields'), 10);
    }
    
    /**
     * Register custom post type for automated emails
     */
    public function register_post_type() {
        $labels = array(
            'name'                  => _x('Automated Emails', 'Post Type General Name', 'monthly-email-automation'),
            'singular_name'         => _x('Automated Email', 'Post Type Singular Name', 'monthly-email-automation'),
            'menu_name'             => __('Email Scheduler', 'monthly-email-automation'),
            'name_admin_bar'        => __('Automated Email', 'monthly-email-automation'),
            'archives'              => __('Email Archives', 'monthly-email-automation'),
            'attributes'            => __('Email Attributes', 'monthly-email-automation'),
            'parent_item_colon'     => __('Parent Email:', 'monthly-email-automation'),
            'all_items'             => __('All Emails', 'monthly-email-automation'),
            'add_new_item'          => __('Add New Email', 'monthly-email-automation'),
            'add_new'               => __('Add New', 'monthly-email-automation'),
            'new_item'              => __('New Email', 'monthly-email-automation'),
            'edit_item'             => __('Edit Email', 'monthly-email-automation'),
            'update_item'           => __('Update Email', 'monthly-email-automation'),
            'view_item'             => __('View Email', 'monthly-email-automation'),
            'view_items'            => __('View Emails', 'monthly-email-automation'),
            'search_items'          => __('Search Email', 'monthly-email-automation'),
            'not_found'             => __('Not found', 'monthly-email-automation'),
            'not_found_in_trash'    => __('Not found in Trash', 'monthly-email-automation'),
            'featured_image'        => __('Featured Image', 'monthly-email-automation'),
            'set_featured_image'    => __('Set featured image', 'monthly-email-automation'),
            'remove_featured_image' => __('Remove featured image', 'monthly-email-automation'),
            'use_featured_image'    => __('Use as featured image', 'monthly-email-automation'),
            'insert_into_item'      => __('Insert into email', 'monthly-email-automation'),
            'uploaded_to_this_item' => __('Uploaded to this email', 'monthly-email-automation'),
            'items_list'            => __('Emails list', 'monthly-email-automation'),
            'items_list_navigation' => __('Emails list navigation', 'monthly-email-automation'),
            'filter_items_list'     => __('Filter emails list', 'monthly-email-automation'),
        );
        
        $args = array(
            'label'                 => __('Automated Email', 'monthly-email-automation'),
            'description'           => __('Scheduled automated emails', 'monthly-email-automation'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail'),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 30,
            'menu_icon'             => 'dashicons-email-alt',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'capability_type'       => 'post',
            'capabilities'          => array(
                'edit_post'          => 'edit_posts',
                'read_post'          => 'read',
                'delete_post'        => 'delete_posts',
                'edit_posts'         => 'edit_posts',
                'edit_others_posts'  => 'edit_others_posts',
                'publish_posts'      => 'publish_posts',
                'read_private_posts' => 'read_private_posts',
            ),
            'map_meta_cap'          => false,
            'show_in_rest'          => false,
        );
        
        register_post_type('mea_automated_email', $args);
    }
    
    /**
     * Register meta fields for email configuration
     */
    public function register_meta_fields() {
        // Recipients (stored as JSON array)
        register_post_meta('mea_automated_email', '_mea_recipients', array(
            'type' => 'string',
            'description' => 'Email recipients (JSON array)',
            'single' => true,
            'sanitize_callback' => array($this, 'sanitize_recipients'),
            'show_in_rest' => false,
        ));
        
        // Email subject
        register_post_meta('mea_automated_email', '_mea_subject', array(
            'type' => 'string',
            'description' => 'Email subject line',
            'single' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => false,
        ));
        
        // Day of month (1-31)
        register_post_meta('mea_automated_email', '_mea_day_of_month', array(
            'type' => 'integer',
            'description' => 'Day of month to send email (1-31)',
            'single' => true,
            'sanitize_callback' => 'absint',
            'show_in_rest' => false,
        ));
        
        // Time to send (HH:MM format)
        register_post_meta('mea_automated_email', '_mea_send_time', array(
            'type' => 'string',
            'description' => 'Time to send email (HH:MM)',
            'single' => true,
            'sanitize_callback' => array($this, 'sanitize_time'),
            'show_in_rest' => false,
        ));
        
        // Status (active/inactive)
        register_post_meta('mea_automated_email', '_mea_status', array(
            'type' => 'string',
            'description' => 'Email status (active/inactive)',
            'single' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => false,
            'default' => 'active',
        ));
        
        // Last sent date
        register_post_meta('mea_automated_email', '_mea_last_sent', array(
            'type' => 'string',
            'description' => 'Last sent date',
            'single' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => false,
        ));
    }
    
    /**
     * Sanitize recipients JSON
     */
    public function sanitize_recipients($value) {
        if (is_string($value)) {
            $recipients = json_decode($value, true);
            if (is_array($recipients)) {
                $sanitized = array();
                foreach ($recipients as $email) {
                    $sanitized[] = sanitize_email($email);
                }
                return json_encode($sanitized);
            }
        }
        return '';
    }
    
    /**
     * Sanitize time format (HH:MM)
     */
    public function sanitize_time($value) {
        if (preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/', $value)) {
            return $value;
        }
        return '09:00'; // Default time
    }
}

