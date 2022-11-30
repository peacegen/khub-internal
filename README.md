## About this project
This project was created as part of a 6 month internship with PeaceGeneration Indonesia. It was created to be a website to help the Comms team organize their files, documents, and such.


## App information
This app uses [Laravel Jetstream](https://jetstream.laravel.com/2.x/introduction.html) and [Laravel Livewire](https://laravel-livewire.com/docs/2.x/quickstart) as the base for the app. 



All of the views are in `/resources/views/`, and are all .blade.php files

Backend files are usually in `/app/Http/livewire`

You can find all the routes in `routes/web.php`

## Installation
* Prerequisites: PHP, Composer, MySQL database, npm

After cloning the repository, run `composer update`

Create a new .env file or copy the example with `cp .env.example .env`

Generate an application key with `php artisan key:generate`

Then run `npm install`

To run a test server, use `npm run dev` and `php artisan serve`

To compile files for deployment, use `npm run build`

## Database Setup

Edit the `.env` file with your database credentials

Run `php artisan migrate` to create the database tables

## License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
