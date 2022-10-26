<?php include 'includes/connection.php';?>
<?php include 'includes/adminheader.php';?>
<?php
if (isset($_GET['id'])) {
	$id = mysqli_real_escape_string($conn, $_GET['id']);  
}
else {
	header('location:posts.php');
}
$currentuser = $_SESSION['firstname'];
if ($_SESSION['role'] == 'superadmin') {
$query = "SELECT * FROM posts WHERE id='$id'";
}
else {
    $query = "SELECT * FROM posts WHERE id='$id' AND author = '$currentuser'" ;
}
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0 ) {
while ($row = mysqli_fetch_array($run_query)) {    
    $post_id = $row['id'];
    $post_author = $row['author'];
    $post_lugar = $row['lugar'];
    $post_actividad = $row['actividad'];
    $post_descripcion = $row['descripcion_actividad'];
    $post_tipo_movilidad = $row['tipo_movilidad'];
    $post_instituto = $row['instituto'];
    $post_fecha_inicio = $row['fecha_inicio'];
    $post_fecha_fin = $row['fecha_fin'];
    $post_ciudad = $row['ciudad'];
    $post_dependencia = $row['dependencia'];
    $post_image = $row['image'];
    $post_status = $row['status'];

if (isset($_POST['update'])) {
require "../gump.class.php";
$gump = new GUMP();
$_POST = $gump->sanitize($_POST); 

$gump->validation_rules(array(
  //  'title'    => 'required|max_len,120|min_len,15',
   // 'tags'   => 'required|max_len,100|min_len,3',
   // 'content' => 'required|max_len,10000|min_len,150',
));
$gump->filter_rules(array(
    'title' => 'trim|sanitize_string',
    'tags' => 'trim|sanitize_string',
    ));
$validated_data = $gump->run($_POST);

if($validated_data === false) {
    ?>
    <center><font color="red" > <?php echo $gump->get_readable_errors(true); ?> </font></center>
    <?php 
}
else {
    $post_actividad = $validated_data['actividad'];
      $post_descripcion = $validated_data['descripcion'];
      $post_dependencia = $validated_data['dependencia'];
    $post_date = date('Y-m-d');
    if ($_SESSION['role'] == 'user') {
    	$post_status = 'draft';
    } else {
    $post_status = $_POST['status'];
}

    

    $image = $_FILES['image']['name'];
    $ext = $_FILES['image']['type'];
    $validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
    if (empty($image)) {
    	$picture = $post_image;
    }
    else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
    {
echo "<script>alert('Tamaño de imagen incorrecto');
window.location.href = 'editposts.php?id=$id';</script>";
    
    }
    else if (!in_array($ext, $validExt)){
        echo "<script>alert('Imagen no válida');
        window.location.href = 'editposts.php?id=$id';</script>";
    exit();
    }
    else {
        $folder  = '../allpostpics/';
        $imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
        $picture = rand(1000 , 1000000) .'.'.$imgext;
        move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture);
    }
  
        $queryupdate = "UPDATE posts SET actividad = '$post_actividad' , descripcion_actividad = '$post_descripcion' , lugar='$post_lugar' , tipo_movilidad = '$post_tipo_movilidad', instituto = '$post_instituto', fecha_inicio = '$post_fecha_inicio', fecha_fin = '$post_fecha_fin', ciudad = '$post_ciudad', dependencia = '$post_dependencia', 	status = '$post_status' , image = '$picture' , postdate = '$post_date' WHERE id= '$post_id' " ;
        $result = mysqli_query($conn , $queryupdate) or die(mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
        	echo "<script>alert('Publicación actualizada satisfactoriamente');
        	window.location.href= 'movilidades.php';</script>";
        }
        else {
        	echo "<script>alert('Error! .. vuélvelo a intentar');</script>";
}
}
}
}
}
?>

<div id="wrapper">

       <?php include 'includes/adminnav.php';?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            MODIFICAR MOVILIDAD 
                        </h1>
                        <form role="form" action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label for='lugar'>Lugar</label>
		<select class="form-control" name="lugar" id="lugar">
			<option value='local' <?php $post_lugar == "local" ? print"selected": print"";?>>Local</option>
			<option value='nacional' <?php $post_lugar == "nacional" ? print"selected": print"";?>>Nacional</option>
			<option value='internacional' <?php $post_lugar == "internacional" ? print"selected": print"";?>>Internacional</option>
		</select>
	</div>
	
	<div class="form-group">
		<label for='tipo_movilidad'>Tipo de Movilidad</label>
		<select class="form-control" name="tipo_movilidad" id="tipo_movilidad">
			<option value='Entrante' <?php $post_tipo_movilidad == "Entrante" ? print"selected": print"";?>>Entrante</option>
			<option value='Saliente' <?php $post_tipo_movilidad == "Saliente" ? print"selected": print"";?>>Saliente</option>
		</select>
	</div>

    <div class="form-group">
        <label for="post_actividad">Actividad</label>
        <input type="text" name="actividad" placeholder = "Ingresa la actividad " value= "<?php echo $post_actividad;  ?>"  class="form-control" required>
    </div>

	<div class="form-group">
        <label for="post_descripcion">descripción</label>
        <input type="text" name="descripcion" placeholder = "Ingresa la descripción " value= "<?php echo $post_descripcion;  ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_instituto">Instituto</label>
        <input type="text" name="instituto" placeholder = "Ingresa la institución " value= "<?php  echo $post_instituto;  ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_fecha_inicio">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" placeholder = "Ingresa la fecha de inicio " value= "<?php echo $post_fecha_inicio;  ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_fecha_fin">Fecha Fin</label>
        <input type="date" name="fecha_fin" placeholder = "Ingresa la fecha de fin " value= "<?php echo $post_fecha_fin;  ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_ciudad">Ciudad</label>
        <input type="text" name="ciudad" placeholder = "Ingresa la Ciudad " value= "<?php echo $post_ciudad;  ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_dependencia">Dependencia</label>
        <input type="text" name="dependencia" placeholder = "Ingresa la dependencia " value= "<?php echo $post_dependencia; ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_image">Evidencia </label> <font color='brown' > &nbsp;&nbsp;(Tamaño máximo permitido 1024 Kb) </font> 
        <input type="file" name="image" >
    </div>
	
	<button type="submit" name="update" class="btn btn-primary" value="Update Post">Modificar movilidad</button>
</form>
</div>
</div>
</div>
</div>
</div>

<script src="js/jquery.js"></script>

    
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

