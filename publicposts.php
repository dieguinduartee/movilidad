<?php include 'includes/header.php';?>
    <!-- Navigation -->
<?php include 'includes/navbar.php';?>

<section>
    <div class="container">
        <div class="row">
            <?php
                $query = "SELECT * FROM movilidad WHERE status='published' ORDER BY updated_on DESC";
                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($run_query) > 0) {
                while ($row = mysqli_fetch_assoc($run_query)) {
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
                    <hr>
                    <p><h2><span class="ml-1"><?php echo $post_actividad; ?></span></h2></p>
                    <p><h2><i class="glyphicon glyphicon-user ml-1"></i><span class=""><?php echo $post_author; ?></span></h2>
                    <p><h3><i class="glyphicon glyphicon-list-alt ml-1"></i>Movilidad:  <?php echo $post_descripcion; ?></h3></p>
                    <p>Modalidad: <?php
                        if($post_tipo_movilidad == 'entrante'){
                            echo "<i class='glyphicon glyphicon-log-in ml-1'></i><span class='mx-1'>Entrante</span>";
                        }else{
                            echo "<i class='glyphicon glyphicon-log-out ml-1'></i><span class='mx-1'>Saliente</span>";
                        }?> -  <?php $post_modalidad;?></p>
                    <p><i class="glyphicon glyphicon-globe ml-1"></i>Lugar: <?php echo $post_ciudad;?></p>
                    <p><span class="glyphicon glyphicon-time ml-1"></span>Fecha de inicio de movilidad <?php echo $post_fecha_inicio; ?></p>
                    <p><span class="glyphicon glyphicon-time ml-1"></span>Fecha de fin de movilidad <?php echo $post_fecha_fin; ?></p>
                    <p><i class="glyphicon glyphicon-map-marker ml-1"></i>Institución: <?php echo $post_instituto; ?></p>
                    <p>Modalidad: <?php echo $post_modalidad;?></p>
                    <?php
                    if($post_modalidad == 'presencial'){
                        echo "<i class='glyphicon glyphicon-ok ml-1'></i>Modalidd Presencial";
                    }else{
                        echo "<i class='glyphicon glyphicon-remove ml-1'></i>Modalidad Virtual";
                    }
                    ?>

                        <div class="row">
                                <?php
                                $query = "SELECT e.id, e.image, e.descripcion FROM movilidad m INNER JOIN evidencia e ON m.id = e.movilidad WHERE m.status = 'published' AND m.id = $post_id;";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn)) ;
                                if (mysqli_num_rows($run_query) > 0 ) {
                                    ?>
                                    <div class="col-6"><?php
                                    while ($row = mysqli_fetch_array($run_query)) {
                                        $ev_id = $row['id'];
                                        $ev_image = $row['image'];
                                        $ev_descripcion = $row['descripcion'];
                                        ?>
                                        <div class="col-6">
                                            <div class="card" style="width: 100%;">
                                                <img class="card-img-top" src="allpostpics/<?php echo $ev_image; ?>" alt="Evidencia de movilidad">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $post_tipo_movilidad; ?></h5>
                                                    <p class="card-text"><?php echo $ev_descripcion; ?></p>
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                                </div>
                                            </div>
                                        </div>

                                    <?php }
                                    echo "</div>";
                                } else { echo "<div class='alert alert-warning' role='alert'>No hay evidencias!</div>"; } ?>
                            </div>
                        </div>


    <?php }} ?>
        </div>
   </div>
   </section>

    <?php include 'includes/footer.php';?>
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>