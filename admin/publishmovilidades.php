<?php include 'includes/adminheader.php';

?>
    <div id="wrapper">

       <?php include 'includes/adminnav.php';?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Agregar Movilidad
                        </h1>
<?php
if (isset($_POST['publish'])) {
require "../gump.class.php";
$gump = new GUMP();
$_POST = $gump->sanitize($_POST); 

$gump->validation_rules(array(
    //'title'    => 'required|max_len,120|min_len,15',
  //  'tags'   => 'required|max_len,100|min_len,3',
   // 'content' => 'required|max_len,20000|min_len,150',
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
    $post_actividad = $_POST['actividad'];
      $post_descripcion = $_POST['descripcion'];
      $post_lugar = $_POST['lugar'];
      $post_tipo_movilidad = $_POST['tipo_movilidad'];
      $post_instituto = $_POST['instituto'];
      $post_fecha_inicio = $_POST['fecha_inicio'];
      $post_fecha_fin = $_POST['fecha_fin'];
      $post_ciudad = $_POST['ciudad'];
      $post_dependencia = $_POST['dependencia'];
}
else {
    $post_actividad = $_POST['actividad'];
    $post_descripcion = $_POST['descripcion'];
    $post_lugar = $_POST['lugar'];
    $post_tipo_movilidad = $_POST['tipo_movilidad'];
    $post_instituto = $_POST['instituto'];
    $post_fecha_inicio = $_POST['fecha_inicio'];
    $post_fecha_fin = $_POST['fecha_fin'];
    $post_ciudad = $_POST['ciudad'];
    $post_dependencia = $_POST['dependencia'];
if (isset($_SESSION['firstname'])) {
        $post_author = $_SESSION['firstname'];
    }
    $post_date = date('Y-m-d');
    $post_status = 'draft';
    

    $image = $_FILES['image']['name'];
    $ext = $_FILES['image']['type'];
    $validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
    if (empty($image)) {
echo "<script>alert('Adjunta una imagen');</script>";
    }
    else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
    {
echo "<script>alert('El tamaño de la imagen no es correcto');</script>";
    }
    else if (!in_array($ext, $validExt)){
        echo "<script>alert('No es una imagen válida.');</script>";

    }
    else {
        $folder  = '../allpostpics/';
        $imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
        $picture = rand(1000 , 1000000) .'.'.$imgext;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture)) {
            $query = "INSERT INTO posts (author,actividad,descripcion_actividad, lugar, tipo_movilidad, instituto,fecha_inicio, fecha_fin, ciudad, dependencia,postdate,image,status) VALUES ('$post_author','$post_actividad' , '$post_descripcion' , '$post_lugar', '$post_tipo_movilidad', '$post_instituto','$post_fecha_inicio', '$post_fecha_fin', '$post_ciudad', '$post_dependencia',  '$post_date' , '$picture'  , '$post_status') ";
            $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script> alert('Movilidad publicada con éxito. Se publicará después de que el administrador lo apruebe');
                window.location.href='movilidades.php';</script>";
            }
            else {
                "<script> alert('Error al agregar movilidad ... intente de nuevo');</script>";
            }
        }
    }
}
}
?>

<form role="form" action="" method="POST" enctype="multipart/form-data">
		
	<div class="form-group">
		<label for='lugar'>Lugar</label>
		<select class="form-control" name="lugar" id="lugar">
			<option value='local'>Local</option>
			<option value='nacional'>Nacional</option>
			<option value='internacional'>Internacional</option>
		</select>
	</div>
	
	<div class="form-group">
		<label for='tipo_movilidad'>Tipo de Movilidad</label>
		<select class="form-control" name="tipo_movilidad" id="tipo_movilidad">
			<option value='Entrante'>Entrante</option>
			<option value='Saliente'>Saliente</option>
		</select>
	</div>

    <div class="form-group">
        <label for="post_actividad">Actividad</label>
        <input type="text" name="actividad" placeholder = "Ingresa la actividad " value= "<?php if(isset($_POST['actividad'])) { echo $post_actividad; } ?>"  class="form-control" required>
    </div>

	<div class="form-group">
        <label for="post_descripcion">descripción</label>
        <input type="text" name="descripcion" placeholder = "Ingresa la descripción " value= "<?php if(isset($_POST['descripcion'])) { echo $post_descripcion; } ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_instituto">Instituto</label>
        <input type="text" name="instituto" placeholder = "Ingresa la institución " value= "<?php if(isset($_POST['institucion'])) { echo $post_instituto; } ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_fecha_inicio">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" placeholder = "Ingresa la fecha de inicio " value= "<?php if(isset($_POST['fecha_inicio'])) { echo $post_fecha_inicio; } ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_fecha_fin">Fecha Fin</label>
        <input type="date" name="fecha_fin" placeholder = "Ingresa la fecha de fin " value= "<?php if(isset($_POST['fecha_fin'])) { echo $post_fecha_fin; } ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_ciudad">Ciudad</label>
        <input type="text" name="ciudad" placeholder = "Ingresa la Ciudad " value= "<?php if(isset($_POST['ciudad'])) { echo $post_ciudad; } ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_dependencia">Dependencia</label>
        <input type="text" name="dependencia" placeholder = "Ingresa la dependencia " value= "<?php if(isset($_POST['dependencia'])) { echo $post_dependencia; } ?>"  class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="post_image">Evidencia </label> <font color='brown' > &nbsp;&nbsp;(Tamaño máximo permitido 1024 Kb) </font> 
        <input type="file" name="image" >
    </div>

<button type="submit" name="publish" class="btn btn-primary" value="Publish Post">Agregar Movilidad</button>

</form>

 </div>
                </div>
                
            </div>

        </div>
        
   <?php 'includes/admin_footer.php';?>
    </div>
    
    <script src="js/jquery.js"></script>

    
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
