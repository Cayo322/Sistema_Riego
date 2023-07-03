<?php
// Include the database connection file
require_once("dbConnection.php");

// Get id from URL parameter
$id = $_GET['id'];

// Select data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM sistema_planta WHERE id = $id");

// Fetch the next row of a result set as an associative array
$resultData = mysqli_fetch_assoc($result);

$nombre = $resultData['nombre'];
$descripcion = $resultData['descripcion'];
?>

<!DOCTYPE html>
<html>
<head>	
	<title>Edit Data</title>
	<!-- Agrega la hoja de estilos de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<h2>Edit Data</h2>
		<p>
			<a href="index.php">Home</a>
		</p>
		
		<form name="edit" method="post" action="editAction.php" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="nombre" class="form-label">Nombre</label>
						<input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<label for="descripcion" class="form-label">Descripción</label>
						<textarea class="form-control" name="descripcion"><?php echo $descripcion; ?></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<button type="submit" class="btn btn-primary" name="update">Update</button>
				</div>
			</div>
		</form>
	</div>

	<!-- Agrega jQuery (Bootstrap v5.1.0 requiere jQuery) -->
	<script src="ruta/a/jquery.min.js"></script>

	<!-- Agrega el archivo JavaScript de Bootstrap -->
	<script src="ruta/a/bootstrap.min.js"></script>
</body>
</html>
