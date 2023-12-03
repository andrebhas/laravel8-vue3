## Getting Started
PT ABC - ERP using Laravel 8 & Vue 3

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
- PHP >= 7.3 
- Composer
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MYSQL

### Installing Manual
First installation - Clone & Initiating
- Pull from `main` branch
- Copy file `.env.example` and change name to `.env`
- Set db configuration on `.env`
- Run ```composer install```
- Run `php artisan key:generate`

Second Installation - Migrate & Seeding
- Run ```php artisan optimize:clear```
- Run ```php artisan migrate```
- Run ```php artisan db:seed```

Third Installation
- Run ```php artisan serve --port 8989```
- Access on your browser [http://127.0.0.1:8989](http://127.0.0.1:8989)

### API Documentation
- Access on your browser [http://127.0.0.1:8989/api/documentation](http://127.0.0.1:8989/api/documentation)

