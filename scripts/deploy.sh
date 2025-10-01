#!/bin/bash

# Production Deployment Script for Ricochet Construction Presentations
# This script handles the complete deployment process

set -e

# Configuration
DOMAIN=${DOMAIN:-"presentations.ricochetconstruction.com"}
EMAIL=${EMAIL:-"admin@ricochetconstruction.com"}
STAGING=${STAGING:-1}
COMPOSE_FILE="docker-compose.production.yml"

echo "🚀 Deploying Ricochet Construction Presentations Site"
echo "=================================================="

# Check prerequisites
echo "🔍 Checking prerequisites..."

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker and try again."
    exit 1
fi

# Check if Docker Compose is available
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose is not installed. Please install it and try again."
    exit 1
fi

# Check if domain is configured
if [ "$DOMAIN" = "presentations.ricochetconstruction.com" ]; then
    echo "⚠️  Warning: Using default domain. Set DOMAIN environment variable for production."
    read -p "Continue with default domain? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "Deployment cancelled."
        exit 1
    fi
fi

echo "✅ Prerequisites check passed"

# Build and start services
echo "🏗️  Building and starting services..."
docker-compose -f $COMPOSE_FILE build --no-cache
docker-compose -f $COMPOSE_FILE up -d web

# Wait for web service to be ready
echo "⏳ Waiting for web service to be ready..."
sleep 10

# Initialize SSL certificates
echo "🔐 Initializing SSL certificates..."
chmod +x scripts/init-ssl.sh
DOMAIN=$DOMAIN EMAIL=$EMAIL STAGING=$STAGING ./scripts/init-ssl.sh

# Verify deployment
echo "🔍 Verifying deployment..."

# Check if containers are running
if ! docker-compose -f $COMPOSE_FILE ps | grep -q "Up"; then
    echo "❌ Some containers are not running properly"
    docker-compose -f $COMPOSE_FILE logs
    exit 1
fi

# Test HTTP redirect
echo "🌐 Testing HTTP to HTTPS redirect..."
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" -L http://$DOMAIN/health || echo "000")
if [ "$HTTP_STATUS" != "200" ]; then
    echo "⚠️  HTTP health check failed (status: $HTTP_STATUS)"
else
    echo "✅ HTTP redirect working"
fi

# Test HTTPS
echo "🔒 Testing HTTPS..."
HTTPS_STATUS=$(curl -s -o /dev/null -w "%{http_code}" -k https://$DOMAIN/health || echo "000")
if [ "$HTTPS_STATUS" != "200" ]; then
    echo "⚠️  HTTPS health check failed (status: $HTTPS_STATUS)"
else
    echo "✅ HTTPS working"
fi

# Set up SSL renewal cron job
echo "⏰ Setting up SSL renewal cron job..."
chmod +x scripts/renew-ssl.sh

# Create cron job entry
CRON_JOB="0 12 * * * cd $(pwd) && ./scripts/renew-ssl.sh"
(crontab -l 2>/dev/null; echo "$CRON_JOB") | crontab -
echo "✅ SSL renewal cron job added (runs daily at 12:00 PM)"

# Display final information
echo ""
echo "🎉 Deployment completed successfully!"
echo "=================================================="
echo "🌐 Site URL: https://$DOMAIN"
echo "📊 Health Check: https://$DOMAIN/health"
echo "🎯 Presentation: https://$DOMAIN/presentations/"
echo ""
echo "📋 Management Commands:"
echo "  View logs:     docker-compose -f $COMPOSE_FILE logs -f"
echo "  Stop services: docker-compose -f $COMPOSE_FILE down"
echo "  Restart:       docker-compose -f $COMPOSE_FILE restart"
echo "  SSL renewal:   ./scripts/renew-ssl.sh"
echo ""
echo "🔧 Configuration:"
echo "  Domain: $DOMAIN"
echo "  Email: $EMAIL"
echo "  Staging SSL: $STAGING"
echo ""

if [ $STAGING != "0" ]; then
    echo "⚠️  IMPORTANT: You are using staging SSL certificates!"
    echo "   For production, run: STAGING=0 ./scripts/deploy.sh"
fi

echo "✅ Deployment complete! Your site is now live."
