<?php
include 'lib/Kon.php';
include 'lib/KonModel.php';
include 'models/UserModel.php';

function test_clog($msg, $line) {
  Kon::clog_warning(" (TEST LINE: " . $line . ") " . $msg);
}

test_clog("Starting test", __LINE__);

const kon = new Kon('root', '', 'api');
test_clog("KON CREATED", __LINE__);
test_clog("Creating UserModel", __LINE__);

const userModel = new UserModel(kon);
test_clog("UserModel created!", __LINE__);
test_clog("Running `echo UserModel`: \n", __LINE__);

echo userModel;
test_clog("All fields visible?", __LINE__);

test_clog("Invoking `get_fields` method from KonModel", __LINE__);
echo var_dump(userModel->get_fields());

?>