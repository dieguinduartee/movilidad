<?php include 'includes/adminheader.php';

?>
    <div id="wrapper">

       <?php include 'includes/adminnav.php';?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header colores">
                            Publicar Evidencia
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
      $post_movilidad = $_POST['post_movilidad'];
      $post_descripcion = $_POST['post_descripcion'];
}
else {
    $post_movilidad = $validated_data['post_movilidad'];
    $post_descripcion = $validated_data['post_descripcion'];
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
            $query = "INSERT INTO evidencia (movilidad,descripcion,image,status) VALUES ('$post_movilidad' , '$post_descripcion' , '$picture' , '$post_status') ";
            $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script> alert('Evidencia publicada con éxito. Se publicará después de que el administrador lo apruebe');
                window.location.href='posts.php';</script>";
            }
            else {
                "<script> alert('Error al publicar ... intente de nuevo');</script>";
            }
        }
    }
}
}
?>

<form role="form" action="" method="POST" enctype="multipart/form-data" class="colores">

    <div class="form-group">
        <label for="post_movilidad">Movilidad</label>
        <?php $post_author = $_SESSION['firstname']; ?>
        <?php $query = "SELECT id, actividad, descripcion_actividad, ciudad FROM movilidad  WHERE author = '$post_author' ORDER BY id DESC";
            $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($run_query) > 0) {
        ?>
        
       	<select class="form-control" name="post_movilidad" id="post_movilidad">
       		<?php 
       		while ($row = mysqli_fetch_array($run_query)) {
           	    $post_id = $row['id'];
           	    $post_actividad = $row['actividad'];
           	    $post_descripción = $row['descripcion_actividad'];
           	    $post_ciudad = $row['ciudad'];
           	    echo "<option value='$post_id'> $post_actividad.' '.$post_descripción.' - '.$post_ciudad </option>";
           	
       		   }
            }
            
            else {
                echo "<script>alert('No hay movilidades aún, crea una movilidad primero');
                window.location.href= 'publishmovilidades.php';</script>";
            }
           	    ?>
           	    
			
		</select>
    </div>

    
    <div class="form-group">
        <label for="post_image">Imagen </label> <font color='brown' > &nbsp;&nbsp;(Tamaño máximo permitido 1024 Kb) </font> 
        <input type="file" name="image" >
    </div>
    <div class="form-group">
        <label for="post_descripcion">Descripción</label>
        <textarea class="form-control" name="post_descripcion"  id="" cols="30" rows="15" ><?php if(isset($_POST['post_descripcion'])) { echo $post_descripcion; } ?></textarea>
    </div>
<button type="submit" name="publish" class="btn btn-primary" value="Subir Evidencia">Compartir</button>

</form>

 </div>
                </div>
                
            </div>

        </div>
        
</div>
<?php include 'includes/adminfooter.php';

?>

    <script src="js/jquery.js"></script>

  
    <script src="js/bootstrap.min.js"></script>

</body>

</html>