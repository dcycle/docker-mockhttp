<?php

/**
 * @file
 * Web entrypoint for our application.
 */

require_once 'autoload.php';

use myproject\App;

App::instance()->run();
