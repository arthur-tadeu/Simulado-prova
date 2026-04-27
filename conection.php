<?php 
$host = "localhost";
$servername = "root";
$senha = "";
$database = "saep_db";

$con = mysqli_connect($host,$servername,$senha,$database);

if(!$con){
die("DEU ERRADO A CONEXAO" . mysqli_connect_error());
}
?>
