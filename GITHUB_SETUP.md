# GITHUB SETUP INSTRUCTIONS

Panduan lengkap untuk setup GitHub repository untuk AD COLLECTION project.

---

## 1️⃣ CREATE GITHUB ACCOUNT

Jika belum punya GitHub account:
1. Go to https://github.com
2. Click "Sign up"
3. Fill username, email, password
4. Verify email address
5. Complete setup

---

## 2️⃣ CREATE REPOSITORY

### Option A: Via GitHub Website

1. Login ke GitHub
2. Click "+" icon (top right) → "New repository"
3. Fill form:
   ```
   Repository name: UAS-PW1_AD-COLLECTION
   Description: Fashion E-Commerce Management System for TikTok Shop & Shopee
   Visibility: Public
   Initialize: Add README (skip, we have one)
   ```
4. Click "Create repository"

### Option B: Via Git Command Line

```bash
# First, navigate to your project folder
cd d:\laragon\www\UAS-PW1_AD-COLLECTION

# Initialize git repository
git init

# Add all files
git add .

# Create initial commit
git commit -m "Initial commit: AD Collection e-commerce system"

# Add remote repository
git remote add origin https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION.git

# Push to GitHub
git branch -M main
git push -u origin main
```

---

## 3️⃣ INITIALIZE LOCAL REPOSITORY

If you already have git initialized:

```bash
# Navigate to project
cd d:\laragon\www\UAS-PW1_AD-COLLECTION

# Check status
git status

# Add all files if not already added
git add .

# Commit
git commit -m "Initial commit: Complete AD Collection project"

# Add remote (replace YOUR_USERNAME)
git remote add origin https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION.git

# Push to GitHub
git push -u origin main
```

---

## 4️⃣ UPDATE README WITH GITHUB LINK

Edit your README.md and add:

```markdown
## 🔗 Links & Repository

- **GitHub Repository:** https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION
- **Live Demo:** (Add after deployment)
- **Report Issues:** [GitHub Issues](https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION/issues)

```

---

## 5️⃣ ADD GITIGNORE FILE

Create `.gitignore` file to exclude sensitive files:

```
# Sensitive files
config/database.php
.env
.env.local
*.log

# IDE files
.vscode/
.idea/
*.swp
*.swo

# OS files
.DS_Store
Thumbs.db
desktop.ini

# Backup files
*.bak
*.tmp
*~

# Node modules (if using)
node_modules/
package-lock.json

# Dependencies
vendor/
composer.lock

# Cache
.cache/
__pycache__/
```

---

## 6️⃣ VERIFY REPOSITORY

1. Go to https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION
2. Verify files are there
3. Check README displays correctly
4. View code files

---

## 7️⃣ MAKE FUTURE UPDATES

When you make changes locally:

```bash
# Check what changed
git status

# Stage changes
git add .

# Or stage specific file
git add path/to/file.php

# Commit with message
git commit -m "Fix: Updated dashboard statistics"

# Push to GitHub
git push
```

---

## 🔗 GITHUB LINK EXAMPLES

Replace YOUR_USERNAME with actual GitHub username:

```
https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION
```

Example (if username is "nazwakhoerunnisa"):
```
https://github.com/nazwakhoerunnisa/UAS-PW1_AD-COLLECTION
```

---

## ✅ GIT CHEAT SHEET

```bash
# Initial setup
git init                          # Initialize repository
git add .                         # Add all files
git commit -m "message"           # Create commit
git remote add origin <URL>       # Add GitHub remote
git push -u origin main           # Push to GitHub

# Daily usage
git status                        # Check changes
git add .                         # Stage changes
git commit -m "message"           # Commit changes
git push                          # Push to GitHub
git pull                          # Pull from GitHub

# Viewing
git log                           # View commit history
git log --oneline                 # Short log view
git diff                          # View changes
```

---

## 🆘 TROUBLESHOOTING

### "fatal: not a git repository"
```bash
cd d:\laragon\www\UAS-PW1_AD-COLLECTION
git init
```

### "Permission denied" when pushing
```bash
# May need to use SSH key instead
# Generate SSH key and add to GitHub
# Or use personal access token
```

