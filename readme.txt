=== Monthly Email Automation ===
Contributors: elearningevolve
Donate link: https://elearningevolve.com/about/
Tags: email, automation, newsletters, scheduled, wp-mail
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL-3.0+
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Schedule and automate monthly email campaigns, newsletters, and recurring emails. Send automated emails to multiple recipients with WordPress cron.

== Description ==

**Monthly Email Automation** is a powerful WordPress plugin that enables you to schedule, automate, and manage recurring email campaigns directly from your WordPress admin dashboard. Perfect for monthly newsletters, automated email marketing, scheduled announcements, recurring reminders, and any monthly email communications.

**Why Choose Monthly Email Automation?**

* **Simple Setup**: Create automated emails as WordPress posts - no complex configuration needed
* **Flexible Scheduling**: Set any day of the month and time for automatic email delivery
* **Multiple Recipients**: Send to unlimited email addresses per campaign
* **Recipient Management**: Save and reuse recipient lists across multiple email campaigns
* **Delivery Tracking**: Complete email logging with delivery status and error messages
* **WordPress Native**: Built using WordPress core functions and follows WordPress coding standards
* **SMTP Compatible**: Works seamlessly with all SMTP plugins and email services
* **Timezone Aware**: Automatically respects your WordPress timezone settings
* **No External Services**: Uses WordPress built-in cron system - no third-party dependencies

**Perfect For:**

* Monthly newsletter automation
* Recurring email marketing campaigns
* Scheduled monthly reports and updates
* Automated reminders and notifications
* Team communication and updates
* Client monthly reports
* Membership site monthly emails
* E-commerce monthly promotions

= Key Features =

* **Unlimited Automated Emails**: Create as many monthly email campaigns as you need
* **Flexible Scheduling**: Set any day of the month (1-31) and specific time for automatic delivery
* **Multiple Recipients**: Send to unlimited email addresses per campaign
* **Recipient List Management**: Save recipient lists and reuse them across multiple email campaigns
* **Email Delivery Logging**: Complete tracking with delivery status, timestamps, and error messages
* **WordPress Native**: Built using WordPress core functions and follows all WordPress coding standards
* **Timezone Support**: Automatically respects WordPress timezone settings for accurate scheduling
* **Rich HTML Emails**: Use WordPress editor to create beautiful HTML email content
* **Active/Inactive Control**: Easily pause or resume any automated email campaign
* **SMTP Compatible**: Works with all SMTP plugins and email services
* **No External Dependencies**: Uses WordPress built-in cron - no third-party services required

= How It Works =

1. Create a new "Monthly Email" post
2. Add recipients (email addresses)
3. Write your email content using the WordPress editor
4. Set the day of month and time to send
5. Activate the email
6. The plugin automatically sends emails on schedule using WordPress cron

= Use Cases =

* **Newsletter Automation**: Send monthly newsletters to subscribers automatically
* **Email Marketing**: Schedule recurring promotional emails and campaigns
* **Monthly Reports**: Automate monthly reports to clients, team members, or stakeholders
* **Reminders & Notifications**: Send recurring reminders, notifications, and announcements
* **Membership Sites**: Automated monthly updates for membership sites
* **E-commerce**: Monthly promotional emails and product updates
* **Team Communication**: Regular updates and reports to team members
* **Client Updates**: Automated monthly status reports and updates

== Installation ==

= Automatic Installation =

1. Go to Plugins → Add New in your WordPress admin
2. Search for "Monthly Email Automation"
3. Click "Install Now"
4. Activate the plugin

= Manual Installation =

1. Upload the `monthly-email-automation` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Monthly Emails" in the admin menu to create your first automated email

== Frequently Asked Questions ==

= How does monthly email automation work? =

The plugin uses WordPress cron to automatically check daily for scheduled emails. When the scheduled day and time arrives, emails are automatically sent to all configured recipients.

= Can I send automated emails to multiple recipients? =

Yes! You can add unlimited email addresses to each automated email campaign. The plugin also allows you to save recipient lists and reuse them across multiple email campaigns.

= What happens if I schedule an email for day 31 and the month only has 30 days? =

The plugin automatically handles edge cases. If you schedule an email for day 31 and the month only has 30 days (like February), the email will be sent on the last day of that month instead.

= How do I test my automated emails? =

Simply create an email, set it to active, and schedule it for today or tomorrow. The plugin will automatically send it at the scheduled time. You can also check the email logs to verify delivery.

= Does this plugin work with SMTP plugins like WP Mail SMTP? =

Yes! The plugin uses WordPress's built-in `wp_mail()` function, so it works seamlessly with all SMTP plugins including WP Mail SMTP, Easy WP SMTP, Post SMTP, and any other email service plugin.

= Can I schedule different emails for different days of the month? =

Absolutely! You can create unlimited automated emails, each with its own schedule. For example, send a newsletter on the 1st, a reminder on the 15th, and a report on the last day of the month.

= How do I track email delivery? =

Each email has a built-in log viewer that shows delivery status, recipient email addresses, send times, and any error messages. This helps you monitor the success of your email campaigns.

= Can I pause or deactivate an automated email? =

Yes! Each email has an active/inactive status toggle. Simply set it to inactive to pause sending, and reactivate it anytime to resume automated delivery.

= Does the plugin respect WordPress timezone settings? =

Yes! The plugin automatically uses your WordPress timezone settings, so scheduled times are always accurate for your location.

= Is this plugin compatible with email marketing plugins? =

The plugin works alongside email marketing plugins. It uses WordPress core email functions, so it's compatible with most WordPress email-related plugins and services.

= Can I use HTML in my email content? =

Yes! The plugin uses the WordPress content editor, so you can create rich HTML emails with formatting, images, links, and more.

= How many automated emails can I create? =

There's no limit! Create as many automated monthly emails as you need, each with its own schedule, recipients, and content.

== Screenshots ==

1. Create and manage unlimited automated monthly emails from WordPress admin
2. Schedule emails by day of month and time with flexible options
3. Add multiple recipients and save recipient lists for reuse
4. View comprehensive email delivery logs with status tracking
5. Email settings panel with subject, recipients, and status controls
6. Schedule settings showing day of month and send time configuration

== Changelog ==

= 1.0.0 =
* Initial release
* Create unlimited automated monthly emails
* Schedule emails by day of month and time
* Multiple recipients support
* Save and reuse recipient lists
* Email delivery logging
* WordPress timezone support
* Daily cron scheduling

== Upgrade Notice ==

= 1.0.0 =
Initial release of Monthly Email Automation.

