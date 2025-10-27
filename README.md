# mini-mvc

A clean and minimal boilerplate for building native PHP applications using the MVC pattern. This repository is designed as a lightweight starting template.

## Features

  * Clean **MVC Architecture** (Model-View-Controller)
  * **PSR-4 Autoloading** with Composer
  * **Simple File-Based Router** with parameter and middleware support
  * **Base Controller & Model** for shared logic (e.g., `redirect()`, `model()`)
  * **View Helper** (`view()`) with a simple layout/templating system

## Installation

1.  Clone the repository:

    ```bash
    git clone https://github.com/atherizz/mini-mvc.git
    cd mini-mvc
    ```

2.  Install dependencies:

    ```bash
    composer install
    ```

    This will create the `vendor/autoload.php` file, which handles all class loading.

3.  Import your database and run the seeder (optional):

    ```bash
    php database/seeders/seeder.php
    ```

## Directory Structure

```
/app
├── Core/         (Core classes like Database)
├── Http/
│   ├── Controllers/  (Handles user requests, e.g., AuthController)
│   └── Middleware/   (Request filters, e.g., AuthMiddleware)
├── Models/       (Database logic, e.g., UserModel)
└── helpers.php   (Global functions like view())
/database/
└── seeders/      (Database seeder scripts)
/public/            (Web root, all requests go here)
├── .htaccess     (Apache rewrite rules)
└── index.php     (Front Controller / Router)
/resources/
└── views/        (All UI files)
    ├── layouts/  (Main layout file)
    └── ...       (Page-specific view files)
/routes/
└── web.php       (All route definitions)
/vendor/            (Composer dependencies - ignored by Git)
.gitignore
composer.json     (Project dependencies)
```
