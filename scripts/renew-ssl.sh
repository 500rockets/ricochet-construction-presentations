#!/bin/bash

# SSL Certificate Renewal Script for Ricochet Construction Presentations
# This script should be run via cron to automatically renew certificates

set -e

COMPOSE_FILE="docker-compose.production.yml"
LOG_FILE="/var/log/ricochet-ssl-renewal.log"

echo "$(date): Starting SSL certificate renewal check" >> $LOG_FILE

# Check and renew certificates
docker-compose -f $COMPOSE_FILE run --rm certbot renew --quiet

# Reload nginx if certificates were renewed
if [ $? -eq 0 ]; then
    echo "$(date): Certificates checked/renewed successfully" >> $LOG_FILE
    
    # Reload nginx to use new certificates
    docker-compose -f $COMPOSE_FILE exec nginx nginx -s reload
    echo "$(date): Nginx reloaded with updated certificates" >> $LOG_FILE
else
    echo "$(date): Certificate renewal failed" >> $LOG_FILE
    exit 1
fi

# Clean up old certificates
docker-compose -f $COMPOSE_FILE run --rm certbot certificates --quiet

echo "$(date): SSL renewal process completed" >> $LOG_FILE
