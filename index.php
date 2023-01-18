<?php
define('PATH', dirname(__FILE__).'/');
// Add the helpers
require_once('functions.php');
// Load the controller
require_once('controllers/app.php');
// Parse the URL
$parsedURI = parseUrl($_SERVER['REQUEST_URI']);
//
$method = empty($parsedURI) ? 'main' : $parsedURI[0];
// Create Instance of App
$app = new App();
// Check the method in class
if (!in_array($method, get_class_methods($app))){
    exit('Not a valid route');
}
// Call the function
$app->$method();