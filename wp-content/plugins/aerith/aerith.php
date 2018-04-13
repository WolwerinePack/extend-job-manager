<?php

/**
* Plugin Name: aerith
* Description: Surcouche de WP Job Manager
* Version: 1.0.0
* Author <a href="#">Fortuny José</a>
*/

require_once( dirname( __FILE__ ) . '/vendor/autoload.php');

use app\edit_fields;
use app\add_fields;
use app\add_taxonomy;
use app\send_emails;
use app\custom_script;
use app\set_cookies;
use app\find_zone;
use app\script_jquery;

new edit_fields();
new add_fields();
new add_taxonomy();
new send_emails();
new custom_script();
new set_cookies();
new find_zone();
new script_jquery();