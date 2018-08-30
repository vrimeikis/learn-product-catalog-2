# Product catalog one

## Requirements

### Tools

- composer
- Git
- npm

### Server

- `PHP` >= **7.1.3**
- `OpenSSL` PHP Extension
- `PDO` PHP Extension
- `Mbstring` PHP Extension
- `Tokenizer` PHP Extension
- `XML` PHP Extension
- `Ctype` PHP Extension
- `JSON` PHP Extension
- `cURL` PHP Extension
- `sqLite` PHP Extension

## Instructions

### Installation

- Create `mysql database` and login credentials.
- Run `git clone git@github.com:vrimeikis/learn-product-catalog1.git`
- Go to project directory.
- Create `.env` file form `.env.example` file.
- Add your `database credentials` to `.env` file.
- Run `composer install` command.
- Run `php artisan key:generate` command.
- Run `php artisan migrate` command.

### DEV

- If you have not virtual server, you can run `php artisan serve` command to create virtual serve.

## Urls

- Administration home url: `/admin`