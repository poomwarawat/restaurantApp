<!DOCTYPE html>
<?php
    include_once "./conn.php";
    $type = $_GET['FoodType'];
?>

<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
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
            <h1><?php echo $type; ?></h1>
        </div>

        <div class="list">
            <?php
                $sql = "SELECT * FROM table_restaurant WHERE FoodType='$type'";
                $result = mysqli_query($conn, $sql);
                $result_check = mysqli_num_rows($result);

                if($result_check > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<div>';
                        echo '<form method="POST" action="menu.php?id=' . $row['RestaurantID'] . '">';
                        echo    '<img class="res-img"'. 'src="'. '.' .$row['pic'] .'"' . '>';
                        echo     '<h3>'. $row['Restaurant'] .'</h3>';
                        echo     '<p>' . $row['Caption'] .'</p>';
                        echo     '<p>' . $row['OpeningTime'] . '</p>';
                        echo     '<p>' . $row['Address'] . '</p>';
                        echo     '<p>' . $row['PhoneNumber'] . '</p>';
                        echo     '<button type="submit" class="btn-view" id="' . $row['RestaurantID'] . '" >View</button>';
                        echo '</form>';
                        echo '</div>';

                    } 
                }
            ?>
        </div>

    </div>
    <nav></nav>
</body>
</html>