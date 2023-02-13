<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'firstapp';

$mysql = mysqli_connect($server, $username, $password, $database);

if(!$mysql){
   echo print_r(mysqli_connect_error($mysql));
   	die('cannot connect to db');
}
