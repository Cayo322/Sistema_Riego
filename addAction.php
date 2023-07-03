<html>

<head>
	<title>Add Data</title>
</head>

<body>
	<?php
	// Include the database connection file
	require_once("dbConnection.php");

	if (isset($_POST['submit'])) {
		// Escape special characters in strings for use in SQL statement	
		$nombre = mysqli_real_escape_string($mysqli, $_POST['nombre']);
		$descripcion = mysqli_real_escape_string($mysqli, $_POST['descripcion']);

		// Check for empty fields
		if (empty($nombre) || empty($descripcion) || empty($_FILES['imagen']['name'])) {
			if (empty($nombre)) {
				echo "<font color='red'>Nombre field is empty.</font><br/>";
			}

			if (empty($descripcion)) {
				echo "<font color='red'>Descripción field is empty.</font><br/>";
			}

			if (empty($_FILES['imagen']['name'])) {
				echo "<font color='red'>Imagen field is empty.</font><br/>";
			}

			// Show link to the previous page
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		} else {
			// If all the fields are filled (not empty) 

			// Handle image upload
			$targetDir = "uploads/"; // Directory where the image will be stored
			$targetFile = $targetDir . basename($_FILES["imagen"]["name"]); // Path of the image file
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["imagen"]["tmp_name"]);
			if ($check === false) {
				echo "File is not an image.";
				$uploadOk = 0;
			}

			// Check if file already exists
			if (file_exists($targetFile)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}

			// Check file size
			if ($_FILES["imagen"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}

			// Allow only specific file formats
			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			} else {
				// If everything is ok, move the uploaded file to the target directory
				if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
					// Insert data into database
					$result = mysqli_query($mysqli, "INSERT INTO sistema_planta (`nombre`, `descripcion`, `imagen`) VALUES ('$nombre', '$descripcion', '$targetFile')");

					// Display success message
					echo "<p><font color='green'>Data added successfully!</p>";
					echo "<a href='index.php'>View Result</a>";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
		}
	}
	?>
</body>

</html>