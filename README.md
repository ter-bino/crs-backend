[Laravel Documentation](https://laravel.com/docs)

Must have CLI for:
    - `php` - version 8.2.11
    - `composer` - version 2.6.5


Clone the project via:\
    - `git clone https://github.com/ter-bino/crs-backend.git`\
    - Clone using GitHub desktop


Project set-up:\
    - Run `composer install` to install the necessary packages.\
    - Create a file `.env` and copy over the contents of `.env.example`.\
    - In the `.env` file, update the credentials for your local database (entries that start with `DB_`...)\
    - Run `php artisan migrate` to update your database to what's currently in the migrations.\


Running the project:\
    - Run `php artisan serve`.\
    - By default, your application will be available on `http://localhost:8000/`\
    - The project is set up to be an API/backend only project.\
    - I created a sample route in `routes/api.php` for `/sample-route` which forwards request to `sampleRoute` method of `app/Http/Controllers/Api/SampleController.php`.\
    - You can use Postman or any API testing tools to check its response by accessing it at `http://localhost:8000/api/sample-route`. You may also access the link via a browser to see its response as a JSON text.\
    
