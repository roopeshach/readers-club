
The Book Sharing Platform is a web application that allows users to upload, manage, and share their favorite books. It provides functionality for users to register, log in, and view books added by other users. Users with the appropriate permissions can add, edit, and delete books and comments. This report documents the steps and processes involved in building this application from scratch using Laravel and Bootstrap.

## Step 1: Setting Up the Laravel Project

### 1.1 Creating a New Laravel Project

To start, we created a new Laravel project using the following command:

*Command:*

```sh
composer create-project --prefer-dist laravel/laravel book-sharing-platform
```

### 1.2 Configuring the Environment

After creating the project, we configured the `.env` file to connect to the database. The database credentials were set up as follows:

*Configuration:*

*DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=book_sharing  
DB_USERNAME=root  
DB_PASSWORD=your_password_here*

*Screenshot Placeholder:*

*Screenshot of the .env file with database configuration.*

## Step 2: Creating Database Migrations

### 2.1 Generating Migrations

Next, we generated migrations for the `users`, `books`, `categories`, and `comments` tables. The following commands were used:

*Commands:*

```sh
php artisan make:migration create_books_table
php artisan make:migration create_categories_table
php artisan make:migration create_comments_table
php artisan make:migration add_role_to_users_table
```

### 2.2 Writing Migration Files

We then updated the migration files with the necessary columns and relationships.

*Code Placeholder:*

*Sample code snippet from the `create_books_table` migration.*

*Screenshot Placeholder:*

*Screenshot of the migration file in the code editor.*

## Step 3: Creating Models and Relationships

### 3.1 Generating Models

We created models for `Book`, `Category`, `Comment`, and updated the existing `User` model to include a `role` field.

*Commands:*

```sh
php artisan make:model Book
php artisan make:model Category
php artisan make:model Comment
```

### 3.2 Defining Relationships

We defined the relationships between models within each model class.

*Code Placeholder:*

*Sample code snippet showing the relationships defined in the `Book` model.*

*Screenshot Placeholder:*

*Screenshot of the `Book` model file in the code editor.*

## Step 4: Creating Factories and Seeders

### 4.1 Generating Factories

To quickly populate the database with test data, we created factories for each model.

*Commands:*

```sh
php artisan make:factory BookFactory --model=Book
php artisan make:factory CategoryFactory --model=Category
php artisan make:factory CommentFactory --model=Comment
```

### 4.2 Writing Seeder Files

We wrote seeder files to seed the database with initial data using the factories.

*Code Placeholder:*

*Sample code snippet from the `BookSeeder`.*

*Screenshot Placeholder:*

*Screenshot of the seeder file in the code editor.*

### 4.3 Running Seeders

We executed the seeders to populate the database:

*Command:*

```sh
php artisan db:seed
```

*Screenshot Placeholder:*

*Screenshot of the terminal showing successful seeder execution.*

## Step 5: Implementing Controllers and Routing

### 5.1 Generating Controllers

We generated controllers for managing books, categories, and comments:

*Commands:*

```sh
php artisan make:controller BookController
php artisan make:controller CategoryController
php artisan make:controller CommentController
```

### 5.2 Writing Controller Logic

We implemented the necessary CRUD operations in the controllers.

*Code Placeholder:*

*Sample code snippet from the `BookController`.*

*Screenshot Placeholder:*

*Screenshot of the `BookController` file in the code editor.*

### 5.3 Defining Routes

The routes for the application were defined in the `web.php` file:

*Code Placeholder:*

*Sample code snippet from the `web.php` routes file.*

*Screenshot Placeholder:*

*Screenshot of the routes file in the code editor.*

## Step 6: Creating Views and Integrating Bootstrap

### 6.1 Setting Up Layouts

We created a `layouts.app` file to serve as the base layout for our views and integrated Bootstrap for styling.

*Code Placeholder:*

*Sample code snippet from `app.blade.php`.*

*Screenshot Placeholder:*

*Screenshot of the `app.blade.php` file in the code editor.*

### 6.2 Building Blade Templates

We built the necessary blade templates for viewing books, categories, and adding comments.

*Code Placeholder:*

*Sample code snippet from `books/index.blade.php`.*

*Screenshot Placeholder:*

*Screenshot of the `books/index.blade.php` file in the code editor.*

### 6.3 Enhancing UI with DataTables

To enhance the user experience, we integrated DataTables for sorting and searching books.

*Code Placeholder:*

*Sample code snippet showing DataTables integration in `books/index.blade.php`.*

*Screenshot Placeholder:*

*Screenshot of the book list page with DataTables applied.*

## Step 7: Implementing Policies and Authorization

### 7.1 Creating Policies

We created policies to manage user permissions, ensuring that only authorized users could edit or delete books.

*Commands:*

```sh
php artisan make:policy BookPolicy
php artisan make:policy CategoryPolicy
php artisan make:policy CommentPolicy
```

### 7.2 Registering Policies

The policies were registered in the `AuthServiceProvider` to enforce the rules across the application.

*Code Placeholder:*

*Sample code snippet from the `AuthServiceProvider`.*

*Screenshot Placeholder:*

*Screenshot of the `AuthServiceProvider` file in the code editor.*

## Step 8: Testing and Final Adjustments

### 8.1 Testing Functionality

We thoroughly tested all functionalities, ensuring that all user roles (admin, user) had appropriate access.

*Screenshot Placeholder:*

*Screenshots showing successful CRUD operations for books.*

### 8.2 Final UI Adjustments

We made final UI adjustments to ensure a consistent and user-friendly interface.

*Screenshot Placeholder:*

*Screenshot showing the final design of the homepage.*


This report documented the process of building a Book Sharing Platform using Laravel. The project involved setting up a Laravel application, creating database models, implementing controllers, integrating Bootstrap for the UI, and applying policies for user authorization. The final application allows users to share books, view books added by others, and manage their own book collections in a secure environment.
