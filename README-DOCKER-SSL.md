# Ricochet Construction - Docker + SSL Production Setup

## 🚀 Complete Production Deployment with Automated SSL

This setup provides a production-ready Docker environment with nginx reverse proxy and automated SSL certificate management using Let's Encrypt and Certbot.

## 🏗️ Architecture

```
Internet → nginx (SSL termination) → Internal web server → Static files
            ↓
        Certbot (SSL management)
```

### Components

- **nginx (Reverse Proxy)**: SSL termination, security headers, caching
- **web (Backend)**: Internal static file server
- **certbot**: Automated SSL certificate management
- **watchtower**: Automatic container updates

## 📁 File Structure

```
├── docker-compose.production.yml    # Production Docker setup
├── nginx/
│   ├── nginx.conf                  # Main nginx configuration
│   ├── conf.d/default.conf         # Site-specific configuration
│   └── web.conf                    # Internal web server config
├── scripts/
│   ├── deploy.sh                   # Complete deployment script
│   ├── init-ssl.sh                 # SSL initialization
│   └── renew-ssl.sh               # SSL renewal automation
├── dhparam/                        # Diffie-Hellman parameters
└── public/                         # Website files
```

## 🚀 Quick Deployment

### 1. One-Command Deployment

```bash
# Deploy with staging SSL (for testing)
./scripts/deploy.sh

# Deploy with production SSL
STAGING=0 DOMAIN=presentations.ricochetconstruction.com EMAIL=admin@ricochetconstruction.com ./scripts/deploy.sh
```

### 2. Manual Step-by-Step

```bash
# 1. Configure environment
export DOMAIN="presentations.ricochetconstruction.com"
export EMAIL="admin@ricochetconstruction.com"
export STAGING=0  # 0 for production, 1 for staging

# 2. Start services
docker-compose -f docker-compose.production.yml up -d

# 3. Initialize SSL
./scripts/init-ssl.sh

# 4. Verify deployment
curl -I https://$DOMAIN/health
```

## ⚙️ Configuration

### Environment Variables

```bash
# Required
DOMAIN="presentations.ricochetconstruction.com"
EMAIL="admin@ricochetconstruction.com"

# Optional
STAGING=0                    # 0=production SSL, 1=staging SSL
COMPOSE_FILE="docker-compose.production.yml"
```

### Domain Setup

1. **DNS Configuration**:
   ```
   A     presentations.ricochetconstruction.com    → YOUR_SERVER_IP
   AAAA  presentations.ricochetconstruction.com    → YOUR_SERVER_IPv6 (optional)
   ```

2. **Firewall Rules**:
   ```bash
   # Allow HTTP and HTTPS
   ufw allow 80/tcp
   ufw allow 443/tcp
   ```

## 🔐 SSL Certificate Management

### Automatic SSL Setup

The deployment automatically:
1. Generates Diffie-Hellman parameters
2. Creates temporary certificates for nginx startup
3. Requests real certificates from Let's Encrypt
4. Configures automatic renewal

### Manual SSL Operations

```bash
# Initialize SSL certificates
./scripts/init-ssl.sh

# Renew certificates manually
./scripts/renew-ssl.sh

# Check certificate status
docker-compose -f docker-compose.production.yml run --rm certbot certificates

# Test renewal (dry run)
docker-compose -f docker-compose.production.yml run --rm certbot renew --dry-run
```

### SSL Renewal Automation

Automatic renewal is set up via cron:
```bash
# Runs daily at 12:00 PM
0 12 * * * cd /path/to/project && ./scripts/renew-ssl.sh
```

## 🔧 Management Commands

### Service Management

```bash
# View logs
docker-compose -f docker-compose.production.yml logs -f

# Restart services
docker-compose -f docker-compose.production.yml restart

# Stop services
docker-compose -f docker-compose.production.yml down

# Update containers
docker-compose -f docker-compose.production.yml pull
docker-compose -f docker-compose.production.yml up -d
```

### Monitoring

```bash
# Check service status
docker-compose -f docker-compose.production.yml ps

# View nginx logs
docker-compose -f docker-compose.production.yml logs nginx

# Check SSL certificate expiry
echo | openssl s_client -servername $DOMAIN -connect $DOMAIN:443 2>/dev/null | openssl x509 -noout -dates
```

## 🛡️ Security Features

### Implemented Security

- **SSL/TLS**: Modern TLS 1.2/1.3 with secure ciphers
- **HSTS**: HTTP Strict Transport Security with preload
- **Security Headers**: XSS protection, content type sniffing prevention
- **Rate Limiting**: Protection against abuse and DDoS
- **Content Security Policy**: XSS attack prevention
- **Hidden Files**: Protection against sensitive file access

### Security Headers

```nginx
Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
X-Frame-Options: DENY
X-Content-Type-Options: nosniff
X-XSS-Protection: 1; mode=block
Referrer-Policy: no-referrer-when-downgrade
Content-Security-Policy: default-src 'self' https: data: 'unsafe-inline'
```

### Rate Limiting

