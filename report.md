

#  Migration, Model, Factory, and Seeder Steps

## Overview

In this step, I’ll walk  through setting up migrations, models, factories, and seeders for four entities: `Book`, `Category`, `Comment`, and `User`. These steps will help us define our database structure, create models with relationships, generate fake data for testing, and seed the database with initial data.

### Entities Overview

- **Book**: Represents a book with attributes like title, author, ISBN, etc.
- **Category**: Represents a category to which books belong.
- **Comment**: Represents user comments on books.
- **User**: Represents the users of the system, including admins.

## 1: Create Migrations

Migrations are essential for defining the structure of our database tables. I started by creating migrations for each entity.

### Commands to Create Migrations

For each entity, I used the following commands:

```bash
php artisan make:migration create_books_table
php artisan make:migration create_categories_table
php artisan make:migration create_comments_table
php artisan make:migration create_users_table
```

### Migration for `Books` Table

I defined the `books` table like this:

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('title');
            $table->string('isbn')->unique();
            $table->string('author');
            $table->string('publisher');
            $table->integer('edition');
            $table->unsignedBigInteger('category_id'); // Foreign Key to categories table
            $table->string('cover_art')->nullable();
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->unsignedBigInteger('views')->default(0); // Track views
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
```

### Other Migrations

For the `categories`, `comments`, and `users` tables, I created similar migrations:

#### Migration for `Categories` Table

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
```

#### Migration for `Comments` Table

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
```

#### Migration for `Users` Table

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
```

### Running the Migrations

After defining all the migrations, I ran:

```bash
php artisan migrate
```

This command executed all the migrations, creating the corresponding tables in the database.

## 2: Create Models

Models are the PHP classes that represent and interact with our database tables. They also define relationships between different entities.

### Commands to Create Models

I created models for each entity with the following commands:

```bash
php artisan make:model Book
php artisan make:model Category
php artisan make:model Comment
php artisan make:model User
```

### Model for `Book`

Here’s how I defined the `Book` model:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'isbn', 'author', 'publisher', 'edition', 'category_id', 'cover_art', 'user_id', 'views',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function incrementViews()
    {
        $this->views++;
        $this->save();
    }
}
```

### Other Models

I set up the other models similarly:

#### Model for `Category`

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
```

#### Model for `Comment`

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'book_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
```

#### Model for `User`

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
```

### Relationships in Models

- **Book** belongs to **Category** and **User**.
- **Book** has many **Comments**.
- **Category** has many **Books**.
- **Comment** belongs to **Book** and **User**.
- **User** can be associated with **Books** and **Comments**.

## 3: Create Factories

Factories are used to generate fake data, which is useful for testing. I created factories for each model.

### Commands to Create Factories

```bash
php artisan make:factory BookFactory --model=Book
php artisan make:factory CategoryFactory --model=Category
php artisan make:factory CommentFactory --model=Comment
php artisan make:factory UserFactory --model=User
```

### Factory for `Book`

Here’s how I defined the `BookFactory`:

```php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'isbn' => $this->faker->isbn13,
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'edition' => $this->faker->randomDigitNotNull,
            'cover_art' => $this->faker->imageUrl(),
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
```

### Other Factories

I set up the other factories similarly:

#### Factory for `Category`

```php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
        ];
    }
}
```

#### Factory for `Comment`

```php
namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory


{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence,
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
        ];
    }
}
```

#### Factory for `User`

```php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
```

## 4: Create Seeders

Seeders allow us to populate our database with initial data. I created seeders for each entity.

### Commands to Create Seeders

```bash
php artisan make:seeder BookSeeder
php artisan make:seeder CategorySeeder
php artisan make:seeder CommentSeeder
php artisan make:seeder UserSeeder
```

### Seeder for `Book`

Here’s how I set up the `BookSeeder`:

```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class BookSeeder extends Seeder
{
    public function run()
    {
        $data = json_decode(File::get(database_path('data/data.json')), true);
        $books = $data['books'];
        
        foreach ($books as $bookData) {
            $user = User::where('email', $bookData['user_email'])->first();
            $category = Category::where('name', $bookData['category'])->first();
            
            Book::updateOrCreate(
                ['title' => $bookData['title']],
                [
                    'author' => $bookData['author'],
                    'isbn' => $bookData['isbn'],
                    'publisher' => $bookData['publisher'],
                    'edition' => $bookData['edition'],
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'cover_art' => $bookData['cover_art']
                ]
            );
        }
    }
}
```

### Other Seeders

I set up the other seeders similarly:

#### Seeder for `Category`

```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = json_decode(File::get(database_path('data/data.json')), true);
        $categories = $data['categories'];
        
        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category]);
        }
    }
}
```

#### Seeder for `Comment`

```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\File;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $data = json_decode(File::get(database_path('data/data.json')), true);
        $comments = $data['comments'];
        
        foreach ($comments as $commentData) {
            $user = User::where('email', $commentData['user_email'])->first();
            $book = Book::where('title', $commentData['book_title'])->first();
            
            Comment::updateOrCreate(
                ['content' => $commentData['content'], 'user_id' => $user->id, 'book_id' => $book->id],
                ['content' => $commentData['content']]
            );
        }
    }
}
```

#### Seeder for `User`

```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = json_decode(File::get(database_path('data/data.json')), true);
        $users = $data['users'];
        
        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'role' => $userData['role']
                ]
            );
        }
    }
}
```

### Running the Seeder

After setting up the seeders, I ran:

```bash
php artisan db:seed --class=DatabaseSeeder
```

This command populated the database with initial data for all entities.

## Conclusion

Following these steps, I successfully created and managed migrations, models, factories, and seeders for the `Book`, `Category`, `Comment`, and `User` entities. This setup allowed me to define the database structure, establish relationships between entities, generate fake data for testing, and seed the database with meaningful data for development.