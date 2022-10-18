<?php include 'includes/connection.php';
?>
<?php include 'includes/header.php';?>
        
   <?php include 'includes/navbar.php';?>
        
<br>

<br>
<h1 class="titulo">MOVILIDAD</h1>

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


    <div class="container">
        <div class="row">
	        
	        <div class="col-md-8">

<?php
$query = "SELECT * FROM posts WHERE status='published' ORDER BY updated_on DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_assoc($run_query)) {
  $post_title = $row['title'];
  $post_id = $row['id'];
  $post_author = $row['author'];
  $post_date = $row['postdate'];
  $post_image = $row['image'];
  $post_content = $row['content'];
  $post_tags = $row['tag'];
  $post_status = $row['status'];
  if ($post_status !== 'published') {
    echo "NO POST PLS";
  } else {

    ?>
<p><h2><a href="publicposts.php?post=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h2></p>
            <p><h3>Autor <a href="#"><?php echo $post_author; ?> </a></h3></p>
            <p><span class="glyphicon glyphicon-time"></span>Publicado en <?php echo $post_date; ?></p>
            <hr><a href="publicposts.php?post=<?php echo $post_id; ?>">
            <img class="img-responsive img-rounded" src="allpostpics/<?php echo $post_image; ?>" alt="900 * 300"></a>
            <hr>
            <p><?php echo substr($post_content, 0, 300) . '.........'; ?></p>
            <a href="publicposts.php?post=<?php echo $post_id; ?>"><button type="button" class="btn btn-primary">Ver más<span class="glyphicon glyphicon-chevron-right"></span></button></a>
            <hr>
            
            <?php }}}?>

            <hr>
            <ul class="pager">
          <li class="previous"><a href="#"><span class="glyphicon glyphicon-arrow-left"></span> Anteriores</a></li>
          <li class="next"><a href="#">Más nuevos <span class="glyphicon glyphicon-arrow-right"></span></a></li>
        </ul>
          </div>


	        
	        <div class="col-md-4">


	        </div>
	        
        </div>

        
        <?php include 'includes/footer.php';?>
        
    </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>