=== Simple Email Scheduler ===
Contributors: adeelraza_786hotmailcom, elearningevolve
Donate link: https://link.elearningevolve.com/self-pay
Tags: email, automation, newsletters, scheduled-emails, recurring-emails
Requires at least: 6.0
Tested up to: 6.9
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv3 or later
Schedule recurring newsletters and automated emails with WordPress cron, reusable recipient lists, and built-in delivery logs.


== Description ==

**Simple Email Scheduler** solves the critical problem of manually sending recurring emails, newsletters, and automated communications on WordPress sites. If you've ever struggled with remembering to send monthly newsletters, weekly updates, or recurring email campaigns, this plugin automates the entire process using WordPress's built-in cron system.

**The Problem This Plugin Solves:**

* **Manual Email Sending**: No more forgetting to send monthly newsletters or recurring emails
* **Time-Consuming Process**: Eliminates the need to manually compose and send emails repeatedly
* **Inconsistent Delivery**: Ensures emails are sent on schedule, every time
* **No Tracking**: Provides complete delivery logs and status tracking
* **Recipient Management**: Simplifies managing multiple recipient lists across campaigns
* **Complex Setup**: No need for external services or complex integrations

**Why Choose Simple Email Scheduler?**

* **WordPress Native**: Built using WordPress core functions - no external dependencies
* **Simple Setup**: Create automated emails as WordPress posts - intuitive and familiar
* **Flexible Scheduling**: Set any day of the month (1-31) and specific time for automatic delivery
* **Unlimited Recipients**: Send to unlimited email addresses per campaign
* **Recipient Lists**: Save and reuse recipient lists across multiple email campaigns
* **Complete Logging**: Track every email with delivery status, timestamps, and error messages
* **SMTP Compatible**: Works seamlessly with all SMTP plugins (WP Mail SMTP, Easy WP SMTP, Post SMTP)
* **Timezone Aware**: Automatically respects your WordPress timezone settings
* **Active/Inactive Control**: Easily pause or resume any automated email campaign
* **Rich HTML Emails**: Use WordPress editor to create beautiful HTML email content
* **No External Services**: Uses WordPress built-in cron - no third-party services required

**Perfect For:**

* **Monthly Newsletter Automation**: Automatically send recurring newsletters to subscribers
* **Email Marketing Campaigns**: Schedule recurring promotional emails and marketing campaigns
* **Monthly Reports**: Automate monthly reports to clients, team members, or stakeholders
* **Reminders & Notifications**: Send recurring reminders, notifications, and announcements
* **Membership Sites**: Automated monthly updates for membership sites
* **E-commerce**: Monthly promotional emails and product updates
* **Team Communication**: Regular updates and reports to team members
* **Client Updates**: Automated monthly status reports and updates
* **Blog Newsletters**: Recurring blog post summaries and updates
* **Event Reminders**: Monthly event reminders and notifications

= Key Features =

* **Unlimited Automated Emails**: Create as many recurring email campaigns as you need - no limits
* **Flexible Day-of-Month Scheduling**: Set any day of the month (1-31) for automatic delivery
* **Precise Time Control**: Set specific time (24-hour format) for when emails should be sent
* **Multiple Recipients**: Send to unlimited email addresses per campaign
* **Recipient List Management**: Save recipient lists and reuse them across multiple email campaigns
* **Email Delivery Logging**: Complete tracking with delivery status, timestamps, and error messages
* **WordPress Native Integration**: Built using WordPress core functions and follows all WordPress coding standards
* **Automatic Timezone Handling**: Automatically respects WordPress timezone settings for accurate scheduling
* **Rich HTML Email Support**: Use WordPress editor to create beautiful HTML email content with formatting
* **Active/Inactive Toggle**: Easily pause or resume any automated email campaign without deleting it
* **SMTP Plugin Compatible**: Works with all SMTP plugins and email services (WP Mail SMTP, Easy WP SMTP, Post SMTP, etc.)
* **No External Dependencies**: Uses WordPress built-in cron system - no third-party services or API keys required
* **Edge Case Handling**: Automatically handles edge cases (e.g., day 31 in months with only 30 days)
* **Test Email Functionality**: Send test emails before activating campaigns
* **Complete Error Tracking**: Logs all delivery errors with detailed error messages
* **User-Friendly Interface**: Intuitive WordPress admin interface - no technical knowledge required

= How It Works =

1. **Create Email Campaign**: Navigate to "Recurring Emails" → "Add New" in WordPress admin
2. **Add Recipients**: Enter email addresses directly or load a saved recipient list
3. **Write Content**: Use the WordPress editor to write your email content with HTML formatting
4. **Set Schedule**: Choose the day of the month (1-31) and time (24-hour format) for delivery
5. **Activate**: Set status to "Active" and save
6. **Automatic Delivery**: Plugin uses WordPress cron to automatically send emails on schedule

The plugin checks daily for scheduled emails and automatically sends them when the scheduled day and time arrives. All email deliveries are logged with status, timestamps, and any error messages.

= Use Cases =

