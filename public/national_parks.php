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
$result = $mysqli->query("SELECT * FROM national_parks");

?>

<!DOCTYPE html>
<html>
<head>
	<title>National Parks</title>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<style>
h1 {
	text-align: center;
}

</style>

</head>
<body>
	<h1>National Parks</h1>
	<div class="container">
		<table class="table table-striped">
	  		<tr>
	  			<th>Park Name</th>
	  			<th>Location</th>
	  			<th>Description</th>
	  			<th>Date Established</th>
	  			<th>Area (acres)</th>
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

	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
