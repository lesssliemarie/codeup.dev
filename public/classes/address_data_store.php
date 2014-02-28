<?php 
require_once('filestore.php');
// create class to read and write csv files
class AddressDataStore extends Filestore {

    function readBook()
    {
        $contents = $this->readCSV($this->filename);
        return $contents;
    }

    function saveBook($contents) 
    {
        $this->saveCSV($contents);
    }

}

?>