<?php

$user = 'root';
$pass = '';
$db = 'chinook';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

echo "You're connected!!";

?>