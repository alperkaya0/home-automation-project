<?php
//SELECT * FROM `chart_light_usage` WHERE DATEDIFF(CURDATE(), date) >= 0 AND  DATEDIFF(CURDATE(), date) <= 7 AND name = 'alperkaya';
session_start();
$conn=mysqli_connect('localhost','meryem','localhost','web');

if(!$conn)
{
    echo "connection error: " . mysqli_connect_error();
}

//FIND LAST DAY AVERAGE(Pseudo average because a day has only one row anyways)
$sql = "SELECT AVG(value) as average FROM `chart_light_usage` WHERE DATEDIFF(CURDATE(), date) >= 0 AND  DATEDIFF(CURDATE(), date) <= 1 AND name = '".$_SESSION["username"]."';";
$result = mysqli_query($conn, $sql);

$response = [];
while ($row = $result->fetch_assoc()) {
    $response["day"] = $row["average"];
}

//FIND LAST WEEK AVERAGE
$sql = "SELECT AVG(value) as average FROM `chart_light_usage` WHERE DATEDIFF(CURDATE(), date) >= 0 AND  DATEDIFF(CURDATE(), date) <= 7 AND name = '".$_SESSION["username"]."';";
$result = mysqli_query($conn, $sql);

while ($row = $result->fetch_assoc()) {
    $response["week"] = $row["average"];
}

//FIND LAST YEAR AVERAGE
$sql = "SELECT AVG(value) as average FROM `chart_light_usage` WHERE DATEDIFF(CURDATE(), date) >= 0 AND  DATEDIFF(CURDATE(), date) <= 365 AND name = '".$_SESSION["username"]."';";
$result = mysqli_query($conn, $sql);

while ($row = $result->fetch_assoc()) {
    $response["year"] = $row["average"];
}

//FIND LAST DECADE AVERAGE
$sql = "SELECT AVG(value) as average FROM `chart_light_usage` WHERE DATEDIFF(CURDATE(), date) >= 0 AND  DATEDIFF(CURDATE(), date) <= 3650 AND name = '".$_SESSION["username"]."';";
$result = mysqli_query($conn, $sql);

while ($row = $result->fetch_assoc()) {
    $response["decade"] = $row["average"];
}

if (!$response["day"])    $response["day"] = 0;
if (!$response["week"])   $response["week"] = 0;
if (!$response["year"])   $response["year"] = 0;
if (!$response["decade"]) $response["decade"] = 0;

echo json_encode($response);
?>