#!/bin/bash
# Simple script to create placeholder banners using ImageMagick (if available)
# This creates simple text-based banners

echo "🎨 Creating Simple Email Scheduler banners..."

# Check if ImageMagick is installed
if ! command -v convert &> /dev/null; then
    echo "❌ ImageMagick not found. Please install it or create banners manually."
    echo "   Install: sudo apt-get install imagemagick"
    echo "   Or use Canva/GIMP to create banners"
    exit 1
fi

# Colors
BG_COLOR="#ffffff"
TEXT_COLOR="#2271b1"
ACCENT_COLOR="#00a0d2"

# Create banner 772x250
echo "Creating banner-772x250.png..."
convert -size 772x250 xc:"$BG_COLOR" \
  -font Arial-Bold -pointsize 48 -fill "$TEXT_COLOR" \
  -gravity NorthWest -annotate +50+50 "Simple Email Scheduler" \
  -font Arial -pointsize 20 -fill "$ACCENT_COLOR" \
  -gravity NorthWest -annotate +50+110 "Automate Recurring Emails & Newsletters" \
  assets/banner-772x250.png

# Create banner 1544x500 (high-res)
echo "Creating banner-1544x500.png..."
convert -size 1544x500 xc:"$BG_COLOR" \
  -font Arial-Bold -pointsize 96 -fill "$TEXT_COLOR" \
  -gravity NorthWest -annotate +100+100 "Simple Email Scheduler" \
  -font Arial -pointsize 40 -fill "$ACCENT_COLOR" \
  -gravity NorthWest -annotate +100+220 "Automate Recurring Emails & Newsletters" \
  assets/banner-1544x500.png

# Create icon 256x256
echo "Creating icon-256x256.png..."
convert -size 256x256 xc:"$BG_COLOR" \
  -font Arial-Bold -pointsize 32 -fill "$TEXT_COLOR" \
  -gravity Center -annotate +0+0 "📧" \
  assets/icon-256x256.png

echo "✅ Banners created!"
echo "📁 Files created in assets/ directory"
