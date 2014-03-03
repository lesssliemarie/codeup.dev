<?php
require('classes/filestore.php');

// create instance of Filestore, create $items
$list = new Filestore('data/todo_list.txt');
$items = $list->read();

// create instance of Filestore, create $archives
$archiveFile = new Filestore('data/archives.txt');
$archives = $archiveFile->read();
// add items to list
if (isset($_POST['newItem'])) {
	if (strlen($_POST['newItem']) > 240) {
		throw new Exception('The item you entered is greater than 240 characters!');
	} elseif (empty($_POST['newItem'])) {
		throw new Exception('You did not enter an item.');
	} else {
		if (isset($_POST['fileO']) && $_POST['fileO'] != 'on') {
			break 2;
		}
		array_push($items, $_POST['newItem']);
		$list->save($items);
	}
}

// remove items from list
if (isset($_GET['remove'])) {
	$archiveItem = array_splice($items, $_GET['remove'], 1);
	$archives = array_merge($archives, $archiveItem);
	$archiveFile->save($archives);
	$list->save($items);
	header("Location: todo-list.php");
	exit(0);
}

$errorMessage = '';
// upload file, if not empty and is text file
if (empty($_POST['newItem']) && count($_FILES) > 0) {
	if($_FILES['file1']['error'] != 0) {
		$errorMessage = 'ERROR UPLOADING FILE.';
	} elseif ($_FILES['file1']['type'] != 'text/plain') {
		$errorMessage = 'ERROR: INVALID FILE TYPE.';
	} else {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$filename = basename($_FILES['file1']['name']);
		$saved_filename = $upload_dir . $filename;
		move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
		$uploadedList = new Filestore($saved_filename);
		$fileContents = $uploadedList->read();	
		
		if (isset($_POST['fileO'])) {
			$items = $fileContents;
		} else {
			$items = array_merge($items, $fileContents);
		}

		$list->save($items);	
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