<?php
define("PROJECT_ROOT_PATH", __DIR__);


// include main configuration file
require_once PROJECT_ROOT_PATH . "\inc\config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "\controller\baseController.php";


// include database  file
require_once PROJECT_ROOT_PATH . "\models\database.php";

// include the models file


require_once PROJECT_ROOT_PATH . "\Models\Users.php";
require_once PROJECT_ROOT_PATH . "\Models\Category.php";
require_once PROJECT_ROOT_PATH . "\Models\slider.php";
require_once PROJECT_ROOT_PATH . "\Models\menu.php";
require_once PROJECT_ROOT_PATH . "\Models\special.php";
require_once PROJECT_ROOT_PATH . "\Models\Home.php";
require_once PROJECT_ROOT_PATH . "\Models\\feedback.php";
require_once PROJECT_ROOT_PATH . "\Models\\Booking.php";
