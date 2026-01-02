# WordPress.org SVN Push Guide - Simple Email Scheduler

## 📋 Overview

This document provides comprehensive step-by-step instructions for pushing the Simple Email Scheduler plugin to WordPress.org SVN repository. This guide serves as a template for all future plugin submissions.

## 🔧 Prerequisites

1. **WordPress.org Account**: You need a WordPress.org account with plugin submission access
2. **SVN Repository**: The plugin must be approved and SVN repository created at `https://plugins.svn.wordpress.org/simple-email-scheduler/`
3. **SVN Checkout**: Repository must be checked out locally at `/home/adeel/astore/Elearning/Plugins/simple-email-scheduler/`
4. **Plugin Ready**: Plugin must pass all WordPress.org checks (Plugin Check, coding standards, etc.)

## 📁 Directory Structure

```
/home/adeel/astore/Elearning/Plugins/simple-email-scheduler/
├── trunk/          # Development version (always latest)
├── tags/           # Version tags (1.0.0, 1.0.1, etc.)
└── assets/         # Plugin banners and icons (optional but recommended)
```

## 🚀 Initial Setup (First Time Only)

### Step 1: Checkout SVN Repository

```bash
# Create parent directory if it doesn't exist
mkdir -p /home/adeel/astore/Elearning/Plugins

# Checkout the SVN repository
svn co https://plugins.svn.wordpress.org/simple-email-scheduler/ \
  /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/
```

**Note**: You'll be prompted for WordPress.org SVN credentials (username and password).

### Step 2: Create Assets Directory (Optional but Recommended)

```bash
cd /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/
mkdir -p assets
svn add assets
svn ci -m "Add assets directory"
```

### Step 3: Add Plugin Banners and Icons

Place the following files in the `assets/` directory:
- `banner-772x250.png` - Plugin banner (772x250px)
- `banner-1544x500.png` - High-resolution banner (1544x500px)
- `icon-256x256.png` - Plugin icon (256x256px)

See `ASSETS_GUIDE.md` for detailed instructions on creating these assets.

```bash
# Add assets to SVN
svn add assets/*.png
svn ci -m "Add plugin banners and icons"
```

## 📤 Pushing Updates to WordPress.org

### Method 1: Using the Automated Script (Recommended)

```bash
cd /var/www/html/wp_local/wp-content/plugins/simple-email-scheduler/

# Make script executable (first time only)
chmod +x upload_simple_email_scheduler_wp_org.sh

# Push to SVN
./upload_simple_email_scheduler_wp_org.sh 1.0.0 "Initial release"
```

**Script Parameters:**
- `1.0.0` - Version number (must match `readme.txt` stable tag)
- `"Initial release"` - Commit message (descriptive of changes)

**What the script does:**
1. Syncs plugin files from working directory to SVN trunk
2. Adds all new/modified files to SVN
3. Removes deleted files from SVN
4. Commits trunk with your message
5. Creates version tag directory
6. Syncs files to tag
7. Commits tag

### Method 2: Combined Git + SVN Push (Recommended for Regular Updates)

```bash
cd /var/www/html/wp_local/wp-content/plugins/simple-email-scheduler/

# Make script executable (first time only)
chmod +x push_to_git_and_svn.sh

# Push to both Git and SVN
./push_to_git_and_svn.sh 1.0.0 "Initial release"
```

This script will:
1. ✅ Stage all changes in Git
2. ✅ Commit to Git with your message
3. ✅ Push to GitHub
4. ✅ Create and push Git tag
5. ✅ Push to WordPress.org SVN (trunk + tag)

### Method 3: Manual Steps (For Understanding or Troubleshooting)

#### Step 1: Sync Files to Trunk

```bash
cd /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/

# Sync plugin files (excludes .git, logs, backup files)
rsync -avz --exclude=logs/debug.log --exclude=.git --exclude=.gitignore \
  --exclude=.github --exclude=node_modules --exclude=.DS_Store \
  --exclude=Thumbs.db --exclude="*.bak" --exclude="*.backup" \
  --exclude="*.old" --exclude="*.orig" \
  /var/www/html/wp_local/wp-content/plugins/simple-email-scheduler/ \
  /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/trunk/
```

#### Step 2: Add/Update Files in SVN

```bash
# Add all new/modified files
svn add --force trunk/* --auto-props --parents --depth infinity -q

# Remove deleted files (files that exist in SVN but not in source)
svn status | grep '^!' | sed 's/^! *//' | xargs -I% svn rm %
```

#### Step 3: Commit Trunk

```bash
svn ci -m "Update plugin to version 1.0.0"
```

You'll be prompted for SVN credentials if not cached.

#### Step 4: Create Version Tag

```bash
# Create tag directory
mkdir -p tags/1.0.0/

# Sync files to tag
rsync -avz --exclude=logs/debug.log --exclude=.git --exclude=.gitignore \
  --exclude=.github --exclude=node_modules --exclude=.DS_Store \
  --exclude=Thumbs.db --exclude="*.bak" --exclude="*.backup" \
  --exclude="*.old" --exclude="*.orig" \
  /var/www/html/wp_local/wp-content/plugins/simple-email-scheduler/ \
  /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/tags/1.0.0/

# Add tag to SVN
svn add tags/1.0.0

# Commit tag
svn ci -m "Tag version 1.0.0"
```

## 📋 Pre-Push Checklist

Before pushing to SVN, ensure:

- [ ] **Plugin Check Passes**: Run `wp plugin check simple-email-scheduler` - must have 0 errors
- [ ] **Version Updated**: Update version in:
  - Main plugin file header (`monthly-email-automation.php`)
  - `readme.txt` (Stable tag)
  - Any version constants in code
