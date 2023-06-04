<?php
session_start();
$conn=mysqli_connect('localhost','meryem','localhost','web');

if(!$conn)
{
    echo "connection error: " . mysqli_connect_error();
}

$sql = "SELECT AVG(value) AS value, name, DAYNAME(date) AS day_of_week FROM `chart_temperature` GROUP BY name, day_of_week;";
$result = mysqli_query($conn, $sql);

$response = [];
$i = 0;
while ($row = $result->fetch_assoc()) {
    if (!isset($response[$row["name"]])) {
        $response[$row["name"]] = [];
    }
    $response[$row["name"]][$row["day_of_week"]] = $row["value"];
}
echo json_encode($response[$_SESSION["username"]]);
?>