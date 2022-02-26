#How to run project:
composer install
cp .env.example .env
php artisan key:generate
npm install
nump run dev / npm run watch
php artisan migrate:fresh --seed (As if there are some dependencies in RoleSeeder to create user and UserSeeder for create default users.)
