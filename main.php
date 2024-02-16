<?php

require_once 'models/UserModel.php';

$userModel = new UserModel('users');

echo $userModel;

echo var_export($userModel->getAll());

?>