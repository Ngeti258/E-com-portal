<!DOCTYPE html>
<html>
<head>
	<title>Add Product Form</title>
</head>
<body>
	<h2>Add Product Form</h2>
	<form method="post" enctype="multipart/form-data">
		<label>Product Name:</label>
		<input type="text" name="product_name"><br><br>

		<label>Product Type:</label>
		<input type="text" name="product_type"><br><br>

		<label>Price:</label>
		<input type="text" name="price"><br><br>

		<label>Quantity:</label>
		<input type="text" name="quantity"><br><br>

		<label>Product Image:</label>
		<input type="file" name="product_image"><br><br>

		<input type="submit" name="submit" value="Add Product">
	</form>

	<?php
	// Check if the form is submitted
	if (isset($_POST['submit'])) {

		// Get the form data
		$product_name = $_POST['product_name'];
		$product_type = $_POST['product_type'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];

		// Check if the product image is uploaded
        if (isset($_FILES['product_image'])) {
            $product_image = $_FILES['product_image']['name'];
            $tmp_name = $_FILES['product_image']['tmp_name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($product_image);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
            // Check if the uploaded file is an image
            $check = getimagesize($tmp_name);
            if($check === false) {
                $error = "File is not an image.";
            } else {
                // Check if the file already exists in the target directory
                if (file_exists($target_file)) {
                    $error = "Sorry, file already exists.";
                } else {
                    // Check file size and file type
                    if ($_FILES["product_image"]["size"] > 500000) {
                        $error = "Sorry, your file is too large.";
                    } elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    } else {
                        // Move the uploaded file to the target directory
                        if (move_uploaded_file($tmp_name, $target_file)) {
                            // The file has been uploaded successfully
                        } else {
                            $error = "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            }
        }
        

		// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "salesandmarketing";
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check if the connection is successful
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Insert the form data into the products table
		$sql = "INSERT INTO products (product_name, product_type, price, quantity,image)
				VALUES ('$product_name', '$product_type', '$price', '$quantity', '$product_image')";


		if ($conn->query($sql) === TRUE) {
			echo "Product added successfully.";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		// Close the database connection
		$conn->close();
	}
	?>
</body>
</html>
