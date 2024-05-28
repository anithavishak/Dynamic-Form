<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Dynamic Form Management

This Laravel project allows admins to create, manage, and display dynamic forms. Admins can add, edit, and delete form fields and save the forms. The forms are visible to the public, allowing data submission.

## Features

- Admin login and dashboard
- Create and save dynamic forms
- Add, edit, and delete form fields
- Send email notifications on form creation
- Public visibility of created forms
- Data submission from the public forms

## Prerequisites

- PHP >= 7.3
- Composer
- MySQL
- Node.js & npm 

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/anithavishak/Dynamic-Form.git     (from master branch)
    cd dynamic-form
    Make sure you are in the branch 'master'
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    ```

3. **Copy the `.env.example` to `.env`:**

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

5. **Configure your database:**

    Update the `.env` file with your database credentials:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

6. **Configure Mailtrap for email notifications:**

    Update the `.env` file with your Mailtrap credentials:

    ```dotenv
    MAIL_MAILER=smtp
    MAIL_HOST=
    MAIL_PORT=2525
    MAIL_USERNAME=your_mailtrap_username
    MAIL_PASSWORD=your_mailtrap_password
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=admin@gmail.com
    MAIL_FROM_NAME="Laravel Dynamic Form"
    ```
7. **Configure Queue connection:**

    ```dotenv
    QUEUE_CONNECTION=database
    ```

8. **Install and set up Laravel Breeze:**

    Run the following commands to install Laravel Breeze for authentication and run its migrations:

    ```bash
    composer require laravel/breeze --dev
    php artisan breeze:install
    npm install && npm run dev
    php artisan migrate
    ```
9. **Run database migrations:**

    ```bash
    php artisan migrate
    ```

10. **Run database seeder:**

    ```bash
    php artisan db:seed --class=AdminUsersSeeder
    ```

11. **Build the frontend assets:**

    ```bash
    npm run dev
    ```

12. **Create job table:**

    ```bash
    php artisan queue:table
    php artisan migrate
   ```

13. **Serve the application:**

    In one terminal, start the Laravel development server:

    ```bash
    php artisan serve
    ```

14. **Run the queue worker:**

    In a separate terminal, start the queue worker:

    ```bash
    php artisan queue:work
    ```

## Usage

- Visit `http://localhost:8000` to access the application.
- Login as an admin to manage forms. `http://localhost:8000/login`
- Login using username:admin@gmail.com , password: admin@123 (after running the db seed)
- Click on Manage Form option
- Create, edit, and delete form fields.
- The created forms are visible to the public at `http://localhost:8000/forms`.
- Submitted form data is stored in the database.
- Mail will be sent for each form creation. 
- Login to the mail trap account , check inbox for the mail. 

## License

This project is open-source and available under the [MIT License](LICENSE).

