<?php
/**
 * Email Sender for Automated Emails
 */

if (!defined('ABSPATH')) {
    exit;
}

class MEA_Email_Sender {
    
    /**
     * Send automated email
     */
    public function send_email($email_id) {
        $email_post = get_post($email_id);
        
        if (!$email_post || $email_post->post_type !== 'mea_automated_email') {
            return false;
        }
        
        // Get email settings
        $recipients_json = get_post_meta($email_id, '_mea_recipients', true);
        $subject = get_post_meta($email_id, '_mea_subject', true);
        $status = get_post_meta($email_id, '_mea_status', true);
        
        // Check if active
        if ($status !== 'active') {
            return false;
        }
        
        // Parse recipients
        $recipients = json_decode($recipients_json, true);
        if (!is_array($recipients) || empty($recipients)) {
            return false;
        }
        
        // Get email content
        $content = apply_filters('the_content', $email_post->post_content);
        
        // If no subject, use post title
        if (empty($subject)) {
            $subject = $email_post->post_title;
        }
        
        // Strip HTML tags from subject (WordPress best practice)
        $subject = wp_strip_all_tags($subject);
        
        // Apply filters before sending (WordPress best practice)
        do_action('mea_email_send_before', $email_id, $recipients, $subject, $content);
        
        // Set up email filters (following EDD and WordPress best practices)
        add_filter('wp_mail_from', array($this, 'get_from_email'));
        add_filter('wp_mail_from_name', array($this, 'get_from_name'));
        add_filter('wp_mail_content_type', array($this, 'get_content_type'));
        
        // Prepare email headers
        $headers = array();
        
        $sent_count = 0;
        $failed_count = 0;
        
        // Send to each recipient
        foreach ($recipients as $recipient_email) {
            if (!is_email($recipient_email)) {
                $this->log_email($email_id, $recipient_email, 'failed', 'Invalid email address');
                $failed_count++;
                continue;
            }
            
            // Send email
            $sent = wp_mail($recipient_email, $subject, $content, $headers);
            
            if ($sent) {
                $this->log_email($email_id, $recipient_email, 'sent');
                $sent_count++;
            } else {
                $this->log_email($email_id, $recipient_email, 'failed', 'wp_mail() returned false');
                $failed_count++;
            }
        }
        
        // Remove filters after sending (WordPress best practice)
        remove_filter('wp_mail_from', array($this, 'get_from_email'));
        remove_filter('wp_mail_from_name', array($this, 'get_from_name'));
        remove_filter('wp_mail_content_type', array($this, 'get_content_type'));
        
        // Apply filters after sending (WordPress best practice)
        do_action('mea_email_send_after', $email_id, $recipients, $subject, $content, $sent_count, $failed_count);
        
        // Update last sent date
        if ($sent_count > 0) {
            update_post_meta($email_id, '_mea_last_sent', current_time('mysql'));
        }
        
        return $sent_count > 0;
    }
    
    /**
     * Log email sending
     */
    private function log_email($email_id, $recipient_email, $status, $error_message = '') {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mea_email_logs';
        
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Custom table requires direct query
        $wpdb->insert(
            $table_name,
            array(
                'email_id' => $email_id,
                'recipient_email' => $recipient_email,
                'sent_at' => current_time('mysql'),
                'status' => $status,
                'error_message' => $error_message
            ),
            array('%d', '%s', '%s', '%s', '%s')
        );
    }
    
    /**
     * Get from email address (filter callback)
     */
    public function get_from_email($from_email = '') {
        $email = get_option('admin_email');
        return apply_filters('mea_email_from_address', $email, $from_email);
    }
    
    /**
     * Get from name (filter callback)
     */
    public function get_from_name($from_name = '') {
        $name = get_bloginfo('name');
        return apply_filters('mea_email_from_name', $name, $from_name);
    }
    
    /**
     * Get content type (filter callback)
     */
    public function get_content_type($content_type = '') {
        return apply_filters('mea_email_content_type', 'text/html', $content_type);
    }
    
    /**
     * Manually trigger email send (for testing)
     */
    public function send_test_email($email_id, $test_recipient = null) {
        // Temporarily override recipients if test email provided
        if (!empty($test_recipient) && is_email($test_recipient)) {
            $original_recipients = get_post_meta($email_id, '_mea_recipients', true);
            update_post_meta($email_id, '_mea_recipients', json_encode(array($test_recipient)));
            
            $result = $this->send_email($email_id);
            
            // Restore original recipients
            update_post_meta($email_id, '_mea_recipients', $original_recipients);
            
            return $result;
        }
        
        return $this->send_email($email_id);
    }
}


