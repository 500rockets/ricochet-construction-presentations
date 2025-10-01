# Ricochet Construction - Presentations Site

> Professional presentation website for Ricochet Construction, featuring company story, services, and interactive presentations.

## 🚀 Features

- **Professional Home Page** with company branding and story
- **Interactive Presentation** (8 slides) with touch/keyboard navigation
- **Production-Ready Docker Setup** with nginx reverse proxy
- **Automated SSL** with Let's Encrypt and Certbot
- **Mobile Responsive** design with modern UI
- **SEO Optimized** with proper meta tags and social sharing

## 🎯 Live Demo

- **Home Page**: [presentations.ricochetconstruction.com](https://presentations.ricochetconstruction.com)
- **Presentation**: [presentations.ricochetconstruction.com/presentations/](https://presentations.ricochetconstruction.com/presentations/)

## 🏗️ Architecture

```
Internet → nginx (SSL termination) → Internal web server → Static files
            ↓
        Certbot (SSL automation)
```

## 📁 Project Structure

```
├── public/                          # Website files
│   ├── index.html                  # Home page
│   ├── presentations/              # Interactive presentation
│   ├── assets/                     # CSS, JS, images
│   └── robots.txt, sitemap.xml     # SEO files
├── nginx/                          # nginx configuration
│   ├── nginx.conf                  # Main config
│   ├── conf.d/default.conf         # Site config
│   └── web.conf                    # Internal server
├── scripts/                        # Deployment scripts
│   ├── deploy.sh                   # One-command deployment
│   ├── init-ssl.sh                 # SSL setup
│   └── renew-ssl.sh               # SSL renewal
├── docker-compose.production.yml   # Production Docker setup
└── README-DOCKER-SSL.md           # Detailed deployment guide
```

## 🚀 Quick Start

### Development

```bash
# Clone the repository
git clone https://github.com/YOUR_USERNAME/ricochet-construction-site.git
cd ricochet-construction-site

# Start development server
python3 -m http.server 8080 --directory public

# Open http://localhost:8080
```

### Production Deployment

```bash
# One-command deployment with staging SSL
./scripts/deploy.sh

# Production deployment with real SSL
STAGING=0 DOMAIN=presentations.ricochetconstruction.com EMAIL=admin@ricochetconstruction.com ./scripts/deploy.sh
```

## 🔧 Configuration

### Environment Variables

```bash
DOMAIN="presentations.ricochetconstruction.com"  # Your domain
EMAIL="admin@ricochetconstruction.com"           # Let's Encrypt email
STAGING=0                                        # 0=production, 1=staging SSL
```

### DNS Setup

Point your domain to your server:
```
A     presentations.ricochetconstruction.com    → YOUR_SERVER_IP
```

## 📋 Company Information

### About Ricochet Construction

Founded in 2017 by Dustin Dohn, Ricochet Construction specializes in:

- 🔥 **Fire & Flood Rebuilds**
- 🏗️ **Balcony Replacement** (cantilevered concrete specialty)
- 💧 **Drainage Upgrades**
- 🏢 **Clubhouse Renovations**
- ⚡ **Electrical Panel Upgrades**
- 🏗️ **Concrete & Roofing**

### Our Promise

- ⏱️ **48-hour response** to project requests
- 📋 **48-hour proposal** delivery
- 🏗️ **Daily presence** until 100% completion
- 💬 **Constant communication** throughout projects

### Experience

- **25+ years** construction experience
- **18 years** advancement from helper to Project Manager
- **Since 2017** - Ricochet Construction founded
- **Texas statewide** service area

## 🛡️ Security Features

- **SSL/TLS Encryption** with Let's Encrypt
- **Security Headers** (HSTS, XSS protection, CSP)
- **Rate Limiting** and DDoS protection
- **Automated Updates** with Watchtower
- **Hidden File Protection**

## 🚀 Performance

- **Static Files** for fast loading
- **HTTP/2** enabled
- **Gzip Compression** for all text content
- **Long-term Caching** for assets
- **Mobile-first** responsive design

## 📱 Mobile Support

- ✅ Touch navigation for presentations
- ✅ Responsive design for all screen sizes
- ✅ Fast mobile loading (<2 seconds)
- ✅ Mobile-friendly presentation controls

## 🔄 Deployment Options

### 1. Docker (Recommended)
Complete production setup with SSL automation:
```bash
./scripts/deploy.sh
```

### 2. Static Hosting
Upload `public/` folder to any static host:
- Netlify, Vercel, GitHub Pages
- Apache, nginx web servers
- CDN services (Cloudflare, AWS CloudFront)

### 3. Manual Server Setup
Copy files and configure web server manually.

## 📊 Analytics & SEO

### SEO Features
- ✅ Semantic HTML structure
- ✅ Meta tags and Open Graph
- ✅ Sitemap and robots.txt
- ✅ Fast loading speeds
- ✅ Mobile-friendly design

### Analytics Setup
Add your tracking code to:
- `public/index.html`
- `public/presentations/index.html`

## 🔧 Development

### Local Development
```bash
# Start local server
python3 -m http.server 8080 --directory public

# Or use any static file server
npx serve public
```

### Making Changes
- **Home page**: Edit `public/index.html`
- **Presentation**: Edit `public/presentations/index.html`
- **Styles**: Modify CSS files in `public/assets/css/`
- **Scripts**: Update JS files in `public/assets/js/`

### Testing
- Test on multiple devices and browsers
- Verify mobile responsiveness
- Check presentation navigation
- Test SSL setup in staging first

## 📚 Documentation

- **[Production Deployment Guide](README-DOCKER-SSL.md)** - Complete Docker + SSL setup
- **[Presentation Features](public/presentations/README.md)** - Interactive presentation details

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is created specifically for Ricochet Construction and contains proprietary company information.

## 📞 Support

For questions about Ricochet Construction services:
- **Phone**: (XXX) XXX-XXXX
- **Email**: info@ricochetconstruction.com
- **Service Area**: Texas Statewide

For technical support with this website:
- Review the documentation
- Check the issues section
- Contact the development team

---

## 🎉 Built With

- **HTML5 & CSS3** - Modern web standards
- **JavaScript** - Interactive presentation features
- **Docker** - Containerized deployment
- **nginx** - High-performance web server
- **Let's Encrypt** - Free SSL certificates
- **Inter Font** - Professional typography

**"At Ricochet Construction, we build trust."** - *Dustin Dohn, Founder*