#!/bin/bash
# push to the server (we add the key to before-install
git config --global push.default matching
git remote add deploy ssh://git@$IP:$PORT$DEPLOY_DIR
git push deploy master

# on-server setup
# Three stages:
# 1) install-deps: Install system packages that we depend on
# 2) setup-app: Set up the application and database
# 3) install-app: Move the app to the webserver root
ssh root@$IP:$PORT 'bash -s' < scripts/install-deps.sh
ssh git@$IP:$PORT 'bash -s' < scripts/setup-app.sh - $DEPLOY_DIR $MIGRATION_PASSWORD $APP_PASSWORD
ssh root@$IP:$PORT 'bash -s' < scripts/install-app.sh

exit 0
