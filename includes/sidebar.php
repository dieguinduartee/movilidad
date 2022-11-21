<div class="container">
    <div class="row">
        <div class="well registro">
            <h4>Ingresar</h4>
            <form method="POST" action="login.php">
                <div class="">
                    <input name="user_name" type="text" class="form-control" placeholder="Usuario" required>
                    <br>
                </div>

                <div class="input-group">
                    <input name="user_password" type="password" class="form-control" placeholder="Contraseña" required>
                    <br>
                    <span class="input-group-btn">
                <button name="login" class="btn btn-primary" type="submit">
                    Iniciar sesión
                </button>
            </span>
                </div>
            </form>
        </div>
    </div>
</div>