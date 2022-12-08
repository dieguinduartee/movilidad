<?php include 'includes/adminheader.php';
?>
    <div id="wrapper">
<?php ?>
       <?php include 'includes/adminnav.php';?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        <div class="col-xs-4">
            <a href="publishnews.php" class="btn btn-primary">AGREGAR</a>
            </div>
                           TODAS LAS EVIDENCIAS
                        </h1>
                         

<?php if($_SESSION['role'] == 'superadmin')  
{ ?>
<div class="row">
<div class="col-lg-12">
        <div class="table-responsive">

<form action="" method="post">
            <table class="table table-bordered table-striped table-hover">


            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Movilidad</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Ver</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                        <th>Publicar</th>
                    </tr>
                </thead>
                <tbody>

                 <?php

$query = "SELECT m.actividad, m.descripcion_actividad, e.id, e.movilidad, e.image, e.descripcion, e.updated_on, e.status, m.author FROM evidencia as e INNER JOIN movilidad as m ON m.id = e.movilidad  ORDER BY e.id DESC;";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_movilidad = $row['movilidad'];
    $post_image = $row['image'];
    $post_descripcion = $row['descripcion'];
    $post_status = $row['status'];
    $post_actividad_movilidad = $row['actividad'];
    $post_autor_movilidad = $row['author'];

    echo "<tr>";
    echo "<td>$post_id</td>";
    echo "<td>$post_autor_movilidad - $post_actividad_movilidad</td>";
    echo "<td>$post_descripcion</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Imagen de evidencia' ></td>";
    echo "<td><a class='btn btn-success btn-sm' role='button' href='post.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a class='btn btn-primary btn-sm' role='button' href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class='btn btn-danger btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta evidencia?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>Eliminar</a></td>";
    if($post_status != 'published') {
        echo "<td><a class='btn btn-warning btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas publicar esta evidencia?')\"href='?pub=$post_id'><i class='fa fa-times' style='color: red;'></i>Publicar</a></td>";
    }else{
        echo "<td><a class='btn btn-warning btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas despublicar esta evidencia?')\"href='?despub=$post_id'><i class='fa fa-ban' style='color: red;'></i>Despublicar</a></td>";
    }
    echo "</tr>";

}
}
else {
    echo
    '<div class="alert alert-danger" role="alert">
  No hay evidencias aún!
  <script>window.location.href="publishnews.php";</script>
</div>';
}
?>


                </tbody>
            </table>
</form>
</div>
</div>
</div>

 <?php
    if (isset($_GET['del'])) {
        $post_del = mysqli_real_escape_string($conn, $_GET['del']);
        $del_query = "DELETE FROM evidencia WHERE id='$post_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo '<div class="alert alert-success" role="alert">
            Evidencia eliminada con exito <a href="#" class="alert-link">Mira tus evidencias!</a>..
          </div>
            <script>window.location.href="posts.php";</script>';
        }
        else {
         echo '<div class="alert alert-danger" role="alert">
           Una simple alerta danger con <a href="#" class="alert-link">un enlace de ejemplo</a>. Dale un clic si quieres.
         </div>';   
        }
        }
        if (isset($_GET['pub'])) {
        $post_pub = mysqli_real_escape_string($conn,$_GET['pub']);
        $pub_query = "UPDATE evidencia SET status='published' WHERE id='$post_pub'";
        $run_pub_query = mysqli_query($conn, $pub_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('publicado satisfactoriamente');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('Ocurrió un error. Intente nuevamente');</script>";   
        }
        }
    if (isset($_GET['despub'])) {
        $post_pub = mysqli_real_escape_string($conn,$_GET['despub']);
        $pub_query = "UPDATE evidencia SET status='draft' WHERE id='$post_pub'";
        $run_pub_query = mysqli_query($conn, $pub_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('despublicado satisfactoriamente');
            window.location.href='posts.php';</script>";
        }
        else {
            echo "<script>alert('Ocurrió un error. Intente nuevamente');</script>";
        }
    }

