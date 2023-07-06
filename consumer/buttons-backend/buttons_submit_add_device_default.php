<?php
session_start();
$conn=mysqli_connect('localhost','meryem','localhost','web');

if(!$conn)
{
    echo "connection error: " . mysqli_connect_error();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents('php://input');
    $opt = json_decode($body)->device;
    $currentDate = date('Y-m-d'); // Get the current date
    $options = array(
        "isEmergency" => '"false"',
        "weatherForecast" => '"sunny"',
        "isAcOn" => '"false"',
        "isLightsOn" => '"false"',
        "isWindowBlindOn" => '"false"',
        "temperature" => "10"
    );
    $conv = array(
        "alarm" => "isEmergency",
        "weather" => "weatherForecast",
        "air conditioning" => "isAcOn",
        "light" => "isLightsOn",
        "blinds" => "isWindowBlindOn",
        "temperature" => "temperature"
    );
    $opt = $conv[$opt];
    $sql = "INSERT INTO user_option (date, name, _option, value) VALUES ('$currentDate', '".$_SESSION["username"]."', '$opt', $options[$opt]);";

    $result = mysqli_query($conn, $sql);
    echo json_encode($result);
}
?>
