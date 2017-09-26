<?php

/*Challenge 1: Create a MySQL table that holds a record for each state. 
Create an html form that has a select field with all of the US states.
Generate the states using PHP/MySQL. */

	try {
		// connecting to mysql database, use hardcoded vars, use default to limit database access
	  $conn = new PDO("mysql:dbname=lperez_Challenges;host=localhost", "r2hstudent", "SbFaGzNgGIE8kfP");
	  

	  // using prepare(protects from SQL injections) to build select statement so it can occur multiple times
	  $sth = $conn->prepare("SELECT State, StateId FROM States");
	  // execute runs prepared statement, but doesn't actually return data
	  $sth->execute();
	  // fetch returns the data
	 	$states = $sth->fetchAll(PDO::FETCH_ASSOC);

	} catch(PDOException $e) {  // catches exceptions (unsuccessful)
	   echo "Connection failed: " . $e->getMessage();
	}

?>

<!-- create form in html and use php / mysql to create dropdown -->
<!DOCTYPE html>
<html>
	<head>
		<title>Challenge 1</title>
	</head>
	<body>
		<form method='post' action='challenge1_post.php'>
			<label for='state'>Select a state:</label>
			<select id='state' name='state'>
				<?php foreach($states as $state): ?>
					<option value='<?= $state['State'] ?>'>
					<?= $state['State'] ?>
					</option>
				<?php endforeach; ?>
			</select>
			<div class="submitBtn" style="margin-top: 2%">
				<button type='submit'>Submit</button>
			</div>
		</form>
	</body>
</html>