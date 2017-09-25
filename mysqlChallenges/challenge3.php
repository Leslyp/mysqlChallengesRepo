<!-- Challenge 3: Create a form to add new products to the database. -->

<!DOCTYPE html>
<html>
  <head>
    <title>Challenge 3</title>
  </head>
  <body>
    <form id="productTable" method="GET" action="challenge3_post.php">
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
  </body>
</html>
