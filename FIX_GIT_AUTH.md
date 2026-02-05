# 🔧 Fix Git Authentication - Step by Step Guide

## Current Status
❌ **No GitHub token found** - You need to create one to push code.

## 🚀 Quick Fix (5 minutes)

### Step 1: Create GitHub Personal Access Token

1. **Open GitHub in your browser:**
   ```
   https://github.com/settings/tokens/new
   ```
   
   Or navigate manually:
   - Go to GitHub.com → Click your profile picture (top right)
   - Settings → Developer settings → Personal access tokens → Tokens (classic)
   - Click "Generate new token" → "Generate new token (classic)"

2. **Fill in the form:**
   - **Note**: `khmer-news-portal-macbook` (or any name you like)
   - **Expiration**: Choose your preference (90 days recommended)
   - **Select scopes**: ✅ Check **`repo`** (Full control of private repositories)
     - This includes: repo:status, repo_deployment, public_repo, repo:invite, security_events

3. **Generate and Copy:**
   - Click **"Generate token"** at the bottom
   - ⚠️ **IMPORTANT**: Copy the token immediately! It starts with `ghp_` and looks like:
     ```
     ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     ```
   - You won't be able to see it again!

### Step 2: Store the Token

**Option A: Use the helper script (Easiest) ⭐**

Run this command in your terminal:
```bash
./store-git-token.sh
```

Then paste your token when prompted (it will be hidden for security).

**Option B: Store during push**

When you run `git push`, Git will prompt you:
- **Username**: `layheangtob-art` (should be pre-filled)
- **Password**: Paste your **Personal Access Token** (not your GitHub password!)

The token will be saved automatically in macOS Keychain.

### Step 3: Test It

After storing your token, try pushing:
```bash
git push origin layheang
```

It should work without any prompts! 🎉

---

## 🔍 Troubleshooting

### If you still get authentication errors:

1. **Clear old credentials:**
   ```bash
   git credential-osxkeychain erase
   ```
   Then enter:
   ```
   protocol=https
   host=github.com
   username=layheangtob-art
   ```
   (Press Enter twice)

2. **Verify your remote URL:**
   ```bash
   git remote -v
   ```
   Should show: `https://layheangtob-art@github.com/layheangtob-art/khmer-news-portal.git`

3. **Try storing the token again:**
   ```bash
   ./store-git-token.sh
   ```

---

## 💡 Tips

- ✅ Tokens are stored securely in macOS Keychain
- ⚠️ If you lose your token, create a new one on GitHub
- ⏰ Tokens expire based on the duration you set
- 🔒 Always use tokens (starting with `ghp_`), never your GitHub password
- 🔄 You can revoke tokens anytime on GitHub Settings → Developer settings → Personal access tokens

---

**Need help?** The token should look like: `ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx`
