#!/bin/bash

# Server Setup Script for Ricochet Construction Presentations
# Run this script on your DigitalOcean server (104.236.226.9)

set -e

SERVER_IP="104.236.226.9"
REPO_URL="https://github.com/500rockets/ricochet-construction-presentations.git"
PROJECT_DIR="/opt/ricochet-construction"
DOMAIN="presentations.ricochetconstruction.com"
EMAIL="admin@ricochetconstruction.com"

echo "🚀 Setting up Ricochet Construction Presentations on server $SERVER_IP"
echo "=================================================================="

# Update system packages
echo "📦 Updating system packages..."
apt update && apt upgrade -y

# Install required packages
echo "📦 Installing required packages..."
apt install -y \
    curl \
    wget \
    git \
    ufw \
    htop \
    nano \
    unzip \
    software-properties-common \
    apt-transport-https \
    ca-certificates \
    gnupg \
    lsb-release

# Install Docker
echo "🐳 Installing Docker..."
if ! command -v docker &> /dev/null; then
    # Add Docker's official GPG key
    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
    
    # Add Docker repository
    echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
    
    # Install Docker
    apt update
    apt install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
    
    # Start and enable Docker
    systemctl start docker
    systemctl enable docker
    
    # Add current user to docker group (if not root)
    if [ "$USER" != "root" ]; then
        usermod -aG docker $USER
    fi
    
    echo "✅ Docker installed successfully"
else
    echo "✅ Docker already installed"
fi

# Install Docker Compose (standalone)
echo "🐳 Installing Docker Compose..."
if ! command -v docker-compose &> /dev/null; then
    DOCKER_COMPOSE_VERSION=$(curl -s https://api.github.com/repos/docker/compose/releases/latest | grep 'tag_name' | cut -d\" -f4)
    curl -L "https://github.com/docker/compose/releases/download/${DOCKER_COMPOSE_VERSION}/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    chmod +x /usr/local/bin/docker-compose
    echo "✅ Docker Compose installed successfully"
else
    echo "✅ Docker Compose already installed"
fi

# Configure firewall
echo "🔥 Configuring firewall..."
ufw --force reset
ufw default deny incoming
ufw default allow outgoing
ufw allow ssh
ufw allow 80/tcp
ufw allow 443/tcp
ufw --force enable
echo "✅ Firewall configured"

# Create project directory
echo "📁 Creating project directory..."
mkdir -p $PROJECT_DIR
cd $PROJECT_DIR

# Clone repository
echo "📥 Cloning repository..."
if [ -d ".git" ]; then
    echo "Repository already exists, pulling latest changes..."
    git pull origin main
else
    git clone $REPO_URL .
fi

# Make scripts executable
echo "🔧 Setting up permissions..."
chmod +x scripts/*.sh

# Create environment file
echo "⚙️ Creating environment configuration..."
cat > .env << EOF
DOMAIN=$DOMAIN
EMAIL=$EMAIL
STAGING=1
COMPOSE_FILE=docker-compose.production.yml
EOF

# Generate DH parameters (this takes a while)
echo "🔐 Generating Diffie-Hellman parameters (this may take several minutes)..."
mkdir -p dhparam
if [ ! -f "dhparam/dhparam.pem" ]; then
    openssl dhparam -out dhparam/dhparam.pem 2048
    echo "✅ DH parameters generated"
else
    echo "✅ DH parameters already exist"
fi

# Start services
echo "🚀 Starting Docker services..."
docker-compose -f docker-compose.production.yml pull
docker-compose -f docker-compose.production.yml up -d web

# Wait for services to be ready
echo "⏳ Waiting for services to start..."
sleep 10

# Initialize SSL certificates (staging first)
echo "🔐 Initializing SSL certificates..."
if [ -f "scripts/init-ssl.sh" ]; then
    STAGING=1 DOMAIN=$DOMAIN EMAIL=$EMAIL ./scripts/init-ssl.sh
else
    echo "⚠️  SSL initialization script not found, skipping SSL setup"
fi

# Display status
echo ""
echo "🎉 Deployment completed!"
echo "================================"
echo "🌐 Server IP: $SERVER_IP"
echo "🔗 Domain: $DOMAIN"
echo "📊 Health Check: http://$SERVER_IP/health"
echo ""
echo "📋 Next steps:"
echo "1. Point your domain DNS to this server IP"
echo "2. Test the site: http://$SERVER_IP"
echo "3. Run production SSL: STAGING=0 ./scripts/init-ssl.sh"
echo ""
echo "🔧 Management commands:"
echo "  View logs: docker-compose -f docker-compose.production.yml logs -f"
echo "  Restart:   docker-compose -f docker-compose.production.yml restart"
echo "  Stop:      docker-compose -f docker-compose.production.yml down"
echo ""
echo "✅ Server setup complete!"
