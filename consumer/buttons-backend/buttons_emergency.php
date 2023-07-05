<?php
session_start();
$conn=mysqli_connect('localhost','meryem','localhost','web');

if(!$conn)
{
    echo "connection error: " . mysqli_connect_error();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents('php://input');
    echo json_encode($body);
    $isEmergency = json_decode($body)->isEmergency;
    $currentDate = date('Y-m-d'); // Get the current date
    $sql = "INSERT INTO user_option (date, name, _option, value) VALUES ('".$currentDate."', '".$_SESSION["username"]."', 'isEmergency', '".$isEmergency."');";

    $result = mysqli_query($conn, $sql);    
} else {
    $sql = "SELECT value FROM `user_option` WHERE name = '".$_SESSION["username"]."' AND _option = 'isEmergency'; ";
    $result = mysqli_query($conn, $sql);
    $response = "";

    while ($row = $result->fetch_assoc()) {
        $response = $row["value"];
    }
    echo json_encode($response);
}
?>
