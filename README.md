# APHI 💀
<i>a.k.a. my desperate attempt to make something cool and useful</i>
<br>
I love [Django](https://www.djangoproject.com/) and [Django REST Framework](https://www.django-rest-framework.org/) (❤️). PHP is cool and all, and PDO has great OOP capabilities but I wanted something a lot closer to Django way of creating [ORM](https://docs.djangoproject.com/en/5.0/topics/db/models/).
<br>
So in my spare time I try to make something out of it. Want to contribute? Fork it and suffer with me 🔥

## Installation 🚀

Well... how can I say that... just download it and use the files. That's it for now fancypants.

### Prerequisites

It's necessary to:
- have installed `php` shell
- use Apache
- use MySQL<sup>*</sup>


<sup>*</sup>And for a long time it'll be the only option, whoray! 🎆

#### Windows

- Follow official documentation [here](https://www.php.net/manual/en/install.windows.commandline.php), or if you're using [XAMPP](https://www.apachefriends.org/index.html), you can you the "`💻Shell`" button on the right side of the control panel.

#### Unix

- You should already have the `php` command installed, research how to use it on your system or follow official documentation [here](https://www.php.net/manual/en/install.unix.apache2.php)

## Usage

### Setup 🔧

Firstly, step over to the `config.php` file and put your credentials to connect to your database:
```php
<?php
 return array (
  'DB' => 
  array (
    'DB_HOST' => 'Database host location',
    'DB_PORT' => 'Database port',
    'DB_NAME' => 'Database name',
    'DB_USER' => 'Database username',
    'DB_PASS' => 'Database password',
  ),
  'APP' => 
  array (
    'APP_NAME' => 'myApp',
  ),
);
?>
```

Right now the CLI is very limited, with only one command: `create model $name`. But in the future I plan to add much more generators and scripts.

> I've included a `UserModel.php` and `main.php` to showcase how the implementation might look like.

### Models 💾

Models are the interfaces between your scripts and database. Why bother creating same queries when you can just invoke a model method? Or so I think
- Run `php manage.php create model YourModelName`. It will generate a starter template for your model file inside `models` directory.
> Anyone has a better idea how to do this? 

```php
<?php 

require_once __DIR__ . '/../core/KonModel.php';

class TestModel extends KonModel {
  public function __construct(protected string $tableName) {
    parent::__construct($tableName);
  }
}
?>

```

- Shape your model by adding database fields
```php
<?php 

require_once __DIR__ . '/../core/KonModel.php';

class TestModel extends KonModel {

  public PrimaryKeyField $id;
  public StringField $username;
  public PasswordField $password;

  public function __construct(protected string $tableName) {
    parent::__construct($tableName);
    $this->id = $this->pk_field();
    $this->username = $this->string_field("username", 100, false);
    $this->password = $this->password_field("password", "default");
  }
}

?>
```

- Import your model wherever you want to use it!

```php
<?php

require_once 'models/UserModel.php';

$userModel = new UserModel('users');

echo $userModel;

echo var_export($userModel->getAll());

?>
```

### Help