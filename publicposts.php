<?php include 'includes/header.php';?>
    <!-- Navigation -->
<?php include 'includes/navbar.php';?>

<section>

    <h2 class="text-center h2">Movilidades</h2>
    <div class="container">
        <?php
        $query = "SELECT * FROM movilidad WHERE status='published';";
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
                ?>
                <div class="row mt-1 mb-2">
                    <hr>
                    <p><h2 class="font-weight-bold"><span class="ml-1"><?php echo $post_actividad; ?></span></h2></p>
                    <p><h2><i class="glyphicon glyphicon-user ml-1 text-info"></i><span class="font-weight-bold"><?php echo $post_author; ?></span></h2>
                    <p><h3 class="font-weight-bold"><i class="fa fa-tasks ml-1 text-info"></i><?php echo $post_descripcion; ?></h3></p>
                    <p>Movilidad: <?php
                        if($post_tipo_movilidad == 'entrante'){
                            echo "<i class='glyphicon glyphicon-log-in ml-1 text-info'></i><span class='mx-1'>Entrante</span>";
                        }else{
                            echo "<i class='glyphicon glyphicon-log-out ml-1 text-info'></i><span class='mx-1'>Saliente</span>";
                        }?> -  <?php $post_modalidad;?></p>
                    <p><i class="fa fa-globe ml-1 text-info"></i>Lugar: <?php echo $post_ciudad;?></p>
                    <p><span class="fa fa-calendar-o ml-1 text-info"></span> <?php echo $post_fecha_inicio; ?> <span class="fa fa-calendar-o ml-1"></span><?php echo $post_fecha_fin; ?></p>
                    <p><i class="fa fa-university ml-1 text-info"></i><?php echo $post_instituto; ?></p>
                    <p>Modalidad:
                        <?php
                        if($post_modalidad == 'Presencial'){
                            echo "<i class='fa fa-street-view ml-1 text-info'></i>Modalidad Presencial";
                        }else{
                            echo "<i class='fa fa-video-camera ml-1 text-info'></i>Modalidad Virtual";
                        }
                        ?></p>

                    <div class="row">
                        <h2 class="text-center h3">Evidencias:</h2>
                        <?php
                        $query2 = "SELECT e.id, e.image, e.descripcion FROM movilidad m INNER JOIN evidencia e ON m.id = e.movilidad WHERE m.id = '$post_id' AND e.status = 'published';";
                        $run_query2 = mysqli_query($conn, $query2) or die(mysqli_error($conn)) ;
                        if (mysqli_num_rows($run_query2) > 0 ) {
                            while ($row = mysqli_fetch_array($run_query2)) {
                                $ev_id = $row['id'];
                                $ev_image = $row['image'];
                                $ev_descripcion = $row['descripcion'];
                                ?>
                                <div class="col-12 col-md-6">
                                    <div class="card" style="width: 100%;">
                                        <img class="card-img-top" src="allpostpics/<?php echo $ev_image; ?>" alt="Evidencia de movilidad" width="100%">
                                        <div class="card-body">
                                            <h5 class="card-title text-center text-muted"><?php echo $ev_descripcion; ?></h5>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                        } else { echo "<div class='alert alert-warning' role='alert'>No hay evidencias!</div>"; } ?>
                    </div>
                </div>


            <?php }} else { echo "<div class='alert alert-warning' role='alert'>No hay movilidades!</div>"; } ?>
    </div>
</section>
    <?php include 'includes/footer.php';?>
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>