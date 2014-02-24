<!DOCTYPE html>
<html>
<head>
	<title>TODO List</title>
</head>
<body>

	<h2>TODO List</h2>
		<?php 
			$listItems = array('Finish php challenges', 'Make JS game', 'Make grooming appt for Jimi');
		?>
		<ul>
			<?php foreach ($listItems as $item) {
				echo "<li>$item</li>";
			}
			?>
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