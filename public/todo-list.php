<?php
require('classes/filestore.php');
class InvalidInputException extends Exception {}

// create instance of Filestore, create $items
$list = new Filestore('data/todo_list.txt');
$items = $list->read();

// create instance of Filestore, create $archives
$archiveFile = new Filestore('data/archives.txt');
$archives = $archiveFile->read();
// add items to list
if (isset($_POST['newItem'])) {
	
	try {
		if (strlen($_POST['newItem']) > 240) {
			throw new InvalidInputException('The item you entered is greater than 240 characters');
		} elseif (empty($_POST['newItem'])) {
		throw new InvalidInputException('You did not enter an item');
		} else {
			if (isset($_POST['fileO']) && $_POST['fileO'] != 'on') {
			break 2;
			}
			array_push($items, $_POST['newItem']);
			$list->save($items);
		}
	} catch (InvalidInputException $e) {
		$invalidInputMessage = $e->getMessage();
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
		$errorMessage = 'ERROR UPLOADING FILE';
	} elseif ($_FILES['file1']['type'] != 'text/plain') {
		$errorMessage = 'ERROR: INVALID FILE TYPE';
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

	<link rel="stylesheet" type="text/css" href="/css/todo-list.css">
	<link href='http://fonts.googleapis.com/css?family=Unica+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Bubbler+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Codystar' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="container">
	<h1>TODO List</h1>
		<ul>
			<? foreach ($items as $key => $item): ?>
				<li><?= htmlspecialchars(strip_tags($item)); ?> &nbsp;&nbsp;&nbsp; <a href="?remove=<?= $key; ?>"> COMPLETED </a></li>
			<? endforeach; ?>
		</ul>


		<h2>Add a TODO List item:</h2>
		<form method="POST" action="todo-list.php">
			<p>
				<label for="newItem">New Item:&nbsp;&nbsp;&nbsp;</label>
				<input id="newItem" name="newItem" type="text" autofocus="autofocus">
				<button type="submit">Add Item</button>
			</p>
			<p style="text-transform: uppercase; color: red;">
				<? if (!empty($invalidInputMessage)) : ?>
				! <?= $invalidInputMessage; ?> !
				<? endif; ?>
			</p>			
		</form>	
		<form method="POST" enctype="multipart/form-data" action="todo-list.php">
			<p style="text-transform: uppercase; color: red;">
				<? if (!empty($errorMessage)) : ?>
				! <?= $errorMessage; ?> !
				<? endif; ?>
			</p>
			<p>
        		<label for="file1">File to upload:&nbsp;&nbsp;&nbsp; </label>
        		<input id="file1" name="file1" type="file">
    		</p>
    		<p>
        		<label for="fileO">Overwrite file? </label>
        		<input id="fileO" name="fileO" type="checkbox">
    			<button type="submit">Add File</button>
    		</p>			
		</form>
	</div>
</body>
</html>