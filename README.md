# laravel-vue-bs-app

It is sample REST API app. Based on Laravel (backend), VueJs (frontend) and MySQL (database).

This app can listing items from database, have three yellow buttons servicing to filters items and one dark button servicing to downloads currently listed items. Additionally this app can/allows listing items, adding new item, updating item and deleting item from database.

This app can filtered items for:
- items availble,
- items which are not in stock (less than 0),
- items which have a value less than 5,


### Quick install

- Clone repository `git clone https://github.com/ghost717/laravel-vue-bs-app.git`
- Copy and edit .env file `cp -r .env.example .env`
- Run commands `composer install` and `npm install`
- Generate key `php artisan key:generate` and testing database `php artisan migration:fresh --seed`
- Run server app `php artisan serve`


### Libraries used

- PHP >= 7.2
- laravel/framework
- laravel/ui
- MySQL > 5
- VueJs >= 2.5
- @fortawesome/fontawesome-free
- vform
- vue-excel-export
- vue-progressbar
- vue-router

### Requirements

