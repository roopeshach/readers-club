# Book Management System

This Book Management System is a Laravel-based web application designed to manage books, categories, users, and comments. It includes features such as user authentication, role-based access control, book management, category filtering, and user comments.

## Features

- **User Authentication**: Users can register, log in, and log out.
- **Role-Based Access Control**: Admins and users have different permissions.
- **Book Management**: Admins can add, edit, and delete books.
- **Category Management**: Admins can add and manage book categories.
- **Book Filtering**: Users can filter books by category.
- **Book Search**: Users can search for books by title, author, or category.
- **Comments**: Users can add comments to books.
- **Pagination**: Paginated view of books.

## Prerequisites

- PHP >= 7.4
- Composer
- Laravel >= 8.x
- MySQL or any other supported database

## Installation

1. **Clone the repository**

   git clone https://github.com/your-repository/book-management-system.git
   cd book-management-system

2. **Install dependencies**

   composer install
   npm install
   npm run dev

3. **Copy the `.env` file**

   cp .env.example .env

4. **Generate application key**

   php artisan key:generate

5. **Configure the `.env` file**

   Update the following variables in your `.env` file:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

6. **Run migrations and seeders**

php artisan migrate --seed

7. **Serve the application**

php artisan serve

8. **Access the application**

Open your browser and navigate to `http://127.0.0.1:8000`

## Project Structure

### Controllers

- **UserController**: Manages user-related actions such as registration and login.
- **BookController**: Manages book-related actions such as adding, editing, viewing, and deleting books.
- **CategoryController**: Manages category-related actions such as adding and viewing categories.
- **CommentController**: Manages comment-related actions such as adding comments to books.

### Models

- **User**: Represents the users of the application.
- **Book**: Represents the books in the application.
- **Category**: Represents the categories of books.
- **Comment**: Represents the comments added to books.

### Seeders

- **DatabaseSeeder**: Calls other seeders to seed the database.
- **UserSeeder**: Seeds the users table.
- **CategorySeeder**: Seeds the categories table.
- **BookSeeder**: Seeds the books table.
- **CommentSeeder**: Seeds the comments table.
- **RoleSeeder**: Seeds roles and assigns permissions.
- **PermissionSeeder**: Seeds permissions.

## Data Flow

1. **User Registration and Authentication**
- Users can register and log in to the system.
- Admin users have additional permissions to manage books and categories.

2. **Book Management**
- Admin users can add new books with details such as title, author, ISBN, publisher, edition, category, and cover art.
- Admin users can edit and delete existing books.

3. **Category Management**
- Admin users can add and manage book categories.

4. **Book Filtering and Search**
- Users can filter books by category using the sidebar.
- Users can search for books by title, author, or category using the search bar.

5. **Comments**
- Users can add comments to books, and these comments are displayed on the book details page.
