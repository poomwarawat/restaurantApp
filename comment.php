<?php
    include_once "./conn.php";

    $comment = $_POST['comment']; //รับข้อมูลจาก comment
    $star = $_POST['ReviewPoint'];//รับข้อมูลจาก star
    $menuId = $_GET['id'];

    // echo $comment ;
    // echo $star;
    // echo $menuId;

    $sql = "INSERT INTO table_reviews (MenuID, comment, ReviewPoint) VALUES ('$menuId', '$comment', '$star')";
    if(mysqli_query($conn, $sql)){
      header("Location: ./menucom.php?id=$menuId"); // header สั่งให้มันเปลี่ยนหน้า
      exit;

    }
?>