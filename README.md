## About this project
This project was created as part of a 6 month internship with PeaceGeneration Indonesia. It was created to be a website to help the Comms team organize their files, documents, and such.

## License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## App information
This app uses Laravel Jetstream as the base for the app. 



All of the views are in `/resources/views/`, and are all .blade.php files

Backend files are usually in `/app/Http/livewire`

You can find all the routes in `routes/web.php`

## Installation
* Prerequisites: PHP, Composer, MySQL database, npm

After cloning the repository, run `composer update`

Then run `npm install`

After that, run `php artisan migrate`

Don't forget to set an application key with `php artisan key:generate`

To run a test server, use `npm run dev` and `php artisan serve`

To compile files for deployment, use `npm run dev`
