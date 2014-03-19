<?php
// Connect to database
$mysqli = @new mysqli('127.0.0.1', 'queenbee', 'b8z92u9z', 'todo_list');

// Check for errors
if ($mysqli->connect_errno) {
	echo 'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . PHP_EOL;
}

// Retrieve list items from list_items table

// if (!empty($_GET)) {
// 	$removeItem = $_GET['id'];

// 	$result = $mysqli->query("SELECT item FROM list_items WHERE id = ? ");
// } 



if (!empty($_POST['item'])) {

	try {	
		// Set variables
		if (empty($_POST['item'])) {
			throw new Exception('You did not enter a list item!');
		} else {
			$newItem = $_POST['item'];
			var_dump($newItem);

			// Create the prepared statement
			$stmt = $mysqli->prepare("INSERT INTO list_items (item) VALUES (?)");

			// bind parameters
			$stmt->bind_param("s", $newItem);

			// execute query, return result
			$stmt->execute();
		}
	} catch (Exception $e) {
		$errorMessage = $e->getMessage();
	}
}

$result = $mysqli->query("SELECT * FROM list_items");
// close connection
$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>TODO LIST &mdash; MySQL</title>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<style>
	#addItem {
		float: right;
	}
	</style>
</head>
<body>
	<div class="container">
		<h1>TODO LIST:<button id ="addItem" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Item</button></h1>

		<div id="list" class="container">
			
			<? while ($items = $result->fetch_assoc()): ?>
				<ul>
					<li><?= $items['item']; ?> <button type="button" class="btn btn-default btn-xs" onclick="removeID(<?= $items['id']; ?>)">Remove</button></li>
				</ul>
			<? endwhile; ?>

		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  		<div class="modal-dialog">
	    		<div class="modal-content">
	      			<div class="modal-body">
						<h2>Add Item:</h2>
						<form method="POST" role="form" action="todo_list_mysql.php">
				  			<div class="form-group">
				   				<input id="item" name="item" type="text" class="form-control"  placeholder="Enter item">
				  			<p>
				  				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  				<button type="submit" class="btn btn-default">Submit</button>
				  			</p>
				  			</div>
				  		</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<form id="removeForm" method="POST" action="todo_list_mysql.php">
	<input id="removeID" name="remove" value="" type="hidden">
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script>
	var form = document.getElementById('removeForm');
	var removeID = document.getElementById('removeID');

	function removeID(id) {
		removeID.value = id;
		form.submit();
	}

</script>

</body>
</html>