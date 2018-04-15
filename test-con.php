<?php

$cat = $_GET['cat'];
$cat1 = str_replace(" and ", " & ", $cat);
echo $cat1;

$host       = "localhost";
$user       = "root";
$pass       = "";
$database   = "pinnacle";


$DB_link = mysqli_connect($host, $user, $pass, $database) or die("Could not connect to host.");


$query = mysqli_query($DB_link,  "SELECT * FROM content_sms where category_name = '$cat1' ORDER BY id DESC");

while ($row = mysqli_fetch_array($query))
{

echo $row['id'];
}

?>