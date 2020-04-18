<!DOCTYPE html>
<?php 
    include_once "./conn.php";
    $id = $_GET['id'];
    
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
    <nav>
            <div >
                <h1> <a href="index.php"> HOME </a> </h1> 
            </div>
    </nav>
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
        <div class="list">
        <?php

            $sql = "SELECT * FROM table_menu WHERE table_menu.RestaurantID='$id'";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);

            $total_sum = 0; //creating for record totla rating menu
            $count_menu_review = 0; //count reating menu

            if($result_check > 0){
                while($row = mysqli_fetch_assoc($result)){                                       
                    $menuID = $row['id'];
                    
                    $sql1 = "SELECT AVG(ReviewPoint) AS AVG_REVIEW FROM table_reviews WHERE MenuID='$menuID'";
                    $result1 = mysqli_query($conn, $sql1);
                    $result_check1 = mysqli_num_rows($result1);

                    $avg_menu = 0; // average score of menu == 4
                    if($result_check1 > 0){            
                               
                        while($row1 = mysqli_fetch_assoc($result1)){
                            if($row1['AVG_REVIEW'] != 0){                               
                               $avg_menu = $row1['AVG_REVIEW']; 
                               $total_sum += $row1['AVG_REVIEW'];
                               $count_menu_review += 1;
                            }
                        }
                    }

                    echo '<div>';
                    echo '<form method="POST" action="menucom.php?id=' . $row['id'] . '">';
                    echo     '<p>' . $avg_menu . '</p>';
                    echo     '<img class="res-image-show"'. 'src=".' . $row['img'] . '"' . '>';
                    echo     '<h3>'. $row['MenuName'] .'</h3>';
                    echo     '<p>' . $row['Price'] .'</p>';
                    echo     '<button type="submit" class="btn-view" id="' . $row['id'] . '" >View</button>';
                    // echo     '<p> all menu review point = ' . $total_sum . '</p>';
                    // echo     '<p> only reivew restaurant = ' . $count_menu_review . 'res </p>';
                    echo '</form>';
                    echo '</div>';
                }
            }
        ?>   

        </div>
        <hr/>
        </div>
        <div>
        </hr>
        </div>
        <div>
            <h1>Display all reivew rating</h1>
            <p> <?php echo $total_sum; ?> </p>
            <h1>Display all rating count</h1>
            <p> <?php echo $count_menu_review; ?> </p>
            <h1>Display all restuarant rating</h1>
            <p> <?php echo $total_sum/$count_menu_review; ?> </p>
        </div>

        <?php
        
            $sql3 = "SELECT * FROM ranking where resId='$id'";
            $result3 = mysqli_query($conn, $sql3);
            $result_check3 = mysqli_num_rows($result3);

            echo $result_check3;

            if($result_check3 == 0){
                $avg = $total_sum/$count_menu_review;
                $a = "INSERT INTO ranking (resId, star) VALUES ($id, $avg)";
                mysqli_query($conn, $a);          
            }
            else{
                $sql5 = "UPDATE ranking SET star=$total_sum/$count_menu_review WHERE resId=$id";
                mysqli_query($conn, $sql5);
            }
            
        ?>
    </div>
    <nav> </nav>
</body>
</html>