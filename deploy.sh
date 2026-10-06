#!/bin/bash

set -e

SSH_HOST="Mulroy"

THEME_NAME="mulroy"
LOCAL_THEME="./wp-content/themes/$THEME_NAME/"

REMOTE_ROOT="/home/u652416532/domains/mulroyarchitects.com/public_html"
echo "Select deployment environment:"
echo "  1) Staging"
echo "  2) Production"
echo ""
read -p "Environment [1/2]: " ENVIRONMENT

case "$ENVIRONMENT" in
    1|staging|Staging|STAGING)
        DEPLOY_ENV="staging"
        REMOTE_THEME="$REMOTE_ROOT/staging/wp-content/themes/$THEME_NAME"
        ;;
    2|production|Production|PRODUCTION)
        DEPLOY_ENV="production"
        REMOTE_THEME="$REMOTE_ROOT/wp-content/themes/$THEME_NAME"
        ;;
    *)
        echo "Invalid environment. Deployment cancelled."
        exit 1
        ;;
esac

echo ""
echo "🎯 Environment: ${DEPLOY_ENV^^}"
echo "📂 Remote theme: $REMOTE_THEME"

BACKUP_DIR="/home/u652416532/backups/themes"
BACKUPS_TO_KEEP=10

TIMESTAMP=$(date +"%Y%m%d-%H%M%S")
BACKUP_FILE="$BACKUP_DIR/${THEME_NAME}-${TIMESTAMP}.tar.gz"

RSYNC_EXCLUDES=(
    --exclude=".DS_Store"
    --exclude=".git/"
    --exclude="node_modules/"
    --exclude="src/"
)


echo "🔍 Checking deployment changes..."

rsync -avzn --delete \
    "${RSYNC_EXCLUDES[@]}" \
    "$LOCAL_THEME" \
    "$SSH_HOST:$REMOTE_THEME/"


echo ""
read -p "Deploy these changes to ${DEPLOY_ENV^^}? (y/N) " CONFIRM

if [[ "$CONFIRM" != "y" && "$CONFIRM" != "Y" ]]; then
    echo "Deployment cancelled."
    exit 0
fi


echo ""
if [[ "$DEPLOY_ENV" == "production" ]]; then
    echo "💾 Backing up current production theme..."

    ssh "$SSH_HOST" "
        set -e

        mkdir -p '$BACKUP_DIR'

        tar -czf '$BACKUP_FILE' \
            -C '$REMOTE_ROOT/wp-content/themes' \
            '$THEME_NAME'

        echo 'Backup created: $BACKUP_FILE'

        # Keep only the most recent backups
        cd '$BACKUP_DIR'

        ls -1t '${THEME_NAME}-'*.tar.gz 2>/dev/null \
            | tail -n +$((BACKUPS_TO_KEEP + 1)) \
            | xargs -r rm --

        echo 'Old backups cleaned up. Keeping the latest $BACKUPS_TO_KEEP.'
    "
else
    echo "⏭️  Staging deployment: skipping backup."
fi


echo ""
echo "🚀 Deploying to ${DEPLOY_ENV^^}..."

rsync -avz --delete \
    "${RSYNC_EXCLUDES[@]}" \
    "$LOCAL_THEME" \
    "$SSH_HOST:$REMOTE_THEME/"


echo ""
echo "✅ Deployment complete."
if [[ "$DEPLOY_ENV" == "production" ]]; then
    echo "💾 Production backup: $BACKUP_FILE"
fi