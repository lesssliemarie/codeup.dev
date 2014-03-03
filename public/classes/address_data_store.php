<?php 
require_once('filestore.php');
// create class to read and write csv files
class AddressDataStore extends Filestore {

    function __construct($filename = '')
    {
        parent::__construct(strtolower($filename));       
    }

}

?>