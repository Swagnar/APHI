# APHI 💀
<i>a.k.a. my desperate attempt to make something cool and useful</i>
<br>
I love Django and Django REST Framework (❤️). PHP is cool and all, and PDO has great OOP capabilities but I wanted something a lot closer to Django way of creating [ORM](https://docs.djangoproject.com/en/5.0/topics/db/models/).
<br>
So in my spare time I try to make something out of it. Want to contribute? Fork it and suffer with me 🔥

## Installation

Well... how can I say that... just download it and use the files. That's it for now fancypants.

## Usage

I've included a `test.php` file with some test code that creates a `Kon` object and a `UserModel` - a instance of user written model that extends `KonModel`. But if you'd like to try it for yourself follow these steps: 
- include all of the necessary files
```php
include 'lib/Kon.php';
include 'lib/KonModel.php';
include 'models/YourModel.php';
```
- connect to your MySQL database with `Kon` object (I hope you're using `localhost` 🤓)
```php
const kon = new Kon('username', 'password', 'database_name');
```
- if you've already written your model, try to create it and `echo` it's contents
```php
const yourModel = new YourModel(kon);
echo yourModel;
```
- if not, create one!
```php
// models/YourModel.php
<?php
  class YourModel extends KonModel {
    use ConsoleOutput;

    private PrimaryKeyField $_id;
    private StringField $_username;
    private PasswordField $_password;

    function __construct(private Kon $kon) {
      parent::__construct('tableName', $kon);
      $this->_id    = $this->pk_field();
      $this->_login = $this->string_field("username", 100, false);
      $this->_haslo = $this->password_field("password", "default");
    }
  }

?>
```

### Help