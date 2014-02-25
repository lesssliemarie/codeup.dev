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
if (!empty($_POST['newItem'])) {
	array_push($items, $_POST['newItem']);
	save_file($file, $items);
	header("Location: todo-list.php");
	exit(0);
}

// remove items from list
if (!empty($_GET['remove'])) {
	array_splice($items, $_GET['remove'], 1);
	save_file($file, $items);
	header("Location: todo-list.php");
	exit(0);
}

// upload file, if not empty and is text file
if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0 && $_FILES['file1']['type'] == 'text/plain') {
	$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
	$filename = basename($_FILES['file1']['name']);
	$saved_filename = $upload_dir . $filename;
	move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
	$fileContents = read_file($saved_filename);
	$items = array_merge($items, $fileContents);
	save_file($file, $items);		
	header("Location: todo-list.php");
	exit(0);
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
			<? foreach ($items as $key => $item): ?>
				<li><?= htmlspecialchars(strip_tags($item)); ?> <a href="?remove=<?= $key; ?>"> Mark Complete </a></li>
			<? endforeach; ?>
		</ul>


		<h3>Add a TODO List item:</h3>
		<form method="POST" enctype="multipart/form-data" action="todo-list.php">
			<p>
				<label for="newItem">New Item:</label>
				<input id="newItem" name="newItem" type="text" autofocus="autofocus">
			</p>
			<p>
        		<label for="file1">File to upload: </label>
        		<input id="file1" name="file1" type="file">
    		</p>

			<button type="submit">Add Item(s)</button>
		</form>

</body>
</html>