- **General**: 10 requests/second with burst of 20
- **API endpoints**: 10 requests/second with burst of 10
- **Login attempts**: 1 request/second

## 🚀 Performance Optimization

### Caching Strategy

- **Static Assets**: 1 year cache with immutable flag
- **HTML Files**: No cache for dynamic content
- **API Responses**: No cache for real-time data

### Compression

- **Gzip**: Enabled for text-based files
- **Brotli**: Available for modern browsers
- **Static Compression**: Pre-compressed files served when available

### HTTP/2

- **Enabled**: Faster multiplexed connections
- **Server Push**: Optimized resource delivery
- **Header Compression**: Reduced overhead

## 📊 Monitoring & Analytics

### Health Checks

```bash
# Application health
curl https://$DOMAIN/health

# SSL certificate check
curl -I https://$DOMAIN

# Performance test
curl -w "@curl-format.txt" -o /dev/null -s https://$DOMAIN
```

### Log Analysis

```bash
# Access logs
docker-compose -f docker-compose.production.yml exec nginx tail -f /var/log/nginx/access.log

# Error logs
docker-compose -f docker-compose.production.yml exec nginx tail -f /var/log/nginx/error.log

# SSL renewal logs
tail -f /var/log/ricochet-ssl-renewal.log
```

## 🔄 Backup & Recovery

### Backup Strategy

```bash
# Backup SSL certificates
docker run --rm -v ricochet_certbot-etc:/backup-source -v $(pwd)/backups:/backup alpine tar czf /backup/ssl-certificates-$(date +%Y%m%d).tar.gz -C /backup-source .

# Backup website files
tar czf backups/website-$(date +%Y%m%d).tar.gz public/

# Backup configuration
tar czf backups/config-$(date +%Y%m%d).tar.gz nginx/ scripts/ docker-compose.production.yml
```

### Recovery Process

```bash
# Restore SSL certificates
docker run --rm -v ricochet_certbot-etc:/restore-target -v $(pwd)/backups:/backup alpine tar xzf /backup/ssl-certificates-YYYYMMDD.tar.gz -C /restore-target

# Restore website files
tar xzf backups/website-YYYYMMDD.tar.gz

# Restart services
docker-compose -f docker-compose.production.yml restart
```

## 🚨 Troubleshooting

### Common Issues

1. **SSL Certificate Errors**:
   ```bash
   # Check certificate status
   docker-compose -f docker-compose.production.yml run --rm certbot certificates
   
   # Regenerate certificates
   ./scripts/init-ssl.sh
   ```

2. **nginx Won't Start**:
   ```bash
   # Check configuration
   docker-compose -f docker-compose.production.yml exec nginx nginx -t
   
   # View logs
   docker-compose -f docker-compose.production.yml logs nginx
   ```

3. **Port Already in Use**:
   ```bash
   # Find process using port
   sudo lsof -i :80
   sudo lsof -i :443
   
   # Stop conflicting services
   sudo systemctl stop apache2  # or nginx
   ```

### Debug Mode

```bash
# Enable debug logging
export NGINX_DEBUG=1
docker-compose -f docker-compose.production.yml up -d

# View detailed logs
docker-compose -f docker-compose.production.yml logs -f nginx
```

## 📈 Scaling & Updates

### Horizontal Scaling

```bash
# Scale web service
docker-compose -f docker-compose.production.yml up -d --scale web=3

# Load balancer configuration automatically handles multiple backends
```

### Zero-Downtime Updates

```bash
# Rolling update
docker-compose -f docker-compose.production.yml pull
docker-compose -f docker-compose.production.yml up -d --no-deps web
docker-compose -f docker-compose.production.yml restart nginx
```

## 🎯 Production Checklist

Before going live:

- [ ] Domain DNS configured correctly
- [ ] Firewall rules configured (ports 80, 443)
- [ ] SSL certificates obtained and working
- [ ] Security headers verified
- [ ] Performance tested (Lighthouse score 90+)
- [ ] Backup strategy implemented
- [ ] Monitoring alerts configured
- [ ] SSL renewal automation tested
- [ ] Error pages customized
- [ ] Analytics tracking configured

## 📞 Support & Maintenance

### Regular Maintenance Tasks

1. **Weekly**: Check SSL certificate expiry
2. **Monthly**: Review access logs and security
3. **Quarterly**: Update Docker images and dependencies
4. **Annually**: Review and update security configurations

### Emergency Contacts

- **SSL Issues**: Check Let's Encrypt status page
- **Performance Issues**: Monitor server resources
- **Security Issues**: Review nginx error logs

---

## 🎉 Ready for Production!

Your Ricochet Construction presentation site is now production-ready with:

✅ **Automated SSL** with Let's Encrypt  
✅ **nginx Reverse Proxy** with security headers  
✅ **Docker Containerization** for easy deployment  
✅ **Automatic Updates** with Watchtower  
✅ **Performance Optimization** with caching and compression  
✅ **Security Hardening** with rate limiting and headers  
✅ **Monitoring & Logging** for operational visibility  

Deploy with confidence! 🚀
