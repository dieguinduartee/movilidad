<?php include 'includes/adminheader.php';
?>

    <div id="wrapper">
       
       <?php include 'includes/adminnav.php';?>
        <div id="page-wrapper">

            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            UFPS MOVILIDAD  - 
                            <small><?php echo $_SESSION['firstname']; ?></small>
                        </h1>

                    </div>
                </div>
                
<div class="row">
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                    <?php
                                    if($_SESSION['role'] == 'superadmin') {
                                        $query = "SELECT * FROM movilidad";
                                    }else{
                                        $currentuser = $_SESSION['firstname'];
                                        $query = "SELECT * FROM movilidad WHERE author = '$currentuser';";
                                    }
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$post_num = mysqli_num_rows($result);
echo "<div class='text-right huge'>{$post_num}</div>";
?>

                                        <div class="text-right">MOVILIDADES</div>

                                    </div>
                                </div>
                            </div>
                            <a href="movilidades.php">
                                <div class="panel-footer">
                                    <span class="pull-left">VER TODAS LAS EXPERIENCIAS DE MOVILIDAD</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                    <?php
                                    if($_SESSION['role'] == 'superadmin') {
                                        $query = "SELECT * FROM evidencia";
                                    }else{
                                        $currentuser = $_SESSION['firstname'];
                                        $query = "SELECT * FROM evidencia INNER JOIN movilidad ON evidencia.movilidad = movilidad.id WHERE movilidad.author = '$currentuser';";
                                    }
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$post_num = mysqli_num_rows($result);
echo "<div class='text-right huge'>{$post_num}</div>";
?>

                                        <div class="text-right">EVIDENCIAS</div>

                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">VER TODAS LAS EVIDENCIAS</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

    <?php if($_SESSION['role'] == 'superadmin') { ?>

                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <?php
                                        $query = "SELECT * FROM users";
                                        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                        $user_num = mysqli_num_rows($result);
                                        echo "<div class='text-right huge'>{$user_num}</div>";
?>


                                        <div class="text-right">USUARIOS</div>

                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">VER USUARIOS</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
                <?php } ?>
            
        </div>
</div>
</div>
        
   <?php include 'includes/adminfooter.php';?>

    <script src="js/jquery.js"></script>

  
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
