<?php
// Challenge 2: 
// Create a MySQL table that holds a list of products (name, description, price, color).
// Create a form that allows users to select a color. 
// When they submit the color choice, display all products that are that color. 
// Bonus if you can dynamically generate the color choices in the form from all of the unique color options in the database.  
	$userColor = $_GET['userColor'];
	try {
	    // connecting to mysql database, use hardcoded vars, use default to limit database access
	    $conn = new PDO("mysql:dbname=lperez_Challenges;host=localhost", "r2hstudent", "SbFaGzNgGIE8kfP");
	    // use distinct to eliminate repeated values
	    $sth = $conn->prepare("SELECT DISTINCT Color FROM Products");
	    $sth->execute();
	    $colors = $sth->fetchAll(PDO::FETCH_ASSOC);
	    $query = "";
	    // show all products
	    if (empty($userColor) || $userColor == "Browse All") {
	    	$query = "SELECT * FROM Products";
	    } else{  //show products that match the user color selected
	    	$query = "SELECT * FROM Products WHERE Color = '{$userColor}'";
	    }
	    // using prepare(protects from SQL injections) to build select statement so it can occur multiple times
	    $sth = $conn->prepare($query);
	    // execute runs prepared statement, but doesn't actually return data
	    $sth->execute();
	    // fetch returns the data
	    $products = $sth->fetchAll(PDO::FETCH_ASSOC);

	} catch(PDOException $e) {  // catches exceptions (unsuccessful)
	   echo "Connection failed: " . $e->getMessage();
	}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Challenge 2</title>
		<link rel="stylesheet" type="text/css" href="./lib/css/mysqlStyles.css">
	</head>
	<body style="background: lavender">
		<h1 style="text-shadow: 2px 2px 1px grey">Welcome to Furniture Zone</h1>
		<form id="productTable" method="get" action="challenge2.php">
			<label for="userColor">What color do you prefer your furniture in?</label>

			<!-- create select dropdown with mysql data -->
			<select id='userColor' name='userColor'>
			<option>Browse All</option>
				<?php foreach($colors as $color): ?>
					<!-- add selected to option to show it in dropdown -->
					<option <?= ($userColor == $color['Color'] ?'selected' : '') ?> value='<?= $color['Color'] ?>'>
					<?= $color['Color'] ?>
					</option>
				<?php endforeach; ?>
			</select>

			<div class="submitBtn" style="margin-top: 2%">
				<button type='submit'>Submit</button>
			</div>
		</form>
		<h1>Results for <?= htmlspecialchars($userColor)?></h1>
      <table>
        <tr >
          <th>Name</th>
          <th>Description</th>
          <th>Price</th> 
          <th>Color</th>
        </tr>
        <?php foreach($products as $product): ?>
        <tr >
          <td><?= $product['Name'] ?></td>
          <td><?= $product['Description'] ?></td>
          <td>$<?= $product['Price'] ?></td>
          <td><?= $product['Color'] ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
      <button>
      	<a href="challenge3_post.php">Suggest a product</a> 
      </button>
	</body>
</html>

