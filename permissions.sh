sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 storage bootstrap/cache
chmod 777 -R storage bootstrap/cache
