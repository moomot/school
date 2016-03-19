<?php
ini_set('display_errors', 1);
require_once("constants.php");
require_once("libraries/loader/loader.php");

Loader::init();
Url::init();
Session::init();
Application::getInstance();

// Load bootstrap
require_once("application/bootstrap.php");
