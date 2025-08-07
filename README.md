# Simple Church CMS in Pure PHP

This is a simple, lightweight Content Management System (CMS) for a church website, built from scratch using pure PHP 8 and a MySQL database. It provides basic functionalities for managing pages, news, events, and sermons.

## Features

-   **Simple Admin Panel:** An easy-to-use interface to manage website content.
-   **Page Management:** Create, edit, and delete custom pages (e.g., "Our History", "What We Believe").
-   **Post Management:** A unified system to manage news, events, and sermons.
-   **Image Uploads:** Easily upload images for posts.
-   **Responsive Design:** The website is designed to work on both desktop and mobile devices.
-   **Dynamic Navigation:** The main menu automatically includes links to the pages you create.

## Requirements

-   PHP 8.0 or higher
-   MySQL or MariaDB
-   A local web server (e.g., XAMPP, WAMP, MAMP, or PHP's built-in server)

## Local Setup Instructions

Follow these steps to get the project running on your local machine.

### 1. Get the Code

Download the project files and place them in a folder on your computer. If you're using a local server like XAMPP, this folder should be inside the `htdocs` directory. Let's assume you place it in a folder named `pib-clone`.

### 2. Configure the Database

-   Open the `config/database.php` file.
-   Update the `DB_HOST`, `DB_USER`, `DB_PASS`, and `DB_NAME` constants with your local MySQL database credentials.

```php
// config/database.php

define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_user'); // e.g., 'root'
define('DB_PASS', 'your_db_password'); // e.g., '' or 'root'
define('DB_NAME', 'church_cms');
```

### 3. Run the Database Setup Script

-   Start your local web server (e.g., Apache in XAMPP).
-   In your web browser, navigate to the `setup.php` script to create the database and tables.
-   URL: `http://localhost/pib-clone/setup.php`

You should see success messages indicating that the database and tables were created.

### 4. Create the First Admin User

-   Navigate to the registration page to create your administrator account.
-   URL: `http://localhost/pib-clone/public/register.php`
-   Fill in a username and password and submit the form.

**IMPORTANT:** After creating the first user, you should **delete the `public/register.php` file** from your server. This is a critical security measure to prevent others from creating admin accounts.

### 5. Log In to the Admin Panel

-   You can now log in to the admin panel to start managing your content.
-   URL: `http://localhost/pib-clone/public/login.php`
-   Use the credentials you created in the previous step.

### 6. View Your Website

-   Your website is now live on your local server.
-   URL: `http://localhost/pib-clone/`

## How to Use the CMS

-   **Dashboard:** After logging in, you'll land on the admin dashboard, which provides quick links to manage content.
-   **Manage Pages:** Here you can create, edit, or delete static pages. Each page needs a unique "slug," which is its URL (e.g., a page with slug `our-history` will be accessible at `.../page/our-history`). If you leave the slug blank, one will be created for you from the title.
-   **Manage Posts:** This section is for time-based content like news, events, or sermons. When creating a post, you can assign it a type, upload an image, and even add an event date or a video link.
