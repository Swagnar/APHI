<?php

class UserModel extends KonModel {
  use ConsoleOutput;

  public PrimaryKeyField $id;
  public StringField $login;
  public PasswordField $haslo;
  public StringField $email;


  public function __construct(private Kon $kon) {
    parent::__construct('users', $kon);
    $this->id    = $this->pk_field();
    $this->login = $this->string_field("login", 100, false);
    $this->haslo = $this->password_field("hasło", "default");
    $this->email = $this->string_field("email");
  }
  
}
?>