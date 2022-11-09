<?php include 'includes/connection.php';
?>
<?php include 'includes/header.php';?>
        
   <?php include 'includes/navbar.php';?>
        
<br>

<br>
<h1 class="titulo p-1 h1">MOVILIDAD</h1>

<div class="container">
  <div class="row">
      <?php
      include 'includes/sidebar.php';
      ?>
  </div>
</div>

<div class="container content-prin profile">

        <div class="row margin-bottom-10 margin-top-10">
            <div class="headline-center-v2 margin-bottom-10">
                <h1 style="font-size: 30px; color:#fff;"><b>Novedades</b></h1>
                <span class="bordered-icon"><i class="fa fa-files-o" aria-hidden="true"></i></span>
            </div>
                                                                                                    <div class="col-sm-4">
                    <div class="service-block-v1 md-margin-bottom-50" style="background: #fff; border-top: 5px solid #f1c40f;">
                                                    <i class="icon-custom icon-lg rounded-x icon-color-yellow icon-line fa fa-link" style="background: #fff;"></i>
                                                                                                <h5 class="title-v3-bg text-uppercase"><a href="/udestacado/acta-eliminacion-admisiones" style="text-transform:none; color:#464646;"><b>Acta eliminación de documentos de Admisiones y Registro Académico</b></a>
                        </h5>
                        <p>
                            viernes                            ,
                            07                            octubre                            2022                        </p>
                        <a href="/udestacado/acta-eliminacion-admisiones"><b>Leer
                                más</b></a>
                    </div>
                </div>
                                                                                                    <div class="col-sm-4">
                    <div class="service-block-v1 md-margin-bottom-50" style="background: #fff; border-top: 5px solid #3498db;">
                                                    <i class="icon-custom icon-lg rounded-x icon-color-blue icon-line fa fa-link" style="background: #fff;"></i>
                                                                                                <h5 class="title-v3-bg text-uppercase"><a href="/udestacado/boletin_22_CE_22" style="text-transform:none; color:#464646;"><b>El Consejo Electoral de la Universidad Francisco de Paula Santander se permite informar a la comunidad universitaria que participará en la consulta democrática para la conformación de la lista de candidatos al cargo de Rector...</b></a>
                        </h5>
                        <p>
                            jueves                            ,
                            06                            octubre                            2022                        </p>
                        <a href="/udestacado/boletin_22_CE_22"><b>Leer
                                más</b></a>
                    </div>
                </div>
                                                                                                    <div class="col-sm-4">
                    <div class="service-block-v1 md-margin-bottom-50" style="background: #fff; border-top: 5px solid #e74c3c;">
                                                    <i class="icon-custom icon-lg rounded-x icon-color-red icon-line fa fa-link" style="background: #fff;"></i>
                                                                                                <h5 class="title-v3-bg text-uppercase"><a href="/udestacado/suspencion-terminos-administrativos-30septiembre" style="text-transform:none; color:#464646;"><b>Resolución 1775 del 27 de septiembre de 2022. Por la cual se suspenden términos administrativos. </b></a>
                        </h5>
                        <p>
                            miércoles                            ,
                            28                            septiembre                            2022                        </p>
                        <a href="/udestacado/suspencion-terminos-administrativos-30septiembre"><b>Leer
                                más</b></a>
                    </div>
                </div>
                        <div class="col-md-12 margin-top-10">
                <a href="/udestacado/listado_destacados/" class="btn-u btn-brd btn-brd-hover btn-u-light btn-u-sm pull-right tooltips" data-toggle="tooltip" data-placement="left" data-original-title="Más Novedades Anteriores">Ver
                    más <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>

            </div>
        </div>
        <!--/row-->

    </div>

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
    //$post_image = $row['image'];
  $post_status = $row['status'];
  if ($post_status !== 'published') {
    echo "NO MOVILIDADES PLS";
  } else {

    ?>
    <div class="col-md-6">     
   	<div class="card" style="width: auto;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $post_actividad; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $post_author; ?></h6>
    <p class="card-text"><?php echo $post_descripcion?></p>
    <p class=""><?php echo $post_instituto; ?></p>
    <p class=""><?php echo $post_ciudad; ?></p>
    <hr/><hr/>
  </div>
  </div>
</div>
   <?php } }}?>
   </div>
   </div>
   </div>
   </section>
    
   <?php include 'includes/footer.php';?>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>