?>
<?php 
}
else if($_SESSION['role'] == 'admin') {
    ?>
    <div class="row">
<div class="col-lg-12">
        <div class="table-responsive">

<form action="" method="post">
            <table class="table table-bordered table-striped table-hover">


            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Autor</th>
                        <th>Movilidad</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Ver</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>

<?php
$currentuser = $_SESSION['firstname'];
$query = "SELECT m.actividad, m.descripcion_actividad, e.id, e.movilidad, e.image, e.descripcion, e.updated_on, e.status FROM evidencia as e INNER JOIN movilidad as m ON m.id = e.movilidad WHERE m.author = '$currentuser' ORDER BY e.id DESC;";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_movilidad = $row['movilidad'];
    $post_date = $row['postdate'];
    $post_image = $row['image'];
    $post_descripcion = $row['descripcion'];
    $post_status = $row['status'];
    $post_actividad_movilidad = $row['actividad'];

    echo "<tr>";
    echo "<td>$post_id</td>";
    echo "<td>$post_actividad_movilidad</td>";
    echo "<td>$post_descripcion</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Evidencia imagen' ></td>";
    echo "<td><a class='btn btn-success btn-sm' role='button' href='post.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a class='btn btn-primary btn-sm' role='button' href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class='btn btn-danger btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta evidencia?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>borrar</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('¡Aún no has subidos evidencia! Comienza a publicar ahora');
    window.location.href= 'publishnews.php';</script>";
}
?>


                </tbody>
            </table>
</form>
</div>
</div>
</div>

 <?php
    if (isset($_GET['del'])) {
        $post_del = mysqli_real_escape_string($conn, $_GET['del']);
        $del_query = "DELETE FROM evidencia WHERE id='$post_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Evidencia borrada satisfactoriamente');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('Ocurrió un error. Intente nuevamente!');</script>";   
        }
        }
        if (isset($_GET['pub'])) {
        $post_pub = mysqli_real_escape_string($conn,$_GET['pub']);
        $pub_query = "UPDATE evidencia SET status='published' WHERE id='$post_pub'";
        $run_pub_query = mysqli_query($conn, $pub_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('publicado satisfactoriamente');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('Ocurrió un error. Intente nuevamente!');</script>";   
        }
        }

        
        ?>
<?php 
}
else {
    ?>
<div class="row">
<div class="col-lg-12">
        <div class="table-responsive">

<form action="" method="post">
            <table class="table table-bordered table-striped table-hover">
 <thead>
                    <tr>
                        <th>ID</th>
                        <th>Movilidad</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Ver</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>

                 <?php
                 $currentuser = $_SESSION['firstname'];

$query = "SELECT e.id, e.movilidad, m.actividad, e.image, e.descripcion, e.updated_on, e.status FROM evidencia as e INNER JOIN movilidad as m ON m.id = e.movilidad WHERE m.author = '$currentuser' ORDER BY e.id DESC;";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_movilidad = $row['movilidad'];
    $post_image = $row['image'];
    $post_descripcion = $row['descripcion'];
    $post_status = $row['status'];
    $post_actividad_movilidad = $row['actividad'];

    echo "<tr>";
    echo "<td>$post_id</td>";
    echo "<td>$post_actividad_movilidad</td>";
    echo "<td>$post_descripcion</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Evidencia Imagen' ></td>";
    echo "<td><a class='btn btn-success btn-sm' role='button' href='post.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a class='btn btn-primary btn-sm' role='button' href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class='btn btn-danger btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta evidencia?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('¡Aún no has subido ninguna evidencia nada! Sube evidencias!');
    window.location.href= 'publishnews.php';</script>";
}
?>
 </tbody>
            </table>
</form>
</div>
</div>
</div>
<?php
    if (isset($_GET['del'])) {
        $post_del = mysqli_real_escape_string($conn , $_GET['del']);
        $del_query = "DELETE FROM evidencia WHERE id='$post_del';";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Evidencia eliminada con éxito');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('Ocurrió un error. Intenta nuevamente');</script>";   
        }
        }
        ?>
<?php    
}
?>
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

