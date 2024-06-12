<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
      <i class="hamburger align-self-center"></i>
    </a>
   
    <form class="d-sm-inline-block" method="GET" action="busqueda.cfm"  enctype="multipart/form-data" role="form">
      <div class="input-group input-group-navbar">
        <input type="text" class="form-control" name='search' placeholder="Quick Search" aria-label="Search">
        <button class="btn" type="submit">
          <i class="align-middle" data-feather="search"></i>
        </button>
      </div>
    </form>

    <div class="navbar-collapse collapse">
      <ul class="navbar-nav navbar-align"> 
        <li class="nav-item dropdown">
          <a class="nav-link d-none d-sm-inline-block" href="#" >
            <img src="<cfoutput>#userPhoto#</cfoutput>" class="avatar img-fluid rounded me-1" alt="<cfoutput>#name#</cfoutput>" />
            <span class="text-dark"><cfoutput>#name#</cfoutput></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
           
            <a class="dropdown-item passwordChange" href="#">Password</a>
            <a class="dropdown-item" href="process/logout.cfm">Log out</a>
          </div>
        </li>
      </ul>
    </div>
</nav>