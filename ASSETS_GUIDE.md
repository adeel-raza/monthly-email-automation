# Plugin Assets Creation Guide

## Required Assets for WordPress.org

WordPress.org requires the following assets for plugin display:

### 1. Banner 772x250px
**File**: `banner-772x250.png`  
**Location**: `/assets/banner-772x250.png` in SVN repository  
**Purpose**: Displayed on plugin page header

**Design Requirements:**
- Size: Exactly 772x250 pixels
- Format: PNG
- Include plugin name clearly
- Show key features visually
- Use readable fonts
- Good contrast for text

**Design Suggestions:**
- Background: Use plugin branding colors
- Text: "Simple Email Scheduler" as main title
- Subtitle: "Automate Recurring Emails & Newsletters"
- Visual: Email icon or calendar icon
- Colors: Professional, clean design

### 2. Banner 1544x500px (High-Resolution)
**File**: `banner-1544x500.png`  
**Location**: `/assets/banner-1544x500.png` in SVN repository  
**Purpose**: High-resolution version for retina displays

**Design Requirements:**
- Size: Exactly 1544x500 pixels
- Format: PNG
- Same design as 772x250px but higher resolution
- Sharper text and graphics

### 3. Icon 256x256px
**File**: `icon-256x256.png`  
**Location**: `/assets/icon-256x256.png` in SVN repository  
**Purpose**: Plugin icon displayed in search results and plugin directory

**Design Requirements:**
- Size: Exactly 256x256 pixels
- Format: PNG
- Square format
- Simple, recognizable design
- Works at small sizes (128x128, 64x64)
- Transparent background recommended

**Design Suggestions:**
- Email envelope icon
- Calendar with email icon
- Simple, minimalist design
- Brand colors
- Clear and recognizable at small sizes

## Creating Assets

### Using Design Tools

1. **Canva** (Free)
   - Create custom size designs
   - Use email/calendar templates
   - Export as PNG

2. **GIMP** (Free)
   - Professional image editing
   - Create custom sizes
   - Export as PNG

3. **Photoshop** (Paid)
   - Professional design tool
   - Create custom sizes
   - Export as PNG

### Design Tips

1. **Keep it Simple**: Clean, uncluttered designs work best
2. **Readable Text**: Use large, readable fonts
3. **Brand Consistency**: Use consistent colors and fonts
4. **Test at Size**: View assets at actual size before finalizing
5. **High Quality**: Use high-resolution graphics for sharp display

## Uploading Assets to SVN

Once assets are created:

```bash
cd /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/

# Create assets directory if it doesn't exist
mkdir -p assets

# Copy your assets
cp /path/to/banner-772x250.png assets/
cp /path/to/banner-1544x500.png assets/
cp /path/to/icon-256x256.png assets/

# Add to SVN
svn add assets/*.png
svn ci -m "Add plugin banners and icons"
```

## Asset Checklist

- [ ] Banner 772x250px created
- [ ] Banner 1544x500px created
- [ ] Icon 256x256px created
- [ ] All assets are PNG format
- [ ] All assets are correct size
- [ ] Text is readable
- [ ] Design is professional
- [ ] Assets uploaded to SVN assets/ directory
- [ ] Assets committed to SVN

## Resources

- [WordPress.org Plugin Assets Guidelines](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/)
- [Canva](https://www.canva.com/)
- [GIMP](https://www.gimp.org/)
