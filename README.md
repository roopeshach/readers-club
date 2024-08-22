# Book Management System

A Laravel-based Book Management System that allows users to manage books, authors, categories, comments, and reactions. The system supports user roles and permissions to control access to various features.

## Features

- **User Authentication**: Login, registration, and password reset functionality.
- **Role Management**: Different roles (Admin and User) with permissions to manage books, authors, and categories.
- **CRUD Operations**: Create, read, update, and delete books, authors, and categories.
- **Comments and Reactions**: Users can comment on and react to books.
- **Responsive UI**: Tailwind CSS is used to style the application with a purple and black theme.

## Requirements

- PHP >= 8.0
- Composer
- Laravel >= 8.x
- Node.js and NPM (for front-end assets)
- MySQL or any other supported database

## Installation

### 1. Go To the Repository

*`cd book-management-system`*

### 2. Install Dependencies

*`composer install`*

*`npm install`*

*`npm run dev`*

### 3. Configure Environment Variables

Copy the `.env.example` file to `.env` and update the database credentials and other environment variables.

*`cp .env.example .env`*

### 4. Generate Application Key

*`php artisan key:generate`*

### 5. Run Migrations and Seeders

Run the database migrations and seed the database with initial data.

*`php artisan migrate --seed`*

### 6. Serve the Application

*`php artisan serve`*

Your application should now be running on `http://127.0.0.1:8000`.

## Usage

### Admin Access

- As an admin, you can create, edit, and delete books, authors, and categories.
- Admins have the ability to manage users and assign roles.

### User Access

- Users can view books, comment on them, and react to them.
- Users have restricted access and cannot manage other users, authors, or categories.

## Development

### Factories and Seeders

Factories and seeders are provided to generate sample data for testing. You can create additional seed data by running:

*`php artisan db:seed`*



