echo "installing dependencies..."
composer install

echo "building assets..."
pnpm run build

echo "starting server..."
php artisan serve --host=172.16.5.15 --port=8000
