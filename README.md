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

## API

### Public
| Method | End point    | Description
|--------|:-------------|:------------
| GET    | /api/posts    | Returns all posts
| GET    | /api/posts/feed | Get a user's feed
| GET    | /api/posts/{post}/pdf | Generate a pdf

### Protected
| Method | End point    | Description
|--------|:-------------|:------------
| POST    | /api/posts | Store a new post
| PATCH    | /api/posts/{post} | Update a post
| DELETE    | /api/posts/{post} | Delete a post
| POST    | /api/posts/{post}/toggleLike | Toggle like on the post

   [laravel]: <https://laravel.com>
   [vuejs]: <https://vuejs.org/>
