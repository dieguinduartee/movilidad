<?php include 'includes/header.php';?>
        <!-- Navigation Bar -->
   <?php include 'includes/navbar.php';?>
        <!-- Navigation Bar -->
 <div class="container">
 <div class="row">

 </div>
 	<div class="row">
		<h1 class="titulo">Registrarme</h1>
 		<div class="col-xs-2"></div>
 		<div class="col-xs-8">
 		 			<form method="POST" action="registerprocess.php">
				<div class="form-group">
					<label for="username">Codigo</label>
					<input type="text" name="username" value= "<?php if(isset($_POST['register'])) { echo $_POST['username']; } ?>" class="form-control" required>
				</div>

				<div class="form-group">
					<label>Nombre Completo </label>
					<input type="text" name="firstname" value= "<?php if(isset($_POST['register'])) { echo $_POST['firstname']; } ?>"class="form-control" required>
				</div>



				
<div class="form-group">
<label>Rol</label>
<select class="form-control" name="lastname" id="">
		    <label for="user_role">Rol a</label>
		   <?php
echo "<option value='Docente'>Docente</option>";
echo "<option value='Estudiante'>Estudiante</option>";
?>
</select>


			


				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" value= "<?php if(isset($_POST['register'])) { echo $_POST['email']; } ?>"class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" name="password" value= "<?php if(isset($_POST['register'])) { echo $_POST['password']; } ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Confirmar Contraseña</label>
					<input type="password" name="cpassword" value= "<?php if(isset($_POST['register'])) { echo $_POST['cpassword']; } ?>"class="form-control" required>
				</div>
<button type="submit" class="btn btn-primary" name="register">Registrar</button>
 			</form>

 		</div>
 		<div class="col-xs-2"></div>
 	</div>

 </div>
</body>
</html>