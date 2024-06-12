<cfinclude template="security.cfm">


<cfquery name='getYear' datasource="#dbMarks#">

    SELECT
        CYEAR
    FROM
        YEAR
</cfquery>

<cfset active = 2>
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
                            <h1 class="h3 mb-3"><cfoutput><strong>Students List</strong></cfoutput> </h1>
                        </div>
                </div>




                    <div class='row'>
                        <div class="col-12">
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row'>
                                        <div class='col-md-10 row'>
                                            <div class='col-12'>
                                                <div class='col-md-4 mb-2'>
                                                    <label for="local" class="fw-bold">Local:</label>
                                                    <div class='flex'>
                                                        <select id="local" name="local" class="form-select">
                                                            <option value="">All</option>
                                                            <option value="E">Early Year</option>
                                                            <option value="L">Primary</option>
                                                            <option value="U">Secondary</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row'>
                                        <div class='col-md-12 row'>
                                            <div class='col-md-4 mb-2'>
                                                <label for="year" class="fw-bold">Year:</label>
                                                <select id="year" name="year" class="form-select">
                                                    <option value="">All Year</option>

                                                    <cfoutput query='getYear'>
                                                        <option value="#cyear#">#cyear#</option>
                                                    </cfoutput>
                                                </select>
                                            </div>

                                            <div class='col-md-4 mb-2'>
                                                <label for="group" class="fw-bold">Group:</label>
                                                <select id="group" name="group" class="form-select">
                                                    <option value="">All Group</option>
                                                    <option value="E">Early Year</option>
                                                    <option value="L">Primary</option>
                                                    <option value="U">Secondary</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row'>
                                        <div class='col-md-12 row'>
                                            <div class='col-md-8 mb-2'>
                                                <label for="name" class="fw-bold">Description:</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Search by word in Names">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label class="fw-bold d-block">&nbsp;</label>
                                            <button type="button" class="btn btn-primary btnColorGeneral drawTable">Search</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class='col-12'>
                            <div class='card table-responsive viewZoom'>
                                <div class='card-body'>
                                    <table id='tableEvents' class='table table-bordered table-hover' style='width:100%'>
                                        <thead class='tableHead'>
                                            <tr class='rounded-top'>
                                                <th scope='col' class='text-center'>Photo</th>
                                                <th scope='col'>FullName</th>
                                                <th scope='col'class='text-center'>Tutgroup</th>
                                                <th scope='col'class='text-center'>Autorization</th>
                                                <th scope='col'class='text-center'>View</th>
                                                <th scope='col'class='text-center'>Form</th>
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