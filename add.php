<!DOCTYPE html>
<html>

<head>
	<title>Add Data</title>
	<!-- Links de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
		if (empty($nombre) || empty($descripcion)) {
			if (empty($nombre)) {
				echo "<font color='red'>Nombre field is empty.</font><br/>";
			}

			if (empty($descripcion)) {
				echo "<font color='red'>Descripción field is empty.</font><br/>";
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

	<div class="container">
		<form action="add.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="nombre" class="form-label">Nombre</label>
						<input type="text" class="form-control" name="nombre" id="nombre">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="descripcion" class="form-label">Descripción</label>
						<input type="text" class="form-control" name="descripcion" id="descripcion">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="imagen" class="form-label">Imagen</label>
						<input type="file" class="form-control" name="imagen" id="imagen">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<input type="submit" name="submit" value="Agregar" class="btn btn-primary">
				</div>
			</div>
		</form>
	</div>

	<!-- Scripts de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>