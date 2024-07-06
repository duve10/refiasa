<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
      <i class="hamburger align-self-center"></i>
    </a>
   
    <form class="d-sm-inline-block" method="GET" action="busqueda.cfm"  enctype="multipart/form-data" role="form">
      <div class="input-group input-group-navbar d-none">
        <input type="text" class="form-control" name='search' placeholder="Quick Search" aria-label="Search">
        <button class="btn" type="submit">
          <i class="align-middle" data-feather="search"></i>
        </button>
      </div>
    </form>

    <div class="navbar-collapse collapse">
      <ul class="navbar-nav navbar-align"> 
        <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none show" href="#" data-bs-toggle="dropdown" aria-expanded="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings align-middle"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
            </a>
            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= BASE_URL.'/'.$_SESSION['imagen'] ?>" class="avatar img-fluid rounded me-1" alt="name" />
                <span class="text-dark"><?= $_SESSION['name'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
            
                <a class="dropdown-item passwordChange d-none" href="#">Cambiar Contraseña</a>
                <a class="dropdown-item" href="/logout">Cerrar Session</a>
            </div>
        </li>
      </ul>
    </div>
</nav>