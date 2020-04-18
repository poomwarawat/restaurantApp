<?php
$connect = mysqli_connect("localhost", "poomwarawat", "", "pom_ma_review");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM table_restaurant 
	WHERE Restaurant LIKE '%".$search."%'
	OR Address LIKE '%".$search."%' 
	OR PhoneNumber LIKE '%".$search."%' 
	";
}

$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive res-name-show" id="bg-search">
					<table class="table table bordered">
						<tr>
							<th>Restaurant</th>							
						</tr>
						';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>				
				<td>
				<form action="./menu.php?id='.$row["RestaurantID"].'" method="POST">
				<button class="btn btn-primary" type="submit">'
					.$row["Restaurant"].
				'</button>
				</form>
				</td>				
			</tr>
		';
	}
	echo $output;
}
?>