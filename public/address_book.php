<?php
include('classes/address_data_store.php');

// create instance of class
$book1 = new AddressDataStore('data/address_book.csv');
// set $addressBook to saved csv file
$addressBook = $book1->readCSV();


// validate inputs, generate error messages
// if passed validation, push new contact to $addressBook array
// prevent XSS
$requiredErrMessage = [];
if (!empty($_POST)) {	
	
	$entry = [];
	$entry['name'] = $_POST['name'];
	$entry['address'] = $_POST['address'];
	$entry['city'] = $_POST['city'];
	$entry['state'] = $_POST['state'];
	$entry['zip'] = $_POST['zip'];

	
	foreach ($entry as $key => $value) {
		if (empty($value)) {
			array_push($requiredErrMessage, $key);
		}
	}

	$entry['phone'] = $_POST['phone'];

	foreach ($_POST as $key => $value) {
		$_POST[$key] = htmlspecialchars(strip_tags($value));
	}

	if (empty($requiredErrMessage)) {
		array_push($addressBook, array_values($entry));
		$book1->saveCSV($addressBook);
	}
}

// remove contact form $addressBook
if (isset($_GET['remove'])) {
	unset($addressBook[$_GET['remove']]);
	// save $addressBook array to csv and redirect page
	$book1->saveCSV($addressBook);
	header("Location: address_book.php");
	exit(0);
}

$fileErrMessage = '';
if (count($_FILES) > 0) {
	if ($_FILES['file1']['error'] !== 0) {
		$fileErrMessage = 'ERROR UPLOADING FILE.';
	} else {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$filename = basename($_FILES['file1']['name']);
		$savedFilename = $upload_dir . $filename;
		move_uploaded_file($_FILES['file1']['tmp_name'], $savedFilename);
		$book2 = new AddressDataStore($savedFilename);
		$upAddressBook = $book2->readCSV();
		
		// if (isset($_POST['fileO'])) {
		// 	$addressBook = $upAddressBook;
		// 	echo 'HERE';
		// } else {
		// 	$addressBook = array_merge($addressBook, $upAddressBook);
		// }
		
		$book1->saveCSV($addressBook);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Address Book</title>
</head>
<body>
	<h1>ADDRESS BOOK</h1>
	<table>
		<tr>
			<th>Name&nbsp;</th>
			<th>Address&nbsp;</th>
			<th>City&nbsp;</th>
			<th>State&nbsp;</th>
			<th>Zip&nbsp;</th>
			<th>Phone Number&nbsp;</th>
		</tr>
		<!-- display contacts from $addressBook in table -->
		<? foreach ($addressBook as $contacts => $contact): ?>
		<tr>
			<? foreach ($contact as $info): ?>
			<td><?= $info; ?></td>
			<? endforeach; ?>
			<td><a href="?remove=<?= $contacts; ?>">Remove Contact</a></td>
			<? endforeach; ?>
		</tr>	
	</table>

	<h2>Enter a New Contact:</h2>
		<p style="color: red">
		<!-- output $errorMessage -->
		<? if (!empty($requiredErrMessage)) : ?>
			REQUIRED FIELDS MISSING: 
			<? foreach ($requiredErrMessage as $message): ?>
				<?= $message . ', '; ?>
			<? endforeach; ?>
		<? endif; ?>
		</p>
	<form method="POST" enctype="multipart/form-data" action="address_book.php">
		<p>
			<label for="name">Name:</label>
			<input id="name" name="name" type="text" autofocus="autofocus">
		</p>
		<p>
			<label for="address">Address:</label>
			<input id="address" name="address" type="text">
		</p>
		<p>
			<label for="city">City:</label>
			<input id="city" name="city" type="text">
		</p>
		<p>
			<label for="state">State:</label>
			<input id="state" name="state" type="text">
		</p>
		<p>
			<label for="zip">Zip:</label>
			<input id="zip" name="zip" type="text">
		</p>
		<p>
			<label for="phone">Phone Number:</label>
			<input id="phone" name="phone" type="text">
		</p>

		<!-- <button type="submit">Add Contact</button> -->
	<!-- </form>
	<form method="POST" enctype="multipart/form-data" action="address_book.php"> -->
		<p>
        	<label for="file1">Upload CSV File: </label>
        	<input id="file1" name="file1" type="file">
    	</p>
    	<!-- <p>
        	<label for="fileO">Overwrite file? </label>
        	<input id="fileO" name="fileO" type="checkbox" value="overwrite">
    	</p> -->
    	<button type="submit">Add Contact(s)</button>
    </form>
</body>
</html>