### "Everything is up to date"
- Make sure you made changes to files
- Use `git status` to verify

### Cannot push to repository
1. Check internet connection
2. Verify GitHub credentials
3. Check repository exists
4. Use `git remote -v` to check URL

---

## 📚 USEFUL RESOURCES

- Git Documentation: https://git-scm.com/doc
- GitHub Guides: https://guides.github.com
- GitHub Help: https://help.github.com
- Pro Git Book: https://git-scm.com/book/en/v2

---

## 🎯 GITHUB FEATURES TO USE

### 1. Issues
```
Create issues for bugs, feature requests, documentation
Example: "Bug: Hamburger menu not closing on mobile"
```

### 2. Wiki
```
Add project documentation to Wiki
Can include deployment guides, API docs, etc.
```

### 3. Releases
```
Create releases for version tags
Example: v1.0.0 - Final submission
```

### 4. Actions
```
Set up automated tests and deployments
(Advanced feature, optional)
```

---

## 📋 GITHUB BEST PRACTICES

### Commit Messages
✅ Good:
```
git commit -m "Fix: Dashboard pesanan terbaru field mapping"
git commit -m "Feature: Add product image display"
git commit -m "Docs: Update README with deployment guide"
```

❌ Bad:
```
git commit -m "fixed stuff"
git commit -m "update"
git commit -m "asdf"
```

### Branch Names
```
main        - Production code
develop     - Development branch
feature/*   - New features (optional)
bugfix/*    - Bug fixes (optional)
```

### File Size
- Avoid committing files > 100MB
- Use .gitignore for large files
- Database backups should not be committed

---

## 🔐 PROTECT SENSITIVE DATA

### Do NOT commit:
- Database passwords
- API keys
- Private tokens
- Email addresses (in config)
- Phone numbers

### How to protect:
1. Add to .gitignore
2. Use environment variables
3. Create example config file

Example config.example.php:
```php
<?php
// Copy this to config/database.php and fill with your credentials
$conn = mysqli_connect(
    'YOUR_HOST',
    'YOUR_USERNAME',
    'YOUR_PASSWORD',
    'YOUR_DATABASE'
);
```

---

## 📊 README GITHUB SECTION EXAMPLE

Add this to your README.md:

```markdown
## 🔗 Repository & Links

### GitHub
- **Repository:** [UAS-PW1_AD-COLLECTION](https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION)
- **Issues:** [Report a bug](https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION/issues)
- **Clone:** 
  ```bash
  git clone https://github.com/YOUR_USERNAME/UAS-PW1_AD-COLLECTION.git
  ```

### Live Demo
- **Staging:** (Coming soon)
- **Production:** (Coming soon)

### Documentation
- [Quick Start](QUICK_START.md)
- [Deployment Guide](DEPLOYMENT.md)
- [Complete Guide](README_COMPLETE.md)
- [Requirements Checklist](COMPLETION_CHECKLIST_FINAL.md)
```

---

## 🚀 DEPLOY FROM GITHUB

### Option 1: Railway.app
1. Go to https://railway.app
2. Click "Deploy from GitHub"
3. Select your repository
4. Configure environment
5. Deploy

### Option 2: Vercel
Note: Vercel is for frontend only (Next.js, etc.)
Not suitable for PHP applications

### Option 3: Heroku (via GitHub)
1. Go to https://heroku.com
2. Create new app
3. Connect GitHub repository
4. Enable auto-deploy
5. Configure PHP buildpack

---

## ✅ FINAL CHECKLIST

- [ ] GitHub account created
- [ ] Repository created
- [ ] Files pushed to GitHub
- [ ] README updated with GitHub link
- [ ] .gitignore created
- [ ] Sensitive files not committed
- [ ] Clone test successful
- [ ] GitHub link in your project README
- [ ] Repository is public
- [ ] Links work correctly

---

## 📞 NEED HELP?

GitHub Support: https://support.github.com
Git Help: `git --help`
Command Help: `git COMMAND --help`

---

**Last Updated:** January 24, 2026
**Status:** ✅ Ready for GitHub submission
