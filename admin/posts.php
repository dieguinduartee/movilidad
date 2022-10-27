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
                           TODAS LAS EXPERIENCIAS
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
                        <th>Autor</th>
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

$query = "SELECT * FROM evidencia ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_movilidad = $row['movilidad'];
    $post_author = $row['author'];
    $post_image = $row['image'];
    $post_descripcion = $row['descripcion'];
    $post_status = $row['status'];

    echo "<tr>";
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_movilidad</td>";
    echo "<td>$post_descripcion</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
    echo "<td><a href='post.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta publicación?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>Eliminar</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('¿Estás seguro de que deseas publicar esta publicación?')\"href='?pub=$post_id'><i class='fa fa-times' style='color: red;'></i>Publicar</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('No hay evidencias aún');
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
            echo "<script>alert('Publicación eliminada con éxito');
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
$query = "SELECT * FROM evidencia WHERE author = '$currentuser' ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_movilidad = $row['movilidad'];
    $post_author = $row['author'];
    $post_date = $row['postdate'];
    $post_image = $row['image'];
    $post_descripcion = $row['descripcion'];
    $post_status = $row['status'];

    echo "<tr>";
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_movilidad</td>";
    echo "<td>$post_descripcion</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Evidencia imagen' ></td>";
    echo "<td><a href='post.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta evidencia?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>borrar</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('¿Estás seguro de que deseas publicar esta evidencia?')\"href='?pub=$post_id'><i class='fa fa-times' style='color: red;'></i>publish</a></td>";

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

$query = "SELECT * FROM evidencia WHERE author = '$currentuser' ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_movilidad = $row['movilidad'];
    $post_author = $row['author'];
    $post_date = $row['postdate'];
    $post_image = $row['image'];
    $post_descripcion = $row['descripcion'];
    $post_status = $row['status'];

    echo "<tr>";
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_movilidad</td>";
    echo "<td>$post_descripcion</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Evidencia Imagen' ></td>";
    echo "<td><a href='post.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta evidencia?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";

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
        $del_query = "DELETE FROM evidencia WHERE id='$post_del' AND author='$currentuser'";
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

