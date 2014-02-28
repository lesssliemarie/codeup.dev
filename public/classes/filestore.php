<?php

class Filestore {

    public $filename = '';

    function __construct($filename = '') 
    {
        // Sets $this->filename
        $this->filename = $filename;
    }

    /**
     * Returns array of lines in $this->filename
     */
    function readLines()
    {
    	$handle = fopen($this->filename, "r");
   		$contents = fread($handle, filesize($this->filename));
    	fclose($handle);
    	return explode("\n", $contents); 
    }

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    function writeLines($array)
    {
    	$handle = fopen($this->filename, 'w');
    	$saveList = implode("\n", $array);
    	fwrite($handle, $saveList);
    	fclose($handle);
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    function readCSV()
    {
    	$contents = [];
		$handle = fopen($this->filename, 'r');
		while (($data = fgetcsv($handle)) !== FALSE) {
			$contents[] = $data;
		}
		fclose($handle);
		return $contents;
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    function saveCSV($contents)
    {
        $handle = fopen($this->filename, 'w+');
		foreach ($contents as $fields) {
			fputcsv($handle, $fields);	
		}
		fclose($handle);
    }

}

?>