# Fake API

<p align="center">
    <img src="https://afindo-inf.com/assets/public/img/blog/bbace49a6c7fe7993946ec4a4b2c5c8c.png" alt="fake-api">
</p>

## Introduction
Free fake API for testing and prototyping.

### Requirement
- PHP ^8.0
- Lumen ^9.0

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
- set config file:

```
logging.php.example -> logging.php
```

### Running service
```         
php -S 0.0.0.0:8000 -t public
```