- [ ] **Changelog Updated**: Add entry to `readme.txt` changelog section
- [ ] **No Backup Files**: Remove all `.bak`, `.backup`, `.old`, `.orig` files
- [ ] **No Git Files**: Ensure `.git`, `.gitignore`, `.github` are excluded from SVN
- [ ] **Tested**: Plugin tested on clean WordPress installation
- [ ] **Readme.txt Valid**: Validate `readme.txt` format (check for syntax errors)
- [ ] **Assets Ready**: Banners and icons created and placed in `assets/` directory (if using)
- [ ] **No Sensitive Data**: Verify no API keys, passwords, or sensitive data in files
- [ ] **PHP Syntax Valid**: Run `php -l` on all PHP files

## 🎨 Creating Plugin Assets

See `ASSETS_GUIDE.md` for detailed instructions on creating:
- Banner 772x250px
- Banner 1544x500px (high-resolution)
- Icon 256x256px

## 🔍 Verification After Push

### 1. Check SVN Status

```bash
cd /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/
svn status
```

Should show no uncommitted changes (empty output).

### 2. View SVN Log

```bash
svn log -l 5
```

Verify your commits appear with correct messages.

### 3. Check WordPress.org

Visit: https://wordpress.org/plugins/simple-email-scheduler/

Verify:
- Version number matches
- Changelog is updated
- Banners/icons display correctly
- Download link works
- Plugin description is correct

## 🐛 Troubleshooting

### Issue: Authentication Failed

```bash
# Clear SVN auth cache
rm -rf ~/.subversion/auth/

# Re-authenticate on next commit
svn ci -m "Test"
```

### Issue: Files Not Syncing

- Check rsync paths are correct
- Verify source directory exists
- Check file permissions
- Ensure excludes are correct
- Verify rsync is installed: `which rsync`

### Issue: Tag Already Exists

```bash
# Remove old tag
svn rm tags/1.0.0
svn ci -m "Remove old tag 1.0.0"

# Create new tag
mkdir tags/1.0.0
# ... sync files ...
svn add tags/1.0.0
svn ci -m "Tag version 1.0.0"
```

### Issue: SVN Commit Fails

- Check SVN credentials
- Verify repository URL
- Check network connection
- Review SVN error messages
- Ensure you have write access to repository

### Issue: "svn: E155004: Working copy locked"

```bash
# Remove lock
svn cleanup
```

## 📝 Version Update Workflow

### For Minor Updates (1.0.0 → 1.0.1)

1. Make code changes
2. Update version in plugin files
3. Update `readme.txt` stable tag to `1.0.1`
4. Add changelog entry for version 1.0.1
5. Test changes thoroughly
6. Run Plugin Check: `wp plugin check simple-email-scheduler`
7. Fix any errors
8. Push to Git and SVN: `./push_to_git_and_svn.sh 1.0.1 "Bug fixes and improvements"`

### For Major Updates (1.0.0 → 2.0.0)

1. Make code changes
2. Update version in plugin files
3. Update `readme.txt` stable tag to `2.0.0`
4. Add major changelog entry describing new features
5. Test thoroughly on clean installation
6. Run Plugin Check: `wp plugin check simple-email-scheduler`
7. Fix any errors
8. Update screenshots if needed
9. Update assets if branding changed
10. Push to Git and SVN: `./push_to_git_and_svn.sh 2.0.0 "Major update with new features"`

## 🔐 Security Notes

- **Never commit** `.env` files or API keys
- **Always exclude** `.git`, `.gitignore`, backup files from SVN
- **Verify** no sensitive data in committed files
- **Use** `.distignore` for distribution files if needed
- **Review** all files before committing

## 📚 Additional Resources

- [WordPress.org Plugin Developer Handbook](https://developer.wordpress.org/plugins/)
- [SVN Quick Start Guide](https://developer.wordpress.org/plugins/wordpress-org/how-to-use-subversion/)
- [Plugin Assets Guidelines](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/)
- [Plugin Check Documentation](https://wordpress.org/plugins/plugin-check/)

## ✅ Quick Reference

### One-Liner Commands

```bash
# Push to both Git and SVN
cd /var/www/html/wp_local/wp-content/plugins/simple-email-scheduler/ && \
./push_to_git_and_svn.sh 1.0.0 "Update description"

# Push to SVN only
cd /var/www/html/wp_local/wp-content/plugins/simple-email-scheduler/ && \
./upload_simple_email_scheduler_wp_org.sh 1.0.0 "Update description"

# Check SVN status
cd /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/ && svn status

# View recent commits
cd /home/adeel/astore/Elearning/Plugins/simple-email-scheduler/ && svn log -l 5
```

## 📌 Important Notes

1. **Version Number**: Must match `readme.txt` stable tag exactly
2. **Commit Messages**: Use descriptive commit messages
3. **Exclude Files**: Always exclude `.git`, `.gitignore`, backup files, logs
4. **Test First**: Always test on clean WordPress installation before pushing
5. **Plugin Check**: Must pass with 0 errors before pushing
6. **Assets**: Upload banners/icons to `assets/` directory in SVN root
7. **Tags**: Create a new tag for every version release

---

**Last Updated**: January 2026  
**Plugin**: Simple Email Scheduler  
**Maintainer**: eLearning evolve  
**SVN Repository**: https://plugins.svn.wordpress.org/simple-email-scheduler/  
**GitHub Repository**: https://github.com/adeel-raza/monthly-email-automation
