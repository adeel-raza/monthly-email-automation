#!/bin/bash
# WordPress.org SVN Upload Script for Simple Email Scheduler
# Usage: ./upload_simple_email_scheduler_wp_org.sh VERSION "Commit message"
# Example: ./upload_simple_email_scheduler_wp_org.sh 1.0.0 "Initial release"

VERSION=$1
COMMIT_MSG=$2

if [ -z "$VERSION" ] || [ -z "$COMMIT_MSG" ]; then
    echo "Usage: $0 VERSION \"Commit message\""
    echo "Example: $0 1.0.0 \"Initial release\""
    exit 1
fi

PLUGIN_SLUG="simple-email-scheduler"
PLUGIN_DIR="/var/www/html/wp_local/wp-content/plugins/${PLUGIN_SLUG}"
SVN_DIR="/home/adeel/astore/Elearning/Plugins/${PLUGIN_SLUG}"

if [ ! -d "$SVN_DIR" ]; then
    echo "❌ SVN directory not found: $SVN_DIR"
    echo "Please checkout the SVN repository first:"
    echo "  svn co https://plugins.svn.wordpress.org/${PLUGIN_SLUG}/ $SVN_DIR"
    exit 1
fi

if [ ! -d "$PLUGIN_DIR" ]; then
    echo "❌ Plugin directory not found: $PLUGIN_DIR"
    exit 1
fi

echo "🚀 Starting SVN upload for ${PLUGIN_SLUG} version ${VERSION}..."
cd "$SVN_DIR"

echo "📦 Syncing files to trunk..."
rsync -avz --exclude=logs/debug.log --exclude=.git --exclude=.gitignore --exclude=.gitattributes \
  --exclude=.github --exclude=node_modules --exclude=.DS_Store --exclude=Thumbs.db \
  --exclude="*.bak" --exclude="*.backup" --exclude="*.old" --exclude="*.orig" \
  "$PLUGIN_DIR/" "$SVN_DIR/trunk/"

echo "📝 Adding/updating files in SVN..."
svn add --force trunk/* --auto-props --parents --depth infinity -q
svn status | grep '^!' | sed 's/^! *//' | xargs -I% svn rm % 2>/dev/null || true

echo "💾 Committing trunk..."
svn ci -m "$COMMIT_MSG" || { echo "❌ SVN commit failed."; exit 1; }

echo "🏷️  Creating tag ${VERSION}..."
mkdir -p "$SVN_DIR/tags/${VERSION}/"
rsync -avz --exclude=logs/debug.log --exclude=.git --exclude=.gitignore --exclude=.gitattributes \
  --exclude=.github --exclude=node_modules --exclude=.DS_Store --exclude=Thumbs.db \
  --exclude="*.bak" --exclude="*.backup" --exclude="*.old" --exclude="*.orig" \
  "$PLUGIN_DIR/" "$SVN_DIR/tags/${VERSION}/"

svn add tags/${VERSION} 2>/dev/null || true
if [ -d "assets" ]; then
    svn add assets 2>/dev/null || true
fi

echo "💾 Committing tag ${VERSION}..."
svn ci -m "$COMMIT_MSG - Tag ${VERSION}" || { echo "❌ SVN tag commit failed."; exit 1; }

echo "✅ Successfully uploaded ${PLUGIN_SLUG} version ${VERSION} to WordPress.org SVN!"
