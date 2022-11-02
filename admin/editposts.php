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
    $query = "SELECT * FROM evidencia WHERE id='$id'";
}
else {
    $query = "SELECT * FROM evidencia WHERE id='$id' AND author = '$currentuser'" ;
}
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0 ) {
while ($row = mysqli_fetch_array($run_query)) {
	$post_id = $row['id'];
	$post_movilidad_ev = $row['movilidad'];
	$post_descripcion = $row['descripcion'];
	//$post_author = $row['author'];
	//$post_date = $row['postdate'];
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
    $post_title = $validated_data['title'];
      $post_tag = $validated_data['tags'];
      $post_content = $validated_data['content'];
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
  
        $queryupdate = "UPDATE evidencia SET title = '$post_title' , tag = '$post_tag' , content='$post_content' , 	status = '$post_status' , image = '$picture' , postdate = '$post_date' WHERE id= '$post_id' " ;
        $result = mysqli_query($conn , $queryupdate) or die(mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
        	echo "<script>alert('Evidencia actualizada satisfactoriamente');
        	window.location.href= 'posts.php';</script>";
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
                <div class="row my-1">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            ACTUALIZAR MOVILIDAD 
                        </h1>
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
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
           	    $post_descripción_mov = $row['descripcion_actividad'];
           	    $post_ciudad = $row['ciudad'];
           	    echo "<option value='$post_id' $post_id == $post_movilidad_ev ? print'selected'> $post_actividad.' '.$post_descripción_mov.' - '.$post_ciudad </option>";
           	
       		   }
            }
            
            else {
                echo "<script>alert('No hay movilidades aún, crea una movilidad primero');
                window.location.href= 'publishmovilidades.php';</script>";
            }
           	    ?>
           	    
			
		</select>
    </div>

	<div class="input-group">
		<label for="post_status">Estado</label>
			<select name="status" class="form-control">
			<?php if($_SESSION['role'] == 'user') { echo "<option value='draft' >draft</option>"; } else { ?> 
        <option value="<?php  echo $post_status; ?>"><?php  echo  $post_status;  ?></option>>
			<?php
if ($post_status == 'published') {
	echo "<option value='draft'>Draft</option>";
} else {
	echo "<option value='published'>Publish</option>";
}
?>
<?php
}
?>


</select>
	</div>

    <div class="form-group">
        <label for="post_image">Imagen</label>
		<img class="img-responsive" width="200" src="../allpostpics/<?php echo $post_image; ?>" alt="Photo">
		<input type="file" name="image"> 
    </div>
	<div class="form-group">
		<label for="post_descripcion">Descripción:</label>
		<textarea  class="form-control" name="post_descripcion" id="" cols="30" rows="10"><?php  echo $post_descripcion;  ?>
		</textarea>
	</div>

	<button type="submit" name="update" class="btn btn-primary" value="Update Evidencia">Actualizar evidencia</button>
</form>
</div>
</div>
</div>
</div>
</div>

<?php include 'includes/adminfooter.php';?>
    <script src="js/jquery.js"></script>

  
    <script src="js/bootstrap.min.js"></script>

</body>

</html>