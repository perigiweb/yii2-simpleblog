## Yii 2 Simple Blogging

This is an example [Yii 2](https://www.yiiframework.com/) application that implement user registration, user login and create post for logged in user.

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.4.


INSTALLATION
------------

1. Clone this git repo & run composer install

```bash
git clone https://github.com/perigiweb/yii2-simpleblog.git

cd yii2-simpleblog

composer install
```


2. Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.

3. Run DB migrations

```bash
./yii migrate
```

4. Visit the website, for example

```
http://localhost/yii2-simpleblog
```