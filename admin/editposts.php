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
    $query = "SELECT m.actividad, m.author, e.id, e.movilidad, e.image, e.descripcion, e.updated_on, e.status FROM evidencia as e INNER JOIN movilidad as m ON m.id = e.movilidad WHERE e.id = '$id';";
}
else {
    $query = "SELECT m.actividad, m.author, e.id, e.movilidad, e.image, e.descripcion, e.updated_on, e.status FROM evidencia as e INNER JOIN movilidad as m ON m.id = e.movilidad WHERE m.author = '$currentuser' AND e.id = '$id';" ;
}
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0 ) {
    while ($row = mysqli_fetch_array($run_query)) {
        $post_id = $row['id'];
        $post_movilidad_actividad = $row['actividad'];
        $post_descripcion = $row['descripcion'];
        $post_author = $row['author'];
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
                $post_descripcion = $_POST['post_descripcion'];
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

                $queryupdate = "UPDATE evidencia SET image = '$picture', descripcion = '$post_descripcion' WHERE id= '$post_id'; " ;
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

                        <h2>Movilidad: <span><?php echo $post_author." : ". $post_movilidad_actividad;   ?></span></h2>


                        <div class="form-group">
                            <label for="post_image">Imagen</label>
                            <img class="img-responsive" width="200" src="../allpostpics/<?php echo $post_image; ?>" alt="Photo">
                            <input type="file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="post_descripcion">Descripción:</label>
                            <textarea  class="form-control" name="post_descripcion" id="post_descripcion" cols="30" rows="10"><?php  echo $post_descripcion;  ?>
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