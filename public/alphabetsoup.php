<?php
	function alphabet_soup($str) {
		// split string by word into an array
		$strArray = str_word_count($str, 1);
		$soupSentence = '';
		// iterate over array 
		foreach($strArray as $word) {
			// split words into separate arrays and sort
			$wordArray = str_split($word);
			sort($wordArray);
			// implode them back to strings and add to empty soupSentence
			$word = implode('', $wordArray);
			$soupSentence .= $word . ' ';
			
		}
		return $soupSentence . PHP_EOL;
	}

	if(!empty($_GET)) {

	}
?>