<?php


/*
 * Plugin name: Rabi Search Optimizer
 * Plugin URI: https://rabisupport.com
 * Description: Search optimizer for persian language
 * Author: rabisupport
 * Author URI: https://rabisupport.com
 * Version: 1.0 
 * Text Domain: rabi-search-optimizer
*/

if (! defined('ABSPATH')){
    exit;
}

define('rso_plugin_path',plugin_dir_path('__FILE__'));

require_once rso_plugin_path.'/includes/search_rules.php';
