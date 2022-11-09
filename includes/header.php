<?php 
include('connection.php');

session_start();
if (isset($_SESSION['role'])) {
	echo "<script>window.location.href='admin/';</script>";	
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Movilidad en Ingeniería de Sistemas</title>
<link rel="icon" type="image/jpg" href="image/favicon.ico"/>
 <script src="admin/js/tinymce/tinymce.min.js"></script>
    <script src="admin/js/tinymce/script.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/material-icons.css">
	<link href="admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/cms-home.css">
</head>
<body>
