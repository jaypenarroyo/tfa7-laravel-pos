# Upload TFA7 to GitHub Using Visual Studio Code

## Part 1: Download and extract the ZIP

1. Download `tfa7-laravel-pos.zip`.
2. Open your **Downloads** folder.
3. Right-click the ZIP and select **Extract All**.
4. Select **Extract**.
5. Open the extracted folders until you see `artisan`, `composer.json`, `app`, `database`, `resources`, and `routes`. This is the project folder you must open.

Do not open the ZIP itself in VS Code. Open the extracted folder containing `artisan`.

## Part 2: Open the correct folder in VS Code

1. Start **Visual Studio Code**.
2. Click **File** in the top-left corner.
3. Click **Open Folder**.
4. Browse to **Downloads** and select the inner `tfa7-laravel-pos` folder.
5. Click **Select Folder**.
6. If VS Code asks whether you trust the authors, click **Yes, I trust the authors**.
7. Check the Explorer on the left. You should see `artisan`, `composer.json`, `app`, `database`, `resources`, and `routes`.

If `artisan` is not visible, use **File > Open Folder** again and choose the next folder inside.

## Part 3: Enable image processing

1. In VS Code, select **File > Open File**.
2. Open `C:\xampp\php\php.ini`.
3. Press **Ctrl+F** and search for `;extension=gd`.
4. Remove only the semicolon so it reads `extension=gd`.
5. Press **Ctrl+S** to save.
6. Close and reopen the VS Code terminal.

## Part 4: Install and run the project

1. In VS Code, click **Terminal > New Terminal**.
2. Confirm the terminal path ends in `tfa7-laravel-pos`.
3. Run these commands one line at a time:

   ```powershell
   composer install
   Copy-Item .env.example .env
   php artisan key:generate
   New-Item database\database.sqlite -ItemType File -Force
   php artisan migrate:fresh --seed
   php artisan storage:link
   php artisan test
   php artisan serve
   ```

4. Wait for `Server running on http://127.0.0.1:8000`.
5. Hold **Ctrl** and click that address, or enter it in your browser.
6. Test the customer and user listings, create forms, edit forms, validation errors, and a user avatar upload.
7. Return to the terminal and press **Ctrl+C** to stop the server.

If `php artisan storage:link` says the link already exists, that is okay.

## Part 5: Open Source Control

1. Find the vertical toolbar on the far-left side of VS Code.
2. Click the **Source Control** icon. It looks like a branching line with three circles.
3. If you cannot see it, use the top menu: **View > Source Control**.
4. Click **Initialize Repository**.

After initialization, the Source Control panel will show the files under **Changes**.

## Part 6: Check files before committing

1. Review the **Changes** list.
2. Make sure none of these appear:

   - `.env`
   - `vendor`
   - `node_modules`
   - `database/database.sqlite`
   - `public/storage`

3. Files such as `.env.example`, `composer.json`, `composer.lock`, migrations, controllers, views, and tests should appear.

Never upload `.env`; it can contain secret keys and passwords.

## Part 7: Create the first commit

1. At the top of the Source Control panel, click the **Message** box.
2. Enter:

   ```text
   Complete TFA7 Laravel forms and file upload
   ```

3. Click the **Commit** button or the checkmark icon.
4. If VS Code asks to stage all changes, click **Yes**.
5. If Git asks for your identity, run the following in the terminal, using your own information:

   ```powershell
   git config --global user.name "Your Name"
   git config --global user.email "your-github-email@example.com"
   ```

6. Try the commit again after setting your identity.

## Part 8: Publish to GitHub

1. Click **Publish Branch** or **Publish to GitHub** in Source Control.
2. If VS Code asks you to sign in, click **Allow** and finish the authorization in your browser.
3. Enter the repository name `tfa7-laravel-pos`.
4. Choose **Publish to GitHub public repository** if your instructor needs unrestricted access.
5. Wait until VS Code finishes uploading.
6. Click **Open on GitHub** when it appears.
7. Copy the repository address from the browser. It should look like `https://github.com/YOUR-USERNAME/tfa7-laravel-pos`.

## Part 9: Terminal method if Publish Branch is missing

1. Go to [GitHub](https://github.com) and sign in.
2. Click the **+** button, then **New repository**.
3. Name it `tfa7-laravel-pos` and select **Public**.
4. Do not add a GitHub README, `.gitignore`, or license.
5. Click **Create repository**.
6. In the VS Code terminal, run these commands:

   ```powershell
   git init
   git add .
   git status
   git commit -m "Complete TFA7 Laravel forms and file upload"
   git branch -M main
   git remote add origin https://github.com/YOUR-USERNAME/tfa7-laravel-pos.git
   git push -u origin main
   ```

7. Replace `YOUR-USERNAME` with your actual GitHub username.

If `git remote add origin` says `origin already exists`, run:

```powershell
git remote set-url origin https://github.com/YOUR-USERNAME/tfa7-laravel-pos.git
git push -u origin main
```

## Part 10: Final submission checklist

- GitHub shows `app`, `database`, `public`, `resources`, `routes`, `tests`, `composer.json`, and `README.md`.
- `.env`, `vendor`, `node_modules`, `database.sqlite`, and `public/storage` are absent.
- Customer creation and editing work.
- Invalid customer email shows an error and preserves old input.
- Duplicate username shows an error.
- User editing accepts an image up to 2 MB and displays a 240 x 240 avatar.
- Users without an uploaded photo show the placeholder.
- `php artisan test` passes.
- The repository is public or shared with your instructor.
- The GitHub repository URL is copied for submission.
- A separate Laravel-compatible live URL is included if the activity requires hosting.
