#!/bin/bash
# Generic Git + SVN Push Script for WordPress Plugins
# Usage: ./push_to_git_and_svn.sh VERSION "Commit message"

VERSION=$1
COMMIT_MSG=$2

if [ -z "$VERSION" ] || [ -z "$COMMIT_MSG" ]; then
    echo "Usage: $0 VERSION \"Commit message\""
    exit 1
fi

PLUGIN_DIR=$(pwd)
PLUGIN_SLUG=$(basename "$PLUGIN_DIR")
SVN_SCRIPT=$(find . -maxdepth 1 -name "upload_*_wp_org.sh" | head -1)

if [ -z "$SVN_SCRIPT" ]; then
    echo "❌ SVN upload script not found."
    exit 1
fi

echo "🚀 Pushing ${PLUGIN_SLUG} version ${VERSION} to Git and SVN..."

if [ -d ".git" ]; then
    if [ -n "$(git status --porcelain)" ]; then
        git add -A
        git commit -m "$COMMIT_MSG" || true
        git push origin main || git push origin master || true
    fi
    if ! git rev-parse "v${VERSION}" >/dev/null 2>&1; then
        git tag -a "v${VERSION}" -m "Version ${VERSION}: ${COMMIT_MSG}"
        git push origin "v${VERSION}" || true
    fi
fi

chmod +x "$SVN_SCRIPT"
"$SVN_SCRIPT" "$VERSION" "$COMMIT_MSG" || exit 1

echo "✅ Successfully pushed ${PLUGIN_SLUG} version ${VERSION} to both Git and SVN!"
