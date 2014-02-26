<?php

// store each form entry as an array of each input
$handle = fopen('data/address_book.csv', 'a+');
$addressBook = [];
while (!feof($handle)) {
	$addressBook[] = fgetcsv($handle);
}

var_dump($addressBook);

fclose($handle);

if (!empty($_POST)) {
	$contact = $_POST;
	array_push($addressBook, $contact);
	
	foreach ($addressBook as $fields) {
		fputcsv($handle, $fields);	
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
		<? foreach ($addressBook as $contacts): ?>
		<tr>
			<? foreach ($contacts as $info): ?>
					<td><?= $info; ?></td>
			<? endforeach; endforeach; ?>
		</tr>	
	</table>

	<h2>Enter a New Contact:</h2>
	<form method="POST" action="address_book.php">
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
		<button type="submit">Add Contact</button>
	</form>

</body>
</html>