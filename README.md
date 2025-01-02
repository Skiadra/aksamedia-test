## Aksamedia Test Project

## Creator:
Riady Wiguna

## Database Relation:
![{8EE133C9-99F9-435F-A5C1-4B670EF7963D}](https://github.com/user-attachments/assets/344b349e-cfcb-4bd9-94eb-d72505166bd6)
The database relation diagram outlines the structure and relationships of the tables used in the Aksamedia project.

## Documentation:
Comprehensive API documentation for this project is available through Postman. You can access it here:
[Aksamedia Test API Documentation](https://www.postman.com/material-observer-66373835/aksamedia-test/documentation/i66hkcw/aksamedia-test)
[Aksamedia Test API POSTMAN COLECTION](https://www.postman.com/material-observer-66373835/aksamedia-test/collection/i66hkcw/aksamedia-test)

## Technologies Used:
- Laravel
- MySQL

This project leverages the Laravel framework for efficient backend development and MySQL for robust database management.

## Getting Started
Clone the repository:
```
git clone 
cd aksamedia-test
```
Install dependencies:
```
composer install
```

Copy .env.example to .env:
```
cp .env.example .env
```
Generate app key
```
php artisan key:generate
```
Configure database credentials in the .env file.
```
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
Run migrations and seed the database:
```
php artisan migrate --seed
```
Serve the application:
```
php artisan serve
```
