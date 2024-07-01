<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand navbar-bg heightHead text-center" href="/dashboard">
            Refiasa
        </a>

        <ul class="sidebar-nav pb-5">
            <li class='sidebar-header'>Veterinaria</li>
            <li class='sidebar-item <?= $active == '1'? 'active': '' ?>'>
                <a class='sidebar-link' href="/dashboard">
                    <i class='align-middle' data-feather='sliders'></i>
                    <span class='align-middle'>Dashboard</span>
                </a>
            </li>
            <!--- CITAS --->
            <?php if(in_array($_SESSION['user_profile_id'],[1,3])) : ?>
            <li class='sidebar-item <?= $active == '2' || $active == '3'? 'active': '' ?>'>
                <a data-bs-target="#s26" data-bs-toggle="collapse" class="sidebar-link <?= $active == '2' || $active == '3'? '': 'collapsed' ?>" aria-expanded="false">
                    <i class="align-middle" data-feather="zap"></i>
                    <span class="align-middle">Citas</span>
                </a>
                <ul id="s26" class="sidebar-dropdown list-unstyled collapse <?= $active == '2' || $active == '3'? 'show': '' ?>" data-bs-parent="#sidebar">
                    <li class='sidebar-item <?= $active == '2'? 'active': '' ?>'>
                        <a class="sidebar-link" href="/citas">
                            <!---<i class="align-middle" data-feather="#icon#"></i>--->
                            <span class="align-middle">Editar / Lista</span>
                        </a>
                    </li>
                    <li class='sidebar-item <?= $active == '3'? 'active': '' ?>'>
                        <a class="sidebar-link" href="/citas/registro">
                            <!---<i class="align-middle" data-feather="#icon#"></i>--->
                            <span class="align-middle">Registro</span>
                        </a>
                    </li>
                
                </ul>
            </li>
            <?php endif; ?>
            <!--- ATECIONES --->
            <?php if(in_array($_SESSION['user_profile_id'],[1,2,3])) : ?>
            <li class='sidebar-item <?= $active == '6' || $active == '7'? 'active': '' ?>'>
                <a data-bs-target="#s27" data-bs-toggle="collapse" class="sidebar-link <?= $active == '6' || $active == '7'? '': 'collapsed' ?>" aria-expanded="false">
                    <i class="align-middle" data-feather="activity"></i>
                    <span class="align-middle">Atenciones</span>
                </a>
                <ul id="s27" class="sidebar-dropdown list-unstyled collapse <?= $active == '6' || $active == '7' || $active == '12' ? 'show': '' ?>" data-bs-parent="#sidebar">
                    <li class='sidebar-item <?= $active == '12'? 'active': '' ?>'>
                        <a class="sidebar-link" href="/atenciones/rtatenciones">
                            <!---<i class="align-middle" data-feather="#icon#"></i>--->
                            <span class="align-middle">RT Atenciones</span>
                        </a>
                    </li>
                    <?php if(in_array($_SESSION['user_profile_id'],[1,3])) : ?>
                    <li class='sidebar-item <?= $active == '6'? 'active': '' ?>'>
                        <a class="sidebar-link" href="/atenciones">
                            <!---<i class="align-middle" data-feather="#icon#"></i>--->
                            <span class="align-middle">Editar / Lista</span>
                        </a>
                    </li>
                    <li class='sidebar-item <?= $active == '7'? 'active': '' ?>'>
                        <a class="sidebar-link" href="/atenciones/registro">
                            <!---<i class="align-middle" data-feather="#icon#"></i>--->
                            <span class="align-middle">Registro</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <!--- CALENDARIO --->
            <li class='sidebar-item <?= $active == '8'? 'active': '' ?>'>
                <a class='sidebar-link' href="/calendario">
                    <i class='align-middle' data-feather='calendar'></i>
                    <span class='align-middle'>Calendario</span>
                </a>
            </li>


            <?php if(in_array($_SESSION['user_profile_id'],[1,3])) : ?>
            <li class="sidebar-header">Administracion</li>
            <li class='sidebar-item <?= $active == '4'? 'active': '' ?>'>
                <a class='sidebar-link' href="/clientes">
                    <i class='align-middle' data-feather='smile'></i>
                    <span class='align-middle'>Clientes</span>
                </a>
            </li>

            
            <li class='sidebar-item <?= $active == '5'? 'active': '' ?>'>
                <a class='sidebar-link' href="/mascotas">
                    <i class='align-middle' data-feather='github'></i>
                    <span class='align-middle'>Mascotas</span>
                </a>
            </li>
            <li class='sidebar-item <?= $active == '9'? 'active': '' ?>'>
                <a class='sidebar-link' href="/usuarios">
                    <i class='align-middle' data-feather='users'></i>
                    <span class='align-middle'>Usuarios</span>
                </a>
            </li>
            <li class='sidebar-item <?= $active == '10'? 'active': '' ?>'>
                <a class='sidebar-link' href="/perfiles">
                    <i class='align-middle' data-feather='book'></i>
                    <span class='align-middle'>Perfiles</span>
                </a>
            </li>
            <li class='sidebar-item <?= $active == '11'? 'active': '' ?>'>
                <a class='sidebar-link' href="/servicios">
                    <i class='align-middle' data-feather='wind'></i>
                    <span class='align-middle'>Servicios</span>
                </a>
            </li>
            <li class="sidebar-header">Inventario</li>
            <li class='sidebar-item <?= $active == '13'? 'active': '' ?>'>
                <a class='sidebar-link' href="/productos">
                    <i class='align-middle' data-feather='box'></i>
                    <span class='align-middle'>Productos</span>
                </a>
            </li>
            <li class='sidebar-item'>
                <a class='sidebar-link'>
                    <i class='align-middle' data-feather='heart'></i>
                    <span class='align-middle'>Vacunas</span>
                </a>
            </li>
            <?php endif; ?>


            <?php if(in_array($_SESSION['user_profile_id'],[1,3])) : ?>
            <li class="sidebar-header">Reportes</li>
            <li class='sidebar-item'>
                <a class='sidebar-link'>
                    <i class='align-middle' data-feather='users'></i>
                    <span class='align-middle'>Reporte de Usuarios</span>
                </a>
            </li>
            <li class='sidebar-item'>
                <a data-bs-target="#s28" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="folder"></i>
                    <span class="align-middle">Reportes</span>
                </a>
                <ul id="s28" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class='sidebar-item'>
                        <a class="sidebar-link" href="/">
                            <!---<i class="align-middle" data-feather="#icon#"></i>--->
                            <span class="align-middle">Reporte 1</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>