# Ricochet Construction - Company Presentation

A professional, interactive presentation showcasing Ricochet Construction's services, experience, and company values.

## 🚀 Features

- **Interactive Navigation**: Arrow keys, clicks, touch/swipe support
- **Professional Design**: Modern gradient background with glass-morphism effects
- **Responsive Layout**: Works on desktop, tablet, and mobile devices
- **Smooth Transitions**: CSS animations and transitions between slides
- **Keyboard Shortcuts**: Full keyboard navigation support
- **Progress Tracking**: Visual progress bar and slide counter

## 📁 Structure

```
CompanyFiles/Presentation/
├── index.html          # Main presentation file
├── assets/
│   └── styles.css      # Presentation styling
├── scripts/
│   └── presentation.js # Navigation and interaction logic
├── slides/            # Individual slide templates (for future use)
├── templates/         # Reusable presentation templates
└── README.md          # This file
```

## 🎯 Slide Content

### Slide 1: Title
- Company name and tagline
- Founder introduction
- Key service areas

### Slide 2: Our Story
- Timeline from 1999 to present
- Career progression
- Company founding story

### Slide 3: Our Mission
- Company mission statement
- Core values (Trust, Quality, Longevity)
- Family legacy focus

### Slide 4: Our Services
- Fire & Flood Rebuilds
- Balcony Replacement
- Drainage Upgrades
- Clubhouse Renovations
- Electrical Upgrades
- Roofing & Concrete

### Slide 5: Our Process
- 48-hour response time
- 48-hour proposal delivery
- Daily project presence
- Communication focus

### Slide 6: What Makes Us Different
- Unique value propositions
- Key statistics
- Competitive advantages

### Slide 7: Our Team
- Team stability and longevity
- Relationship focus
- Family business values

### Slide 8: Call to Action
- Contact information
- Service area
- Request quote button

## 🎮 Navigation Controls

### Keyboard Shortcuts
- `Arrow Keys` / `Space`: Navigate slides
- `Home`: Go to first slide
- `End`: Go to last slide
- `Escape`: Toggle fullscreen mode

### Mouse/Touch
- `Click`: Advance to next slide
- `Navigation Buttons`: Previous/Next
- `Swipe` (mobile): Left/Right navigation

## 🎨 Customization

### Colors
The presentation uses a professional color scheme:
- **Primary**: `#fbbf24` (Golden yellow)
- **Background**: `#1e293b` to `#334155` (Dark blue gradient)
- **Text**: `#ffffff` (White)
- **Accent**: `#cbd5e1` (Light gray)

### Fonts
- **Primary Font**: Inter (Google Fonts)
- **Weights**: 300, 400, 500, 600, 700

### Responsive Breakpoints
- **Desktop**: 1200px+ (full layout)
- **Tablet**: 768px-1199px (adjusted spacing)
- **Mobile**: <768px (single column layout)

## 📱 Usage

### Development
1. Open `index.html` in a web browser
2. Use keyboard navigation or click to advance slides
3. Test on different screen sizes

### Presentation Mode
1. Press `F11` or `Escape` to enter fullscreen
2. Use arrow keys or space to navigate
3. Click anywhere (except controls) to advance

### Auto-Advance (Optional)
Uncomment in `presentation.js`:
```javascript
presentation.startAutoAdvance(15000); // 15 seconds per slide
```

## 🔧 Technical Features

### JavaScript Features
- **Class-based architecture** for easy maintenance
- **Event delegation** for efficient event handling
- **Touch gesture recognition** for mobile support
- **Keyboard accessibility** compliance
- **Fullscreen API** integration
- **Progress tracking** and visual feedback

### CSS Features
- **CSS Grid** for responsive layouts
- **Flexbox** for component alignment
- **CSS Transitions** for smooth animations
- **Backdrop filters** for glass effects
- **Custom properties** for theme consistency
- **Media queries** for responsive design

### Performance
- **Optimized animations** using CSS transforms
- **Minimal JavaScript** for fast loading
- **External font loading** optimization
- **Efficient event handling** to prevent memory leaks

## 📝 Content Updates

### Adding New Slides
1. Add new `<section class="slide">` in `index.html`
2. Update `totalSlides` in `presentation.js`
3. Add corresponding content and styling

### Updating Content
- Edit slide content directly in `index.html`
- Modify company information in contact section
- Update statistics and achievements as needed

### Styling Changes
- Modify colors in `styles.css`
- Adjust typography settings
- Update responsive breakpoints

## 🚀 Deployment

### Local Hosting
1. Use any local web server (Live Server, Python's http.server, etc.)
2. Navigate to `CompanyFiles/Presentation/index.html`

### Web Hosting
1. Upload entire `Presentation` folder to web server
2. Ensure proper MIME types for CSS and JS files
3. Test on various devices and browsers

### Integration with Next.js Site
The presentation can be integrated into the main Next.js site by:
1. Moving files to `public/presentation/`
2. Creating a Next.js page that serves the presentation
3. Adding presentation routing to the main site

## 🤝 Maintenance

### Regular Updates
- Update company statistics and achievements
- Add new project examples and case studies
- Refresh testimonials and client feedback
- Update contact information as needed

### Browser Compatibility
- Tested on modern browsers (Chrome, Firefox, Safari, Edge)
- Fallbacks provided for older browser features
- Mobile-first responsive design approach

## 📄 License

This presentation is created specifically for Ricochet Construction and contains proprietary company information.
