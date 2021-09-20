## Introduction
DataMax-Test was written with laravel php and the external api used was <a href="https://anapioficeandfire.com/">Iron and Fire</a> working majorly with the books api endpoints

## Installation
After Cloning or forking this repo, </br>

<p style="background-color:#B2BEB5">run "composer install"</p></br>
to update the dependencies, after installation of composer, you are required to run
<p style="background-color:#B2BEB5">run "npm install && npm run dev"</p></br>

to compile the js and css scripts. Then we are required to set up our database, duplicate the env.example file and the rename the duplicate file to .env and add the following information as displayed below

DB_DATABASE=your_db_name
DB_USERNAME=db_user_name
*DB_PASSWORD=db_password (not compulsory, only required if your mysql has password)

Now we can run "php artisan migrate" to set up our database with the required tables
By now we are up and running.

## Working with the endpoints
First we need to make sure our server is running, run "php artisan serve" to start up the server, then <a href="https://www.postman.com/downloads/">Postman</a> is required to fetch and post to the endpoints

<h4>Requirement 1</h4>






