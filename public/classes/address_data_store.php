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

?>