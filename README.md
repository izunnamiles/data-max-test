## Introduction
DataMax-Test was written with laravel php and the external api used was <a href="https://anapioficeandfire.com/">Iron and Fire</a> working majorly with the books api endpoints

## Installation
After Cloning or forking this repo, you are required to run </br>

<p style="background-color:#B2BEB5"> "composer install"</p></br>
to set up the application on the local, after installation of composer, you are required to run
<p style="background-color:#B2BEB5"> "npm install && npm run dev"</p>

For compiling the js and css scripts. Then we are required to set up our database, duplicate the env.example file and the rename the duplicate file to .env and add the following information as displayed below<br>

DB_DATABASE=your_db_name<br>
DB_USERNAME=db_user_name<br>
*DB_PASSWORD=db_password (not compulsory, only required if your mysql has password)<br>

Now we can run "php artisan migrate" to set up our database with the required tables
By now we are up and running.

## Working with the endpoints
First we need to make sure our server is running, run "php artisan serve" to start up the server @ http://127.0.0.1:8000, then <a href="https://www.postman.com/downloads/">Postman</a> is required to fetch and post to the endpoints.

The specific endpoints can passed via postman</br>

'http://127.0.0.1:8000/api/external-books?name=$book_name' to query the Iron and fire ApI to fetch the record for the book name passed as a parameter,</br>
'http://127.0.0.1:8000/api/v1/book' to make a post request to populate the database </br>
'http://127.0.0.1:8000/api/v1/book' to fetch the records inserted on our db</br>
'http://127.0.0.1:8000/api/v1/book/{id}' to fetch, update or delete the record where {id} was passed using either a GET, PATCH OR DELETE method respectively</br>
 
For the frontend Implementation
http://127.0.0.1:8000/view-books, on the browser to view the records of the 10 records from the Iron and Fire Api, 

## Testing our endpoints
To test the endpoints, simply go to the cmd on the folder root directory and run<br>
"php artisan test" <br>
we can test individual testcase by running <br>
"php artisan test --filter=any_test_function_avaliable"




