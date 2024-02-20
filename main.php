<?php

require_once 'models/UserModel.php';


ConsoleOutput::clog_test("STARTING TEST", __LINE__);
$userModel = new UserModel('users');

ConsoleOutput::clog_test("ECHOING USER MODEL", __LINE__);
echo $userModel;

echo var_export($userModel->getAll());

?>