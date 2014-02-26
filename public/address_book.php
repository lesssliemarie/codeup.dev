<?php

// store each form entry as an array of each input
$handle = fopen('data/address_book.csv', 'r');
$addressBook = [];
while (($data = fgetcsv($handle)) !== FALSE) {
	// var_dump($data);
	$addressBook[] = $data;
}
fclose($handle);

var_dump($addressBook);


$errorMessage = [];
if (!empty($_POST)) {
	if (empty($_POST['name'])) {
		array_push($errorMessage, "!! NAME IS REQUIRED !!");
	} 
	if (empty($_POST['address'])) {
		array_push($errorMessage,"!! ADDRESS IS REQUIRED !!");
	}

	if (empty($_POST['city'])) {
		array_push($errorMessage,"!! CITY IS REQUIRED !!");
	}

	if (empty($_POST['state'])) {
		array_push($errorMessage,"!! STATE IS REQUIRED !!");
	}
	if (empty($_POST['zip'])) {
		array_push($errorMessage,"!! ZIP IS REQUIRED !!");
	}
	$errorMessage = implode("\n", $errorMessage);
	
	$contact = $_POST;
	array_push($addressBook, $contact);
	
	$handle = fopen('data/address_book.csv', 'w+');
	foreach ($addressBook as $fields) {
		fputcsv($handle, $fields);	
	}
	fclose($handle);
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
		<p style="color: red">
		<? if (!empty($errorMessage)) : ?>
				<?php echo $errorMessage; ?>
				<? endif; ?>
		</p>
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