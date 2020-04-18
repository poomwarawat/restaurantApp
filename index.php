<!DOCTYPE html>
<?php
    include_once "./conn.php";
   
?>

<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />    
</head>
<body>

    <nav>
            <div >
                <h1> <a href="index.php"> HOME </a> </h1> 
            </div>
    </nav>
    
    <div class="container">
			<h2 align="center">Search Restaurant Name</h2><br />
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Search</span>
					<input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
				</div>
			</div>
			<br />
			<div class="result">
                <div id="result" ></div>
            </div>
		</div>
		<div style="clear:both"></div>
		<br />
    
    
    <div>
        <div class="head">
            <h1>Food</h1>
        </div>
        <div class="type">
            <div>
                <form action="./res-type.php?FoodType=Fastfood" method="POST"> 
                <button class="type-btn" type="submit">อาหารจานเดียว</button>
                </form>
            </div>
            <div>
                <form action="./res-type.php?FoodType=Noodle" method="POST">
                <button class="type-btn" type="submit">ก๋วยเตี๋ยว</button>
                </form>
            </div>
            <div>
                <form action="./res-type.php?FoodType=Japanese" method="POST">
                <button class="type-btn" type="submit">อาหารญี่ปุ่น</button>
                </form>
            </div>
            <div>
                <form action="./res-type.php?FoodType=Chabu" method="POST">
                <button class="type-btn" type="submit">ชาบู</button>
                </form>
            </div>
            <div>
                <form action="./res-type.php?FoodType=Grilled" method="POST">
                <button class="type-btn" type="submit">ปิ้งย่าง</button>
                </form>
            </div>
            <div>
                <form action="./res-type.php?FoodType=Cafe" method="POST">
                <button class="type-btn" type="submit">คาเฟ่</button>
                </form>
            </div>
        </div>

        <!-- search -->

        

        <!-- ranking -->

        <hr/>
        <h1>Top 10 Ranking</h1>
        <div class="list">
            <?php
                $topten = "SELECT ranking.star, table_restaurant.Restaurant, ranking.resId, table_restaurant.pic, table_restaurant.RestaurantID FROM ranking INNER JOIN table_restaurant ON ranking.resId=table_restaurant.RestaurantID ORDER BY ranking.star DESC LIMIT 10";
                $result1 = mysqli_query($conn, $topten);
                $result_check_topten = mysqli_num_rows($result1);

                // echo $result_check_topten;
                if($result_check_topten > 0){
                    while($test = mysqli_fetch_assoc($result1)){
                        echo '<div>';
                        echo '<form method="POST" action="menu.php?id=' . $test['RestaurantID'] . '">';
                        echo    '<img class="res-img"'. 'src="'. '.' .$test['pic'] .'"' . '>';
                        echo     '<h3>'. $test['Restaurant'] .'</h3>';    
                        echo     '<p>' . $test['star'] . '</p>';          
                        if($test['star'] >= 1 && $test['star'] <= 1.99){
                            echo "<p class='star'>✰</p>";
                        }else if($test['star'] >= 2 && $test['star'] <= 2.99){
                            echo "<p class='star'>✰✰</p>";
                        }else if($test['star'] >= 3 && $test['star'] <= 3.99){
                            echo "<p class='star'>✰✰✰</p>";
                        }else if($test['star'] >= 4 && $test['star'] <= 4.99){
                            echo "<p class='star'>✰✰✰✰</p>";
                        }else if($test['star'] >= 5 ){
                            echo "<p class='star'>✰✰✰✰✰</p>";
                        }          
                        echo     '<button type="submit" class="btn-view">View</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                }

            ?>
        </div>
        <hr/>
        <h1> รีวิวล่าสุด</h1>
        <div class="list">
        <br>
        <?php    
                //ใช้สำหรับแสดงคอมเม้นทั้งหมดของแต่ละร้าน
                //LIMIT 3 น้องใช้ได้
                $sql = "SELECT table_reviews.comment AS COMMENT, table_menu.MenuName AS NAME, table_menu.img AS PIC
                , table_menu.MenuID AS MENUID, table_reviews.ReviewPoint AS STAR , table_menu.id AS RESID 
                FROM table_reviews INNER JOIN table_menu ON table_reviews.MenuID=table_menu.id 
                ORDER BY table_reviews.id DESC LIMIT 3 ";

                // $sql = "SELECT * FROM comment ORDER BY ID DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $result_check = mysqli_num_rows($result);
                // echo $result_check;
                if($result_check > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<div>';
                        echo '<form method="POST" action="menucom.php?id=' . $row['RESID'] . '">';
                        echo     '<img class="res-img"'. 'src=".' . $row['PIC'] . '"' . '>';
                        echo     '<h3>'. $row['NAME'] .'</h3>';
                        echo     '<p>'. $row['COMMENT'] .'</p>';
                        if($row['STAR'] == 1){
                            echo "<p class='star'>✰</p>";
                        }else if($row['STAR'] == 2){
                            echo "<p class='star'>✰✰</p>";
                        }else if($row['STAR'] == 3){
                            echo "<p class='star'>✰✰✰</p>";
                        }else if($row['STAR'] == 4){
                            echo "<p class='star'>✰✰✰✰</p>";
                        }else if($row['STAR'] == 5){
                            echo "<p class='star'>✰✰✰✰✰</p>";
                        }
                        echo     '<button type="submit" class="btn-view" id="' . $row['MENUID'] . '" >View</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                }
            ?>
            </div>


<!-- 
            <hr/>
        <h1> แรงค์10</h1>
        <div class="list">
        <br>
        <?php    
                
            ?>
            </div> -->



            <hr/>
            <h1> ร้านอาหารทั้งหมด</h1>
        <div class="list">
            <?php
                $sql = "SELECT * FROM table_restaurant";
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
        <hr/>
        <div>
        <h1> All comment</h1>
            <?php
                //ใช้สำหรับแสดงคอมเม้นท์ทั้งหมดของแต่ละร้าน
                $sql = "SELECT * FROM table_reviews ";
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
        </div>
    </div>

    <nav> </nav>
</body>
<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"./fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>
</html>