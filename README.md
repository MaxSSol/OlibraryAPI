# A simple online library Laravel + Vue.js
## Technical information
- Ubuntu 20.04
- Laravel 8
- Docker compose
- PHP 7.4
- Vue.js 2
- Vue-router
- VUEX
- MySQL
- Codeception

## Instructions for starting

Copy the .env.example file and make the following changes:
- APP_NAME(***Example*** Olibrary)
- APP_DEBUG(`false`)
- APP_URL(***Example*** `http://localhost:8082`)
- SANCTUM_STATEFUL_DOMAINS(***Example*** `localhost:8082`)
- DB_USERNAME(***Example*** `root`)
- DB_PASSWORD(***Example*** `password`)
- DB_HOST(`mysql`)
- FORWARD_DB_PORT(***Example*** `33061`)
- SESSION_DRIVER(`cookie`)
- MAIL_HOST(***Example*** `stmp.mailtrap.io`)
- MAIL_PORT(***Example*** `465`)
- MAIL_USERNAME(YOUR_USERNAME)
- MAIL_PASSWORD(YOUR_PASSWORD)
- MAIL_ENCRYPTION(***Example*** `TLS`)
- MAIL_FROM_ADDRESS(YOUR_ADDRESS)
- QUEUE_CONNECTION(`database`)
```bash
chmod 777 -R OlibraryAPI/storage/
```

To start the containers, execute the command:
```bash
docker-compose up --build -d
```
Next, you need to open the container with PHP.

CONTAINER ID & NAMES of the container with php:
```bash
docker ps
```
![docker ps](https://i.postimg.cc/brWBNrhg/New-Project-10.jpg

To enter the container, execute the command:
```bash
docker exec -it (CONTAINER_ID or NAMES) /bin/bash
```
![docker exec](https://i.postimg.cc/gkZqRNpN/New-Project-11.jpg)
Execute the following commands in the container:
```bash
composer i
```
```bash
php artisan key:generate 
```
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan storage:link
```

Run the commands to start npm:
```bash
docker-compose run npm i
```
```bash
docker-compose run npm prod
```
### After completing all the commands, you have a working application:
![example](https://i.postimg.cc/nVcDYZ8d/New-Project-12.jpg)

# Implemented functionality
- Login, registration;
- Email confirmation, Google login, password reset;
- View books with filters, pagination;
- Adding books to favorites;
- View favorites in your personal account;
- Ability to download the book from the site.

### The personal account:
![profile](https://i.postimg.cc/bYRNgFc3/New-Project-13.jpg)
