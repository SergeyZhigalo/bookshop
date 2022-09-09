<?php
include '../db.php';

$query = "SELECT * FROM `publishing`";
$result = mysqli_query($link,$query);
if ($result) {
$json_array = array();
while($row = mysqli_fetch_assoc($result))
    $json_array[] = $row;

}
echo json_encode($json_array);