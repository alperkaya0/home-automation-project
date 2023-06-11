<?php
    session_start();
    $conn=mysqli_connect('localhost','meryem','localhost','web');
    
    if(!$conn)
    {
        echo "connection error: " . mysqli_connect_error();
    }
    
    $sql = "SELECT * FROM device WHERE username = \"".$_SESSION["username"]."\";";
    $result = mysqli_query($conn, $sql);
    $response = [];

    while ($row = $result->fetch_assoc()) {
        if ($row["light"] == 1) {
            $response["light"] = 1;
        }
        if ($row["airConditioning"] == 1) {
            $response["airConditioning"] = 1;
        }
        if ($row["blinds"] == 1) {
            $response["blinds"] = 1;
        }
        if ($row["alarm"] == 1) {
            $response["alarm"] = 1;
        }
        if ($row["weather"] == 1) {
            $response["weather"] = 1;
        }
        if ($row["temperature"] == 1) {
            $response["temperature"] = 1;
        }
    }

    if (!isset($response["light"])) {
        $response["light"] = 0;
    }
    if (!isset($response["airConditioning"])) {
        $response["airConditioning"] = 0;
    }
    if (!isset($response["blinds"])) {
        $response["blinds"] = 0;
    }
    if (!isset($response["alarm"])) {
        $response["alarm"] = 0;
    }
    if (!isset($response["weather"])) {
        $response["weather"] = 0;
    }
    if (!isset($response["temperature"])) {
        $response["temperature"] = 0;
    }

    echo json_encode($response);

?>