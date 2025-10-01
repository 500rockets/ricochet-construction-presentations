#!/bin/bash

# SSL Initialization Script for Ricochet Construction Presentations
# This script sets up SSL certificates using Let's Encrypt and Certbot

set -e

# Configuration
DOMAIN="presentations.ricochetconstruction.com"
EMAIL="admin@ricochetconstruction.com"
STAGING=${STAGING:-1}  # Set to 0 for production certificates
COMPOSE_FILE="docker-compose.production.yml"

echo "🚀 Initializing SSL for Ricochet Construction Presentations"
echo "Domain: $DOMAIN"
echo "Email: $EMAIL"
echo "Staging: $STAGING"

# Check if domain is set
if [ "$DOMAIN" = "presentations.ricochetconstruction.com" ]; then
    echo "⚠️  Warning: Using default domain. Update DOMAIN variable for production."
fi

# Create dhparam if it doesn't exist
if [ ! -f "dhparam/dhparam.pem" ]; then
    echo "📝 Generating Diffie-Hellman parameters (this may take a while)..."
    mkdir -p dhparam
    openssl dhparam -out dhparam/dhparam.pem 2048
    echo "✅ Diffie-Hellman parameters generated"
fi

# Create dummy certificate for initial nginx start
echo "📝 Creating dummy certificate for $DOMAIN..."
mkdir -p "nginx/ssl/live/$DOMAIN"
docker-compose -f $COMPOSE_FILE run --rm --entrypoint "\
    openssl req -x509 -nodes -newkey rsa:2048 -days 1 \
    -keyout '/etc/letsencrypt/live/$DOMAIN/privkey.pem' \
    -out '/etc/letsencrypt/live/$DOMAIN/fullchain.pem' \
    -subj '/CN=localhost'" certbot

echo "✅ Dummy certificate created"

# Start nginx with dummy certificate
echo "🔄 Starting nginx with dummy certificate..."
docker-compose -f $COMPOSE_FILE up --force-recreate -d nginx

# Remove dummy certificate
echo "🗑️  Removing dummy certificate..."
docker-compose -f $COMPOSE_FILE run --rm --entrypoint "\
    rm -Rf /etc/letsencrypt/live/$DOMAIN && \
    rm -Rf /etc/letsencrypt/archive/$DOMAIN && \
    rm -Rf /etc/letsencrypt/renewal/$DOMAIN.conf" certbot

# Request real certificate
echo "📜 Requesting SSL certificate from Let's Encrypt..."

# Determine staging flag
STAGING_FLAG=""
if [ $STAGING != "0" ]; then
    STAGING_FLAG="--staging"
    echo "🧪 Using staging environment"
else
    echo "🔴 Using production environment"
fi

# Request certificate
docker-compose -f $COMPOSE_FILE run --rm --entrypoint "\
    certbot certonly --webroot -w /var/www/html \
    $STAGING_FLAG \
    --email $EMAIL \
    --agree-tos \
    --no-eff-email \
    --force-renewal \
    -d $DOMAIN" certbot

echo "✅ SSL certificate obtained"

# Reload nginx with real certificate
echo "🔄 Reloading nginx with real certificate..."
docker-compose -f $COMPOSE_FILE exec nginx nginx -s reload

echo "🎉 SSL setup complete!"
echo ""
echo "📋 Next steps:"
echo "1. Test your site: https://$DOMAIN"
echo "2. Check SSL rating: https://www.ssllabs.com/ssltest/analyze.html?d=$DOMAIN"
echo "3. Set up automatic renewal (see scripts/renew-ssl.sh)"
echo ""
echo "🔧 To use production certificates:"
echo "   STAGING=0 ./scripts/init-ssl.sh"
