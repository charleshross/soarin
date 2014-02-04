<?php

// Index
$router->addRoute(array(
'path'     => '/',
'get'	=> array('Controllers\Soarin\Index', 'read'),
));