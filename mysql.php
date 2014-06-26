<?php
$dsn = 'mysql:dbname=heroku_fb563b1b44ed385;host=us-cdbr-east-06.cleardb.net;charset=utf8';
$user = 'ba872eefd46ca3';
$password = '101c94ca';
try {
    $con = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
