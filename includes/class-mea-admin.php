<?php
/**
 * Admin Interface for Managing Automated Emails
 */

if (!defined('ABSPATH')) {
    exit;
}

class MEA_Admin {
    
    public function init() {
        // Add meta boxes
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        
        // Save meta data
        add_action('save_post_mea_automated_email', array($this, 'save_meta_data'));
        
        // Add custom columns
        add_filter('manage_mea_automated_email_posts_columns', array($this, 'add_custom_columns'));
        add_action('manage_mea_automated_email_posts_custom_column', array($this, 'render_custom_columns'), 10, 2);
        
        // Add quick edit support
        add_action('quick_edit_custom_box', array($this, 'quick_edit_fields'), 10, 2);
        
        // Enqueue admin scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        
        // AJAX handlers for saved recipients
        add_action('wp_ajax_mea_save_recipients', array($this, 'ajax_save_recipients'));
        add_action('wp_ajax_mea_load_recipients', array($this, 'ajax_load_recipients'));
        add_action('wp_ajax_mea_delete_recipients', array($this, 'ajax_delete_recipients'));
    }
    
    /**
     * Add meta boxes
     */
    public function add_meta_boxes() {
        add_meta_box(
            'mea_email_settings',
            __('Email Settings', 'monthly-email-automation'),
            array($this, 'render_email_settings_meta_box'),
            'mea_automated_email',
            'normal',
            'high'
        );
        
        add_meta_box(
            'mea_email_logs',
            __('Email Logs', 'monthly-email-automation'),
            array($this, 'render_logs_meta_box'),
            'mea_automated_email',
            'side',
            'default'
        );
    }
    