* **Monthly Newsletter Automation**: Automatically send recurring newsletters to subscribers on the same day each month
* **Email Marketing Campaigns**: Schedule recurring promotional emails and marketing campaigns
* **Monthly Reports**: Automate monthly reports to clients, team members, or stakeholders
* **Reminders & Notifications**: Send recurring reminders, notifications, and announcements
* **Membership Sites**: Automated monthly updates for membership sites
* **E-commerce Promotions**: Monthly promotional emails and product updates
* **Team Communication**: Regular updates and reports to team members
* **Client Updates**: Automated monthly status reports and updates
* **Blog Newsletters**: Recurring blog post summaries and updates to subscribers
* **Event Reminders**: Monthly event reminders and notifications
* **Subscription Services**: Automated monthly subscription updates and renewals
* **Educational Content**: Recurring educational emails and course updates

= Installation =

= Automatic Installation =

1. Go to **Plugins → Add New** in your WordPress admin
2. Search for "Simple Email Scheduler"
3. Click **Install Now**
4. Click **Activate**

= Manual Installation =

1. Download the plugin ZIP file
2. Upload the `simple-email-scheduler` folder to `/wp-content/plugins/`
3. Activate the plugin through the **Plugins** menu in WordPress
4. Go to **Recurring Emails** in the admin menu to create your first automated email

= Installation via Git =

`cd wp-content/plugins/`
`git clone https://github.com/adeel-raza/monthly-email-automation.git simple-email-scheduler`

= Frequently Asked Questions =

= How does recurring email automation work? =

The plugin uses WordPress cron to automatically check daily for scheduled emails. When the scheduled day and time arrives, emails are automatically sent to all configured recipients. The plugin handles all scheduling, sending, and logging automatically.

= Can I send automated emails to multiple recipients? =

Yes! You can add unlimited email addresses to each automated email campaign. Simply enter email addresses separated by commas or load a saved recipient list. The plugin also allows you to save recipient lists and reuse them across multiple email campaigns.

= What happens if I schedule an email for day 31 and the month only has 30 days? =

The plugin automatically handles edge cases. If you schedule an email for day 31 and the month only has 30 days (like February or April), the email will be sent on the last day of that month instead. The plugin intelligently adjusts for months with different numbers of days.

= How do I test my automated emails? =

Simply create an email, set it to active, and schedule it for today or tomorrow. The plugin will automatically send it at the scheduled time. You can also use the test email functionality to send a test email to yourself before activating the campaign.

= Does this plugin work with SMTP plugins like WP Mail SMTP? =

Yes! The plugin uses WordPress's built-in `wp_mail()` function, so it works seamlessly with all SMTP plugins including WP Mail SMTP, Easy WP SMTP, Post SMTP, and any other email service plugin. Simply configure your SMTP plugin as usual, and Simple Email Scheduler will use it automatically.

= Can I schedule different emails for different days of the month? =

Absolutely! You can create unlimited automated emails, each with its own schedule. For example, send a newsletter on the 1st, a reminder on the 15th, and a report on the last day of the month. Each email campaign operates independently.

= How do I track email delivery? =

Each email has a built-in log viewer that shows delivery status, recipient email addresses, send times, and any error messages. Navigate to the email post and scroll down to view the delivery logs. This helps you monitor the success of your email campaigns.

= Can I pause or deactivate an automated email? =

Yes! Each email has an active/inactive status toggle. Simply set it to inactive to pause sending, and reactivate it anytime to resume automated delivery. The email configuration is preserved, so you can easily toggle it on and off.

= Does the plugin respect WordPress timezone settings? =

Yes! The plugin automatically uses your WordPress timezone settings, so scheduled times are always accurate for your location. No need to manually adjust for timezones - the plugin handles it automatically.

= Do I need any external services or API keys? =

No! The plugin uses WordPress's built-in cron system and `wp_mail()` function. No external services, API keys, or third-party dependencies are required. However, you can use SMTP plugins for better email delivery if desired.

= Can I use HTML formatting in my emails? =

Yes! The plugin uses the WordPress editor, so you can create rich HTML email content with formatting, images, links, and more. The editor supports all standard WordPress formatting options.

= What if WordPress cron doesn't run? =

WordPress cron runs when your site receives traffic. If your site doesn't receive regular traffic, you may need to set up a server-level cron job to trigger WordPress cron. Most hosting providers handle this automatically.

= Screenshots =

1. Create recurring email campaigns in WordPress admin
2. Add multiple recipients or load saved recipient lists
3. Use WordPress editor to create rich HTML email content
4. Set day of month and time for automatic delivery
5. View complete email delivery logs with status and timestamps
6. Manage recipient lists and reuse them across campaigns

= Changelog =

= 1.0.0 =
* Initial release
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

= Upgrade Notice =

= 1.0.0 =
Initial release of Simple Email Scheduler. Install to start automating your recurring email campaigns.

== Installation ==

= Automatic Installation =

1. Go to **Plugins → Add New** in your WordPress admin
2. Search for "Simple Email Scheduler"
3. Click **Install Now**
4. Click **Activate**

= Manual Installation =

1. Download the plugin ZIP file
2. Upload the `simple-email-scheduler` folder to `/wp-content/plugins/`
3. Activate the plugin through the **Plugins** menu in WordPress
4. Go to **Recurring Emails** in the admin menu to create your first automated email

== Support ==

For support, feature requests, or bug reports, please visit the [WordPress.org support forum](https://wordpress.org/support/plugin/simple-email-scheduler/) or [open an issue on GitHub](https://github.com/adeel-raza/monthly-email-automation/issues).
