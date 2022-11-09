<?php include 'includes/connection.php';?>
<?php include 'includes/adminheader.php';?>
<?php
if (isset($_GET['post'])) {
	$post = mysqli_real_escape_string($conn, $_GET['post']);  
}
else {
    header('location:movilidades.php');
}
$currentuser = $_SESSION['firstname'];
if ($_SESSION['role'] == 'superadmin') {
$query = "SELECT * FROM movilidad WHERE id='$post'";
}
else {
    $query = "SELECT * FROM movilidad WHERE id='$post' AND author = '$currentuser'" ;
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
    $post_modalidad = $row['modalidad'];
    $post_status = $row['status'];
    

	?>
   
    <div id="wrapper">
       <?php include 'includes/adminnav.php';?>
    <div id="page-wrapper">


    <div class="container-fluid">
    <div class="container">

        <div class="row">

            
            <div class="col-lg-8">

                
                <hr>
	       		<p><h2><a href="#"><?php echo $post_actividad; ?></a></h2></p>
	       		<p><h2><i class="fa-solid fa-person"></i><span class=""><?php echo $post_author; ?></span></h2>
                <p><h3>Movilidad <a href="#"><?php echo $post_descripcion; ?></a></h3></p>
                <p>Modalidad: <?php echo $post_tipo_movilidad;?> -  <?php $post_modalidad;?></p>
                <p>Lugar: <?php echo $post_lugar;?></p>
                <p><span class="glyphicon glyphicon-time"></span>Fecha de inicio de movilidad <?php echo $post_fecha_inicio; ?></p>
                <p><span class="glyphicon glyphicon-time"></span>Fecha de fin de movilidad <?php echo $post_fecha_fin; ?></p>
				<p>Institución: <?php echo $post_instituto; ?></p>
                <p>Ciudad: <?php echo $post_ciudad; ?></p>
                <p>Dependencia: <?php echo $post_modalidad;?></p>
                <p>Estado de la movilidad: <?php 
                if($post_status == 'published'){
                    echo "Aprobado y Publicado";
                }else{
                    echo "Pendiente, No publicado";
                }
                
                ?></p>
				
                <hr>

                <hr>
                <?php } }
                else { echo"<div class='alert alert-danger' role='alert'>
  This is a danger alert with <a href='#' class='alert-link'>Error link</a>Intenta mas tarde.</div>"; } ?>
	        	
  </div>

           

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