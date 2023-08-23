# SALES APP
### Sell faster and smarter with the sales app

REQUIREMENTS
------------

- [Composer 2.5.2](https://getcomposer.org/download/)
- [PHP 7.4](https://prototype.php.net/versions/7.4/install/)
- Node (14.21.3)


INSTALLATION
------------

You can then install this project by forking the code or clone the repository down locally

~~~
git clone https://github.com/ale94lko/sales.git sales
~~~

Navigate to the source folder `sales/` and run
~~~
composer install
~~~

Navigate to the frontend folder `sales/site/` and run
~~~
npm install
~~~

CONFIGURATION
-------------

### Database

Create a database `sales` manually. You can change the name and edit
the file `config/db.php` if you are using another db connection,
for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=sales',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
Run migrations. Stand in folder `sales/` and run
~~~
php yii migrate
~~~

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.

## Assets

Assets folder needs to be copy manually

Copy folder `sales/site/node_modules/@salesforce-ux/design-system/assets/*`
to `sales/site/src/assets/`

STARTING WEB SERVER
-------

### Backend server

Stand in folder `sales/` and run

~~~
php yii serve
~~~

### Frontend server

Stand in folder `sales/site` and run

~~~
npm run serve
~~~

Now you are able to open the site in a browser
~~~
http://localhost:8081
~~~
