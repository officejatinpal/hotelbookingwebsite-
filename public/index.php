<?php

$minPhpVersion = '8.1';

if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    exit('PHP 8.1 or higher is required.');
}

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

// Correct project root
$rootPath = realpath(FCPATH . '../') . DIRECTORY_SEPARATOR;

// Load Paths.php
require $rootPath . 'app/Config/Paths.php';

// Define APPPATH
defined('APPPATH') || define('APPPATH', $rootPath . 'app' . DIRECTORY_SEPARATOR);

$paths = new Config\Paths();

// Load Composer
require $rootPath . 'vendor/autoload.php';

// Boot CodeIgniter
require $paths->systemDirectory . '/Boot.php';

exit(CodeIgniter\Boot::bootWeb($paths));