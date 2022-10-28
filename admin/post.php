<?php include 'includes/connection.php';?>
<?php include 'includes/adminheader.php';?>
<?php
if (isset($_GET['post'])) {
	$post = mysqli_real_escape_string($conn, $_GET['post']);  
}
else {
    header('location:posts.php');
}
$currentuser = $_SESSION['firstname'];
if ($_SESSION['role'] == 'superadmin') {
    $query = "SELECT m.actividad, m.descripcion_actividad, e.id, e.movilidad, e.image, e.descripcion, e.updated_on, e.status FROM evidencia as e INNER JOIN movilidad as m ON m.id = e.movilidad WHERE e.id = $post  ORDER BY e.id DESC;";
}
else {
    $query = "SELECT m.actividad, m.descripcion_actividad, e.id, e.movilidad, e.image, e.descripcion, e.updated_on, e.status FROM evidencia as e INNER JOIN movilidad as m ON m.id = e.movilidad WHERE m.author = '$currentuser' ORDER BY e.id DESC;" ;
}
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0 ) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_actividad = $row['actividad'];
    $post_actividad_des = $row['descripcion_actividad']; 
    $post_movilidad = $row['movilidad'];
    $post_image = $row['image'];
    $post_descripcion = $row['descripcion'];
    $post_status = $row['status'];

	?>
   
    <div id="wrapper">
       <?php include 'includes/adminnav.php';?>
    <div id="page-wrapper">


    <div class="container-fluid">
    <div class="container">

        <div class="row">

            <h1>Evidencia de movilidad</h1>
            <div class="col-lg-8">

                
                <hr>
	       		<p><h2>Actividad: <a href="movilidad.php?post=<?php echo $post_movilidad;?>" class="enlace"><?php echo $post_actividad; ?></a></h2>
                <p><h3>Descripción: <?php echo $post_actividad_des; ?></h3>
               
                <img class="img-responsive img-rounded" src="../allpostpics/<?php echo $post_image; ?>" alt="900 * 300">
                <hr>
                <p><span class=""></span>Descripción de la evidencia: <?php echo $post_descripcion; ?></p>
                
                <p>Estado de la evidencia: <?php echo $post_status; ?></p>

                <hr>
                <?php } }
                else { echo"<script>alert('error');</script>"; } ?>
	        	
  </div>

           

        </div>
        </div>
        </div>
        </div>
        </div>

   
    <?php include ('includes/adminfooter.php');
    ?>
       <script src="js/jquery.js"></script>

  
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
   