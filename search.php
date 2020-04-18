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
             if(isset($_GET['search'])){
                 $search_value = $_REQUEST['value'];
             }
             if(empty($search_value)){
                 echo "<h1> </h1>";
             }else{
                $sql ="SELECT * FROM table_restaurant WHERE Restaurant LIKE '%$search_value%'";
                $result = mysqli_query($conn,$sql);
                // $result_check = mysqli_num_rows($result);

                while($row = mysqli_fetch_assoc($result)){
                    echo '<div>';
                    echo '<form method="POST" action="menu.php?id=' . $row['RestaurantID'] . '">';
                    echo     '<img class="res-image-show"'. 'src=".' . $row['pic'] . '"' . '>';
                    echo     '<h3>'. $row['Restaurant'] .'</h3>';
                    echo     '<p>' . $row['Caption'] .'</p>';
                    echo     '<p>' . $row['OpeningTime'] . '</p>';
                    echo     '<p>' . $row['Address'] . '</p>';
                    echo     '<p>' . $row['PhoneNumber'] . '</p>';
                    echo '</div>';

             ?> 

             <figure>
             <h1><a herf="menu.php?"id=<?php echo 

             </figure>

             <?php
               }
            }
            ?> 





            // $sql = "SELECT * FROM table_restaurant WHERE RestaurantID='$id'";
            // $result = mysqli_query($conn, $sql);
            // $result_check = mysqli_num_rows($result);

            // if($result_check > 0){
            //     while($row = mysqli_fetch_assoc($result)){
            //         echo '<div>';
            //         echo     '<img class="res-image-show"'. 'src=".' . $row['pic'] . '"' . '>';
            //         echo     '<h3>'. $row['Restaurant'] .'</h3>';
            //         echo     '<p>' . $row['Caption'] .'</p>';
            //         echo     '<p>' . $row['OpeningTime'] . '</p>';
            //         echo     '<p>' . $row['Address'] . '</p>';
            //         echo     '<p>' . $row['PhoneNumber'] . '</p>';
            //         echo '</div>';
            //     }
            // }
           

    </div>
</body>
</html>
<?php

?>