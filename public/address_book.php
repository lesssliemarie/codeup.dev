<?php
// create class to read and write csv files
class AddressDataStore {

    public $filename = '';

    function __construct($filename = 'data/address_book.csv') 
    {
    	$this->filename = $filename;
    }

    function readCSV()
    {
        // read file $this->filename
        $contents = [];
		$handle = fopen($this->filename, 'r');
		while (($data = fgetcsv($handle)) !== FALSE) {
			$contents[] = $data;
		}
		fclose($handle);
		return $contents;
    }

    function saveCSV($contents) 
    {
        // write $contents array to file $this->filename
        $handle = fopen($this->filename, 'w+');
		foreach ($contents as $fields) {
		fputcsv($handle, $fields);	
		}
		fclose($handle);
    }

}

// create instance of class
$book1 = new AddressDataStore('data/address_book.csv');
// set $addressBook to saved csv file
$addressBook = $book1->readCSV();


// validate inputs, generate error messages
// if passed validation, push new contact to $addressBook array
// prevent XSS
$errorMessage = [];
if (!empty($_POST)) {	
	foreach ($_POST as $key => $value) {
		$_POST[$key] = htmlspecialchars(strip_tags($value));
		if (empty($_POST[$key])) {
			array_push($errorMessage, $key);
		} else {
			$contact = $_POST;
			array_push($addressBook, $contact);
		}
	}
	// prepare error message for display
	$errorMessage = 'REQUIRED FIELDS MISSING: ' . implode(", ", $errorMessage);
	// save new $addressBook array to csv
	$book1->saveCSV($addressBook);
}

// remove contact form $addressBook
if (isset($_GET['remove'])) {
	unset($addressBook[$_GET['remove']]);
	// save $addressBook array to csv and redirect page
	$book1->saveCSV($addressBook);
	header("Location: address_book.php");
	exit(0);
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