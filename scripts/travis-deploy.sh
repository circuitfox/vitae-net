#!/bin/bash
# exit on error and log everything
set -ev

# decrypt our ssh key
openssl aes-256-cbc \
    -K $encrypted_c1928afcd687_key -iv $encrypted_c1928afcd687_iv \
    -in .travis/id_travis.enc -out /tmp/id_travis -d
eval "$(ssh-agent -s)"
chmod 600 /tmp/id_travis
ssh-add /tmp/id_travis
cat .travis/server-ssh-fingerprints >> ~/.ssh/known_hosts

# push to the server (we add the key to before-install
git config --global push.default matching
git remote add deploy ssh://git@$IP:$DEPLOY_DIR
git config --global remote.deploy.receivepack="/opt/rh/rh-git29/root/usr/bin/git-receive-pack"
GIT_SSH_COMMAND="ssh -i /tmp/id_travis" git push deploy "$TRAVIS_BRANCH":master

# on-server setup
# Three stages:
# 1) install-deps: Install system packages that we depend on
# 2) setup-app: Set up the application and database
# 3) install-app: Move the app to the webserver root
ssh root@$IP:$PORT 'bash -s' < scripts/install-deps.sh
ssh git@$IP:$PORT 'bash -s' < scripts/setup-app.sh - $DEPLOY_DIR $MIGRATION_PASSWORD $APP_PASSWORD
ssh root@$IP:$PORT 'bash -s' < scripts/install-app.sh

exit 0
