# PHP DEVELOPER PRACTICAL ASSESSMENT

This application was developed with [laravel] 5.5*

## Installation

Install GIT 

Run the following GIT command to clone the project repository:

``` bash

$ cd /path/to/apache/www/directory

$ git clone https://github.com/reggiestain/hybrid-assessment.git

```
## Database Configuration

Read and edit the .env file located in the project directory setup the 'Datasources' and any other configuration relevant for your application.


## Run Database Migration

``` bash

$ cd /path/to/project/directory

$ php artisan migrate

```

## Run Database Seeder

``` bash

$ cd /path/to/project/directory

$ php artisan db:seed --class=UsersSeeder
$ php artisan db:seed --class=ProductCategorySeeder
$ php artisan db:seed --class=ProductsSeeder

```

## Run Server

``` bash

$ cd /path/to/project/directory

$ php artisan serve

```

You are now set to go.

Run the application on your web server and register as a normal user to login with email and password

Login as an administration with the details below:

Email: reggiestain@gmail.com
Password: adminadmin0123
