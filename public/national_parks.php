<?php

// Connect to database
$mysqli = @new mysqli('127.0.0.1', 'queenbee', 'b8z92u9z', 'codeup_mysqli_test_db');

// Check for errors
if ($mysqli->connect_errno) {
	echo 'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . PHP_EOL;
} else {
	// echo $mysqli->host_info . PHP_EOL;
}


// Retrieve a result set using SELECT

if (!empty($_GET)) {
	$result = $mysqli->query("SELECT * FROM national_parks ORDER BY {$_GET['sort_column']} {$_GET['sort_order']} ");
} else {
	$result = $mysqli->query("SELECT * FROM national_parks");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>National Parks</title>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<style>
h1 {
	text-align: center;
	color: #20511b;
}

td {
	font-size: 12px;
}

a#heading {
	text-decoration: none;
	color: #FFFFFF;
}

body {
	background-image: url('/img/arches.jpg');
}

table {
	background-color: #FFFFFF;
	opacity: 0.9;
}

</style>

</head>
<body>
<div class="container">
	<h1><a id="heading" href="national_parks.php">National Parks <span class="glyphicon glyphicon-tree-conifer"></span></a></h1>

	

		<table class="table table-bordered">
	  		<tr>
	  			<th>Park Name<br>
	  				<a href="?sort_column=name&amp;sort_order=asc"><span class="glyphicon glyphicon-sort-by-alphabet"></span></a>
					<a href="?sort_column=name&amp;sort_order=desc"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></a>
				</th>
	  			<th>Location
	  				<a href="?sort_column=location&amp;sort_order=asc"><span class="glyphicon glyphicon-sort-by-alphabet"></span></a>
					<a href="?sort_column=location&amp;sort_order=desc"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></a>
	  			</th>
	  			<th>Description</th>
	  			<th>Date Established
	  				<a href="?sort_column=date_established&amp;sort_order=asc"><span class="glyphicon glyphicon-sort-by-order"></span></a>
					<a href="?sort_column=date_established&amp;sort_order=desc"><span class="glyphicon glyphicon-sort-by-order-alt"></span></a>
	  			</th>
	  			<th>Area (acres)
	  				<a href="?sort_column=area_in_acres&amp;sort_order=asc"><span class="glyphicon glyphicon-sort-by-order"></span></a>
					<a href="?sort_column=area_in_acres&amp;sort_order=desc"><span class="glyphicon glyphicon-sort-by-order-alt"></span></a>
	  			</th>
	  		</tr>

	 	<?php while ($parks = $result->fetch_assoc()): ?>
		 		<tr>
			  			<td> <?= $parks['name']; ?> </td>
			  			<td> <?= $parks['location']; ?> </td>
			  			<td> <?= $parks['description']; ?> </td>
			  			<td> <?= $parks['date_established']; ?> </td>
			  			<td> <?= $parks['area_in_acres']; ?> </td>
		  		</tr>
		<? endwhile; ?>


		</table>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
