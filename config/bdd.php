<?php

define('DB_URL', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PWD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_DSN', "mysql:host=" . DB_URL . ";dbname=" . DB_NAME . ";charset=UTF8");
