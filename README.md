# event_ukm
 
### Installation

 1. Clone this project\
 `git clone https://github.com/susatyo441/event_ukm.git`
 2. Cd into your project folder\
 `cd event_ukm`
 3. Install dependencies\
 `composer install`
 4. Copy env file\
 `cp .env.staging .env`
 5. Make app key\
`php artisan key:generate`
 6. Migrate database\
 `php artisan migrate`
 7. Seed the database\
 `php artisan db:seed`
 8. Create passport key\
 `php artisan passport:install`
