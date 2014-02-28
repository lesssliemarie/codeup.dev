<?php
require_once('address_book_classes.php');

$newContact = new AddressEntry($_POST);
var_dump($newContact);

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
	<form method="POST" enctype="multipart/form-data" action="address_book_two.php">
		<p>
			<label for="name">Name:</label>
			<input id="name" name="0" type="text" autofocus="autofocus">
		</p>
		<p>
			<label for="address">Address:</label>
			<input id="address" name="1" type="text">
		</p>
		<p>
			<label for="city">City:</label>
			<input id="city" name="2" type="text">
		</p>
		<p>
			<label for="state">State:</label>
			<input id="state" name="3" type="text">
		</p>
		<p>
			<label for="zip">Zip:</label>
			<input id="zip" name="4" type="text">
		</p>
		<p>
			<label for="phone">Phone Number:</label>
			<input id="phone" name="5" type="text">
		</p>
		<p>
        	<label for="file1">Upload CSV File: </label>
        	<input id="file1" name="file1" type="file">
    	</p>

    	<button type="submit">Add Contact(s)</button>
    </form>
</body>
</html>