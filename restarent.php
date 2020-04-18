<!DOCTYPE html>
<?php 
    include_once "./conn.php";
    $id = $_GET['RestaurantID'];
    
?>

<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <div>
        <div class="head">
            <h1>Food</h1>
        </div>
        <?php
            $sql = "SELECT * FROM table_restaurant WHERE RestaurantID='$id'";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);

            if($result_check > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<div>';
                    echo     '<img class="res-image-show"'. 'src=".' . $row['pic'] . '"' . '>';
                    echo     '<h3>'. $row['Restaurant'] .'</h3>';
                    echo     '<p>' . $row['Caption'] .'</p>';
                    echo     '<p>' . $row['OpeningTime'] . '</p>';
                    echo     '<p>' . $row['Address'] . '</p>';
                    echo     '<p>' . $row['PhoneNumber'] . '</p>';
                    echo '</div>';
                }
            }
        ?>
        <h1>Rating</h1>
        <?php
            $sql = "SELECT AVG(ReviewPoint) AS AverageStar FROM table_reviews where MenuID=$id";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);

            if($result_check > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<h3> All rating : " . $row['AverageStar'] . "</h3>";

                }
            }
        ?>
        <hr/>
            <h1> All comment</h1>
            <?php
                //ใช้สำหรับแสดงคอมเม้นท์ทั้งหมดของแต่ละร้าน
                $sql = "SELECT * FROM table_reviews WHERE MenuID=$id";
                $result = mysqli_query($conn, $sql);
                $result_check = mysqli_num_rows($result);

                if($result_check > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<div class="show-comment">';
                    echo    '<p>Comment : ' .$row['comment'] .  '</p>';
                    if($row['ReviewPoint'] == 1){
                        echo "<p class='star'>✰</p>";
                    }else if($row['ReviewPoint'] == 2){
                        echo "<p class='star'>✰✰</p>";
                    }else if($row['ReviewPoint'] == 3){
                        echo "<p class='star'>✰✰✰</p>";
                    }else if($row['ReviewPoint'] == 4){
                        echo "<p class='star'>✰✰✰✰</p>";
                    }else if($row['ReviewPoint'] == 5){
                        echo "<p class='star'>✰✰✰✰✰</p>";
                    }
                    echo '</div>';

                }
            }
            ?>
           
        <hr/>
        <div class="stars" >
            <?php
                echo "<h3>Comment here!!!</h3>";
                echo '<form method="POST" action="./comment.php?id=' . $id .'">';
                
                    echo    '<input class="star star-5" id="star-5" type="radio" value="5" name="star"/>';
                    echo    '<label class="star star-5" for="star-5"></label>';
                    echo    '<input class="star star-4" id="star-4" type="radio" value="4" name="star"/>';
                    echo    '<label class="star star-4" for="star-4"></label>';
                    echo    '<input class="star star-3" id="star-3" type="radio" value="3" name="star"/>';
                    echo    '<label class="star star-3" for="star-3"></label>';
                    echo    '<input class="star star-2" id="star-2" type="radio" value="2" name="star"/>';
                    echo    '<label class="star star-2" for="star-2"></label>';
                    echo    '<input class="star star-1" id="star-1" type="radio" value="1" name="star"/>';
                    echo    '<label class="star star-1" for="star-1"></label>';

                echo    '<input class="comment" name="comment">';
                echo    '<button class="input-btn" type="submit">Send</button>';
                echo '</form>';
            ?>
        </div>


        </div>
    </div>
</body>
</html>
<?php

?>