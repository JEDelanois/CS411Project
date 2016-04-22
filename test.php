<?php
require 'dbconfig.php';
require 'classes/Database.php';
// require 'scripts.php';
$date = new DateTime('now', new \DateTimeZone( 'UTC'));
$arr = suggest_rec_by_macros(50, $date);

echo $arr;
