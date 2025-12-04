# Email Scheduler

[![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-GPL--3.0%2B-green.svg)](https://www.gnu.org/licenses/gpl-3.0.html)
[![WordPress Plugin](https://img.shields.io/badge/WordPress-Plugin-orange.svg)](https://wordpress.org/plugins/monthly-email-automation/)

> **Schedule and automate recurring email campaigns, newsletters, and recurring emails. Send automated emails to multiple recipients with WordPress cron. Track delivery logs and manage recipient lists.**

Email Scheduler is a powerful WordPress plugin that enables you to schedule, automate, and manage recurring email campaigns directly from your WordPress admin dashboard. Perfect for recurring newsletters, automated email marketing, scheduled announcements, recurring reminders, and any recurring email communications.

---

<h2 align="center">💝 Support This Project</h2>

<p align="center">
<strong>If you find this project helpful, please consider supporting it:</strong>
</p>

<p align="center">
<a href="https://link.elearningevolve.com/self-pay" target="_blank">
<img src="https://img.shields.io/badge/Support%20via%20Stripe-635BFF?style=for-the-badge&logo=stripe&logoColor=white" alt="Support via Stripe" height="50" width="300">
</a>
</p>

<p align="center">
<a href="https://link.elearningevolve.com/self-pay" target="_blank">
<strong>👉 Click here to support via Stripe 👈</strong>
</a>
</p>

---## 🚀 Features

- ✅ **Unlimited Automated Emails** - Create as many recurring email campaigns as you need
- ✅ **Flexible Scheduling** - Set any day of the month (1-31) and specific time for automatic delivery
- ✅ **Multiple Recipients** - Send to unlimited email addresses per campaign
- ✅ **Recipient List Management** - Save recipient lists and reuse them across multiple email campaigns
- ✅ **Email Delivery Logging** - Complete tracking with delivery status, timestamps, and error messages
- ✅ **WordPress Native** - Built using WordPress core functions and follows all WordPress coding standards
- ✅ **Timezone Support** - Automatically respects WordPress timezone settings for accurate scheduling
- ✅ **Rich HTML Emails** - Use WordPress editor to create beautiful HTML email content
- ✅ **Active/Inactive Control** - Easily pause or resume any automated email campaign
- ✅ **SMTP Compatible** - Works with all SMTP plugins and email services
- ✅ **No External Dependencies** - Uses WordPress built-in cron - no third-party services required

## 📋 Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher
- WordPress cron enabled (default)

## 📦 Installation

### Automatic Installation

1. Go to **Plugins → Add New** in your WordPress admin
2. Search for "Email Scheduler"
3. Click **Install Now**
4. Activate the plugin

### Manual Installation

1. Download the plugin ZIP file
2. Upload the `monthly-email-automation` folder to `/wp-content/plugins/`
3. Activate the plugin through the **Plugins** menu in WordPress
4. Go to **recurring emails** in the admin menu to create your first automated email

### Installation via Git

```bash
cd wp-content/plugins/
git clone https://github.com/yourusername/monthly-email-automation.git
```

## 🎯 Quick Start

1. **Create Your First Email**
   - Navigate to **recurring emails → Add New** in WordPress admin
   - Enter a title for your email campaign

2. **Add Recipients**
   - In the Email Settings meta box, add one or more email addresses
   - Or load a saved recipient list

3. **Write Your Email**
   - Use the WordPress editor to write your email content
   - Add HTML formatting, images, and links as needed

4. **Set Schedule**
   - Choose the day of the month (1-31)
   - Set the time for delivery (24-hour format)

5. **Activate**
   - Set status to "Active"
   - Save the email
   - The plugin will automatically send it on schedule!

## 💡 Use Cases

- **Newsletter Automation** - Send recurring newsletters to subscribers automatically
- **Email Marketing** - Schedule recurring promotional emails and campaigns
- **Monthly Reports** - Automate monthly reports to clients, team members, or stakeholders
- **Reminders & Notifications** - Send recurring reminders, notifications, and announcements
- **Membership Sites** - Automated monthly updates for membership sites
- **E-commerce** - Monthly promotional emails and product updates
- **Team Communication** - Regular updates and reports to team members
- **Client Updates** - Automated monthly status reports and updates

## 🔧 How It Works

The plugin uses WordPress cron to automatically check daily for scheduled emails. When the scheduled day and time arrives, emails are automatically sent to all configured recipients.

1. Create a new "recurring email" post
2. Add recipients (email addresses)
3. Write your email content using the WordPress editor
4. Set the day of month and time to send
5. Activate the email
6. The plugin automatically sends emails on schedule using WordPress cron

## ❓ Frequently Asked Questions

### How does recurring email automation work?

The plugin uses WordPress cron to automatically check daily for scheduled emails. When the scheduled day and time arrives, emails are automatically sent to all configured recipients.

### Can I send automated emails to multiple recipients?

Yes! You can add unlimited email addresses to each automated email campaign. The plugin also allows you to save recipient lists and reuse them across multiple email campaigns.

### What happens if I schedule an email for day 31 and the month only has 30 days?

The plugin automatically handles edge cases. If you schedule an email for day 31 and the month only has 30 days (like February), the email will be sent on the last day of that month instead.

### How do I test my automated emails?

Simply create an email, set it to active, and schedule it for today or tomorrow. The plugin will automatically send it at the scheduled time. You can also check the email logs to verify delivery.

### Does this plugin work with SMTP plugins like WP Mail SMTP?

Yes! The plugin uses WordPress's built-in `wp_mail()` function, so it works seamlessly with all SMTP plugins including WP Mail SMTP, Easy WP SMTP, Post SMTP, and any other email service plugin.

### Can I schedule different emails for different days of the month?

Absolutely! You can create unlimited automated emails, each with its own schedule. For example, send a newsletter on the 1st, a reminder on the 15th, and a report on the last day of the month.

### How do I track email delivery?

Each email has a built-in log viewer that shows delivery status, recipient email addresses, send times, and any error messages. This helps you monitor the success of your email campaigns.

### Can I pause or deactivate an automated email?

Yes! Each email has an active/inactive status toggle. Simply set it to inactive to pause sending, and reactivate it anytime to resume automated delivery.

### Does the plugin respect WordPress timezone settings?

Yes! The plugin automatically uses your WordPress timezone settings, so scheduled times are always accurate for your location.

## 🛠️ Development

### File Structure

```
monthly-email-automation/
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
└── README.md
```

### Hooks and Filters

The plugin provides several hooks for extensibility:

#### Actions

- `mea_email_send_before` - Fires before sending an email
- `mea_email_send_after` - Fires after sending an email

#### Filters

- `mea_email_from_address` - Filter the email from address
- `mea_email_from_name` - Filter the email from name
- `mea_email_content_type` - Filter the email content type

### Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 Changelog

### 1.0.0 (Initial Release)

- Create unlimited automated recurring emails
- Schedule emails by day of month and time
- Multiple recipients support
- Save and reuse recipient lists
- Email delivery logging
- WordPress timezone support
- Daily cron scheduling

## 🔒 Security

The plugin follows WordPress security best practices:

- All user inputs are sanitized and validated
- Nonce verification for all forms
- Capability checks for all actions
- Prepared SQL statements
- Escaped output

## 📄 License

This plugin is licensed under the GPL-3.0+ license.

## 👤 Author

**eLearning evolve**

- Website: [https://elearningevolve.com/about/](https://elearningevolve.com/about/)
- WordPress.org: [https://wordpress.org/plugins/monthly-email-automation/](https://wordpress.org/plugins/monthly-email-automation/)

## 🙏 Credits

Built with ❤️ for the WordPress community.

## 📞 Support

For support, feature requests, or bug reports, please open an issue on GitHub or visit the [WordPress.org support forum](https://wordpress.org/support/plugin/monthly-email-automation/).

## ⭐ Show Your Support

If you find this plugin useful, please consider:

- ⭐ Starring this repository
- 📝 Leaving a review on WordPress.org
- 🐛 Reporting bugs
- 💡 Suggesting new features
- 🔄 Contributing code

---

**Keywords:** WordPress email automation, scheduled emails, recurring newsletters, recurring emails, email campaigns, WordPress cron, automated emails, email marketing, SMTP compatible, email delivery tracking
