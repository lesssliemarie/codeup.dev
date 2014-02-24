<?php

function read_file($file) {
    $handle = fopen($file, "r");
    $contents = fread($handle, filesize($file));
    fclose($handle);
    return explode("\n", $contents);
}

function save_file($filePath, $array) {
    $handle = fopen($filePath, 'w');
    $saveList = implode("\n", $array);
    fwrite($handle, $saveList);
    fclose($handle);
}

$items = read_file("data/todo_list.txt");

if (!empty($_POST)) {
	array_push($items, $_POST['newItem']);			
	save_file("data/todo_list.txt", $items);
}

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
			<?php foreach ($items as $item) {
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