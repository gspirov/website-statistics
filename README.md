1. In order to create the PostgreSQL database and insert some data, you should execute `init.sql`.
2. Run `composer dump-autoload -o` command in the root path of the project in order to register psr-4 autoloader.
2. Afterwards `init_db_config.php` console script will properly create your db config file with dsn, username, and password. 
   It should be execute in root folder of the project via `php init_db_config.php`.
3. Start php built-in web server in root folder of the project, e.g `php -S localhost:8000`.
4. You can use Postman to simulate API requests.

E.g. Endpoint requests:

1. http://localhost:8000/statistics/index?startDate=2020-04-09T10:15&endDate=2020-05-09T10:15
2. http://localhost:8000/statistics/index?startDate=1586427300&endDate=1589019300