    /**
     * Render email settings meta box
     */
    public function render_email_settings_meta_box($post) {
        wp_nonce_field('mea_save_meta', 'mea_meta_nonce');
        
        // Verify post object
        if (!is_object($post) || !isset($post->ID)) {
            return;
        }
        
        $recipients = get_post_meta($post->ID, '_mea_recipients', true);
        $subject = get_post_meta($post->ID, '_mea_subject', true);
        // If no subject set, use post title as default
        if (empty($subject)) {
            $subject = $post->post_title;
        }
        $status = get_post_meta($post->ID, '_mea_status', true);
        // Default to 'active' if status is empty (new post)
        if (empty($status)) {
            $status = 'active';
        }
        $last_sent = get_post_meta($post->ID, '_mea_last_sent', true);
        
        // Get schedule settings
        $day_of_month = get_post_meta($post->ID, '_mea_day_of_month', true);
        $send_time = get_post_meta($post->ID, '_mea_send_time', true);
        if (empty($day_of_month)) {
            $day_of_month = 1;
        }
        if (empty($send_time)) {
            $send_time = '09:00';
        }
        
        // Parse recipients
        $recipients_array = array();
        if (!empty($recipients)) {
            $recipients_array = json_decode($recipients, true);
            if (!is_array($recipients_array)) {
                $recipients_array = array();
            }
        }
        
        ?>
        <table class="form-table">
            <tr>
                <th><label for="mea_subject"><?php esc_html_e('Email Subject', 'monthly-email-automation'); ?> <span style="color: red;">*</span></label></th>
                <td>
                    <input type="text" id="mea_subject" name="mea_subject" value="<?php echo esc_attr($subject); ?>" class="regular-text" required />
                    <p class="description"><?php esc_html_e('Subject line for the email. This is required and will be used as the email subject when sending.', 'monthly-email-automation'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="mea_recipients"><?php esc_html_e('Recipients', 'monthly-email-automation'); ?></label></th>
                <td>
                    <div id="mea-recipients-container">
                        <?php if (!empty($recipients_array)): ?>
                            <?php foreach ($recipients_array as $index => $email): ?>
                                <div class="mea-recipient-row" style="margin-bottom: 5px;">
                                    <input type="email" name="mea_recipients[]" value="<?php echo esc_attr($email); ?>" class="regular-text" />
                                    <button type="button" class="button mea-remove-recipient"><?php esc_html_e('Remove', 'monthly-email-automation'); ?></button>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="mea-recipient-row" style="margin-bottom: 5px;">
                                <input type="email" name="mea_recipients[]" value="" class="regular-text" placeholder="email@example.com" />
                                <button type="button" class="button mea-remove-recipient"><?php esc_html_e('Remove', 'monthly-email-automation'); ?></button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="button" id="mea-add-recipient"><?php esc_html_e('Add Recipient', 'monthly-email-automation'); ?></button>
                    <p class="description"><?php esc_html_e('Add one or more email addresses to receive this automated email.', 'monthly-email-automation'); ?></p>
                    
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #ddd;">
                        <strong><?php esc_html_e('Saved Recipient Lists:', 'monthly-email-automation'); ?></strong>
                        <div style="margin-top: 10px;">
                            <select id="mea-saved-recipients" style="width: 300px; margin-right: 5px;">
                                <option value=""><?php esc_html_e('-- Select a saved list --', 'monthly-email-automation'); ?></option>
                                <?php
                                $saved_lists = get_option('mea_saved_recipients', array());
                                foreach ($saved_lists as $key => $list): ?>
                                    <option value="<?php echo esc_attr($key); ?>" data-recipients="<?php echo esc_attr(json_encode($list['recipients'])); ?>">
                                        <?php echo esc_html($list['name']); ?> (<?php echo count($list['recipients']); ?> recipients)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="button" id="mea-load-recipients"><?php esc_html_e('Load', 'monthly-email-automation'); ?></button>
                            <button type="button" class="button" id="mea-delete-recipients"><?php esc_html_e('Delete', 'monthly-email-automation'); ?></button>
                        </div>
                        <div style="margin-top: 10px;">
                            <input type="text" id="mea-save-recipients-name" placeholder="<?php esc_attr_e('Enter name for this list', 'monthly-email-automation'); ?>" style="width: 200px; margin-right: 5px;" />
                            <button type="button" class="button button-primary" id="mea-save-recipients"><?php esc_html_e('Save Current Recipients', 'monthly-email-automation'); ?></button>
                        </div>
                        <p class="description"><?php esc_html_e('Save your recipient lists to reuse them in other emails.', 'monthly-email-automation'); ?></p>
                    </div>
                </td>
            </tr>
            <tr>
                <th><label for="mea_status"><?php esc_html_e('Status', 'monthly-email-automation'); ?></label></th>
                <td>
                    <select id="mea_status" name="mea_status">
                        <option value="active" <?php selected($status, 'active'); ?>><?php esc_html_e('Active', 'monthly-email-automation'); ?></option>
                        <option value="inactive" <?php selected($status, 'inactive'); ?>><?php esc_html_e('Inactive', 'monthly-email-automation'); ?></option>
                    </select>
                    <p class="description"><?php esc_html_e('Only active emails will be sent automatically.', 'monthly-email-automation'); ?></p>
                </td>
            </tr>
            <?php if (!empty($last_sent)): ?>
            <tr>
                <th><?php esc_html_e('Last Sent', 'monthly-email-automation'); ?></th>
                <td>
                    <strong><?php echo esc_html($last_sent); ?></strong>
                </td>
            </tr>
            <?php endif; ?>
        </table>
        
        <hr style="margin: 20px 0;">
        
        <h3 style="margin-top: 0;"><?php esc_html_e('Schedule Settings', 'monthly-email-automation'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="mea_day_of_month"><?php esc_html_e('Day of Month', 'monthly-email-automation'); ?></label></th>
                <td>
                    <input type="number" id="mea_day_of_month" name="mea_day_of_month" value="<?php echo esc_attr($day_of_month); ?>" min="1" max="31" step="1" class="small-text" style="width: 80px;" />
                    <p class="description"><?php esc_html_e('Day of the month to send this email (1-31). If the day doesn\'t exist in a month (e.g., Feb 30), it will be sent on the last day of that month.', 'monthly-email-automation'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="mea_send_time"><?php esc_html_e('Send Time', 'monthly-email-automation'); ?></label></th>
                <td>
                    <input type="time" id="mea_send_time" name="mea_send_time" value="<?php echo esc_attr($send_time); ?>" />
                    <p class="description"><?php esc_html_e('Time of day to send the email (24-hour format).', 'monthly-email-automation'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * Render schedule meta box
     */
    public function render_schedule_meta_box($post) {
        $day_of_month = get_post_meta($post->ID, '_mea_day_of_month', true);
        $send_time = get_post_meta($post->ID, '_mea_send_time', true);
        
        if (empty($day_of_month)) {
            $day_of_month = 1;
        }
        if (empty($send_time)) {
            $send_time = '09:00';
        }
        
        ?>
        <table class="form-table">
            <tr>
                <th><label for="mea_day_of_month"><?php esc_html_e('Day of Month', 'monthly-email-automation'); ?></label></th>
                <td>
                    <input type="number" id="mea_day_of_month" name="mea_day_of_month" value="<?php echo esc_attr($day_of_month); ?>" min="1" max="31" step="1" class="small-text" style="width: 80px;" />
                    <p class="description"><?php esc_html_e('Day of the month to send this email (1-31). If the day doesn\'t exist in a month (e.g., Feb 30), it will be sent on the last day of that month.', 'monthly-email-automation'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="mea_send_time"><?php esc_html_e('Send Time', 'monthly-email-automation'); ?></label></th>
                <td>
                    <input type="time" id="mea_send_time" name="mea_send_time" value="<?php echo esc_attr($send_time); ?>" />
                    <p class="description"><?php esc_html_e('Time of day to send the email (24-hour format).', 'monthly-email-automation'); ?></p>
                </td>
            </tr>
        </table>
        <p class="description">
            <strong><?php esc_html_e('Note:', 'monthly-email-automation'); ?></strong><br>
            <?php esc_html_e('The email will be sent on the specified day and time each month. If the day doesn\'t exist in a month (e.g., Feb 30), it will be sent on the last day of that month.', 'monthly-email-automation'); ?>
        </p>
        <?php
    }
    
    /**
     * Render logs meta box
     */
    public function render_logs_meta_box($post) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mea_email_logs';
        
        // Verify post object
        if (!is_object($post) || !isset($post->ID)) {
            return;
        }
        
        // Use proper table name escaping - table name is safe as it's constructed from $wpdb->prefix
        $table_name = $wpdb->prefix . 'mea_email_logs';
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
        $logs = $wpdb->get_results(
            // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- Table name cannot be prepared, validated as safe above
            $wpdb->prepare( "SELECT * FROM `{$table_name}` WHERE email_id = %d ORDER BY sent_at DESC LIMIT 20", $post->ID )
        );
        
        ?>
        <div class="mea-logs-container">
            <?php if (empty($logs)): ?>
                <p><?php esc_html_e('No emails sent yet.', 'monthly-email-automation'); ?></p>
            <?php else: ?>
                <table class="widefat">
                    <thead>
                        <tr>
                            <th><?php esc_html_e('Recipient', 'monthly-email-automation'); ?></th>
                            <th><?php esc_html_e('Sent At', 'monthly-email-automation'); ?></th>
                            <th><?php esc_html_e('Status', 'monthly-email-automation'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td><?php echo esc_html($log->recipient_email); ?></td>
                                <td><?php echo esc_html($log->sent_at); ?></td>
                                <td>
                                    <?php if ($log->status === 'sent'): ?>
                                        <span style="color: green;"><?php esc_html_e('Sent', 'monthly-email-automation'); ?></span>
                                    <?php else: ?>
                                        <span style="color: red;"><?php esc_html_e('Failed', 'monthly-email-automation'); ?></span>
                                        <?php if (!empty($log->error_message)): ?>
                                            <br><small><?php echo esc_html($log->error_message); ?></small>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <?php
    }
    
    /**
     * Save meta data
     */
    public function save_meta_data($post_id) {
        // Check nonce
        if (!isset($_POST['mea_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mea_meta_nonce'])), 'mea_save_meta')) {
            return;
        }
        
        // Check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        // Check permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // Save recipients
        if (isset($_POST['mea_recipients']) && is_array($_POST['mea_recipients'])) {
            $recipients = array();
            // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Sanitized in loop below
            $recipients_raw = wp_unslash($_POST['mea_recipients']); // Unslash before processing
            foreach ($recipients_raw as $email) {
                $email = sanitize_email($email);
                if (!empty($email) && is_email($email)) {
                    $recipients[] = $email;
                }
            }
            update_post_meta($post_id, '_mea_recipients', wp_json_encode($recipients));
        }
        
        // Save subject (required field)
        if (isset($_POST['mea_subject'])) {
            $subject = sanitize_text_field(wp_unslash($_POST['mea_subject']));
            if (!empty($subject)) {
                update_post_meta($post_id, '_mea_subject', $subject);
            } else {
                // If empty, use post title as fallback
                $post = get_post($post_id);
                if ($post) {
                    update_post_meta($post_id, '_mea_subject', $post->post_title);
                }
            }
        } else {
            // If not set, use post title as default
            $post = get_post($post_id);
            if ($post) {
                update_post_meta($post_id, '_mea_subject', $post->post_title);
            }
        }
        
        // Save day of month
        if (isset($_POST['mea_day_of_month'])) {
            $day = absint(wp_unslash($_POST['mea_day_of_month']));
            if ($day >= 1 && $day <= 31) {
                update_post_meta($post_id, '_mea_day_of_month', $day);
            }
        }
        
        // Save send time
        if (isset($_POST['mea_send_time'])) {
            update_post_meta($post_id, '_mea_send_time', sanitize_text_field(wp_unslash($_POST['mea_send_time'])));
        }
        
        // Save status (default to 'active' if not set)
        if (isset($_POST['mea_status'])) {
            $status = sanitize_text_field(wp_unslash($_POST['mea_status']));
            if (in_array($status, array('active', 'inactive'))) {
                update_post_meta($post_id, '_mea_status', $status);
            }
        } else {
            // Default to 'active' for new posts
            update_post_meta($post_id, '_mea_status', 'active');
        }
    }
    
    /**
     * Add custom columns
     */
    public function add_custom_columns($columns) {
        $new_columns = array();
        $new_columns['cb'] = $columns['cb'];
        $new_columns['title'] = $columns['title'];
        $new_columns['mea_subject'] = __('Email Subject', 'monthly-email-automation');
        $new_columns['mea_recipients'] = __('Recipients', 'monthly-email-automation');
        $new_columns['mea_schedule'] = __('Schedule', 'monthly-email-automation');
        $new_columns['mea_status'] = __('Status', 'monthly-email-automation');
        $new_columns['mea_last_sent'] = __('Last Sent', 'monthly-email-automation');
        $new_columns['date'] = $columns['date'];
        
        return $new_columns;
    }
    
    /**
     * Render custom columns
     */
    public function render_custom_columns($column, $post_id) {
        switch ($column) {
            case 'mea_subject':
                $subject = get_post_meta($post_id, '_mea_subject', true);
                if (!empty($subject)) {
                    echo esc_html($subject);
                } else {
                    echo '<span style="color: #999;">—</span>';
                }
                break;
                
            case 'mea_recipients':
                $recipients = get_post_meta($post_id, '_mea_recipients', true);
                if (!empty($recipients)) {
                    $recipients_array = json_decode($recipients, true);
                    if (is_array($recipients_array)) {
                        // translators: %d is the number of recipients
                        echo esc_html(sprintf(_n('%d recipient', '%d recipients', count($recipients_array), 'monthly-email-automation'), count($recipients_array)));
                    } else {
                        echo '—';
                    }
                } else {
                    echo '—';
                }
                break;
                
            case 'mea_schedule':
                $day = get_post_meta($post_id, '_mea_day_of_month', true);
                $time = get_post_meta($post_id, '_mea_send_time', true);
                if (!empty($day) && !empty($time)) {
                    // translators: %1$s is the day of month, %2$s is the time
                    echo esc_html(sprintf(__('Day %1$s at %2$s', 'monthly-email-automation'), $day, $time));
                } else {
                    echo '—';
                }
                break;
                
            case 'mea_status':
                $status = get_post_meta($post_id, '_mea_status', true);
                if ($status === 'active') {
                    echo '<span style="color: green;">' . esc_html__('Active', 'monthly-email-automation') . '</span>';
                } else {
                    echo '<span style="color: gray;">' . esc_html__('Inactive', 'monthly-email-automation') . '</span>';
                }
                break;
                
            case 'mea_last_sent':
                $last_sent = get_post_meta($post_id, '_mea_last_sent', true);
                echo $last_sent ? esc_html($last_sent) : '—';
                break;
        }
    }
    
    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        if ('post.php' !== $hook && 'post-new.php' !== $hook) {
            return;
        }
        
        global $post_type;
        if ('mea_automated_email' !== $post_type) {
            return;
        }
        
        wp_enqueue_script(
            'mea-admin-js',
            MEA_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            MEA_PLUGIN_VERSION,
            true
        );
        
        // Localize script for AJAX
        wp_localize_script(
            'mea-admin-js',
            'meaAdmin',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('mea_recipients_nonce'),
            )
        );
    }
    
    /**
     * AJAX handler: Save recipients list
     */
    public function ajax_save_recipients() {
        check_ajax_referer('mea_recipients_nonce', 'nonce');
        
        if (!current_user_can('edit_posts')) {
            wp_send_json_error(array('message' => __('Permission denied.', 'monthly-email-automation')));
        }
        
        $name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
        // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Sanitized in loop below
        $recipients_raw = isset($_POST['recipients']) ? wp_unslash($_POST['recipients']) : array();
        
        if (empty($name)) {
            wp_send_json_error(array('message' => __('List name cannot be empty.', 'monthly-email-automation')));
        }
        
        if (!is_array($recipients_raw) || empty($recipients_raw)) {
            wp_send_json_error(array('message' => __('No recipients provided.', 'monthly-email-automation')));
        }
        
        // Sanitize recipients
        $recipients = array();
        foreach ($recipients_raw as $email) {
            $email = sanitize_email($email);
            if (!empty($email) && is_email($email)) {
                $recipients[] = $email;
            }
        }
        
        if (empty($recipients)) {
            wp_send_json_error(array('message' => __('No valid recipients provided.', 'monthly-email-automation')));
        }
        
        // Get existing lists
        $saved_lists = get_option('mea_saved_recipients', array());
        
        // Generate unique key
        $key = sanitize_key($name);
        $counter = 1;
        while (isset($saved_lists[$key])) {
            $key = sanitize_key($name) . '-' . $counter;
            $counter++;
        }
        
        // Save list
        $saved_lists[$key] = array(
            'name' => $name,
            'recipients' => $recipients,
        );
        
        if (update_option('mea_saved_recipients', $saved_lists)) {
            wp_send_json_success(array('message' => __('Recipient list saved successfully.', 'monthly-email-automation')));
        } else {
            wp_send_json_error(array('message' => __('Failed to save recipient list.', 'monthly-email-automation')));
        }
    }
    
    /**
     * AJAX handler: Load recipients list
     */
    public function ajax_load_recipients() {
        check_ajax_referer('mea_recipients_nonce', 'nonce');
        
        if (!current_user_can('edit_posts')) {
            wp_send_json_error(array('message' => __('Permission denied.', 'monthly-email-automation')));
        }
        
        $key = isset($_POST['key']) ? sanitize_text_field(wp_unslash($_POST['key'])) : '';
        
        if (empty($key)) {
            wp_send_json_error(array('message' => __('No list selected.', 'monthly-email-automation')));
        }
        
        $saved_lists = get_option('mea_saved_recipients', array());
        
        if (!isset($saved_lists[$key])) {
            wp_send_json_error(array('message' => __('Recipient list not found.', 'monthly-email-automation')));
        }
        
        wp_send_json_success(array(
            'recipients' => $saved_lists[$key]['recipients'],
            'name' => $saved_lists[$key]['name'],
        ));
    }
    
    /**
     * AJAX handler: Delete recipients list
     */
    public function ajax_delete_recipients() {
        check_ajax_referer('mea_recipients_nonce', 'nonce');
        
        if (!current_user_can('edit_posts')) {
            wp_send_json_error(array('message' => __('Permission denied.', 'monthly-email-automation')));
        }
        
        $key = isset($_POST['key']) ? sanitize_text_field(wp_unslash($_POST['key'])) : '';
        
        if (empty($key)) {
            wp_send_json_error(array('message' => __('No list selected.', 'monthly-email-automation')));
        }
        
        $saved_lists = get_option('mea_saved_recipients', array());
        
        if (!isset($saved_lists[$key])) {
            wp_send_json_error(array('message' => __('Recipient list not found.', 'monthly-email-automation')));
        }
        
        unset($saved_lists[$key]);
        
        if (update_option('mea_saved_recipients', $saved_lists)) {
            wp_send_json_success(array('message' => __('Recipient list deleted successfully.', 'monthly-email-automation')));
        } else {
            wp_send_json_error(array('message' => __('Failed to delete recipient list.', 'monthly-email-automation')));
        }
    }
}


