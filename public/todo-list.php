<?php
// read from txt file, return array
function read_file($file) {
    $handle = fopen($file, "r");
   	$contents = fread($handle, filesize($file));
    fclose($handle);
    return explode("\n", $contents); 	
}

// save to array txt file
function save_file($file, $array) {
    $handle = fopen($file, 'w');
    $saveList = implode("\n", $array);
    fwrite($handle, $saveList);
    fclose($handle);
}

// set file location
$file = "data/todo_list.txt";

// check that file is not empty
$items = (filesize($file) > 0) ? read_file($file) : array();

// add items to list
if (!empty($_POST)) {
	array_push($items, $_POST['newItem']);
	save_file("data/todo_list.txt", $items);
	header("Location: todo-list.php");
}

// remove items from list
if (!empty($_GET)) {
	array_splice($items, $_GET['remove'], 1);
	save_file($file, $items);
	header("Location: todo-list.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>TODO List</title>
</head>
<body>

	<h2>TODO List</h2>
		<ul>
			<?php foreach ($items as $key => $item) { ?>
				<li><?php echo $item ?> <a href="?remove=<?php echo $key; ?>"> Mark Complete </a></li>
			<?php } ?>
		</ul>


		<h3>Add a TODO List item:</h3>
		<form method="POST" action="todo-list.php">
			<p>
				<label for="newItem">New Item:</label>
				<input id="newItem" name="newItem" type="text" autofocus="autofocus">
			</p>

			<button type="submit">Add Item</button>
		</form>

</body>
</html>