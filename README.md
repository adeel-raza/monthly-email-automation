# Simple Email Scheduler

> **Schedule and automate recurring email campaigns, newsletters, and recurring emails. Send automated emails to multiple recipients with WordPress cron. Track delivery logs and manage recipient lists.**

[![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-GPL%20v3%2B-green.svg)](https://www.gnu.org/licenses/gpl-3.0.html)

**Simple Email Scheduler** is a powerful WordPress plugin that solves the critical problem of manually sending recurring emails, newsletters, and automated communications. If you've ever struggled with remembering to send monthly newsletters, weekly updates, or recurring email campaigns, this plugin automates the entire process using WordPress's built-in cron system.

## 🎯 The Problem This Plugin Solves

### Common Email Automation Challenges

* **Manual Email Sending**: No more forgetting to send monthly newsletters or recurring emails
* **Time-Consuming Process**: Eliminates the need to manually compose and send emails repeatedly
* **Inconsistent Delivery**: Ensures emails are sent on schedule, every time
* **No Tracking**: Provides complete delivery logs and status tracking
* **Recipient Management**: Simplifies managing multiple recipient lists across campaigns
* **Complex Setup**: No need for external services or complex integrations

### Why You Need This Plugin

If you answer "yes" to any of these questions, this plugin is for you:

* Do you send monthly newsletters or recurring emails?
* Do you forget to send scheduled emails?
* Do you spend hours manually sending the same emails repeatedly?
* Do you need to track email delivery status?
* Do you manage multiple recipient lists?
* Do you want to automate email marketing campaigns?
* Do you need to send monthly reports or updates?

## ✨ Key Features

### Core Functionality

* ✅ **Unlimited Automated Emails** - Create as many recurring email campaigns as you need
* ✅ **Flexible Day-of-Month Scheduling** - Set any day of the month (1-31) for automatic delivery
* ✅ **Precise Time Control** - Set specific time (24-hour format) for when emails should be sent
* ✅ **Multiple Recipients** - Send to unlimited email addresses per campaign
* ✅ **Recipient List Management** - Save recipient lists and reuse them across multiple email campaigns
* ✅ **Email Delivery Logging** - Complete tracking with delivery status, timestamps, and error messages
* ✅ **Active/Inactive Toggle** - Easily pause or resume any automated email campaign

### Technical Features

* ✅ **WordPress Native** - Built using WordPress core functions - no external dependencies
* ✅ **SMTP Compatible** - Works with all SMTP plugins (WP Mail SMTP, Easy WP SMTP, Post SMTP)
* ✅ **Timezone Aware** - Automatically respects WordPress timezone settings
* ✅ **Rich HTML Emails** - Use WordPress editor to create beautiful HTML email content
* ✅ **Edge Case Handling** - Automatically handles edge cases (e.g., day 31 in months with only 30 days)
* ✅ **Test Email Functionality** - Send test emails before activating campaigns
* ✅ **Complete Error Tracking** - Logs all delivery errors with detailed error messages

## 🚀 Quick Start

### Installation

#### Automatic Installation

1. Go to **Plugins → Add New** in your WordPress admin
2. Search for "Simple Email Scheduler"
3. Click **Install Now**
4. Click **Activate**

#### Manual Installation

1. Download the plugin ZIP file
2. Upload the `simple-email-scheduler` folder to `/wp-content/plugins/`
3. Activate the plugin through the **Plugins** menu in WordPress

#### Installation via Git

```bash
cd wp-content/plugins/
git clone https://github.com/adeel-raza/monthly-email-automation.git simple-email-scheduler
```

### Creating Your First Automated Email

1. **Navigate to Recurring Emails**
   * Go to **Recurring Emails → Add New** in WordPress admin

2. **Add Recipients**
   * Enter email addresses directly (comma-separated)
   * Or load a saved recipient list

3. **Write Your Email**
   * Use the WordPress editor to write your email content
   * Add HTML formatting, images, and links as needed

4. **Set Schedule**
   * Choose the day of the month (1-31)
   * Set the time for delivery (24-hour format)

5. **Activate**
   * Set status to "Active"
   * Save the email
   * The plugin will automatically send it on schedule!

## 💡 Use Cases

### Business & Marketing

* **Monthly Newsletter Automation** - Automatically send recurring newsletters to subscribers
* **Email Marketing Campaigns** - Schedule recurring promotional emails and campaigns
* **Monthly Reports** - Automate monthly reports to clients, team members, or stakeholders
* **E-commerce Promotions** - Monthly promotional emails and product updates

### Communication & Notifications

* **Reminders & Notifications** - Send recurring reminders, notifications, and announcements
* **Team Communication** - Regular updates and reports to team members
* **Client Updates** - Automated monthly status reports and updates
* **Event Reminders** - Monthly event reminders and notifications

### Specialized Applications

* **Membership Sites** - Automated monthly updates for membership sites
* **Blog Newsletters** - Recurring blog post summaries and updates to subscribers
* **Subscription Services** - Automated monthly subscription updates and renewals
* **Educational Content** - Recurring educational emails and course updates

## 🔧 How It Works

The plugin uses WordPress cron to automatically check daily for scheduled emails. When the scheduled day and time arrives, emails are automatically sent to all configured recipients.

### Technical Flow

1. **Plugin Registration**: Registers custom post type "Recurring Emails"
2. **Scheduling**: WordPress cron checks daily for scheduled emails
3. **Email Processing**: When scheduled time arrives, plugin processes active emails
4. **Email Sending**: Uses WordPress `wp_mail()` function to send emails
5. **Logging**: All delivery attempts are logged with status and error messages

### WordPress Integration

* Uses WordPress core `wp_mail()` function
* Integrates with WordPress cron system
* Respects WordPress timezone settings
* Follows WordPress coding standards
* Compatible with all SMTP plugins

## ❓ Frequently Asked Questions

### How does recurring email automation work?

The plugin uses WordPress cron to automatically check daily for scheduled emails. When the scheduled day and time arrives, emails are automatically sent to all configured recipients. The plugin handles all scheduling, sending, and logging automatically.

### Can I send automated emails to multiple recipients?

Yes! You can add unlimited email addresses to each automated email campaign. Simply enter email addresses separated by commas or load a saved recipient list. The plugin also allows you to save recipient lists and reuse them across multiple email campaigns.

### What happens if I schedule an email for day 31 and the month only has 30 days?

The plugin automatically handles edge cases. If you schedule an email for day 31 and the month only has 30 days (like February or April), the email will be sent on the last day of that month instead. The plugin intelligently adjusts for months with different numbers of days.

### How do I test my automated emails?

Simply create an email, set it to active, and schedule it for today or tomorrow. The plugin will automatically send it at the scheduled time. You can also use the test email functionality to send a test email to yourself before activating the campaign.

### Does this plugin work with SMTP plugins like WP Mail SMTP?

Yes! The plugin uses WordPress's built-in `wp_mail()` function, so it works seamlessly with all SMTP plugins including WP Mail SMTP, Easy WP SMTP, Post SMTP, and any other email service plugin. Simply configure your SMTP plugin as usual, and Simple Email Scheduler will use it automatically.

### Can I schedule different emails for different days of the month?

Absolutely! You can create unlimited automated emails, each with its own schedule. For example, send a newsletter on the 1st, a reminder on the 15th, and a report on the last day of the month. Each email campaign operates independently.

### How do I track email delivery?

Each email has a built-in log viewer that shows delivery status, recipient email addresses, send times, and any error messages. Navigate to the email post and scroll down to view the delivery logs. This helps you monitor the success of your email campaigns.

### Can I pause or deactivate an automated email?

Yes! Each email has an active/inactive status toggle. Simply set it to inactive to pause sending, and reactivate it anytime to resume automated delivery. The email configuration is preserved, so you can easily toggle it on and off.

### Does the plugin respect WordPress timezone settings?

Yes! The plugin automatically uses your WordPress timezone settings, so scheduled times are always accurate for your location. No need to manually adjust for timezones - the plugin handles it automatically.

### Do I need any external services or API keys?

No! The plugin uses WordPress's built-in cron system and `wp_mail()` function. No external services, API keys, or third-party dependencies are required. However, you can use SMTP plugins for better email delivery if desired.

## 🛠️ Development

### File Structure

```
simple-email-scheduler/
├── assets/
│   └── js/
│       └── admin.js
├── includes/
│   ├── class-mea-admin.php
│   ├── class-mea-email-sender.php
│   ├── class-mea-post-type.php
│   └── class-mea-scheduler.php
├── languages/
├── monthly-email-automation.php
├── readme.txt
├── README.md
└── uninstall.php
```

### Hooks and Filters

The plugin provides several hooks for extensibility:

#### Actions

* `simesc_email_send_before` - Fires before sending an email
* `simesc_email_send_after` - Fires after sending an email

#### Filters

* `simesc_email_from_address` - Filter the email from address
* `simesc_email_from_name` - Filter the email from name
* `simesc_email_content_type` - Filter the email content type

### Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 Changelog

### 1.0.0 (Initial Release)

* Create unlimited automated recurring emails
* Schedule emails by day of month and time
* Multiple recipients support
* Save and reuse recipient lists
* Email delivery logging with status and error messages
* WordPress timezone support
* Daily cron scheduling
* Active/inactive email control
* Test email functionality
* SMTP plugin compatibility
* Edge case handling for month-end dates

## 🔒 Security

The plugin follows WordPress security best practices:

* All user inputs are sanitized and validated
* Nonce verification for all forms
* Capability checks for all actions
* Prepared SQL statements
* Escaped output
* Follows WordPress coding standards

## 📄 License

This plugin is licensed under the GPL-3.0+ license.

## 👤 Author

**eLearning evolve**

* Website: [elearningevolve.com](https://elearningevolve.com/about/)
* WordPress.org: [Simple Email Scheduler](https://wordpress.org/plugins/simple-email-scheduler/)
* GitHub: [@adeel-raza](https://github.com/adeel-raza)

## 🙏 Credits

Built with ❤️ for the WordPress community.

## 📞 Support

For support, feature requests, or bug reports:

* [WordPress.org Support Forum](https://wordpress.org/support/plugin/simple-email-scheduler/)
* [GitHub Issues](https://github.com/adeel-raza/monthly-email-automation/issues)

## ⭐ Show Your Support

If you find this plugin useful, please consider:

* ⭐ Starring this repository
* 📝 Leaving a review on WordPress.org
* 🐛 Reporting bugs
* 💡 Suggesting new features
* 🔄 Contributing code

---

**Keywords**: WordPress email automation, scheduled emails, recurring newsletters, recurring emails, email campaigns, WordPress cron, automated emails, email marketing, SMTP compatible, email delivery tracking, monthly newsletters, email scheduler, WordPress email plugin
