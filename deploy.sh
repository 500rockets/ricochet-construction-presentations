#!/bin/bash

# Ricochet Construction Presentations - Deployment Script
# Usage: ./deploy.sh

set -e

echo "🚀 Deploying Ricochet Construction Presentations..."

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Configuration
SERVER_IP="104.236.226.9"
SSH_KEY="~/.ssh/mattdigitalocean"
DOMAIN="slides.ricochetconstruction.com"
WEB_ROOT="/var/www/slides.ricochetconstruction.com"

echo -e "${BLUE}📦 Pushing changes to GitHub...${NC}"
git add .
git commit -m "Deploy: $(date '+%Y-%m-%d %H:%M:%S')" || echo "No changes to commit"
git push origin main

echo -e "${BLUE}🔄 Pulling latest changes on server...${NC}"
ssh -i $SSH_KEY root@$SERVER_IP "cd ricochet-construction-presentations && git pull origin main"

echo -e "${BLUE}📁 Updating web files...${NC}"
ssh -i $SSH_KEY root@$SERVER_IP "
    cp -r /root/ricochet-construction-presentations/public/* $WEB_ROOT/
    chown -R www-data:www-data $WEB_ROOT
    chmod -R 755 $WEB_ROOT
"

echo -e "${BLUE}🔄 Reloading nginx...${NC}"
ssh -i $SSH_KEY root@$SERVER_IP "nginx -t && systemctl reload nginx"

echo -e "${GREEN}✅ Deployment complete!${NC}"
echo -e "${GREEN}🌐 Site is live at: https://$DOMAIN${NC}"

# Test the deployment
echo -e "${BLUE}🧪 Testing deployment...${NC}"
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://$DOMAIN)

if [ $HTTP_STATUS -eq 200 ]; then
    echo -e "${GREEN}✅ Site is responding correctly (HTTP $HTTP_STATUS)${NC}"
else
    echo -e "${RED}❌ Site returned HTTP $HTTP_STATUS${NC}"
    exit 1
fi

echo -e "${GREEN}🎉 Deployment successful!${NC}"
