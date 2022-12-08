<?php include 'includes/adminheader.php';
?>
<div id="wrapper">

    <?php include 'includes/adminnav.php'; ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row my-1">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Agregar Movilidad
                    </h1>
                    <?php
                    if (isset($_POST['publish'])) {
                        require "../gump.class.php";
                        $gump = new GUMP();

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

                        if ($validated_data === false) {
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
                            $post_modalidad = $_POST['modalidad'];
                            
                            
                            if ($_SESSION['role'] == 'superadmin') {
                                $post_author = $_POST['author'];
                                $post_tipoauthor = $_POST['tipo_autor'];
                            }
                            if ($_SESSION['role'] == 'admin') {
                                $$post_tipoauthor = 'Docente';
                            }
                            if ($_SESSION['role'] == 'user') {
                                $$post_tipoauthor = 'Estudiante';
                            }
                            
                        } else {
                            $post_actividad = $_POST['actividad'];
                            $post_descripcion = $_POST['descripcion'];
                            $post_lugar = $_POST['lugar'];
                            $post_tipo_movilidad = $_POST['tipo_movilidad'];
                            $post_instituto = $_POST['instituto'];
                            $post_fecha_inicio = $_POST['fecha_inicio'];
                            $post_fecha_fin = $_POST['fecha_fin'];
                            $post_ciudad = $_POST['ciudad'];
                            $post_modalidad = $_POST['modalidad'];
                            
                            if (isset($_SESSION['firstname'])) {
                                $post_author = $_SESSION['firstname'];
                            }
                            
                            if ($_SESSION['role'] == 'superadmin') {
                                $post_author = $_POST['author'];
                                $post_tipoauthor = $_POST['tipo_autor'];
                            }
                            if ($_SESSION['lastname'] == 'Docente') {
                                $post_tipoauthor = 'Docente';
                            }
                            if ($_SESSION['lastname'] == 'Estudiante') {
                                $post_tipoauthor = 'Estudiante';
                            }
                            
                            $post_date = date('Y-m-d');
                            $post_status = 'draft';

                            $query = "INSERT INTO movilidad (author,tipo_author,actividad,descripcion_actividad, lugar, tipo_movilidad, instituto,fecha_inicio, fecha_fin, ciudad, modalidad,postdate, status) VALUES ('$post_author','$post_tipoauthor','$post_actividad' , '$post_descripcion' , '$post_lugar', '$post_tipo_movilidad', '$post_instituto','$post_fecha_inicio', '$post_fecha_fin', '$post_ciudad', '$post_modalidad',  '$post_date', '$post_status');";
                            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                            if (mysqli_affected_rows($conn) > 0) {
                                echo "<script> alert('Movilidad publicada con éxito. Se publicará después de que el administrador lo apruebe');
            window.location.href='movilidades.php';</script>";
                            } else {
                                "<script> alert('Error al agregar movilidad ... intente de nuevo');</script>";
                            }
                        }
                    }
                    ?>

                    <form role="form" action="" method="POST" enctype="multipart/form-data" class="colores">
                        <?php if ($_SESSION['role'] == 'superadmin') { ?>
                            <div class="form-group">
                                <label for='tipo_autor'>Usuario de Movilidad *</label>
                                <select class="form-control" name="tipo_autor" id="tipo_autor" required>
                                    <option value='Docente'>Docente</option>
                                    <option value='Estudiante'>Estudiante</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="autor">Nombre del usuario *</label>
                                <input type="text" name="author" id="author" placeholder = "Ingrese el nombre del usuario" value= "<?php
                        if (isset($_POST['author'])) {
                            echo $post_author;
                        }
                            ?>"  class="form-control" required>
                            </div>

<?php } ?>
                        <div class="form-group">
                            <label for='lugar'>Ámbito *</label>
                            <select class="form-control" name="lugar" id="lugar" *>
                                <option value='Local'>Local</option>
                                <option value='Nacional'>Nacional</option>
                                <option value='Internacional'>Internacional</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for='tipo_movilidad'>Tipo de Movilidad *</label>
                            <select class="form-control" name="tipo_movilidad" id="tipo_movilidad" required>
                                <option value='Entrante'>Entrante</option>
                                <option value='Saliente'>Saliente</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="post_actividad">Actividad *</label>
                            <input type="text" name="actividad" placeholder = "Ingresa la actividad " value= "<?php
                                   if (isset($_POST['actividad'])) {
                                       echo $post_actividad;
                                   }
                                   ?>"  class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="post_descripcion">descripción *</label>
                            <input type="text" name="descripcion" placeholder = "Ingresa la descripción " value= "<?php
                                   if (isset($_POST['descripcion'])) {
                                       echo $post_descripcion;
                                   }
                                   ?>"  class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="post_instituto">Instituto *</label>
                            <input type="text" name="instituto" placeholder = "Ingresa la institución " value= "<?php
                                   if (isset($_POST['institucion'])) {
                                       echo $post_instituto;
                                   }
                                   ?>"  class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="post_fecha_inicio">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" placeholder = "Ingresa la fecha de inicio " value= "<?php
                            if (isset($_POST['fecha_inicio'])) {
                                echo $post_fecha_inicio;
                            }
                            ?>"  class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="post_fecha_fin">Fecha Fin</label>
                            <input type="date" name="fecha_fin" placeholder = "Ingresa la fecha de fin " value= "<?php
                            if (isset($_POST['fecha_fin'])) {
                                echo $post_fecha_fin;
                            }
                            ?>"  class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="post_ciudad">Ciudad/Pais *</label>
                            <input type="text" name="ciudad" placeholder = "Ingresa la Ciudad " value= "<?php
                            if (isset($_POST['ciudad'])) {
                                echo $post_ciudad;
                            }
                            ?>"  class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="modalidad">Modalidad *</label>
                            <select class="form-control" name="modalidad" id="movilidad">
                                <option value='Presencial'>Presencial</option>
                                <option value='Virtual'>Virtual</option>
                            </select>
                        </div>


                        <button type="submit" name="publish" class="btn btn-primary" value="Publish Post">Agregar Movilidad</button>

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