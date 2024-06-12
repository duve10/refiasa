
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand navbar-bg heightHead" href="##">
            <img src="img/general/LOGO-NEW.png" alt="Logo Markham">
        </a>

        <ul class="sidebar-nav pb-5">
            <li class='sidebar-header'>Medical Information</li>
            <li class='sidebar-item <cfoutput><cfif active EQ 1>active</cfif></cfoutput>'>
                <a class='sidebar-link' href="/">
                    <i class='align-middle' data-feather='sliders'></i>
                    <span class='align-middle'>Dashboard</span>
                </a>
            </li>
            <li class='sidebar-item <cfoutput><cfif active EQ 2>active</cfif></cfoutput>'>
                <a class='sidebar-link' href="information.cfm">
                    <i class='align-middle' data-feather='heart'></i>
                    <span class='align-middle'>Information Student</span>
                </a>
            </li>
            <li class='sidebar-item <cfoutput><cfif active EQ 3>active</cfif></cfoutput>'>
                <a class='sidebar-link' href="informationStaff.cfm">
                    <i class='align-middle' data-feather='briefcase'></i>
                    <span class='align-middle'>Information Staff</span>
                </a>
            </li>
            <li class="sidebar-header">Administration</li>
            <li class='sidebar-item'>
                <a class='sidebar-link'>
                    <i class='align-middle' data-feather='users'></i>
                    <span class='align-middle'>Recorded Users</span>
                </a>
            </li>
            <li class='sidebar-item'>
                <a data-bs-target="#s26" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="folder"></i>
                    <span class="align-middle">Report</span>
                </a>
                <ul id="s26" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" >
                    <li class='sidebar-item'>
                        <a class="sidebar-link" href="/">
                            <!---<i class="align-middle" data-feather="#icon#"></i>--->
                            <span class="align-middle">Report 1</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </nav>
