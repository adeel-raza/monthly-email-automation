# Simple Email Scheduler - Asset Creation Guide

## Required Assets

### 1. Banner 772x250px
**File**: `banner-772x250.png`  
**Size**: Exactly 772x250 pixels  
**Purpose**: Plugin page header banner

### 2. Banner 1544x500px  
**File**: `banner-1544x500.png`  
**Size**: Exactly 1544x500 pixels  
**Purpose**: High-resolution version for retina displays

### 3. Icon 256x256px
**File**: `icon-256x256.png`  
**Size**: Exactly 256x256 pixels  
**Purpose**: Plugin icon in search results

## Design Specifications

### Color Scheme
- Primary: #2271b1 (WordPress blue)
- Secondary: #00a0d2 (WordPress light blue)
- Accent: #00a32a (Success green)
- Background: #ffffff (White) or gradient

### Design Elements

**Banner Design:**
- Background: Clean white or light gradient (#f0f0f1 to #ffffff)
- Main Text: "Simple Email Scheduler" (Large, bold, readable font)
- Subtitle: "Automate Recurring Emails & Newsletters" (Smaller text)
- Icon/Visual: Email envelope icon or calendar with email icon
- Colors: Use WordPress blue (#2271b1) for text/accents

**Icon Design:**
- Simple email envelope icon
- Or calendar with email icon
- Square format, centered
- Transparent or white background
- Must be recognizable at 64x64px size

## Quick Creation Options

### Option 1: Using Canva (Free)
1. Go to https://www.canva.com/
2. Create custom size: 772x250px for banner
3. Use template or create from scratch
4. Add text: "Simple Email Scheduler"
5. Add subtitle: "Automate Recurring Emails"
6. Add email/calendar icon
7. Export as PNG
8. Repeat for 1544x500px (same design, higher resolution)
9. Create 256x256px icon separately

### Option 2: Using GIMP (Free)
1. File → New → Set size to 772x250px
2. Add background layer
3. Add text layer with plugin name
4. Add icon/image layer
5. Export as PNG
6. Repeat for other sizes

### Option 3: Simple Text-Based Banner (Quick)
Create a simple banner with:
- White background
- Large text: "Simple Email Scheduler"
- Smaller text: "Automate Recurring Emails & Newsletters"
- Simple email icon (emoji or icon font)
- WordPress blue color scheme

## Text Content

**Banner Text:**
- Main: "Simple Email Scheduler"
- Subtitle: "Automate Recurring Emails & Newsletters"
- Optional tagline: "WordPress Native • SMTP Compatible • Free"

## Icon Ideas

1. **Email Envelope** - Simple, recognizable
2. **Calendar with Email** - Shows scheduling aspect
3. **Clock + Email** - Time-based automation
4. **Mailbox** - Classic email symbol

## File Naming

Save files as:
- `banner-772x250.png`
- `banner-1544x500.png`
- `icon-256x256.png`

## Upload to SVN

Once created, upload to SVN:

```bash
cd /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/
cp /path/to/banner-772x250.png assets/
cp /path/to/banner-1544x500.png assets/
cp /path/to/icon-256x256.png assets/
svn add assets/*.png
svn ci -m "Add plugin banners and icons"
```

## Design Tips

1. **Keep it Simple**: Clean, uncluttered design
2. **Readable Text**: Use large, bold fonts
3. **Brand Consistency**: Use WordPress colors
4. **Test at Size**: View at actual size before finalizing
5. **High Quality**: Use high-resolution graphics
6. **Contrast**: Ensure text is readable on background
