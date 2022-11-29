<?php
include('connection.php');
session_start();
if (isset($_SESSION['role'])) {
	
}
else {
    echo "<script>alert('Necesitas ingresar primero');
    window.location.href='../index.php';</script>";	
}

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Movilidad del programa Ingeniería de Sistemas">
    <meta name="author" content="">

    <title>Movilidad - <?php echo $_SESSION['username']; ?></title>
    <link rel="icon" type="image/png" href="../image/favicon.ico">
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.css">
 	<script src="js/tinymce/tinymce.min.js"></script>
    <script src="js/tinymce/script.js"></script>
    <link rel="stylesheet" href="css/material-icons.css">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/cms-home.css" rel="stylesheet">

</head>

<body>
