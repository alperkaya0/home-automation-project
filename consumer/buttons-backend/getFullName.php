<?php
    session_start();
    $conn=mysqli_connect('localhost','meryem','localhost','web');
    
    if(!$conn)
    {
        echo "connection error: " . mysqli_connect_error();
    }
    
    $sql = "SELECT name, surname FROM register WHERE username = "."'".($_SESSION["username"])."'";
    $result = mysqli_query($conn, $sql);
    $response = "";

    while ($row = $result->fetch_assoc()) {
        $response = ucfirst($row["name"])." ".ucfirst($row["surname"]);
    }
    echo json_encode($response);

?>