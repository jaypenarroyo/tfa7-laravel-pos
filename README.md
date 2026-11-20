# TFA7 Laravel POS: Forms, Validation, and File Upload

This project extends the database-backed TFA6 Laravel POS with create and edit forms for customers and users. It validates every submission, enforces unique usernames, processes profile pictures into display-ready avatars, stores the files on Laravel's public disk, and saves only the file path in the database.

## Activity requirements completed

- Create and edit forms for customers and users
- Required and valid-email validation for customers
- Required and unique-username validation for users
- Old input and field-level error messages after failed validation
- Prefilled edit forms
- Nullable `avatar` database column
- Image-only avatar validation with a 2 MB maximum
- Intervention Image processing into a centered 240 x 240 JPEG
- Public-disk storage with only the relative path saved in the database
- Avatar or placeholder on the user listing
- Database migrations, seeder, SQL export, and automated feature tests

## Requirements

- PHP 8.2 or later
- Composer 2
- XAMPP PHP extensions: `fileinfo` and `gd`
- Git
- Visual Studio Code

## Important: enable the GD image extension in XAMPP

Avatar processing needs GD. Do this once before running the project:

1. Close any running Laravel server.
2. Open `C:\xampp\php\php.ini` in Visual Studio Code or Notepad.
3. Press **Ctrl+F** and search for `;extension=gd`.
4. Remove the semicolon so the line becomes:

   ```ini
   extension=gd
   ```

5. Save `php.ini`.
6. Close and reopen the VS Code terminal.
7. Verify it is enabled:

   ```powershell
   php -m | Select-String gd
   ```

The terminal should print `gd`.

## Run the project locally on Windows

1. Extract the ZIP.
2. Open Visual Studio Code.
3. Select **File > Open Folder**.
4. Select the inner `tfa7-laravel-pos` folder containing `artisan` and `composer.json`.
5. Select **Terminal > New Terminal**.
6. Install the dependencies:

   ```powershell
   composer install
   ```

7. Create the local environment file:

   ```powershell
   Copy-Item .env.example .env
   ```

8. Generate the application key:

   ```powershell
   php artisan key:generate
   ```

9. Create the SQLite database:

   ```powershell
   New-Item database\database.sqlite -ItemType File -Force
   ```

10. Create the tables and sample records:

    ```powershell
    php artisan migrate:fresh --seed
    ```

11. Make uploaded avatars accessible in the browser:

    ```powershell
    php artisan storage:link
    ```

12. Run the automated checks:

    ```powershell
    php artisan test
    ```

13. Start Laravel:

    ```powershell
    php artisan serve
    ```

14. Open `http://127.0.0.1:8000` in a browser.

## Pages to test

- `/` - home page
- `/about` - project explanation
- `/customers` - customer listing
- `/customers/create` - new customer form
- `/customers/{id}/edit` - customer edit form
- `/users` - user listing with avatars
- `/users/create` - new user form
- `/users/{id}/edit` - user edit form and profile-picture upload

Use an actual record number in place of `{id}`, such as `/users/1/edit`.

## Avatar behavior

The user edit form accepts JPEG, PNG, or WebP files up to 2 MB. Intervention Image crops the picture to a centered 240 x 240 image and saves it as an optimized JPEG under `storage/app/public/avatars`. Laravel stores a relative path such as `avatars/example.jpg` in the `users.avatar` column. Users without an avatar display the included placeholder image.

## Test and reset commands

```powershell
php artisan test
php artisan migrate:fresh --seed
```

`migrate:fresh` deletes and recreates the local tables, so use it only when resetting development data.

## Important project files

- `routes/web.php`
- `app/Http/Controllers/CustomerController.php`
- `app/Http/Controllers/UserController.php`
- `database/migrations/2026_11_20_000001_add_avatar_to_users_table.php`
- `database/seeders/PosSeeder.php`
- `database/pos_database.sql`
- `resources/views/customers/`
- `resources/views/users/`
- `public/images/avatar-placeholder.svg`
- `tests/Feature/FormWorkflowTest.php`

## Upload to GitHub

Follow [GITHUB_UPLOAD_GUIDE.md](GITHUB_UPLOAD_GUIDE.md). The `.gitignore` prevents `.env`, `vendor`, `node_modules`, the local SQLite database, and generated uploads from being committed.

## Hosting note

GitHub stores the source code, but GitHub Pages cannot run PHP or Laravel. If the activity requires a hosted application, deploy it to a Laravel-compatible PHP host, configure its database and environment variables, then run migrations and `php artisan storage:link` on that host.
