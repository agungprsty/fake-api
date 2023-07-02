# JSONFaker

<p align="center">
    <img src="public/assets/img/restapi.png" alt="JSONFaker restapi">
</p>

## Introduction
Free fake REST API for testing and prototyping.
## URL
- [jsonfaker](https://jsonfaker.000webhost.com/)
- [jsonfaker documentation](https://jsonfaker.000webhost.com/apidocs/)

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
- set ``JWT_SECRET`` execute command :
```bash
php artisan jwt:secret
```
- set ownership of the file run.sh and apidocs.sh
```bash
sudo chmod 777 ./run.sh ./apidocs.sh
```

### Running service
```bash      
./run.sh
```

### Generate docs swagger-php
```bash
./apidocs.sh
```
