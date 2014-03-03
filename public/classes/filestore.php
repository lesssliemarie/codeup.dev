<?php

class Filestore {

    public $filename = '';
    private $isCSV = FALSE;

    function __construct($filename = '') 
    {
        // Sets $this->filename
        $this->filename = $filename;
        if (substr($filename, -3) == 'csv') {
            $this->isCSV = TRUE;
        }
    }

    public function read() 
    {
        if ($this->isCSV == TRUE) {
            $this->readCSV();
        } else {
            $this->readFile();
        }
    }

    public function write($contents) 
    {
        if ($this->isCSV == TRUE) {
            $this->saveCSV($contents);
        } else {
            $this->saveFile($contents);
        }
    }

    // Returns array of lines in $this->filename
    function readFile()
    {
    	$handle = fopen($this->filename, "r");
    	if (filesize($this->filename) > 0) {
    		$contents = fread($handle, filesize($this->filename));
    		return explode("\n", $contents); 
    	} else {
    		return array();
    	}
    	fclose($handle);
    }


    // Writes each element in $array to a new line in $this->filename
    function saveFile($contents)
    {
    	$handle = fopen($this->filename, 'w');
    	$saveList = implode("\n", $contents);
    	fwrite($handle, $saveList);
    	fclose($handle);
    }

    // Reads contents of csv $this->filename, returns an array
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

    // Writes contents of $array to csv $this->filename
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