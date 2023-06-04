<?php
session_start();
$conn=mysqli_connect('localhost','meryem','localhost','web');

if(!$conn)
{
    echo "connection error: " . mysqli_connect_error();
}

$sql = "SELECT name, value AS weather, COUNT(value) AS value FROM `chart_weather` GROUP BY name, value;";
$result = mysqli_query($conn, $sql);

$response = [];
$i = 0;
while ($row = $result->fetch_assoc()) {
    if (!isset($response[$row["name"]])) {
        $response[$row["name"]] = [];
    }
    $response[$row["name"]][$row["weather"]] = $row["value"];
}
echo json_encode($response[$_SESSION["username"]]);
?>