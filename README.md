# Pentip

Pentip is a new platform for content sharing.

## Tech

Pentip uses a number of projects to work properly:

* [laravel] - The PHP Framework For Web Artisans  
* [vuejs] - The Progressive JavaScript Framework

## Installation

Pentip requires PHP7 and MySQL.

1) Install the dependencies
2) Migrate the database
3) Seed the database
4) Run the server

```sh
$ cd pentip
$ composer install
$ php artisan migrate
$ php artisan db:seed
$ php artisan serve
```

<!---

## API

### Public
| Method | End point    | Description
|--------|:-------------|:------------
| GET    | /articles    | Returns all articles
| GET    | /articles/{article} | Get an article by URL
| GET    | /articles/{article}/comments | Get article's comments

### Protected (JWT)
| Method | End point    | Description
|--------|:-------------|:------------
| PUT | /users/{user} | Edit a user by ID
| PUT | /articles/{article} | Edit an article by URL
| PUT | /comments/{comment} | Edit an comment
| DELETE | /articles/{article} |  Delete an article by URL
| DELETE | /comments/{comment} | Delete an comment
-->

   [laravel]: <https://laravel.com>
   [vuejs]: <https://vuejs.org/>