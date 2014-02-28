<?php

class AddressDataStore {
    public $filename = '';
    public $entries = array();

    public function __construct($file = '') {
        $this->filename = $file;
    }

    public function readCSV() {
        // Open file for read
        // Iterate over CSV file
        // Create new instances of AddressEntry
        // Push each instance onto $entries array
        // Close file
    }

    public function writeCSV() {
        // Open file for write
        // Iterate over $entries
        // Call getArray() on each entry
        // fputcsv() array to file
        // Close file
    }

    // Push a new entry onto the $entries array
    public function addEntry(AddressEntry $entry) {
        // Push $entry onto $entries
    }

    // Remove a given entry from the $entries array
    public function removeEntry($index) {
        // Unset entry at $index
    }

    // Merge a second AddressDataStore into this one
    public function mergeAddressBooks(AddressDataStore $book) {

    }
}

class AddressEntry {
    public $name;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $phone;

    public $errors = array();

    // Take in array from CSV or POST & assign values
    public function __construct(array $values = array()) {
        //
    }

    // Return boolean: is entry valid?
    public function validate() {
        //
    }

    // Return values as an array for CSV output
    public function getArray() {

    }
}

?>