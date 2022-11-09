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
            </div><br/>
                           <h1 class="titulo">TODAS LAS MOVILIDADES</h1>
                        
                         

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
                        <th>Lugar</th>
                        <th>Actividad</th>
                        <th>Descripción</th>
                        <th>Tipo Movilidad</th>
                        <th>Instituto</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Pais/Ciudad</th>
                        <th>Modalidad</th>
                        <th>Ver</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                        <th>Publicar</th>
                    </tr>
                </thead>
                <tbody>

                 <?php

$query = "SELECT * FROM movilidad ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
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
    <?php if ($post_status == 'published'){
       echo "<tr style='background-color: #74992e;'>";
    }else{
        echo "<tr style='background-color: rgb(255, 255, 128);'>";
    }
        ?>
    <td><?php echo $post_id; ?></td>
    <td><?php echo $post_author; ?></td>
    <td><?php echo $post_lugar; ?></td>
    <td><?php echo $post_actividad; ?></td>
    <td><?php echo $post_descripcion; ?></td>
    <td><?php echo $post_tipo_movilidad; ?></td>
    <td><?php echo $post_instituto; ?></td>
    <td><?php echo $post_fecha_inicio; ?></td>
    <td><?php echo $post_fecha_fin; ?></td>
    <td><?php echo $post_ciudad; ?></td>
    <td><?php echo $post_modalidad; ?></td>
    <?php 
    echo "<td><a class='btn btn-success btn-sm' role='button' href='movilidad.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a class='btn btn-primary btn-sm' role='button' href='editmovilidad.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class='btn btn-danger btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta movilidad?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>Eliminar</a></td>";
    echo "<td><a class='btn btn-warning btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas publicar esta movilidad?')\"href='?pub=$post_id'><i class='fa fa-times' style='color: red;'></i>Publicar</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('No hay Movilidades aún');
    window.location.href= 'publishmovilidades.php';</script>";
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
        $del_query = "DELETE FROM movilidad WHERE id=$post_del";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Movilidad eliminada con éxito');
            window.location.href='movilidades.php';</script>";
        }
        else {
         echo "<script>alert('Ocurrió un error. Intente nuevamente!');</script>";   
        }
        }
        if (isset($_GET['pub'])) {
        $post_pub = mysqli_real_escape_string($conn,$_GET['pub']);
        $pub_query = "UPDATE movilidad SET status='published' WHERE id=$post_pub";
        $run_pub_query = mysqli_query($conn, $pub_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('publicado satisfactoriamente');
            window.location.href='movilidades.php';</script>";
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
                        <th>Lugar</th>
                        <th>Actividad</th>
                        <th>Descripción</th>
                        <th>Tipo Movilidad</th>
                        <th>Instituto</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Ciudad</th>
                        <th>Modalidad</th>
                        <th>Ver</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>

                 <?php
$currentuser = $_SESSION['firstname'];
$query = "SELECT * FROM movilidad WHERE author = '$currentuser' ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
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

    echo "<tr>";
    
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_lugar</td>";
    echo "<td>$post_actividad</td>";
    echo "<td>$post_descripcion</td>";
    echo "<td>$post_tipo_movilidad</td>";
    echo "<td>$post_instituto</td>";
    echo "<td>$post_fecha_inicio</td>";
    echo "<td>$post_fecha_fin</td>";
    echo "<td>$post_ciudad</td>";
    echo "<td>$post_modalidad</td>";
    echo "<td><a class='btn btn-success btn-sm' role='button' href='movilidad.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a class='btn btn-primary btn-sm' role='button' href='editmovilidad.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class='btn btn-danger btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta movilidad?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>borrar</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('¡Aún no has publicado nada! Comienza a publicar ahora');
    window.location.href= 'publishmovilidades.php';</script>";
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
        $del_query = "DELETE FROM movilidad WHERE id='$post_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Publicación borrada satisfactoriamente');
            window.location.href='movilidades.php';</script>";
        }
        else {
         echo "<script>alert('Ocurrió un error. Intente nuevamente!');</script>";   
        }
        }
        if (isset($_GET['pub'])) {
        $post_pub = mysqli_real_escape_string($conn,$_GET['pub']);
        $pub_query = "UPDATE movilidad SET status='published' WHERE id='$post_pub'";
        $run_pub_query = mysqli_query($conn, $pub_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('publicado satisfactoriamente');
            window.location.href='movilidades.php';</script>";
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
                        <th>Lugar</th>
                        <th>Actividad</th>
                        <th>Descripción</th>
                        <th>Tipo Movilidad</th>
                        <th>Instituto</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Ciudad</th>
                        <th>Modalidad</th>
                        <th>Ver</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>

                 <?php
                 $currentuser = $_SESSION['firstname'];

$query = "SELECT * FROM movilidad WHERE author = '$currentuser' ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
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
    $post_modalidad = $row['dependencia'];
    $post_status = $row['status'];
    

    echo "<tr>";
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_lugar</td>";
    echo "<td>$post_actividad</td>";
    echo "<td>$post_descripcion</td>";
    echo "<td>$post_tipo_movilidad</td>";
    echo "<td>$post_instituto</td>";
    echo "<td>$post_fecha_inicio</td>";
    echo "<td>$post_fecha_fin</td>";
    echo "<td>$post_ciudad</td>";
    echo "<td>$post_modalidad</td>";
    echo "<td><a class='btn btn-success btn-sm' role='button' href='movilidad.php?post=$post_id' style='color:green'>Ver</a></td>";
    echo "<td><a class='btn btn-primary btn-sm' role='button' href='editmovilidad.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class='btn btn-danger btn-sm' role='button' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta publicación?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('¡Aún no has publicado nada! Comienza a publicar ahora');
    window.location.href= 'publishmovilidades.php';</script>";
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
        $del_query = "DELETE FROM movilidad WHERE id='$post_del' AND author='$currentuser'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo '
            <div class="alert alert-success" role="alert">
  Movilidad eliminada con exito <a href="#" class="alert-link">Mira tus movilidades</a>.
</div><script>window.location.href="movilidades.php";</script>';
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