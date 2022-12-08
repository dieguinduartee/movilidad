<?php

    ob_start();
    
    include ('includes/connection.php'); 
    include "includes/adminheader.php";
?>
<body>
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
        </tr>
    <?php }} ?>
    </table>
    
<?php

 include ('includes/adminfooter.php');
?>
<script src="js/jquery.js"></script>

  
<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php 
    $html=ob_get_clean();
    echo $html;
    
    
    require '../vendor/autoload.php';
    // include autoloader
    // require_once '../vendor/dompdf/autoload.inc.php';
    
    use Dompdf\Dompdf;
    
    $dompdf = new Dompdf();
    
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    
    $dompdf->render();
    $dompdf->stream("reporte.pdf", array("Attachment" => true));
    
    ?>