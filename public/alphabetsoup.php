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

<!DOCTYPE html>
<html>
<head>
	<title>Alphabet Soup</title>
	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<!-- JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!-- 	// <script src="/js/animate.js"></script> -->
	<script src="/js/lettering.min.js"></script>
	<script src="/js/textillate.js"></script>
</head>
<body>
<div class="container">
	<h1>Alphabet Soup</h1>

	<form role="form" method="GET">
	  <div class="form-group">
	    <label for="userPhrase">Phrase</label>
	    <input type="text" class="form-control" id="userPhrase" placeholder="Enter word or phrase">
	  </div>
	  <button type="submit" id="soupit" class="btn btn-default" >Soup It</button>
	</form>

	<div id="soup"></div>
</div>

<script>
	var soupIt = $('#userPhrase').val();
	console.log(soupIt);
	var souped = '';

	$('#soupit').click(function() {
		var splitSoup = str.split(soupIt, '').length;
		// for (i = 0; i > = soupIt.length; i++) {

		// }

	});

</script>

</body>
</html>