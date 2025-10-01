# Ricochet Construction - Production Deployment Guide

## 🚀 Production-Ready Presentation Site

This site is ready for deployment to a subdomain with a professional home page and direct presentation linking.

## 📁 Site Structure

```
public/
├── index.html                    # Main home page
├── presentations/
│   ├── index.html               # Interactive presentation
│   ├── assets/                  # Presentation assets
│   └── scripts/                 # Presentation JavaScript
├── assets/
│   ├── css/main.css            # Main site styles
│   ├── js/main.js              # Main site JavaScript
│   └── images/                 # Logos and images
└── .htaccess                   # Apache configuration
```

## 🌐 Deployment Options

### Option 1: Docker Deployment (Recommended)

```bash
# Build and run with Docker
docker-compose -f docker-compose.presentations.yml up -d

# Access at http://localhost:8080 (development)
# Configure SSL for production HTTPS
```

### Option 2: Static File Hosting

Upload the entire `public/` folder to your web server:
- **Netlify**: Drag & drop the `public` folder
- **Vercel**: Deploy from Git repository
- **Apache/Nginx**: Upload to document root
- **GitHub Pages**: Push to gh-pages branch

### Option 3: CDN Deployment

For maximum performance, deploy to a CDN:
- **Cloudflare Pages**
- **AWS CloudFront + S3**
- **Azure Static Web Apps**

## 🔗 URL Structure

### Home Page
- `https://presentations.ricochetconstruction.com/`
- Clean, branded landing page with navigation
- Links to presentation and company information

### Direct Presentation Link
- `https://presentations.ricochetconstruction.com/presentations/`
- Interactive 8-slide company presentation
- Shareable link for clients and prospects
- Mobile-responsive with touch controls

## ⚙️ Configuration

### 1. Domain Setup
Update these files with your actual domain:

**nginx/presentations.conf:**
```nginx
server_name presentations.ricochetconstruction.com;
```

**public/index.html:**
```html
<meta property="og:url" content="https://presentations.ricochetconstruction.com">
```

### 2. SSL Certificate (Production)
Uncomment SSL configuration in `nginx/presentations.conf`:
```nginx
ssl_certificate /etc/ssl/certs/cert.pem;
ssl_certificate_key /etc/ssl/certs/key.pem;
```

### 3. Contact Information
Update contact details in `public/index.html`:
```html
<p>Phone: (XXX) XXX-XXXX</p>
<p>Email: info@ricochetconstruction.com</p>
```

## 🎯 Features

### Home Page Features
- ✅ Professional branded design
- ✅ Company story and services
- ✅ Founder introduction
- ✅ Direct presentation access
- ✅ Contact information
- ✅ Mobile responsive
- ✅ SEO optimized

### Presentation Features
- ✅ 8 interactive slides
- ✅ Keyboard navigation (arrow keys, space)
- ✅ Touch/swipe support
- ✅ Progress tracking
- ✅ Direct sharing links
- ✅ Professional green/black branding
- ✅ Company logo integration

### Technical Features
- ✅ Fast loading static files
- ✅ Optimized images and assets
- ✅ Security headers
- ✅ Cache optimization
- ✅ Gzip compression
- ✅ Rate limiting
- ✅ Error handling

## 📊 Analytics Setup

Add your analytics tracking code to:
- `public/index.html` (before closing `</head>`)
- `public/presentations/index.html` (before closing `</head>`)

Example Google Analytics:
```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

## 🔒 Security

### Implemented Security Features
- **HTTPS Redirect**: Automatic HTTP to HTTPS
- **Security Headers**: XSS protection, content type sniffing prevention
- **Rate Limiting**: Protection against abuse
- **File Access Control**: Hidden files and sensitive extensions blocked
- **Content Security Policy**: XSS attack prevention

### Additional Security Recommendations
1. **SSL Certificate**: Use Let's Encrypt or commercial SSL
2. **Firewall**: Configure server firewall rules
3. **Monitoring**: Set up uptime and security monitoring
4. **Backups**: Regular automated backups
5. **Updates**: Keep server and dependencies updated

## 🚀 Performance

### Optimization Features
- **Static Files**: No server-side processing needed
- **Gzip Compression**: Reduced file sizes
- **Browser Caching**: Long-term caching for assets
- **Image Optimization**: Optimized logo files
- **Minified Assets**: Compressed CSS and JavaScript

### Performance Metrics
- **Lighthouse Score**: 95+ expected
- **Load Time**: <2 seconds on 3G
- **First Paint**: <1 second
- **Mobile Friendly**: 100% responsive

## 📱 Mobile Support

### Responsive Features
- ✅ Mobile-first design
- ✅ Touch navigation for presentation
- ✅ Responsive typography
- ✅ Optimized images for mobile
- ✅ Fast mobile loading

## 🔧 Maintenance

### Regular Tasks
1. **Content Updates**: Update company information as needed
2. **Image Updates**: Replace photos and logos as required
3. **Analytics Review**: Monitor traffic and engagement
4. **Security Updates**: Keep server and SSL certificates current
5. **Performance Monitoring**: Check loading speeds regularly

### Content Management
- **Presentation Updates**: Edit `public/presentations/index.html`
- **Home Page Updates**: Edit `public/index.html`
- **Styling Changes**: Modify CSS files in `assets/css/`
- **New Features**: Add to JavaScript files in `assets/js/`

## 📞 Support

For technical support or questions about deployment:
- Review this documentation
- Check server logs for errors
- Test on staging environment first
- Monitor analytics for user behavior

## 🎉 Launch Checklist

Before going live:

- [ ] Domain configured and DNS pointing correctly
- [ ] SSL certificate installed and working
- [ ] Contact information updated
- [ ] Analytics tracking installed
- [ ] All links tested (home ↔ presentation)
- [ ] Mobile responsiveness verified
- [ ] Performance tested (Lighthouse)
- [ ] Security headers verified
- [ ] Backup system configured
- [ ] Monitoring alerts set up

## 📈 Success Metrics

Track these metrics post-launch:
- **Page Views**: Home page and presentation views
- **Engagement**: Time spent on presentation
- **Conversions**: Contact form submissions or calls
- **Sharing**: Presentation link shares
- **Mobile Usage**: Mobile vs desktop traffic
- **Load Performance**: Page speed metrics

---

**Ready for Production!** 🚀

Your Ricochet Construction presentation site is now ready for professional deployment with a clean home page, direct presentation linking, and production-grade configuration.
