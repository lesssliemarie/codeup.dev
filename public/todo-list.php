<?php

echo "<p>GET:</p>";
var_dump($_GET);

echo "<p>POST:</p>";
var_dump($_POST);

?>

<!DOCTYPE html>
<html>
<head>
	<title>TODO List</title>
</head>
<body>

	<h2>TODO List</h2>
		<ul>
			<li>Finish php challenges</li>
			<li>Make JS game</li>
			<li>Make grooming appt for Jimi</li>
		</ul>

		<h3>Add a TODO List item:</h3>
		<form method="POST" action="">
			<p>
				<label for="newItem">New Item:</label>
				<input id="newItem" name="newItem" type="text">
			</p>

			<button type="submit">Add Item</button>
		</form>

</body>
</html>