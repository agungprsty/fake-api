# JSONFaker

<p align="center">
    <img src="public/assets/img/restapi.png" alt="JSONFaker restapi">
</p>

## Introduction
Free fake REST API for testing and prototyping.

### Requirement
- PHP ^8.0
- Lumen ^8.0

### Knowledge base 
- [jsonplaceholder](https://jsonplaceholder.typicode.com/)

### Usage 
- git clone
- composer install
- copy ``.env.example`` to ``.env``
- set ``APP_KEY`` execute command :
```bash
php artisan key:generate
```

### Running service
```bash      
php -S 0.0.0.0:8081 -t public
```

### Generate docs swagger-php
```bash
./vendor/bin/openapi app -o public/assets/apispec.json
```