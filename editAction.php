<?php
// Include the database connection file
require_once("dbConnection.php");

if (isset($_POST['update'])) {
	// Escape special characters in a string for use in an SQL statement
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
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
		
	} else {
		// Update the database table
		$result = mysqli_query($mysqli, "UPDATE sistema_planta SET `nombre` = '$nombre', `descripcion` = '$descripcion' WHERE `id` = $id");

		// Display success message
		echo "<p><font color='green'>Data updated successfully!</p>";
		echo "<a href='index.php'>View Result</a>";
	}
}
?>
