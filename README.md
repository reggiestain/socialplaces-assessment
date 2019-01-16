# PHP DEVELOPER PRACTICAL ASSESSMENT

This application was developed with [symfony] 4.2*

## Installation

Install GIT 

Run the following GIT command to clone the project repository:

``` bash

$ cd /path/to/apache/www/directory

$ git clone https://github.com/reggiestain/hybrid-assessment.git

```

Install Composer

Run composer command to install dependencies

``` bash

$ cd /path/to/apache/www/directory

$ composer install

```

## Database Configuration

Read and edit the .env file located in the project directory setup the 'Datasources' and any other configuration relevant for your application.


## Run Database Migration

``` bash

$ cd /path/to/project/directory

$ php bin/console doctrine:migrations:migrate

```

## Run Database Seeder

``` bash

$ cd /path/to/project/directory

$ php bin/console doctrine:fixtures:load

```

## Run Server

``` bash

$ cd /path/to/project/directory

$ php bin/console server:run

```

You are now set to go.

Run the application on your web server and login with username and password

Login as  ROLE_USER with the details below:

Username: guest
Password: guest

## Create a new contact record with an API call

| Title    | Create new contact    |
| URL   |  /api/contact/create   |
| Method    |  POST   |
| URL Params    | Required: firstname=[string]  surname=[string] mobile=[string] |
| Data Params   | Example: {contact : {firstname : [string],surname : [string],mobile : [alphanumeric]}} |
|  Success Response   |  status: 201     |  
|  Error Response   |  status: 201     | 


