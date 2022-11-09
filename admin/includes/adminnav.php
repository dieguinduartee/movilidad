<nav class="navbar navbar-light navbar-fixed-top barra" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">MOVILIDAD</a>
    </div>

    <ul class="nav navbar-right top-nav barra">
        <li><a href="index.php">Inicio</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="./profile.php?section=<?php echo $_SESSION['username']; ?>"><i
                            class="fa fa-fw fa-user"></i> Perfil</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav barra">
            <li>
                <a href="index.php" class="active"><i class="fa fa-fw fa-dashboard"></i> Panel de Control</a>
            </li>

            <li>
                <a href="javascript:;" class="dropdown-toggle" data-toggle="collapse" data-target="#movilidad"><i
                        class="fa fa-fw fa-file-text"></i> Movilidad <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="movilidad" class="collapse">
                    <li>
                        <a href="./movilidades.php">Ver todos las movilidades</a>
                    </li>
                    <li>
                        <a href="./publishmovilidades.php">Agregar una nueva movilidad</a>
                    </li>
                </ul>
            <li>
                <a href="javascript:;" class="dropdown-toggle" data-toggle="collapse" data-target="#posts"><i
                        class="fa fa-fw fa-file-text"></i> Evidencias <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts" class="collapse">
                    <li>
                        <a href="./posts.php">Ver todas las evidencias</a>
                    </li>
                    <li>
                        <a href="./publishnews.php">Agregar una nueva evidencias</a>
                    </li>
                </ul>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-users"></i>
                    Usuarios <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="user" class="collapse">
                    <li>
                        <a href="./users.php">Ver todos los Usuarios</a>
                    </li>
                    <li>
                        <a href="adduser.php">Agregar un nuevo Usuario</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./profile.php?section=<?php echo $_SESSION['username']; ?>"><i class="fa fa-fw fa-user"></i>
                    Perfil</a>
            </li>
        </ul>
    </div>
</nav>