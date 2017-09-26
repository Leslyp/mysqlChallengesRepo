<?php  
  $name = $_GET['name'];
  $description = $_GET['description'];
  $price = $_GET['price'];
  $color = $_GET['color'];

	try {
    // connecting to mysql database, use hardcoded vars, use default to limit database access
    $conn = new PDO("mysql:host=localhost;dbname=Challenges;port=3306", "default", "eB0pBlUcnSZNpdNh");
	
	} catch(PDOException $e) {  // catches exceptions (unsuccessful)
	   echo "Connection failed: " . $e->getMessage();
	}

	if(isset($_GET['submit'])) {
    try {
      $sql = "INSERT INTO Products (Name, ProductId, Description, Price, Color) ";
      $sql .= "VALUES(:name, NULL, :description, :price, :color)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':name',$name);
      $stmt->bindParam(':description',$description);
      $stmt->bindParam(':price',$price);
      $stmt->bindParam(':color',$color);
      $stmt->execute();   
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
	}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Challenge 3</title>
  </head>
  <body>
    <form id="productTable" method="GET" action="">
    <!-- form area to add new products -->
    <h2>Suggest a product:</h2>
    <div style="margin-bottom: 30px">
      <label for="name">Product Name:</label>
      <input type="text" name="name" id="name">
    </div>

    <div style="margin-bottom: 30px">
      <label for="description">Product Description:</label>
      <input type="text" name="description" id="description">
    </div>
      
    <div style="margin-bottom: 30px">
      <label for="price">Product Price:</label>
      <input type="text" name="price" id="price">
    </div>

    <div style="margin-bottom: 30px">
      <label for="color">Product Color:</label>
      <input type="text" name="color" id="color">
    </div> 
    
    <div class="submitBtn" style="margin-top: 2%">
      <button type='submit' name="submit" value="submit">Submit</button>
    </div>
  </form>

  <div>
  	<a href="challenge2.php">Back to Home Page</a> 
  </div> 
  </body>
</html>


