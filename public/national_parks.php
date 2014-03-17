<?php

// Connect to database
$mysqli = @new mysqli('127.0.0.1', 'queenbee', 'b8z92u9z', 'codeup_mysqli_test_db');

// Check for errors
if ($mysqli->connect_errno) {
	echo 'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . PHP_EOL;
} 

// Retrieve a result set using SELECT

if (!empty($_GET)) {
	$result = $mysqli->query("SELECT * FROM national_parks ORDER BY {$_GET['sort_column']} {$_GET['sort_order']} ");
} 

// $sortCol = 'name';
// $sortOrder = 'desc';
// $validCols = ['name', etc];
// if (!empty($_GET['sort_column'])) {
// 	// check if in array
// 	// if so, set to $sortCol
// 	// if not, throw error?
// }

// if (!empty($_GET['sort_order'])) {
// 	// if desc, set $sortOrder
// }


if (!empty($_POST)) {

	try {	
		// Set variables
		if (empty($_POST['name'])) {
			throw new Exception('\'Park Name\' IS EMPTY. Please fill out again.');
		} elseif (empty($_POST['location'])) {
			throw new Exception('\'Location\' IS EMPTY. Please fill out again.');
		} elseif (empty($_POST['description'])) {
			throw new Exception('\'Description\' IS EMPTY. Please fill out again.');
		} elseif (empty($_POST['date_established'])) {
			throw new Exception('\'Date Established\' IS EMPTY. Please fill out again.');
		} elseif (empty($_POST['area'])) {
			throw new Exception('\'Area\' IS EMPTY. Please fill out again.');
		} else {
			$name = $_POST['name'];
			$location = $_POST['location'];
			$description = $_POST['description'];
			$date_established = $_POST['date_established'];	
			$area_in_acres = $_POST['area'];

			// Create the prepared statement
			$stmt = $mysqli->prepare("INSERT INTO national_parks (name, location, description, date_established, area_in_acres) VALUES (?, ?, ?, ?, ?)");

			// bind parameters
			$stmt->bind_param("ssssd", $name, $location, $description, $date_established, $area_in_acres);

			// execute query, return result
			$stmt->execute();

			// close connection
			$mysqli->close();
		}
	} catch (Exception $e) {
		$errorMessage = $e->getMessage();
	}
}

$result = $mysqli->query("SELECT * FROM national_parks");

?>

<!DOCTYPE html>
<html>
<head>
	<title>National Parks</title>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<style>

td {
	font-size: 12px;
}

a#heading {
	text-decoration: none;
	color: #FFFFFF;
}

body {
	background-image: url('/img/arches.jpg');
	background-position: fixed;
	background-repeat: no-repeat;
}

table {
	background-color: #FFFFFF;
	opacity: 0.9;
	margin-top: 20px;
}

#addpark {
	float: right;
}

</style>

</head>
<body>
<div class="container">
	<h1><a id="heading" href="national_parks.php">National Parks <span class="glyphicon glyphicon-tree-conifer"></span></a> <button id ="addpark" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Park</button> </h1>

	<? if(!empty($errorMessage)): ?> 
		<div class="alert alert-danger" data-dismiss="alert"><?= $errorMessage; ?>
	</div>
	<? endif; ?>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Add a National Park</h4>
	      </div>
	      <div class="modal-body">
	        <form method="POST" action="national_parks.php" role="form"> 
				<div class="form-group">	
					<label for="name">Park Name</label>
					<input id="name" name="name" type="text" class="form-control">
					<label for="location">Location</label>
					<input id="location" name="location" type="text" class="form-control">
					<label for="description">Description</label>
					<textarea id="description" name="description" class="form-control" rows="3"></textarea>
					<label for="date_established">Date Established</label>
					<input id="date_established" name="date_established" type="text" class="form-control" placeholder="YYYY-MM-DD">
					<label for="area">Area (acres)</label>
					<input id="area" name="area" type="text" class="form-control" placeholder="0000.00"><hr>
					<p>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        		<button type="submit" class="btn btn-primary">Add Park</button>
		        	</p>
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>
	

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
