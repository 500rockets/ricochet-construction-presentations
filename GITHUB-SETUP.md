# GitHub Setup Instructions

## 🚀 Push to GitHub

### Step 1: Create GitHub Repository

1. Go to [GitHub.com](https://github.com) and sign in
2. Click the "+" icon in the top right corner
3. Select "New repository"
4. Fill in the repository details:
   - **Repository name**: `ricochet-construction-presentations`
   - **Description**: `Professional presentation website for Ricochet Construction with Docker deployment`
   - **Visibility**: Choose Public or Private
   - **DO NOT** initialize with README, .gitignore, or license (we already have these)

### Step 2: Add Remote and Push

After creating the repository, run these commands:

```bash
# Add GitHub as remote origin
git remote add origin https://github.com/YOUR_USERNAME/ricochet-construction-presentations.git

# Push to GitHub
git branch -M main
git push -u origin main
```

Replace `YOUR_USERNAME` with your actual GitHub username.

### Step 3: Verify Upload

1. Refresh your GitHub repository page
2. You should see all the files uploaded
3. The README.md will display the project information

## 📋 Repository Structure on GitHub

Your repository will contain:

```
ricochet-construction-presentations/
├── README.md                        # Main project documentation
├── README-DOCKER-SSL.md            # Detailed deployment guide
├── README-PRODUCTION.md             # Production setup guide
├── public/                          # Website files
│   ├── index.html                  # Home page
│   ├── presentations/              # Interactive presentation
│   └── assets/                     # CSS, JS, images
├── nginx/                          # nginx configuration
├── scripts/                        # Deployment scripts
├── docker-compose.production.yml   # Production Docker setup
└── .gitignore                      # Git ignore rules
```

## 🔧 GitHub Features to Enable

### 1. GitHub Pages (Optional)
If you want to host on GitHub Pages:
1. Go to repository Settings
2. Scroll to "Pages" section
3. Select source: "Deploy from a branch"
4. Choose branch: `main`
5. Folder: `/ (root)` or `/public`

### 2. Repository Settings
- **Description**: Add a good description
- **Topics**: Add tags like `construction`, `presentations`, `docker`, `nextjs`
- **Website**: Add your live site URL when deployed

### 3. Branch Protection (Recommended)
1. Go to Settings → Branches
2. Add rule for `main` branch
3. Enable "Require pull request reviews before merging"

## 🚀 Deployment from GitHub

### Option 1: Clone and Deploy
```bash
# On your server
git clone https://github.com/YOUR_USERNAME/ricochet-construction-presentations.git
cd ricochet-construction-presentations
./scripts/deploy.sh
```

### Option 2: GitHub Actions (Advanced)
Create `.github/workflows/deploy.yml` for automated deployment.

### Option 3: Direct Deploy Services
- **Netlify**: Connect GitHub repo for automatic deployments
- **Vercel**: Import GitHub repository
- **Railway/Render**: Connect and deploy

## 📝 Next Steps After GitHub Setup

1. **Update README**: Add your actual domain and contact info
2. **Configure Secrets**: Add environment variables if using GitHub Actions
3. **Set up Webhooks**: For automatic deployment triggers
4. **Add Collaborators**: If working with a team
5. **Create Issues**: For tracking features and bugs

## 🔒 Security Considerations

- **Never commit**: SSL certificates, private keys, or sensitive data
- **Use Secrets**: For environment variables in GitHub Actions
- **Review PRs**: Always review pull requests before merging
- **Keep Updated**: Regularly update dependencies

## 📞 Support

If you encounter issues:
1. Check the repository's Issues section
2. Review the documentation files
3. Ensure all prerequisites are installed
4. Verify GitHub repository permissions

---

**Ready to push to GitHub!** 🎉
