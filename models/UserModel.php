<?php

class UserModel extends KonModel {
  use ConsoleOutput;

  private PrimaryKeyField $_id;
  private StringField $_login;
  private PasswordField $_haslo;
  private StringField $_email;


  public function __construct(private Kon $kon) {
    parent::__construct('users', $kon);
    $this->_id    = $this->pk_field();
    $this->_login = $this->string_field("login", 100, false);
    $this->_haslo = $this->password_field("hasło", "default");
    $this->_email = $this->string_field("email");
  }
  
}
?>