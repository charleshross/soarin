<?php

// Route exception
header("Content-Type: application/json;", TRUE, 404);
$out = array("error" => "404 file not found");
die(json_encode($out));