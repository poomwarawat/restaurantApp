<?php
//ใช้สำหรับเชื่อมต่อดาต้าเบส
    $servername = "localhost";
    $username = "poomwarawat";
    $password = "";
    $db = "pom_ma_review";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    
    // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    // echo "Connected successfully";


?>