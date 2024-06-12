<cfinclude template="security.cfm">


<cfparam  name="search" default=''>

<cfset active = 0>
<cfinclude template="includes/header.cfm">

<body>
    <div class='wrapper'>
        <cfinclude template="includes/sidebar.cfm">
        <div class='main'>
            <cfinclude template="includes/navbar.cfm">


            <main class='content'>
                <div class='container-fluid p-0'>

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h1 class="h3 mb-3"><cfoutput><strong>Quick Search: #search#</strong></cfoutput> </h1>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="col-12">
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                                <label for="name" class="fw-bold">Write Name / Last Name:</label>
                                                <input type="text" class="form-control" name="name" value="<cfoutput>#search#</cfoutput>" id="name" placeholder="Search by word in Names / Last Names">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class='col-12'>
                            <div class='card table-responsive viewZoom'>
                                <div class='card-body'>
                                    <table id='tableBusqueda' class='table table-bordered table-hover' style='width:100%'>
                                        <thead class='tableHead'>
                                            <tr class='rounded-top'>
                                                <th scope='col' class='text-center'>Photo</th>
                                                <th scope='col'>FullName</th>
                                                <th scope='col'class='text-center'>Autorization</th>
                                                <th scope='col'class='text-center'>View</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                   



                </div>
            </main>
        </div>
    </div>

    <div class="loading d-none">Loading&#8230;</div>
    <script src="js/app.js"></script>
    <script src="js/clinicalMedico.js"></script>
</body>

</html>