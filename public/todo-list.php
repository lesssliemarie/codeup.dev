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
$archives = "data/archives.txt";

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
	$archive = array_splice($items, $_GET['remove'], 1);
	save_file($archives, $archive);
	save_file($file, $items);
	header("Location: todo-list.php");
	exit(0);
}

$errorMessage = '';
// upload file, if not empty and is text file
if (count($_FILES) > 0) {
	if($_FILES['file1']['error'] != 0) {
		$errorMessage = 'ERROR UPLOADING FILE.';
	} elseif ($_FILES['file1']['type'] != 'text/plain') {
		$errorMessage = 'ERROR: INVALID FILE TYPE.';
	} else {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$filename = basename($_FILES['file1']['name']);
		$saved_filename = $upload_dir . $filename;
		move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
		$fileContents = read_file($saved_filename);
	
		if ($_POST['fileO'] == TRUE) {
			$items = $fileContents;
		} else {
			$items = array_merge($items, $fileContents);
		}

		save_file($file, $items);		
		header("Location: todo-list.php");
		exit(0);
	}
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
				<? if (!empty($errorMessage)) : ?>
				<?= $errorMessage; ?>
				<? endif; ?>
			</p>
			<p>
        		<label for="file1">File to upload: </label>
        		<input id="file1" name="file1" type="file">
    		</p>
    		<p>
        		<label for="fileO">Overwrite file? </label>
        		<input id="fileO" name="fileO" type="checkbox">
    		</p>

			<button type="submit">Add Item(s)</button>
		</form>

</body>
</html>