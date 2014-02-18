<?php

echo "<p>GET:</p>";
var_dump($_GET);

echo "<p>POST:</p>";
var_dump($_POST);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My First HTML Form</title>
</head>
<body>
	
	<h2>User Login</h2>
	<form method="POST" action="">
	    <p>
	        <label for="username">Username</label>
	        <input id="username" name="username" placeholder="Username Here" type="text">
	    </p>
	    <p>
	        <label for="password">Password</label>
	        <input id="password" name="password" placeholder="Password Here" type="password">
	    </p>
	    <p>
	        <button type="submit">Login</button>
	    </p>
	</form>

	<h2>Compose an Email</h2>
	<form method="POST" action="">
		<p>
			<label for"recipient">To:</label>
			<input id="recipient" name="recipient" placeholder="Recipient Email" type="text">
		</p>
		<p>
			<label for"sender">From:</label>
			<input id="sender" name="sender" placeholder="Sender Email" type="text">
		</p>
		<p>
			<label for"subject">Subject:</label>
			<input id="subject" name="subject" placeholder="Subject" type="text">
		</p>
		<p>
			<textarea id="emailBody" name="emailBody" placeholder="Type message here..." rows="30" cols="50"></textarea>
		</p>
		<p>
			<label for="copyEmail">
				<input id="copyEmail" name="copyEmail" type="checkbox" value="yes" checked> Do you want to save a copy of your email?
			</label>
		</p>
		<p>
			<button type="submit">Send Email</button>
		</p>
	</form>

	<h2>Multiple Choice Test</h2>
	<form method="POST" action="">
		
		<p>What's your favorite US state?</p>
		<label for="q1a">
    		<input type="radio" id="q1a" name="q1" value="Texas">TEXAS
		</label>
		<label for="q1b">
    		<input type="radio" id="q1b" name="q1" value="Texas">TEXAS
		</label>
		<label for="q1c">
    		<input type="radio" id="q1c" name="q1" value="Texas">TEXAS
		</label>
		<label for="q1d">
   		 	<input type="radio" id="q1d" name="q1" value="Texas">TEXAS
		</label>
	
		<p>What's your favorite color?</p>
		<label for="q1a">
    		<input type="radio" id="q1a" name="q2" value="purple">Purple
		</label>
		<label for="q1b">
    		<input type="radio" id="q1b" name="q2" value="green">Green
		</label>
		<label for="q1c">
    		<input type="radio" id="q1c" name="q2" value="aqua">Aqua
		</label>
		<label for="q1d">
   		 	<input type="radio" id="q1d" name="q2" value="Yellow">Yellow
		</label>

		<p>
			<label for="dayOfWeek">What is your favorite day of the week?</label>
				<select id="dayOfWeek" name="dayOfWeek[]" multiple>
					<option value="monday">Monday</option>
					<option value="tuesday">Tuesday</option>
					<option value="wedensday">Wednesday</option>
					<option value="thursday">Thursday</option>
					<option value="friday">Friday</option>
					<option value="saturday">Saturday</option>
					<option value="sunday">Sunday</option>
				</select>
		</p>
		<p>
		<button type="submit">Submit Answers</button>
		</p>

	</form>

	<h2>Select Testing:</h2>
	<form method="POST" action="">
		<label for="drivecar">Do you drive a car?</label>
		<select id="drivecar" name="drivecar">
			<option value=1>Yes</option>
			<option value=0>No</option>
		</select>

		<button type="submit">Submit Answer</button>
	</form>

</body>
</html>