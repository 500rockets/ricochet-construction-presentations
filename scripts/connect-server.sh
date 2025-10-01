#!/bin/bash

# Server Connection Script for Ricochet Construction Presentations
# This script helps you connect to and manage your DigitalOcean server

SERVER_IP="104.236.226.9"
SSH_KEY="~/.ssh/mattdigitalocean"
PROJECT_DIR="/opt/ricochet-construction"

echo "🌐 Ricochet Construction Server Management"
echo "========================================"
echo "Server IP: $SERVER_IP"
echo "SSH Key: $SSH_KEY"
echo ""

# Function to test SSH connection
test_connection() {
    echo "🔍 Testing SSH connection..."
    if ssh -i $SSH_KEY -o ConnectTimeout=10 -o BatchMode=yes root@$SERVER_IP exit 2>/dev/null; then
        echo "✅ SSH connection successful"
        return 0
    else
        echo "❌ SSH connection failed"
        return 1
    fi
}

# Function to connect to server
connect_server() {
    echo "🔗 Connecting to server..."
    ssh -i $SSH_KEY root@$SERVER_IP
}

# Function to deploy project
deploy_project() {
    echo "🚀 Deploying project to server..."
    
    # Copy setup script to server
    echo "📤 Copying setup script to server..."
    scp -i $SSH_KEY scripts/server-setup.sh root@$SERVER_IP:/tmp/
    
    # Run setup script on server
    echo "🏃 Running setup script on server..."
    ssh -i $SSH_KEY root@$SERVER_IP "chmod +x /tmp/server-setup.sh && /tmp/server-setup.sh"
}

# Function to check server status
check_status() {
    echo "📊 Checking server status..."
    ssh -i $SSH_KEY root@$SERVER_IP "
        echo '🐳 Docker status:'
        systemctl status docker --no-pager -l
        echo ''
        echo '📦 Running containers:'
        docker ps
        echo ''
        echo '🌐 Service health:'
        curl -s http://localhost/health || echo 'Health check failed'
        echo ''
        echo '💾 Disk usage:'
        df -h
        echo ''
        echo '🧠 Memory usage:'
        free -h
    "
}

# Function to view logs
view_logs() {
    echo "📋 Viewing application logs..."
    ssh -i $SSH_KEY root@$SERVER_IP "
        cd $PROJECT_DIR
        docker-compose -f docker-compose.production.yml logs --tail=50 -f
    "
}

# Function to restart services
restart_services() {
    echo "🔄 Restarting services..."
    ssh -i $SSH_KEY root@$SERVER_IP "
        cd $PROJECT_DIR
        docker-compose -f docker-compose.production.yml restart
    "
}

# Function to update project
update_project() {
    echo "📥 Updating project from GitHub..."
    ssh -i $SSH_KEY root@$SERVER_IP "
        cd $PROJECT_DIR
        git pull origin main
        docker-compose -f docker-compose.production.yml pull
        docker-compose -f docker-compose.production.yml up -d
    "
}

# Main menu
show_menu() {
    echo ""
    echo "Choose an option:"
    echo "1) Test SSH connection"
    echo "2) Connect to server (SSH)"
    echo "3) Deploy project (first time setup)"
    echo "4) Check server status"
    echo "5) View application logs"
    echo "6) Restart services"
    echo "7) Update project from GitHub"
    echo "8) Exit"
    echo ""
}

# Main script logic
if [ "$1" = "deploy" ]; then
    deploy_project
elif [ "$1" = "connect" ]; then
    connect_server
elif [ "$1" = "status" ]; then
    check_status
elif [ "$1" = "logs" ]; then
    view_logs
elif [ "$1" = "restart" ]; then
    restart_services
elif [ "$1" = "update" ]; then
    update_project
else
    # Interactive mode
    while true; do
        show_menu
        read -p "Enter your choice (1-8): " choice
        
        case $choice in
            1) test_connection ;;
            2) connect_server; break ;;
            3) deploy_project ;;
            4) check_status ;;
            5) view_logs ;;
            6) restart_services ;;
            7) update_project ;;
            8) echo "👋 Goodbye!"; exit 0 ;;
            *) echo "❌ Invalid option. Please try again." ;;
        esac
        
        echo ""
        read -p "Press Enter to continue..."
    done
fi
